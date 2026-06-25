<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Models\Delivery;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Seed 10 sample orders across all statuses, including assigned deliveries.
     */
    public function run(): void
    {
        $menuItems = MenuItem::all();
        $deliveryUsers = User::where('role', 'delivery')->get();
        $customers = User::where('role', 'customer')->get();

        $orders = [
            [
                'customer_name'  => 'Ana García',
                'customer_phone' => '+34 612 100 001',
                'customer_email' => 'ana@gmail.com',
                'customer_address' => 'Calle Gran Vía 25, Madrid',
                'status'         => 'entregado',
                'type'           => 'domicilio',
                'pickup_time'    => null,
                'notes'          => 'Sin picante por favor',
                'user_id'        => $customers[0]->id ?? null,
                'item_count'     => 3,
                'created_offset' => -180, // 3 hours ago
            ],
            [
                'customer_name'  => 'Javier Martín',
                'customer_phone' => '+34 612 100 002',
                'customer_email' => 'javier@gmail.com',
                'customer_address' => null,
                'status'         => 'listo',
                'type'           => 'recogida',
                'pickup_time'    => Carbon::now()->addMinutes(15),
                'notes'          => null,
                'user_id'        => $customers[1]->id ?? null,
                'item_count'     => 2,
                'created_offset' => -60,
            ],
            [
                'customer_name'  => 'Lucía Fernández',
                'customer_phone' => '+34 612 100 003',
                'customer_email' => 'lucia@gmail.com',
                'customer_address' => 'Avenida de la Constitución 8, Madrid',
                'status'         => 'preparando',
                'type'           => 'domicilio',
                'pickup_time'    => null,
                'notes'          => 'Alergia a frutos secos',
                'user_id'        => $customers[2]->id ?? null,
                'item_count'     => 4,
                'created_offset' => -30,
            ],
            [
                'customer_name'  => 'Pedro Sánchez',
                'customer_phone' => '+34 612 200 001',
                'customer_email' => 'pedro@hotmail.com',
                'customer_address' => null,
                'status'         => 'pendiente',
                'type'           => 'recogida',
                'pickup_time'    => Carbon::now()->addMinutes(45),
                'notes'          => null,
                'user_id'        => null,
                'item_count'     => 2,
                'created_offset' => -10,
            ],
            [
                'customer_name'  => 'María Rodríguez',
                'customer_phone' => '+34 612 200 002',
                'customer_email' => 'maria@gmail.com',
                'customer_address' => 'Calle Alcalá 50, Madrid',
                'status'         => 'entregado',
                'type'           => 'domicilio',
                'pickup_time'    => null,
                'notes'          => 'Llamar al llegar',
                'user_id'        => null,
                'item_count'     => 3,
                'created_offset' => -240,
            ],
            [
                'customer_name'  => 'Carlos Gutiérrez',
                'customer_phone' => '+34 612 200 003',
                'customer_email' => null,
                'customer_address' => null,
                'status'         => 'pendiente',
                'type'           => 'recogida',
                'pickup_time'    => Carbon::now()->addMinutes(60),
                'notes'          => 'Extra salsa',
                'user_id'        => null,
                'item_count'     => 1,
                'created_offset' => -5,
            ],
            [
                'customer_name'  => 'Elena Torres',
                'customer_phone' => '+34 612 200 004',
                'customer_email' => 'elena@gmail.com',
                'customer_address' => 'Paseo de la Castellana 120, Madrid',
                'status'         => 'preparando',
                'type'           => 'domicilio',
                'pickup_time'    => null,
                'notes'          => null,
                'user_id'        => null,
                'item_count'     => 5,
                'created_offset' => -20,
            ],
            [
                'customer_name'  => 'Ahmed Benali',
                'customer_phone' => '+34 612 200 005',
                'customer_email' => 'ahmed@gmail.com',
                'customer_address' => 'Calle Fuencarral 85, Madrid',
                'status'         => 'entregado',
                'type'           => 'domicilio',
                'pickup_time'    => null,
                'notes'          => null,
                'user_id'        => null,
                'item_count'     => 2,
                'created_offset' => -300,
            ],
            [
                'customer_name'  => 'Isabel Navarro',
                'customer_phone' => '+34 612 200 006',
                'customer_email' => 'isabel@hotmail.com',
                'customer_address' => null,
                'status'         => 'cancelado',
                'type'           => 'recogida',
                'pickup_time'    => null,
                'notes'          => 'Pedido cancelado por el cliente',
                'user_id'        => null,
                'item_count'     => 2,
                'created_offset' => -120,
            ],
            [
                'customer_name'  => 'Roberto Díaz',
                'customer_phone' => '+34 612 200 007',
                'customer_email' => 'roberto@gmail.com',
                'customer_address' => 'Calle Serrano 40, Madrid',
                'status'         => 'listo',
                'type'           => 'domicilio',
                'pickup_time'    => null,
                'notes'          => 'Piso 3, puerta B',
                'user_id'        => null,
                'item_count'     => 3,
                'created_offset' => -45,
            ],
        ];

        $orderNumber = 1;

        foreach ($orders as $orderData) {
            $createdAt = Carbon::now()->addMinutes($orderData['created_offset']);
            $dateStr = $createdAt->format('Ymd');
            $orderNum = sprintf('MAR-%s-%03d', $dateStr, $orderNumber);

            // Pick random menu items for this order
            $selectedItems = $menuItems->random(min($orderData['item_count'], $menuItems->count()));
            $itemsJson = [];
            $subtotal = 0;

            foreach ($selectedItems as $menuItem) {
                $qty = rand(1, 3);
                $itemsJson[] = [
                    'id'       => $menuItem->id,
                    'name'     => $menuItem->name,
                    'price'    => (float) $menuItem->price,
                    'quantity' => $qty,
                    'image_url' => $menuItem->image_url,
                ];
                $subtotal += $menuItem->price * $qty;
            }

            $assignedTo = null;
            if ($orderData['type'] === 'domicilio' && in_array($orderData['status'], ['preparando', 'listo', 'entregado'])) {
                $assignedTo = $deliveryUsers->random()->id;
            }

            $order = Order::create([
                'order_number'    => $orderNum,
                'user_id'         => $orderData['user_id'],
                'customer_name'   => $orderData['customer_name'],
                'customer_phone'  => $orderData['customer_phone'],
                'customer_email'  => $orderData['customer_email'],
                'customer_address' => $orderData['customer_address'],
                'pickup_time'     => $orderData['pickup_time'],
                'items'           => $itemsJson,
                'subtotal'        => round($subtotal, 2),
                'total'           => round($subtotal, 2),
                'status'          => $orderData['status'],
                'type'            => $orderData['type'],
                'notes'           => $orderData['notes'],
                'assigned_to'     => $assignedTo,
                'created_at'      => $createdAt,
                'updated_at'      => $createdAt,
            ]);

            // Create normalized order_items
            foreach ($selectedItems as $idx => $menuItem) {
                $qty = $itemsJson[$idx]['quantity'];
                OrderItem::create([
                    'order_id'     => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity'     => $qty,
                    'unit_price'   => $menuItem->price,
                ]);
            }

            // Create delivery record for delivery orders with assigned driver
            if ($assignedTo && $orderData['type'] === 'domicilio') {
                $deliveryStatus = match ($orderData['status']) {
                    'preparando' => 'asignado',
                    'listo'      => 'recogido',
                    'entregado'  => 'entregado',
                    default      => 'asignado',
                };

                $assignedAt = (clone $createdAt)->addMinutes(5);
                $pickedUpAt = in_array($deliveryStatus, ['recogido', 'en_camino', 'entregado'])
                    ? (clone $assignedAt)->addMinutes(15) : null;
                $deliveredAt = $deliveryStatus === 'entregado'
                    ? (clone $pickedUpAt)->addMinutes(25) : null;

                Delivery::create([
                    'order_id'           => $order->id,
                    'delivery_person_id' => $assignedTo,
                    'assigned_at'        => $assignedAt,
                    'picked_up_at'       => $pickedUpAt,
                    'delivered_at'       => $deliveredAt,
                    'status'             => $deliveryStatus,
                    'notes'              => null,
                ]);
            }

            $orderNumber++;
        }
    }
}
