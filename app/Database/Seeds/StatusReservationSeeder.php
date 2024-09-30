<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusReservationSeeder extends Seeder
{
    public function run()
    {
        $status_reservation = [
            [
                'id' => 1,
                'name' => 'Pendiente de confirmación'
            ],
            [
                'id' => 2,
                'name' => 'Confirmada'
            ],
            [
                'id' => 3,
                'name' => 'Cancelada'
            ],
            [
                'id' => 4,
                'name' => 'En estancia'
            ],
            [
                'id' => 5,
                'name' => 'Finalizada'
            ],
            [
                'id' => 6,
                'name' => 'Modificada'
            ],
        ];
        $this->db->table('status_reservations')->insertBatch($status_reservation);
    }


}
