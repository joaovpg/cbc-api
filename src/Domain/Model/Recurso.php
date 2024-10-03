<?php

namespace CBC\Api\Domain\Model;
class Recurso implements \JsonSerializable
{
    private ?int $id;
    private string $recurso;
    private string $saldo_disponivel;

    public function __construct(?int $id, string $recurso, string $saldo_disponivel)
    {
        $this->id = $id;
        $this->recurso = $recurso;
        $this->saldo_disponivel = $saldo_disponivel;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecurso(): string
    {
        return $this->recurso;
    }

    public function getSaldoDisponivel(): string
    {
        return $this->saldo_disponivel;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'clube' => $this->clube,
            'saldo_disponivel' => $this->saldo_disponivel
        ];
    }

}