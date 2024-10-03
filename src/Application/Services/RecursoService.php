<?php

namespace CBC\Api\Application\Services;

use CBC\Api\Api\Models\Recurso\ConsumirRecursoResponse;
use CBC\Api\Application\Interfaces\IRecursoService;
use CBC\Api\Infrastructure\Interfaces\IClubeRepository;
use CBC\Api\Infrastructure\Interfaces\IRecursoRepository;
use Error;
use PDO;

class RecursoService implements IRecursoService
{
    private IRecursoRepository $recursoRepository;
    private IClubeRepository $clubeRepository;
    private PDO $connection;

    public function __construct(
        IRecursoRepository $recursoRepository,
        IClubeRepository $clubeRepository,
        PDO $connection
    ) {
        $this->recursoRepository = $recursoRepository;
        $this->clubeRepository = $clubeRepository;
        $this->connection = $connection;
    }

    public function consumirRercurso(string $valorConsumido, int $idRecurso, int $idClube): ConsumirRecursoResponse
    {
        $valorConsumido = (float)str_replace(",", ".", $valorConsumido);
        $valorAnteriorRecurso = $this->recursoRepository->consultarSaldoRecurso($idRecurso);
        $valorAnteriorClube = $this->clubeRepository->consultarSaldoClube($idClube);
        $saldoAtualRecurso = (float)$valorAnteriorRecurso - $valorConsumido;
        $saldoAtualClube = (float)$valorAnteriorClube - $valorConsumido;

        if ($saldoAtualClube < 0) {
            throw new \Error('O saldo disponível do clube é insuficiente.');
        }

        if ($saldoAtualRecurso < 0) {
            throw new \Error('O saldo disponível do recurso é insuficiente.');
        }

        try {
            $this->connection->beginTransaction();
            $this->recursoRepository->consumirSaldoRecurso($idRecurso, $saldoAtualRecurso);
            $this->clubeRepository->AtualizarSaldoClube($idClube, $saldoAtualClube);

            $this->connection->commit();
        } catch (\Exception $e) {
            $this->connection->rollBack();
            throw new Error('Ocorreu um erro ao atualizar o saldo do recurso.');
        }

        $clube = $this->clubeRepository->buscarClubePorId($idClube);
        $clubeData = new ConsumirRecursoResponse(
            $clube->nomeClube(),
            str_replace(".", ",", $valorAnteriorClube),
            str_replace(".", ",", $clube->getSaldoDisponivel()),
        );
        return  $clubeData;
    }

    public function listarRecursos(): ?array
    {
        $listaRecursos = $this->recursoRepository->listarRecursos();

        foreach ($listaRecursos as $recurso) {
            $saldoFormatado = number_format($recurso->getSaldoDisponivel(), 2, ',', '');
            $recurso->setSaldoDisponivel($saldoFormatado);
        }
        return $listaRecursos;
    }
}
