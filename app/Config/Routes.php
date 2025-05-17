<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->options('(:any)', 'CorsController::preflight');

// Cursos
$routes->get('cursos', 'CursoController::index');

// Compras
$routes->post('comprar', 'CompraController::crear');
$routes->get('/compras/cliente', 'CompraController::getComprasPorCliente');
$routes->get('/compras/admin', 'CompraController::getResumenComprasAdmin');

// Swagger
$routes->get('api/v1/docs/generate', 'SwaggerDocGenerator::generate');
$routes->get('api/v1/docs/ui',       'SwaggerDocGenerator::index');


