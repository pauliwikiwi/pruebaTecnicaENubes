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
                'name' => 'Pendiente de confirmación',
                'abbreviation' => 'PEND'
            ],
            [
                'id' => 2,
                'name' => 'Confirmada',
                'abbreviation' => 'CONF'
            ],
            [
                'id' => 3,
                'name' => 'Cancelada',
                'abbreviation' => 'CANC'
            ],
            [
                'id' => 4,
                'name' => 'En estancia',
                'abbreviation' => 'ESTA'
            ],
            [
                'id' => 5,
                'name' => 'Finalizada',
                'abbreviation' => 'FIN'
            ],
            [
                'id' => 6,
                'name' => 'Modificada',
                'abbreviation' => 'MOD'
            ],
        ];
        $this->db->table('status_reservations')->insertBatch($status_reservation);
    }


}
