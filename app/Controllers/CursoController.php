<?php

namespace App\Controllers;

use App\Models\CursoModel;
use CodeIgniter\RESTful\ResourceController;

class CursoController extends ResourceController
{
    protected $modelName = 'App\Models\CursoModel';
    protected $format    = 'json';

    public function index()
    {
        $cursos = $this->model->findAll();
        return $this->respond($cursos);
    }
}
