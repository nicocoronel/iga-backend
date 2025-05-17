<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use OpenApi\Generator;

class SwaggerDocGenerator extends Controller
{
    /**
     * Genera el swagger.json a partir de las anotaciones @OA
     * y devuelve el JSON en la respuesta.
     */
    public function generate()
    {
        // Escanea todos los controladores en busca de anotaciones @OA
        $openapi = Generator::scan([APPPATH . 'Controllers']);

        // Convierte a JSON y lo guarda en public/swagger_ui/swagger.json
        $json = $openapi->toJson();
        file_put_contents(FCPATH . 'swagger_ui/swagger.json', $json);

        // Devuelve la respuesta JSON con el contenido generado
        return $this->response
                    ->setStatusCode(200)
                    ->setHeader('Content-Type', 'application/json; charset=utf-8')
                    ->setBody($json);
    }

    /**
     * Muestra la vista con el UI de Swagger.
     */
    public function index()
    {
        return view('swagger_docs/index');
    }
}
