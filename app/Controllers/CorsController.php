<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class CorsController extends ResourceController
{
    public function preflight()
    {
        return $this->response->setStatusCode(204); // No Content
    }
}
