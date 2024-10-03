<?php

namespace CBC\Api\Infrastructure\Repository;

use CBC\Api\Domain\Model\Recurso;
use CBC\Api\Infrastructure\Interfaces\IRecursoRepository;
use PDO;

class RecursoRepository implements IRecursoRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function listarRecursos(): array
    {
        $sqlQuery = "SELECT * FROM recurso";
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydrateListaRecursos($stmt);
    }

    public function consumirSaldoRecurso(int $id, float $saldo): bool
    {
        $sqlUpdateQuery = "UPDATE recurso SET saldo_disponivel = :novoValor WHERE id = :id";
        $stmt = $this->connection->prepare($sqlUpdateQuery);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':novoValor', $saldo, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function consultarSaldoRecurso($id): false|null|string
    {
        $sqlSelectQuery = "SELECT saldo_disponivel FROM recurso WHERE id = :id";
        $stmt = $this->connection->prepare($sqlSelectQuery);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    private function hydrateListaRecursos(\PDOStatement $stmt): array
    {
        $recursoDataList = $stmt->fetchAll();
        $recursoList = [];

        foreach ($recursoDataList as $recursoData) {
            $recursoList[] = new Recurso(
                $recursoData['id'],
                $recursoData['recurso'],
                $recursoData['saldo_disponivel'],
            );
        }

        return $recursoList;
    }
}
