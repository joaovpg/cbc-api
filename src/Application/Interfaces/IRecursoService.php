<?php

namespace CBC\Api\Application\Interfaces;
interface IRecursoService
{
    public function consumirRercurso(string $valorConsumido, int $idRecurso, int $idClube): bool;
    public function listarRecursos(): ?array;

}