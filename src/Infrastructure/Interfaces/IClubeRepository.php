<?php

namespace CBC\Api\Infrastructure\Interfaces;

use CBC\Api\Domain\Model\Clube;

interface IClubeRepository
{
    public function listarClubes(): array;
    public function buscarClubePorId(int $idClube): ?Clube;
    public function CadastrarClube(Clube $clube): bool;
    public function AtualizarSaldoClube(int $idClube, float $saldo): bool;
}