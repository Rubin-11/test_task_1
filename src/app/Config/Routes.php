<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\CommentsController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [CommentsController::class, 'index']);
$routes->get('/comments/index(:num)', [CommentsController::class, 'index/$1']);

$routes->post('/comments/create', [CommentsController::class, 'create']);
$routes->post('/comments/delete/(:num)', [CommentsController::class, 'delete/$1']);
