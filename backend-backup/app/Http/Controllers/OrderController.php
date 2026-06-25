<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'nullable|string|max:255',
            'type' => 'required|in:recogida,domicilio',
            'pickup_time' => 'nullable|date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.name' => 'required|string',
            'items.*.image_url' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validated['type'] === 'domicilio' && empty($validated['customer_address'])) {
            return response()->json(['message' => 'La dirección es obligatoria para pedidos a domicilio'], 422);
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth('sanctum')->id(),
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'],
                'customer_address' => $validated['customer_address'],
                'pickup_time' => $validated['pickup_time'],
                'items' => $validated['items'],
                'subtotal' => $validated['subtotal'],
                'total' => $validated['total'],
                'status' => 'pendiente',
                'type' => $validated['type'],
                'notes' => $validated['notes'],
            ]);

            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            DB::commit();

            return new OrderResource($order);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating order: ' . $e->getMessage());
            return response()->json(['message' => 'Error al procesar el pedido'], 500);
        }
    }

    public function show($order_number)
    {
        $order = Order::with(['orderItems.menuItem', 'assignedDriver', 'delivery'])
            ->where('order_number', $order_number)
            ->firstOrFail();

        return new OrderResource($order);
    }
}
