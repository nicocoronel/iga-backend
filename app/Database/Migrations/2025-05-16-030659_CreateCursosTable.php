<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCursosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'nombre'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'descripcion' => ['type' => 'TEXT', 'null' => true],
            'precio'      => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'detalle'     => ['type' => 'TEXT', 'null' => true],
            'imagen'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cursos');
    }

    public function down()
    {
        $this->forge->dropTable('cursos');
    }
}
