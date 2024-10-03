<?php

namespace CBC\Api\Api\Models\Recurso;

class ConsumirRecursoRequest
{
    private string $clube_id;
    private string $recurso_id;
    private string $valor_consumo;

    public function __construct(string $clube_id, string $recurso_id, string $valor_consumo)
    {
        $this->clube_id = $clube_id;
        $this->recurso_id = $recurso_id;
        $this->valor_consumo = $valor_consumo;
    }

    public function getClubId(): string
    {
        return $this->clube_id;
    }

    public function getRecursoId(): string
    {
        return $this->recurso_id;
    }

    public function getValorConsumo(): string
    {
        return $this->valor_consumo;
    }
}
