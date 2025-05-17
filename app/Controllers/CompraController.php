<?php

namespace App\Controllers;

use OpenApi\Annotations as OA;
use App\Models\ClienteModel;
use App\Models\CompraModel;
use CodeIgniter\RESTful\ResourceController;

/**
 * @OA\Tag(
 *   name="Compras",
 *   description="Operaciones relacionadas con compras de cursos"
 * )
 *
 * @OA\PathItem(
 *   path="/compras",
 *   description="Rutas para crear y listar compras"
 * )
 */
class CompraController extends ResourceController
{
    protected $format = 'json';

    /**
     * @OA\Post(
     *   path="/comprar",
     *   summary="Registrar una nueva compra",
     *   tags={"Compras"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nombre","email","telefono","curso_id"},
     *       @OA\Property(property="nombre", type="string", example="Nicolas Coronel"),
     *       @OA\Property(property="email", type="string", format="email", example="nico@example.com"),
     *       @OA\Property(property="telefono", type="string", example="3518459621"),
     *       @OA\Property(property="curso_id", type="integer", example=2)
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Compra registrada correctamente",
     *     @OA\JsonContent(
     *       @OA\Property(property="mensaje", type="string", example="Compra registrada correctamente")
     *     )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Error de validación"
     *   )
     * )
     */
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

    /**
     * @OA\Get(
     *   path="/compras/cliente",
     *   summary="Obtener compras por cliente (email)",
     *   tags={"Compras"},
     *   @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Correo del cliente",
     *     required=true,
     *     @OA\Schema(type="string", format="email", example="nico@gmail.com")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Listado de compras del cliente",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(
     *         @OA\Property(property="nombre", type="string", example="Panadería Artesanal"),
     *         @OA\Property(property="precio", type="number", format="float", example=22.000),
     *         @OA\Property(property="fecha_compra", type="string", format="date-time", example="2025-05-15 16:11:08")
     *       )
     *     )
     *   )
     * )
     */
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

    /**
     * @OA\Get(
     *   path="/compras/admin",
     *   summary="Obtener resumen de compras por curso",
     *   tags={"Compras"},
     *   @OA\Response(
     *     response=200,
     *     description="Resumen de compras agrupadas por curso",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(
     *         @OA\Property(property="nombre", type="string", example="Cocina Vegana"),
     *         @OA\Property(property="cantidad", type="integer", example=2)
     *       )
     *     )
     *   )
     * )
     */
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
