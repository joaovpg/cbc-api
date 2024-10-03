<?php

require_once 'vendor/autoload.php';

use CBC\Api\Domain\Model\Clube;
use CBC\Api\Infrastructure\Persistence\ConnectionCreator;
use CBC\Api\Infrastructure\Repository\ClubeRepositoryPDO;
use CBC\Api\Infrastructure\Repository\RecursoRepositoryPDO;

$connection = ConnectionCreator::createConnection();

//$connection->exec('CREATE TABLE IF NOT EXISTS clube (id INT NOT NULL AUTO_INCREMENT, clube VARCHAR(100), saldo_disponivel DECIMAL(12,2) NOT NULL, PRIMARY KEY(id))');
//$connection->exec('CREATE TABLE IF NOT EXISTS recurso (id INT NOT NULL AUTO_INCREMENT, recurso VARCHAR(100), saldo_disponivel DECIMAL(12,2) NOT NULL, PRIMARY KEY(id))');

//$connection->exec("INSERT INTO recurso (recurso, saldo_disponivel)
//VALUES ('Recurso para passagens', 10000.00);");
//$connection->exec("INSERT INTO recurso (recurso, saldo_disponivel)
//VALUES ('Recurso para hospedagens', 10000.00);");

$clubeRepository = new ClubeRepositoryPDO($connection);
$recursoRepository = new RecursoRepositoryPDO($connection);

$goiasEsporteClube = new Clube(null, 'Goiás esporte clube', '100000.15');

$listaClubes = $recursoRepository->listarRecursos();

var_dump($listaClubes);