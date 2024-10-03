<?php

namespace CBC\Api\Api\Controllers;

use CBC\Api\Api\Models\Clube\ClubeCadastroRequest;
use CBC\Api\Application\Interfaces\IClubeService;
use Exception;

class ClubeController
{
    private IClubeService $clubeService;

    public function __construct(IClubeService $clubeService)
    {
        $this->clubeService = $clubeService;
    }
    public function getClubes()
    {
        $listaClubes = $this->clubeService->getListaClube();

        header('Content-type: application/json');
        http_response_code(200);
        echo(json_encode($listaClubes));
    }

    public function postClubes()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        if(!isset($dados['clube'])|| !isset($dados['saldo_disponivel'])){
            http_response_code(400);
            echo json_encode(['erro' => 'Dados inválidos. Campos "clube" e "saldo_disponivel" são obrigatórios.']);
            return;
        }

        try {

            $novoClube = new ClubeCadastroRequest($dados['clube'], $dados['saldo_disponivel']);
            $this->clubeService->cadastrarClube($novoClube);

            http_response_code(200);
            echo json_encode(['sucesso' => 'Clube cadastrado com sucesso.']);

        } catch (Exception $e) {
            http_response_code(400);
        }
        header('Content-type: application/json');

    }
}