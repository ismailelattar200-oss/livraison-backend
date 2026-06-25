<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Seed the 19 menu categories in exact display order.
     */
    public function run(): void
    {
        $categories = [
            'Desayunos',
            'Ensaladas',
            'Entrantes Calientes',
            'Cocina Marroquí',
            'Poke Bowl',
            'Platos del Mundo',
            'Pastas',
            'Wraps',
            'Tacos Gratinados',
            'Hamburguesas',
            'Pizzas',
            'Pescado y Carne por Kilo',
            'Postres',
            'Cafés',
            'Zumos',
            'Mojitos',
            'Milkshakes',
            'Bebidas',
            'Cócteles',
        ];

        foreach ($categories as $index => $name) {
            Category::create([
                'name'          => $name,
                'slug'          => Str::slug($name),
                'display_order' => $index + 1,
                'is_active'     => true,
            ]);
        }
    }
}
