<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['orderItems', 'assignedDriver', 'delivery'])
            ->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->byStatus($request->status);
        }
        
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Pagination for real app, but for demo get all
        $orders = $query->get();
        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load(['orderItems.menuItem', 'assignedDriver', 'delivery']));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pendiente,preparando,listo,entregado,cancelado',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $order->update($validated);

        // If status updated and has delivery, update delivery status too if applicable
        if ($order->type === 'domicilio' && $order->delivery) {
             if ($validated['status'] === 'entregado') {
                 $order->delivery->update([
                     'status' => 'entregado',
                     'delivered_at' => now()
                 ]);
             }
        }

        return new OrderResource($order->load(['assignedDriver', 'delivery']));
    }
}
