<?php

namespace CBC\Api\Infrastructure\Repository;

use CBC\Api\Domain\Model\Clube;
use CBC\Api\Infrastructure\Interfaces\IClubeRepository;
use PDO;

class ClubeRepositoryPDO implements IClubeRepository
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

        return $this->hydrateListaClubes($stmt);
    }

    public function buscarClubePorId(int $idClube): ?Clube
    {
        $sqlSelectQuery = "SELECT * FROM clube WHERE id = :idClube";

        $stmt = $this->connection->prepare($sqlSelectQuery);

        $stmt->bindValue(":idClube", $idClube);
        $stmt->execute();

        if($stmt->rowCount() === 1){
            $clubeData = $stmt->fetch();

            return new Clube(
             $clubeData["id"],
             $clubeData["clube"],
             $clubeData["saldo_disponivel"],
            );
        }
        return null;
    }

    public function CadastrarClube(Clube $clube): bool
    {
        $sqlInsertQuery = "INSERT INTO clube (clube, saldo_disponivel) VALUES (:clube, :saldo_disponivel)";
        $stmt = $this->connection->prepare($sqlInsertQuery);

        $sucess = $stmt->execute([
            ':clube' => $clube->nomeClube(),
            ':saldo_disponivel' => $clube->saldoDisponivel(),
        ]);

        return $sucess;
    }


    private function hydrateListaClubes(\PDOStatement $stmt): array
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

    public function AtualizarSaldoClube(int $idClube, float $saldo): bool
    {
        $sqlUpdateQuery = "UPDATE clube SET saldo_disponivel = :novoValor WHERE id = :id";
        $stmt = $this->connection->prepare($sqlUpdateQuery);
        $stmt->bindValue(":id", $idClube, PDO::PARAM_INT);
        $stmt->bindValue(":novoValor", $saldo);
        return $stmt->execute();
    }

    public function consultarSaldoClube(int $idClube): float
    {
        $sqlSelectQuery = "SELECT saldo_disponivel FROM clube WHERE id = :idClube";
        $stmt = $this->connection->prepare($sqlSelectQuery);
        $stmt->bindValue(':idClube', $idClube, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn()
        ;
    }
}