<?php

namespace CBC\Api\Api\Controllers;

use CBC\Api\Application\Interfaces\IRecursoService;
use Exception;

class RecursoController {
    private IRecursoService $recursoService;
    public function __construct(IRecursoService $recursoService)
    {
        $this->recursoService = $recursoService;
    }

    public function getRecursos()
    {
        $listaRecursos = $this->recursoService->listarRecursos();

        header('Content-type: application/json');
        http_response_code(200);
        echo(json_encode($listaRecursos));
    }

    public function postConsumirRecurso()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        if(!isset($dados['clube_id'])|| !isset($dados['recurso_id']) || !isset($dados['valor_consumo'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados inválidos. Campos "recurso_id", "valor_consumo" e "clube_id" são obrigatórios.']);
            return;
        }

        try {
            $idClube = $dados['clube_id'];
            $idRecurso = $dados['recurso_id'];
            $valorConsumo = $dados['valor_consumo'];
            $this->recursoService->consumirRercurso($valorConsumo,  $idRecurso, $idClube);

            http_response_code(200);
            echo json_encode(['sucesso' => 'Mudar resposta.']);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['erro' => $e->getMessage()]);
        }
        header('Content-type: application/json');
    }
}