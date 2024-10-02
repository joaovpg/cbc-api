<?php

namespace CBC\Api\Domain\Repository;

use CBC\Api\Domain\Model\Clube;

interface ClubeRepository
{
    public function listarClubes(): array;
    public function buscarCursoPorId(int $idClube): ?Clube;
    public function CadastrarClube(Clube $clube): bool;
}