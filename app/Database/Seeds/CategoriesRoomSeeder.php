<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesRoomSeeder extends Seeder
{
    public function run()
    {
        $hotelsCategories = [
            [
                'id' => 1,
                'name' => 'Económico'
            ],
            [
                'id' => 2,
                'name' => 'Estándar'
            ],
            [
                'id' => 3,
                'name' => 'Superior'
            ],
            [
                'id' => 4,
                'name' => 'Lujo'
            ],
            [
                'id' => 5,
                'name' => 'Boutique'
            ],
            [
                'id' => 6,
                'name' => 'Resort'
            ],
            [
                'id' => 7,
                'name' => 'Todo Incluido'
            ],
            [
                'id' => 8,
                'name' => 'Hostal'
            ],
            [
                'id' => 9,
                'name' => 'Casa de Huéspedes'
            ],
            [
                'id' => 10,
                'name' => 'Bed & Breakfast'
            ],
        ];

        $this->db->table('categories_rooms')->insertBatch($hotelsCategories);
    }
}
