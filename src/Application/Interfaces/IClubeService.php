<?php

namespace CBC\Api\Application\Interfaces;
use CBC\Api\Api\Models\Clube\ClubeCadastroRequest;
use CBC\Api\Domain\Model\Clube;

interface IClubeService
{
    public function getListaClube(): array;
    public function cadastrarClube(ClubeCadastroRequest $clubeCadastro): bool;
}