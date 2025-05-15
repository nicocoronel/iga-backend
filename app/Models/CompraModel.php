<?php

namespace App\Models;

use CodeIgniter\Model;

class CompraModel extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cliente_id', 'curso_id', 'fecha_compra'];
    protected $returnType = 'array';
}
