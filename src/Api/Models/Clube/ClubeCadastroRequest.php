<?php

namespace CBC\Api\Api\Models\Clube;
class ClubeCadastroRequest
{
    private string $nome;
    private string $saldo_disponivel;

    function __construct(string $nome, string $saldo_disponivel)
    {
        $this->nome = $nome;
        $this->saldo_disponivel = $saldo_disponivel;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSaldoDisponivel(): string
    {
        return $this->saldo_disponivel;
    }
}