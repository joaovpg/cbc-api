<?php

use CBC\Api\Api\Controllers\ClubeController;
use CBC\Api\Api\Controllers\RecursoController;
use CBC\Api\Application\Services\ClubeService;
use CBC\Api\Application\Services\RecursoService;
use CBC\Api\Infrastructure\Persistence\ConnectionCreator;
use CBC\Api\Infrastructure\Repository\ClubeRepository;
use CBC\Api\Infrastructure\Repository\RecursoRepository;

require_once 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$connection = ConnectionCreator::createConnection();

$clubeRepository  = new ClubeRepository($connection);
$clubeService = new ClubeService($clubeRepository);
$clubeController = new ClubeController($clubeService);

$recursoRepository = new RecursoRepository($connection);
$recursoService = new RecursoService($recursoRepository, $clubeRepository, $connection);
$recursoController = new RecursoController($recursoService);

if ($uri === '/clubes') {
    switch ($method) {
        case 'GET':
            $clubeController->getClubes();
            break;
        case 'POST':
            $clubeController->postClubes();
            break;
        default:
            http_response_code(405);
    }
} elseif ($uri === '/recursos') {
    switch ($method) {
        case 'GET':
            $recursoController->getRecursos();
            break;
        case 'POST':
            $recursoController->postConsumirRecurso();
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => '404 Not Found']);
}
