<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Cursos
$routes->get('cursos', 'CursoController::index');

// Compras
$routes->post('comprar', 'CompraController::crear');
$routes->get('/compras/cliente', 'CompraController::getComprasPorCliente');
$routes->get('/compras/admin', 'CompraController::getResumenComprasAdmin');

