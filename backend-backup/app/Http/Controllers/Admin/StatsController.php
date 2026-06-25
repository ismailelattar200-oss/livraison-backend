<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $pedidosHoy = Order::whereDate('created_at', $today)->count();
        $pedidosPendientes = Order::pending()->count();
        $entregasEnCamino = Delivery::where('status', 'en_camino')->count();
        $pedidosEntregadosHoy = Order::whereDate('created_at', $today)
            ->where('status', 'entregado')
            ->count();
        
        $ingresosHoy = Order::whereDate('created_at', $today)
            ->where('status', '!=', 'cancelado')
            ->sum('total');

        return response()->json([
            'pedidos_hoy' => $pedidosHoy,
            'pedidos_pendientes' => $pedidosPendientes,
            'entregas_en_camino' => $entregasEnCamino,
            'pedidos_entregados_hoy' => $pedidosEntregadosHoy,
            'ingresos_hoy' => (float) $ingresosHoy,
        ]);
    }
}
