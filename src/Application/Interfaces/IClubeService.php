<?php

namespace CBC\Api\Application\Interfaces;

use CBC\Api\Api\Models\Clube\ClubeCadastroRequest;

interface IClubeService
{
    public function getListaClube(): array;
    public function cadastrarClube(ClubeCadastroRequest $clubeCadastro): bool;
}
