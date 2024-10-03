<?php

namespace CBC\Api\Api\Models\Recurso;

use JsonSerializable;

class ConsumirRecursoResponse implements JsonSerializable
{
    private string $clube;
    private string $saldoAnterior;
    private string $saldoAtual;

    public function __construct(string $clube, string $saldoAnterior, string $saldoAtual)
    {
        $this->clube = $clube;
        $this->saldoAnterior = $saldoAnterior;
        $this->saldoAtual = $saldoAtual;
    }

    public function getClube(): string
    {
        return $this->clube;
    }

    public function getSaldoAnterior(): string
    {
        return $this->saldoAnterior;
    }

    public function getSaldoAtual(): string
    {
        return $this->saldoAtual;
    }

    public function jsonSerialize()
    {
        return [
            'clube' => $this->clube,
            'saldo_anterior' => $this->saldoAnterior,
            'saldo_disponivel' => $this->saldoAtual
        ];
    }
}
