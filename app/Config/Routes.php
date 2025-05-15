<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/testdb', 'TestDb::index');

// Cursos
$routes->get('cursos', 'CursoController::index');

// Compras
$routes->post('comprar', 'CompraController::crear');
