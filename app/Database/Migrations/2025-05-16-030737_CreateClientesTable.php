<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'auto_increment' => true],
            'nombre'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'telefono' => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
