<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table with admin, staff, delivery, and customer accounts.
     */
    public function run(): void
    {
        $users = [
            // ── Admin ───────────────────────────────────────────
            [
                'name'     => 'Administrador MAREA',
                'email'    => 'admin@marea.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'phone'    => '+34 612 000 001',
            ],

            // ── Staff ───────────────────────────────────────────
            [
                'name'     => 'Chef Hassan',
                'email'    => 'chef@marea.com',
                'password' => Hash::make('admin123'),
                'role'     => 'staff',
                'phone'    => '+34 612 000 002',
            ],
            [
                'name'     => 'Sara López',
                'email'    => 'sara@marea.com',
                'password' => Hash::make('admin123'),
                'role'     => 'staff',
                'phone'    => '+34 612 000 003',
            ],

            // ── Delivery ────────────────────────────────────────
            [
                'name'     => 'Mohamed El Amrani',
                'email'    => 'repartidor1@marea.com',
                'password' => Hash::make('admin123'),
                'role'     => 'delivery',
                'phone'    => '+34 612 000 010',
            ],
            [
                'name'     => 'Carlos Ruiz',
                'email'    => 'repartidor2@marea.com',
                'password' => Hash::make('admin123'),
                'role'     => 'delivery',
                'phone'    => '+34 612 000 011',
            ],

            // ── Customers ───────────────────────────────────────
            [
                'name'     => 'Ana García',
                'email'    => 'ana@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 'customer',
                'phone'    => '+34 612 100 001',
            ],
            [
                'name'     => 'Javier Martín',
                'email'    => 'javier@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 'customer',
                'phone'    => '+34 612 100 002',
            ],
            [
                'name'     => 'Lucía Fernández',
                'email'    => 'lucia@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 'customer',
                'phone'    => '+34 612 100 003',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
