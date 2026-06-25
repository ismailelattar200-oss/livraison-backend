<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $isStaff = $request->user()?->role === 'staff';

        // 3. DONUT CHART (Statut des Livraisons / Commandes)
        $statusCounts = [
            'En attente' => Order::where('status', 'en_attente')->count(),
            'En préparation' => Order::where('status', 'en_preparation')->count(),
            'Prête' => Order::where('status', 'pret')->count(),
            'En cours' => Order::where('status', 'en_cours')->count(),
            'Livré' => Order::where('status', 'livre')->count(),
        ];

        if ($isStaff) {
            // STAFF (Cuisine) gets ONLY kitchen data
            // Calculate Temps Moyen de Préparation (mocked logic or simple average for today)
            // Assuming we just use a realistic static value or simple calculation for demo
            $tempsMoyen = "18 min"; // In a real app, this would be AVG(time_ready - time_started)

            return response()->json([
                'success' => true,
                'data' => [
                    'cards' => [
                        'nouvelles' => [
                            'value' => $statusCounts['En attente']
                        ],
                        'en_preparation' => [
                            'value' => $statusCounts['En préparation']
                        ],
                        'pretes' => [
                            'value' => $statusCounts['Prête']
                        ],
                        'temps_moyen' => [
                            'value' => $tempsMoyen
                        ]
                    ],
                    'delivery_status' => [
                        'Nouvelles' => $statusCounts['En attente'],
                        'En préparation' => $statusCounts['En préparation'],
                        'Prêtes' => $statusCounts['Prête']
                    ],
                    'recent_orders' => Order::orderBy('created_at', 'desc')->take(6)->get()->map(function ($order) {
                        return [
                            'id' => $order->id,
                            'order_number' => $order->order_number,
                            'status' => $order->status,
                            'time' => $order->created_at->format('H:i')
                        ];
                    }),
                    'alerts' => [] // No revenue/delivery alerts for kitchen
                ]
            ]);
        }

        // ADMIN gets full data
        // 1. STAT CARDS
        // Revenue (Chiffre d'Affaires)
        $revenueToday = Order::whereDate('created_at', $today)->where('status', '!=', 'annule')->sum('total');
        $revenueYesterday = Order::whereDate('created_at', $yesterday)->where('status', '!=', 'annule')->sum('total');
        $revenueTrend = $revenueYesterday > 0 ? (($revenueToday - $revenueYesterday) / $revenueYesterday) * 100 : ($revenueToday > 0 ? 100 : 0);

        // Orders (Commandes)
        $ordersToday = Order::whereDate('created_at', $today)->count();
        $ordersYesterday = Order::whereDate('created_at', $yesterday)->count();
        $ordersTrend = $ordersYesterday > 0 ? (($ordersToday - $ordersYesterday) / $ordersYesterday) * 100 : ($ordersToday > 0 ? 100 : 0);

        // Menu Items (Plats au Menu)
        $menuItemsTotal = MenuItem::count();
        $menuItemsAddedToday = MenuItem::whereDate('created_at', $today)->count();

        // Active Drivers (Livreurs Actifs)
        $activeDrivers = User::where('role', 'delivery')->count(); // simplified

        // 2. LINE CHART (Évolution des Commandes - last 7 days)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dayRevenue = Order::whereDate('created_at', $date)->where('status', '!=', 'annule')->sum('total');
            $dayOrders = Order::whereDate('created_at', $date)->count();
            
            $chartData[] = [
                'day' => $date->format('d/m'),
                'revenue' => (float) $dayRevenue,
                'orders' => $dayOrders
            ];
        }

        // 4. RECENT ORDERS
        $recentOrders = Order::orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'customer_name' => $order->customer_name,
                    'total' => (float) $order->total,
                    'status' => $order->status,
                    'time' => $order->created_at->format('H:i')
                ];
            });

        // 5. ALERTS
        $alerts = [];
        
        // 1. Commandes en retard (> 20 min en attente)
        $pendingDelayed = Order::where('status', 'en_attente')
            ->where('created_at', '<', Carbon::now()->subMinutes(20))
            ->count();
        if ($pendingDelayed > 0) {
            $alerts[] = [
                'id' => 1,
                'type' => 'warning',
                'title' => 'Commandes en retard',
                'message' => "{$pendingDelayed} commande(s) en attente depuis > 20 min.",
                'count' => $pendingDelayed
            ];
        }

        // 2. Livreurs indisponibles (hors service avec commandes actives)
        $unavailableDriversCount = 0;
        $unavailableDriverNames = [];
        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'is_available')) {
            $unavailableDrivers = User::where('role', 'delivery')
                ->where('is_available', false)
                ->whereHas('assignedOrders', function($q) {
                    $q->whereNotIn('status', ['livre', 'annule']);
                })->get();
            $unavailableDriversCount = $unavailableDrivers->count();
            $unavailableDriverNames = $unavailableDrivers->pluck('name')->toArray();
        }

        if ($unavailableDriversCount > 0) {
            $namesStr = implode(', ', $unavailableDriverNames);
            $alerts[] = [
                'id' => 2,
                'type' => 'danger',
                'title' => 'Livreurs indisponibles',
                'message' => "{$unavailableDriversCount} livreur(s) hors service avec des commandes ({$namesStr}).",
                'count' => $unavailableDriversCount
            ];
        }

        // 3. Plats indisponibles
        $unavailableItems = MenuItem::where('is_available', false)->count();
        if ($unavailableItems > 0) {
            $alerts[] = [
                'id' => 3,
                'type' => 'danger',
                'title' => 'Plats indisponibles',
                'message' => "{$unavailableItems} plat(s) actuellement indisponible(s).",
                'count' => $unavailableItems
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'cards' => [
                    'revenue' => [
                        'value' => $revenueToday,
                        'trend' => round($revenueTrend, 1)
                    ],
                    'orders' => [
                        'value' => $ordersToday,
                        'trend' => round($ordersTrend, 1)
                    ],
                    'menu_items' => [
                        'total' => $menuItemsTotal,
                        'added_today' => $menuItemsAddedToday
                    ],
                    'drivers' => [
                        'active' => $activeDrivers
                    ]
                ],
                'chart_data' => $chartData,
                'delivery_status' => $statusCounts,
                'recent_orders' => $recentOrders,
                'alerts' => $alerts
            ]
        ]);
    }
}
