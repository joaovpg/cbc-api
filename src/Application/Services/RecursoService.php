<?php

namespace CBC\Api\Application\Services;
use CBC\Api\Application\Interfaces\IRecursoService;
use CBC\Api\Infrastructure\Repository\ClubeRepositoryPDO;
use CBC\Api\Infrastructure\Repository\RecursoRepositoryPDO;
use Error;
use PDO;

class RecursoService implements IRecursoService
{
    private RecursoRepositoryPDO $recursoRepository;
    private ClubeRepositoryPDO $clubeRepository;
    private PDO $connection;

    public function __construct(RecursoRepositoryPDO $recursoRepository, ClubeRepositoryPDO $clubeRepository, PDO $connection)
    {
        $this->recursoRepository = $recursoRepository;
        $this->clubeRepository = $clubeRepository;
        $this->connection = $connection;
    }

    public function consumirRercurso(string $valorConsumido, int $idRecurso, int $idClube):bool
    {
        $valorConsumido = str_replace(",", ".", $valorConsumido);
        $valorAnteriorRecurso = $this->recursoRepository->consultarSaldoRecurso($idRecurso);
        $valorAnteriorClube = $this->clubeRepository->consultarSaldoClube($idClube);
        $saldoAtualRecurso = $valorAnteriorRecurso - $valorConsumido;
        $saldoAtualClube = $valorAnteriorClube - $valorConsumido;

        if ($saldoAtualClube < 0) {
            return new \Error('O saldo disponível do clube é insuficiente.');
        }

        if ($saldoAtualRecurso < 0) {
            return new \Error('O saldo do recurso é insuficiente.');
        }

        try {
            $this->connection->beginTransaction();
            $this->recursoRepository->consumirSaldoRecurso($idRecurso, $saldoAtualRecurso);
            $this->clubeRepository->AtualizarSaldoClube($idClube, $saldoAtualClube);

            $this->connection->commit();
            return true;
        } catch (\Exception $e) {
            $this->connection->rollBack();
            return new Error('Ocorreu um erro ao atualizar o saldo do recurso.');
        }

    }

    public function listarRecursos(): ?array
    {
        return $this->recursoRepository->listarRecursos();
    }
}