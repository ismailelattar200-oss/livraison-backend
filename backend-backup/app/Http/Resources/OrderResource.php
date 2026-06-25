<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'order_number'     => $this->order_number,
            'customer_name'    => $this->customer_name,
            'customer_phone'   => $this->customer_phone,
            'customer_email'   => $this->customer_email,
            'customer_address' => $this->customer_address,
            'pickup_time'      => $this->pickup_time?->toISOString(),
            'items'            => $this->items,
            'subtotal'         => (float) $this->subtotal,
            'total'            => (float) $this->total,
            'status'           => $this->status,
            'type'             => $this->type,
            'notes'            => $this->notes,
            'assigned_to'      => $this->assigned_to,
            'assigned_driver'  => new UserResource($this->whenLoaded('assignedDriver')),
            'delivery'         => new DeliveryResource($this->whenLoaded('delivery')),
            'order_items'      => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
