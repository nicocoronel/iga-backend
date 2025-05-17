<?php

namespace App\Controllers;

use OpenApi\Annotations as OA;
use App\Models\CursoModel;
use CodeIgniter\RESTful\ResourceController;

/**
 * @OA\Tag(
 *   name="Cursos",
 *   description="Operaciones relacionadas con cursos"
 * )
 *
 * @OA\PathItem(
 *   path="/cursos",
 *   description="Rutas para crear y listar cursos"
 * )
 */
class CursoController extends ResourceController
{
    protected $modelName = 'App\Models\CursoModel';
    protected $format    = 'json';


    /**
     * @OA\Get(
     *   path="/cursos",
     *   summary="Obtener todos los cursos",
     *   tags={"Cursos"},
     *   @OA\Response(
     *     response=200,
     *     description="Listado de cursos disponibles",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(
     *         type="object",
     *         @OA\Property(property="id", type="integer", example=1),
     *         @OA\Property(property="nombre", type="string", example="Pastelería Profesional"),
     *         @OA\Property(property="descripcion", type="string", example="Aprendé técnicas de pastelería desde lo básico hasta lo avanzado."),
     *         @OA\Property(property="precio", type="number", format="float", example=25.000),
     *         @OA\Property(property="detalle", type="string", example="Incluye módulos de tortas, masas, cremas, decoración y más."),
     *         @OA\Property(property="imagen", type="string", example="pasteleria.jpg")
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $cursos = $this->model->findAll();
        return $this->respond($cursos);
    }
}
