<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Seed 8 gallery photos: 5 restaurant/food + 3 staff (personal).
     */
    public function run(): void
    {
        $photos = [
            // ── Restaurant / Food Photos ────────────────────────
            [
                'image_url'     => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&q=80',
                'category'      => 'galeria',
                'caption'       => 'Interior del restaurante MAREA',
                'display_order' => 1,
            ],
            [
                'image_url'     => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&q=80',
                'category'      => 'galeria',
                'caption'       => 'Platos estrella de nuestra carta',
                'display_order' => 2,
            ],
            [
                'image_url'     => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1200&q=80',
                'category'      => 'galeria',
                'caption'       => 'Ambiente nocturno en MAREA',
                'display_order' => 3,
            ],
            [
                'image_url'     => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80',
                'category'      => 'galeria',
                'caption'       => 'Cocina mediterránea con alma marroquí',
                'display_order' => 4,
            ],
            [
                'image_url'     => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=1200&q=80',
                'category'      => 'galeria',
                'caption'       => 'Terraza al atardecer',
                'display_order' => 5,
            ],

            // ── Staff / Personal Photos ─────────────────────────
            [
                'image_url'     => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=1200&q=80',
                'category'      => 'personal',
                'caption'       => 'Chef Hassan en la cocina',
                'display_order' => 1,
            ],
            [
                'image_url'     => 'https://images.unsplash.com/photo-1581299894007-aaa50297cf16?w=1200&q=80',
                'category'      => 'personal',
                'caption'       => 'Nuestro equipo de sala',
                'display_order' => 2,
            ],
            [
                'image_url'     => 'https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?w=1200&q=80',
                'category'      => 'personal',
                'caption'       => 'Preparando el servicio de noche',
                'display_order' => 3,
            ],
        ];

        foreach ($photos as $photo) {
            GalleryPhoto::create($photo);
        }
    }
}
