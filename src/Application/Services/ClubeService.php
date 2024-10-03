<?php

namespace  CBC\Api\Application\Services;

use CBC\Api\Api\Models\Clube\ClubeCadastroRequest;
use CBC\Api\Application\Interfaces\IClubeService;
use CBC\Api\Domain\Model\Clube;
use CBC\Api\Infrastructure\Interfaces\IClubeRepository;

class ClubeService implements IClubeService
{
    private IClubeRepository $clubeRepository;

    function __construct(IClubeRepository $clubeRepository)
    {
        $this->clubeRepository = $clubeRepository;
    }

    public function getListaClube(): array
    {
        return $this->clubeRepository->listarClubes();
    }

    public function cadastrarClube(ClubeCadastroRequest $clubeCadastro): bool
    {
        $valorNumero = str_replace(
             ",", ".", $clubeCadastro->getSaldoDisponivel()
        );

        $novoClube = new Clube(
            null,
            $clubeCadastro->getNome(),
            $valorNumero,
        );

        return $this->clubeRepository->cadastrarClube($novoClube);
    }
}