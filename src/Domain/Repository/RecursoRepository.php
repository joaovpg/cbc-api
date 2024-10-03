<?php

namespace CBC\Api\Domain\Repository;

use CBC\API\Domain\Model\Recurso;

interface RecursoRepository
{
    public function listarRecursos();
    public function consultarSaldoRecurso($id): float;
    public function consumirSaldoRecurso(int $id, float $saldo): bool;
}