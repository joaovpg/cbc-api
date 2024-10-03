<?php

namespace  CBC\Api\Application\Services;

use CBC\Api\Api\Models\Clube\ClubeCadastroRequest;
use CBC\Api\Application\Interfaces\IClubeService;
use CBC\Api\Domain\Model\Clube;
use CBC\Api\Infrastructure\Interfaces\IClubeRepository;

class ClubeService implements IClubeService
{
    private IClubeRepository $clubeRepository;

    public function __construct(
        IClubeRepository $clubeRepository
    ) {
        $this->clubeRepository = $clubeRepository;
    }

    public function getListaClube(): array
    {
        $listaClubes = $this->clubeRepository->buscarClubes();

        foreach ($listaClubes as $clube) {
            $saldoFormatado = number_format($clube->getSaldoDisponivel(), 2, ',', '');
            $clube->setSaldoDisponivel($saldoFormatado);
        }

        return $listaClubes;
    }

    public function cadastrarClube(ClubeCadastroRequest $clubeCadastro): bool
    {
        $valorNumero = str_replace(",", ".", $clubeCadastro->getSaldoDisponivel());

        $novoClube = new Clube(
            null,
            $clubeCadastro->getNome(),
            $valorNumero,
        );

        return $this->clubeRepository->cadastrarClube($novoClube);
    }
}
