<?php

namespace CBC\Api\Domain\Model;
class Recurso
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



}