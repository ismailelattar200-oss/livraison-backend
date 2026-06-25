<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Http\Resources\DeliveryResource;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $query = Delivery::with(['order', 'deliveryPerson'])
            ->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('delivery_person_id')) {
            $query->where('delivery_person_id', $request->delivery_person_id);
        }

        $deliveries = $query->get();
        return DeliveryResource::collection($deliveries);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'delivery_person_id' => 'required|exists:users,id',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        if ($order->type !== 'domicilio') {
            return response()->json(['message' => 'Order must be of type domicilio'], 422);
        }

        $delivery = Delivery::updateOrCreate(
            ['order_id' => $validated['order_id']],
            [
                'delivery_person_id' => $validated['delivery_person_id'],
                'status' => 'asignado',
                'assigned_at' => now(),
            ]
        );

        $order->update([
            'assigned_to' => $validated['delivery_person_id'],
        ]);

        return new DeliveryResource($delivery->load(['order', 'deliveryPerson']));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'status' => 'required|in:asignado,recogido,en_camino,entregado',
            'notes' => 'nullable|string',
        ]);

        $updateData = ['status' => $validated['status']];

        if ($validated['status'] === 'recogido' && !$delivery->picked_up_at) {
            $updateData['picked_up_at'] = now();
        } elseif ($validated['status'] === 'entregado' && !$delivery->delivered_at) {
            $updateData['delivered_at'] = now();
            // Sync order status
            $delivery->order->update(['status' => 'entregado']);
        }

        if (isset($validated['notes'])) {
            $updateData['notes'] = $validated['notes'];
        }

        $delivery->update($updateData);

        return new DeliveryResource($delivery->load(['order', 'deliveryPerson']));
    }
}
