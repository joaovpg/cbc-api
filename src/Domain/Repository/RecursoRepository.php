<?php

namespace CBC\API\Domain\Repository;

use CBC\API\Domain\Model\Recurso;

interface RecursoRepository
{
    public function listarRecursos();
    public function buscarRecurso($id);
    public function consumirRecurso(Recurso $recurso);
}