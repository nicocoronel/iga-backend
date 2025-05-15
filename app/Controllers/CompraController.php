<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\CompraModel;
use CodeIgniter\RESTful\ResourceController;

class CompraController extends ResourceController
{
    protected $format = 'json';

    public function crear()
    {
        $data = $this->request->getJSON(true); // Obtener datos como array

        if (!isset($data['nombre'], $data['email'], $data['telefono'], $data['curso_id'])) {
            return $this->failValidationErrors('Faltan datos requeridos');
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
}
