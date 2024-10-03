<?php

namespace CBC\Api\Domain\Model;

class Clube
{
    private ?int $id;
    private string $clube;
    private string $saldo_disponivel;


    public function __construct(?int $id, string $clube, string $saldo_disponivel)
    {
        $this->id = $id;
        $this->clube = $clube;
        $this->saldo_disponivel = $saldo_disponivel;
    }

    public function idClube(): int
    {
        return $this->id;
    }

    public function nomeClube(): string
    {
        return $this->clube;
    }

    public function saldoDisponivel(): string
    {
        return $this->saldo_disponivel;
    }

}