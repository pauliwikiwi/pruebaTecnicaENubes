<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatusReservationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Definir la clave primaria
        $this->forge->addKey('id', true);

        // Crear la tabla
        $this->forge->createTable('status_reservations', true);
    }

    public function down()
    {
        $this->forge->dropTable('status_reservations');
    }
}
