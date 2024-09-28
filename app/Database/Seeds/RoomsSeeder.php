<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomsSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'id' => 1,
                'name' => 'Habitación Económica Simple',
                'people' => 1,
                'price' => 45.00,
                'id_category' => 1, // Económica
                'description' => 'Habitación ideal para una persona, cómoda y económica, perfecta para estancias cortas.',
                'television' => 1,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 0,
                'wifi' => 1
            ],
            [
                'id' => 2,
                'name' => 'Habitación Económica Doble',
                'people' => 2,
                'price' => 60.00,
                'id_category' => 1, // Económica
                'description' => 'Habitación doble con lo esencial para una estancia asequible y confortable.',
                'television' => 1,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 0,
                'wifi' => 1
            ],
            [
                'id' => 3,
                'name' => 'Habitación Doble Estándar',
                'people' => 2,
                'price' => 75.00,
                'id_category' => 2, // Estándar
                'description' => 'Habitación estándar con capacidad para dos personas, equipada con aire acondicionado y televisión.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 0,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 4,
                'name' => 'Habitación Triple Estándar',
                'people' => 3,
                'price' => 90.00,
                'id_category' => 2, // Estándar
                'description' => 'Habitación perfecta para tres personas, con televisión, aire acondicionado y Wi-Fi gratuito.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 0,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 5,
                'name' => 'Suite Superior',
                'people' => 4,
                'price' => 150.00,
                'id_category' => 3, // Superior
                'description' => 'Amplia suite superior, ideal para familias, con minibar y todas las comodidades de lujo.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 6,
                'name' => 'Suite Familiar Superior',
                'people' => 5,
                'price' => 180.00,
                'id_category' => 3, // Superior
                'description' => 'Suite familiar de lujo, con capacidad para cinco personas, aire acondicionado y minibar.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 7,
                'name' => 'Suite de Lujo con Vista al Mar',
                'people' => 4,
                'price' => 350.00,
                'id_category' => 4, // Lujo
                'description' => 'Exclusiva suite con impresionantes vistas al mar, minibar y servicios de primera calidad.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 8,
                'name' => 'Habitación de Lujo con Jacuzzi',
                'people' => 2,
                'price' => 400.00,
                'id_category' => 4, // Lujo
                'description' => 'Habitación de lujo con jacuzzi privado, ideal para parejas que buscan una experiencia romántica.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 9,
                'name' => 'Habitación Boutique',
                'people' => 2,
                'price' => 120.00,
                'id_category' => 5, // Boutique
                'description' => 'Habitación boutique decorada con estilo, perfecta para estancias románticas y escapadas cortas.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 10,
                'name' => 'Suite Boutique Familiar',
                'people' => 4,
                'price' => 250.00,
                'id_category' => 5, // Boutique
                'description' => 'Suite familiar boutique, diseñada para ofrecer el máximo confort y elegancia en cada detalle.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 11,
                'name' => 'Habitación de Resort con Balcón',
                'people' => 4,
                'price' => 220.00,
                'id_category' => 6, // Resort
                'description' => 'Habitación de resort con amplio balcón, ideal para disfrutar de las vistas y la brisa marina.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 12,
                'name' => 'Habitación Familiar de Resort',
                'people' => 6,
                'price' => 300.00,
                'id_category' => 6, // Resort
                'description' => 'Habitación familiar de resort con amplio espacio, minibar y aire acondicionado para mayor confort.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 13,
                'name' => 'Habitación Todo Incluido Estándar',
                'people' => 4,
                'price' => 280.00,
                'id_category' => 7, // Todo Incluido
                'description' => 'Habitación estándar todo incluido, con acceso a todas las comodidades del hotel y servicios premium.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 14,
                'name' => 'Habitación Todo Incluido Deluxe',
                'people' => 4,
                'price' => 350.00,
                'id_category' => 7, // Todo Incluido
                'description' => 'Habitación deluxe con todo incluido, para una experiencia de lujo con todas las facilidades del resort.',
                'television' => 1,
                'air_conditioning' => 1,
                'minibar' => 1,
                'hair_dryer' => 1,
                'wifi' => 1
            ],
            [
                'id' => 15,
                'name' => 'Cama en Dormitorio Compartido',
                'people' => 1,
                'price' => 20.00,
                'id_category' => 8, // Hostal
                'description' => 'Cama en dormitorio compartido, perfecta para mochileros o viajeros con presupuesto ajustado.',
                'television' => 0,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 0,
                'wifi' => 1
            ],
            [
                'id' => 16,
                'name' => 'Habitación Privada en Hostal',
                'people' => 2,
                'price' => 40.00,
                'id_category' => 8, // Hostal
                'description' => 'Habitación privada en hostal, ideal para quienes buscan privacidad a precio accesible.',
                'television' => 0,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 0,
                'wifi' => 1
            ],
            [
                'id' => 17,
                'name' => 'Habitación Casa de Huéspedes Económica',
                'people' => 2,
                'price' => 30.00,
                'id_category' => 9, // Casa de Huéspedes
                'description' => 'Habitación económica en casa de huéspedes, perfecta para estancias cortas a bajo costo.',
                'television' => 1,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 0,
                'wifi' => 1
            ],
            [
                'id' => 18,
                'name' => 'Habitación Casa de Huéspedes Deluxe',
                'people' => 2,
                'price' => 50.00,
                'id_category' => 9, // Casa de Huéspedes
                'description' => 'Habitación deluxe en casa de huéspedes, con detalles únicos para una estancia especial.',
                'television' => 1,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 0,
                'wifi' => 1
            ],
            [
                'id' => 19,
                'name' => 'Habitación con Desayuno Estándar',
                'people' => 2,
                'price' => 80.00,
                'id_category' => 10, // Desayuno Incluido
                'description' => 'Habitación estándar con desayuno incluido, perfecta para viajeros que buscan comodidad y buen servicio.',
                'television' => 1,
                'air_conditioning' => 0,
                'minibar' => 0,
                'hair_dryer' => 1,
                'wifi' => 1
            ]
        ];



        $this->db->table('rooms')->insertBatch($rooms);

    }
}
