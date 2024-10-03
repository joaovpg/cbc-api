<?php

namespace CBC\Api\Infrastructure\Interfaces;

interface IRecursoRepository
{
    public function listarRecursos(): array;
    public function consultarSaldoRecurso($id): float;
    public function consumirSaldoRecurso(int $id, float $saldo): bool;
}