<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoryRoomTable extends Migration
{
    public function up(): void
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
        $this->forge->createTable('categories_rooms', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('categories_rooms');
    }
}
