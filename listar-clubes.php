<?php

require_once 'vendor/autoload.php';

use CBC\Api\Infrastructure\Persistence\ConnectionCreator;
use CBC\Api\Infrastructure\Repository\ClubeRepositoryPDO;

$connection = ConnectionCreator::createConnection();

//$connection->exec('CREATE TABLE IF NOT EXISTS clube (id INT NOT NULL AUTO_INCREMENT, clube VARCHAR(100), saldo_disponivel VARCHAR(10) NOT NULL, PRIMARY KEY(id))');

$clubeRepository = new ClubeRepositoryPDO($connection);

$listaClubes = $clubeRepository->listarClubes();

var_dump($listaClubes);