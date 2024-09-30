<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'id_room' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'id_status' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'entry_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'departure_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'confirmed' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'reservation_token' => [
                'type' => 'VARCHAR',
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

        //Definir claves foraneas
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_room', 'rooms', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status', 'status_reservations', 'id', 'CASCADE', 'CASCADE');

        // Crear la tabla
        $this->forge->createTable('reservations', true);
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}
