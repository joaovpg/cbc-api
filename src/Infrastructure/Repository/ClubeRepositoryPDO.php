<?php

namespace CBC\Api\Infrastructure\Repository;

use CBC\Api\Domain\Model\Clube;
use CBC\Api\Domain\Repository\ClubeRepository;
use PDO;

class ClubeRepositoryPDO implements ClubeRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function listarClubes(): array
    {
        $sqlQuery = "SELECT * FROM clube";
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydrateClubes($stmt);
    }

    public function buscarCursoPorId(int $idClube): ?Clube
    {
        // TODO: Implement buscarCursoPorId() method.
    }

    public function CadastrarClube(Clube $clube): bool
    {
        // TODO: Implement CadastrarClube() method.
    }


    private function hydrateClubes(\PDOStatement $stmt): array
    {
        $clubeDataList = $stmt->fetchAll();
        $clubeList = [];

        foreach ($clubeDataList as $clubeData) {
            $clubeList[] = new Clube(
                $clubeData['id'],
                $clubeData['clube'],
                $clubeData['saldo_disponivel'],
            );
        }

        return $clubeList;
    }
}