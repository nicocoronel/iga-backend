<?php

namespace App\Controllers;

use OpenApi\Annotations as OA;
use App\Models\ClienteModel;
use App\Models\CompraModel;
use CodeIgniter\RESTful\ResourceController;

class CompraController extends ResourceController
{
    protected $format = 'json';

    public function crear()
    {
        $data = $this->request->getJSON(true); // Obtener datos como array

        // Validaciones
        $rules = [
            'nombre'    => 'required|min_length[3]',
            'email'     => 'required|valid_email',
            'telefono'  => 'required|numeric|min_length[8]|max_length[15]',
            'curso_id'  => 'required|is_not_unique[cursos.id]', // Asegura que exista el curso
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $clienteModel = new ClienteModel();
        $compraModel = new CompraModel();

        // Buscar cliente por email
        $cliente = $clienteModel->where('email', $data['email'])->first();

        // Si no existe, lo creamos
        if (!$cliente) {
            $clienteId = $clienteModel->insert([
                'nombre'   => $data['nombre'],
                'email'    => $data['email'],
                'telefono' => $data['telefono'],
            ]);
        } else {
            $clienteId = $cliente['id'];
        }

        // Crear la compra
        $compraModel->insert([
            'cliente_id' => $clienteId,
            'curso_id'   => $data['curso_id'],
        ]);

        return $this->respondCreated(['mensaje' => 'Compra registrada correctamente']);
    }

    public function getComprasPorCliente()
    {
        $email = $this->request->getGet('email');
        $db = \Config\Database::connect();

        $builder = $db->table('compras');
        $builder->select('cursos.nombre, cursos.precio, compras.fecha_compra');
        $builder->join('clientes', 'compras.cliente_id = clientes.id');
        $builder->join('cursos', 'compras.curso_id = cursos.id');
        $builder->where('clientes.email', $email);

        $query = $builder->get();
        $result = $query->getResult();

        return $this->response->setJSON($result);
    }

    public function getResumenComprasAdmin()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('compras');
        $builder->select('cursos.nombre, COUNT(compras.id) as cantidad');
        $builder->join('cursos', 'compras.curso_id = cursos.id');
        $builder->groupBy('cursos.id');

        $query = $builder->get();
        $result = $query->getResult();

        return $this->response->setJSON($result);
    }

}
