<?php

use CBC\Api\Api\Controllers\ClubeController;
use CBC\Api\Api\Controllers\RecursoController;
use CBC\Api\Application\Services\ClubeService;
use CBC\Api\Application\Services\RecursoService;
use CBC\Api\Infrastructure\Persistence\ConnectionCreator;
use CBC\Api\Infrastructure\Repository\ClubeRepositoryPDO;
use CBC\Api\Infrastructure\Repository\RecursoRepositoryPDO;

require_once 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$connection = ConnectionCreator::createConnection();

$clubeRepository  = new ClubeRepositoryPDO($connection);
$clubeService = new ClubeService($clubeRepository);
$clubeController = new ClubeController($clubeService);

$recursoRepository = new RecursoRepositoryPDO($connection);
$recursoService = new RecursoService($recursoRepository, $clubeRepository, $connection);
$recursoController = new RecursoController($recursoService);

if ($uri === '/clubes') {
    switch($method) {
        case 'GET':
            $clubeController->getClubes();
            break;
        case 'POST':
            $clubeController->postClubes();
            break;
    }

} else if($uri === '/recursos') {
    switch($method) {
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