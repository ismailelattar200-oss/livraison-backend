<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Seed 60+ realistic Mediterranean/Moroccan menu items with HD Unsplash photos.
     * Each image URL is hand-picked to match the dish category for a professional demo.
     */
    public function run(): void
    {
        $menuData = [

            // ─────────────────────────────────────────────────────
            // 1. DESAYUNOS
            // ─────────────────────────────────────────────────────
            'Desayunos' => [
                [
                    'name'        => 'Desayuno Mediterráneo',
                    'description' => 'Huevos revueltos con tomate, aceitunas, queso feta, pan artesano tostado y aceite de oliva virgen extra.',
                    'price'       => 9.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Desayuno Marroquí',
                    'description' => 'Msemen casero, miel de azahar, mantequilla de smen, mermelada de higos y té moruno.',
                    'price'       => 8.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Tostadas con Aguacate',
                    'description' => 'Pan de masa madre con aguacate machacado, huevo poché, semillas de sésamo y sumac.',
                    'price'       => 8.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Açaí Bowl MAREA',
                    'description' => 'Açaí orgánico con granola casera, plátano, fresas, coco rallado y miel.',
                    'price'       => 10.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 2. ENSALADAS
            // ─────────────────────────────────────────────────────
            'Ensaladas' => [
                [
                    'name'        => 'Ensalada MAREA',
                    'description' => 'Mix de lechugas, pollo a la parrilla, aguacate, tomates cherry, queso parmesano y vinagreta de limón.',
                    'price'       => 12.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&q=80',
                    'is_featured' => true,
                ],
                [
                    'name'        => 'Ensalada Fattoush',
                    'description' => 'Ensalada libanesa con pan pita crujiente, pepino, rábano, menta fresca y vinagreta de granada.',
                    'price'       => 11.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Tabbouleh Clásico',
                    'description' => 'Bulgur, perejil fresco, tomate, cebolla, menta, limón y aceite de oliva.',
                    'price'       => 9.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1529059997568-3d847b1154f0?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 3. ENTRANTES CALIENTES
            // ─────────────────────────────────────────────────────
            'Entrantes Calientes' => [
                [
                    'name'        => 'Briouats de Pollo',
                    'description' => 'Triángulos crujientes de pasta brick rellenos de pollo especiado, almendras y canela.',
                    'price'       => 8.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Falafel con Hummus',
                    'description' => 'Falafel casero de garbanzos crujiente servido con hummus cremoso y pan pita caliente.',
                    'price'       => 9.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1593001874117-c99c800e3eb7?w=800&q=80',
                    'is_featured' => true,
                ],
                [
                    'name'        => 'Gambas al Ajillo',
                    'description' => 'Gambas salteadas en aceite de oliva con ajo laminado, guindilla y perejil fresco.',
                    'price'       => 13.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Patatas Bravas MAREA',
                    'description' => 'Patatas crujientes con salsa brava picante y alioli de harissa casero.',
                    'price'       => 7.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1585672840563-f2af2ced55c9?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 4. COCINA MARROQUÍ
            // ─────────────────────────────────────────────────────
            'Cocina Marroquí' => [
                [
                    'name'        => 'Tajín de Cordero',
                    'description' => 'Cordero estofado lentamente con ciruelas pasas, almendras tostadas, canela y miel de azahar.',
                    'price'       => 18.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1511690743698-d9d18f7e20f1?w=800&q=80',
                    'is_featured' => true,
                ],
                [
                    'name'        => 'Cuscús Real',
                    'description' => 'Cuscús al vapor con siete verduras, garbanzos, cordero y caldo perfumado con ras el hanout.',
                    'price'       => 16.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=800&q=80',
                    'is_featured' => true,
                ],
                [
                    'name'        => 'Pastela de Pollo',
                    'description' => 'Hojaldre crujiente relleno de pollo especiado, almendras y huevo, espolvoreado con canela y azúcar glas.',
                    'price'       => 15.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1547424850-28ac9ec3c6e7?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Kefta con Huevo',
                    'description' => 'Albóndigas de ternera especiadas en salsa de tomate con huevos escalfados y pan marroquí.',
                    'price'       => 14.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Harira',
                    'description' => 'Sopa tradicional de lentejas, garbanzos, tomate y cilantro con un toque de limón.',
                    'price'       => 7.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 5. POKE BOWL
            // ─────────────────────────────────────────────────────
            'Poke Bowl' => [
                [
                    'name'        => 'Poke de Salmón',
                    'description' => 'Arroz de sushi, salmón fresco marinado, aguacate, edamame, mango, alga wakame y salsa ponzu.',
                    'price'       => 14.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&q=80',
                    'is_featured' => true,
                ],
                [
                    'name'        => 'Poke de Atún',
                    'description' => 'Arroz de sushi, atún rojo, pepino, zanahoria encurtida, sésamo y salsa sriracha-mayo.',
                    'price'       => 15.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1580476262798-bddd9f4b7369?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Poke Vegano',
                    'description' => 'Quinoa, tofu marinado, aguacate, mango, edamame, rábano y vinagreta de jengibre.',
                    'price'       => 13.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 6. PLATOS DEL MUNDO
            // ─────────────────────────────────────────────────────
            'Platos del Mundo' => [
                [
                    'name'        => 'Pollo Tikka Masala',
                    'description' => 'Pechuga de pollo marinada en yogur y especias, cocinada en salsa cremosa de tomate y garam masala.',
                    'price'       => 15.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Pad Thai',
                    'description' => 'Noodles de arroz salteados al wok con gambas, huevo, cacahuetes, brotes de soja y salsa tamarindo.',
                    'price'       => 14.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1559314809-0d155014e29e?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Gyoza de Cerdo',
                    'description' => 'Empanadillas japonesas a la plancha rellenas de cerdo y jengibre, con salsa de soja y vinagre de arroz.',
                    'price'       => 10.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1496116218417-1a781b1c416c?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 7. PASTAS
            // ─────────────────────────────────────────────────────
            'Pastas' => [
                [
                    'name'        => 'Linguini alle Vongole',
                    'description' => 'Linguini con almejas frescas, ajo, vino blanco, perejil y un toque de guindilla.',
                    'price'       => 16.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Rigatoni al Ragù',
                    'description' => 'Rigatoni con ragú napolitano de ternera cocinado a fuego lento durante 6 horas.',
                    'price'       => 14.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Penne al Pesto',
                    'description' => 'Penne rigate con pesto genovés de albahaca fresca, piñones, parmigiano reggiano y aceite de oliva.',
                    'price'       => 13.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 8. WRAPS
            // ─────────────────────────────────────────────────────
            'Wraps' => [
                [
                    'name'        => 'Wrap de Shawarma',
                    'description' => 'Tortilla de trigo con pollo shawarma, lechuga, tomate, cebolla morada y salsa tahini.',
                    'price'       => 10.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Wrap Falafel',
                    'description' => 'Falafel crujiente, hummus, pepino, tomate, pickles y salsa de yogur en pan plano.',
                    'price'       => 9.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Wrap César',
                    'description' => 'Pollo a la plancha, lechuga romana, parmesano, croutons crujientes y salsa César casera.',
                    'price'       => 10.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 9. TACOS GRATINADOS
            // ─────────────────────────────────────────────────────
            'Tacos Gratinados' => [
                [
                    'name'        => 'Taco de Pulled Pork',
                    'description' => 'Tortilla de maíz con cerdo deshilachado BBQ, queso cheddar gratinado y coleslaw.',
                    'price'       => 11.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Taco de Pollo Tikka',
                    'description' => 'Tortilla con pollo tikka, queso mozzarella fundido, cebolla caramelizada y cilantro.',
                    'price'       => 11.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Taco Vegetal',
                    'description' => 'Verduras asadas, queso de cabra gratinado, rúcula, nueces y reducción de miel.',
                    'price'       => 10.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1599974579688-8dbdd335c77f?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 10. HAMBURGUESAS
            // ─────────────────────────────────────────────────────
            'Hamburguesas' => [
                [
                    'name'        => 'Burger MAREA',
                    'description' => 'Doble smash burger de ternera, queso cheddar ahumado, cebolla caramelizada, bacon crujiente y salsa secreta.',
                    'price'       => 14.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800&q=80',
                    'is_featured' => true,
                ],
                [
                    'name'        => 'Burger de Cordero',
                    'description' => 'Burger de cordero especiado con queso feta, pepino encurtido, rúcula y salsa de yogur con menta.',
                    'price'       => 15.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Burger Vegana',
                    'description' => 'Burger de remolacha y quinoa, aguacate, lechuga, tomate y mayonesa vegana de chipotle.',
                    'price'       => 13.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1520072959219-c595e6cdc652?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 11. PIZZAS
            // ─────────────────────────────────────────────────────
            'Pizzas' => [
                [
                    'name'        => 'Pizza Mediterránea',
                    'description' => 'Tomate San Marzano, mozzarella, aceitunas kalamata, alcachofas, pimiento asado y orégano fresco.',
                    'price'       => 14.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Pizza Merguez',
                    'description' => 'Base de tomate, mozzarella, merguez picante, cebolla morada, pimiento verde y harissa.',
                    'price'       => 15.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Pizza Trufa',
                    'description' => 'Crema de trufa, mozzarella di bufala, champiñones portobello, rúcula y lascas de parmesano.',
                    'price'       => 17.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 12. PESCADO Y CARNE POR KILO
            // ─────────────────────────────────────────────────────
            'Pescado y Carne por Kilo' => [
                [
                    'name'        => 'Lubina a la Parrilla',
                    'description' => 'Lubina fresca del día cocinada a la brasa con hierbas mediterráneas, limón y aceite de oliva. Precio por kilo.',
                    'price'       => 24.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1534604973900-c43ab4c2e0ab?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Chuletón de Ternera',
                    'description' => 'Chuletón de ternera gallega madurada 45 días, cocinado a la brasa. Precio por kilo.',
                    'price'       => 25.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1558030006-450675393462?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Gambas Rojas',
                    'description' => 'Gambas rojas del Mediterráneo a la plancha con sal gruesa y limón. Precio por kilo.',
                    'price'       => 22.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1625943553852-781c6dd46faa?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 13. POSTRES
            // ─────────────────────────────────────────────────────
            'Postres' => [
                [
                    'name'        => 'Baklava de Pistacho',
                    'description' => 'Hojaldre crujiente de capas finas con pistachos triturados, bañado en almíbar de azahar.',
                    'price'       => 7.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Crème Brûlée',
                    'description' => 'Crema de vainilla de Madagascar con costra de caramelo crujiente.',
                    'price'       => 7.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Pastela de Leche',
                    'description' => 'Postre marroquí de hojaldre crujiente relleno de crema de leche y almendras, con canela.',
                    'price'       => 6.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Tarta de Chocolate',
                    'description' => 'Tarta de chocolate negro 70% con base de galleta y coulis de frambuesa.',
                    'price'       => 8.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 14. CAFÉS
            // ─────────────────────────────────────────────────────
            'Cafés' => [
                [
                    'name'        => 'Café Espresso',
                    'description' => 'Espresso italiano doble con crema natural.',
                    'price'       => 2.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1510707577719-ae7c14805e3a?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Café con Especias',
                    'description' => 'Café arábica con canela, cardamomo y un toque de nuez moscada. Servido con leche espumada.',
                    'price'       => 4.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Té Moruno',
                    'description' => 'Té verde gunpowder con hierbabuena fresca y azúcar, servido en vaso tradicional.',
                    'price'       => 3.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1571934811356-5cc061b6821f?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 15. ZUMOS
            // ─────────────────────────────────────────────────────
            'Zumos' => [
                [
                    'name'        => 'Zumo de Naranja Natural',
                    'description' => 'Zumo de naranjas recién exprimidas.',
                    'price'       => 4.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Zumo Detox Verde',
                    'description' => 'Espinacas, pepino, manzana verde, jengibre y limón.',
                    'price'       => 5.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1610970881699-44a5587cabec?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Zumo Tropical',
                    'description' => 'Mango, piña, maracuyá y naranja natural.',
                    'price'       => 5.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 16. MOJITOS
            // ─────────────────────────────────────────────────────
            'Mojitos' => [
                [
                    'name'        => 'Mojito Clásico',
                    'description' => 'Ron blanco, hierbabuena fresca, lima, azúcar de caña y soda.',
                    'price'       => 8.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1551538827-9c037cb4f32a?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Mojito de Mango',
                    'description' => 'Ron blanco, puré de mango fresco, hierbabuena, lima y soda.',
                    'price'       => 9.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1536935338788-846bb9981813?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Mojito de Fresa',
                    'description' => 'Ron blanco, fresas frescas machacadas, hierbabuena, lima y soda.',
                    'price'       => 9.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 17. MILKSHAKES
            // ─────────────────────────────────────────────────────
            'Milkshakes' => [
                [
                    'name'        => 'Milkshake de Chocolate',
                    'description' => 'Helado de chocolate belga, leche, nata montada y virutas de chocolate.',
                    'price'       => 6.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Milkshake de Vainilla',
                    'description' => 'Helado de vainilla de Madagascar, leche, nata montada y caramelo.',
                    'price'       => 6.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Milkshake Oreo',
                    'description' => 'Helado de vainilla, galletas Oreo trituradas, leche, nata y sirope de chocolate.',
                    'price'       => 7.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1568901839119-631418a3910d?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 18. BEBIDAS
            // ─────────────────────────────────────────────────────
            'Bebidas' => [
                [
                    'name'        => 'Agua Mineral',
                    'description' => 'Agua mineral natural 500ml.',
                    'price'       => 2.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Coca-Cola',
                    'description' => 'Coca-Cola original 330ml.',
                    'price'       => 3.00,
                    'image_url'   => 'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Limonada Casera',
                    'description' => 'Limonada natural con hierbabuena, jengibre y miel.',
                    'price'       => 4.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859?w=800&q=80',
                    'is_featured' => false,
                ],
            ],

            // ─────────────────────────────────────────────────────
            // 19. CÓCTELES
            // ─────────────────────────────────────────────────────
            'Cócteles' => [
                [
                    'name'        => 'Margarita MAREA',
                    'description' => 'Tequila reposado, triple sec, zumo de lima fresco y sal de escama con pimentón ahumado.',
                    'price'       => 10.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1556855810-ac404aa91e85?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Gin Tonic Mediterráneo',
                    'description' => 'Gin premium, tónica artesanal, romero, pepino y bayas de enebro.',
                    'price'       => 11.50,
                    'image_url'   => 'https://images.unsplash.com/photo-1560512823-829485b8bf24?w=800&q=80',
                    'is_featured' => false,
                ],
                [
                    'name'        => 'Aperol Spritz',
                    'description' => 'Aperol, prosecco, soda y rodaja de naranja.',
                    'price'       => 9.90,
                    'image_url'   => 'https://images.unsplash.com/photo-1560512823-829485b8bf24?w=800&q=80',
                    'is_featured' => false,
                ],
            ],
        ];

        foreach ($menuData as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($items as $index => $itemData) {
                MenuItem::create([
                    'category_id'    => $category->id,
                    'name'           => $itemData['name'],
                    'description'    => $itemData['description'],
                    'price'          => $itemData['price'],
                    'image_url'      => $itemData['image_url'],
                    'display_number' => $index + 1,
                    'is_available'   => true,
                    'is_featured'    => $itemData['is_featured'],
                ]);
            }
        }
    }
}
