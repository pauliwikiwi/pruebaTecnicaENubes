<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'people' => [
                'type' => 'INT',
                'constraint' => '10',
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => '100',
            ],
            'id_category' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'television' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'minibar' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'air_conditioning' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'hair_dryer' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'wifi' => [
                'type' => 'INT',
                'constraint' => '1',
                'default' => 1
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
        $this->forge->addForeignKey('id_category', 'categories_rooms', 'id', 'CASCADE', 'CASCADE');

        // Crear la tabla
        $this->forge->createTable('rooms', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('rooms');
    }
}
