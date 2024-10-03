<?php

namespace CBC\Api\Infrastructure\Interfaces;

use CBC\Api\Domain\Model\Clube;

interface IClubeRepository
{
    public function buscarClubes(): array;
    public function buscarClubePorId(int $idClube): ?Clube;
    public function cadastrarClube(Clube $clube): bool;
    public function atualizarSaldoClube(int $idClube, float $saldo): bool;
    public function consultarSaldoClube(int $idClube);
}
