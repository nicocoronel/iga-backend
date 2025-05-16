<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateComprasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'cliente_id'   => ['type' => 'INT'],
            'curso_id'     => ['type' => 'INT'],
            'fecha_compra' => ['type' => 'DATETIME', 'default' => new RawSql('CURRENT_TIMESTAMP'),],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('curso_id', 'cursos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('compras');
    }

    public function down()
    {
        $this->forge->dropTable('compras');
    }
}
