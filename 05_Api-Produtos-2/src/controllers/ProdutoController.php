<?php

require_once __DIR__ . '/../models/ProdutoModel.php';
require_once __DIR__ . '/../DTOs/ProdutoCreateDTO.php';
require_once __DIR__ . '/../DTOs/ProdutoResponseDTO.php';

class ProdutoController{
    private ProdutoModel $model;

    public function __construct(){
        $this->model = new ProdutoModel();
    }

    public function criar():?array{
        $json = file_get_contents('php://input');
        $dados = json_decode($json, true) ?? $_POST;
        $dto = new ProdutoCreateDTO($dados);
        $erros = $dto->validar();

        if(!empty($erros)){
            http_response_code(400);
            echo json_encode(["erros" => $erros]);
        
            return null;
        }

        $idCriado = $this->model->criar($dto);
        $produtoCriado = $this->model->buscarPorId($idCriado);

        http_response_code(201);

        return $produtoCriado;
    }

    public function listar():void{
        $produtos = $this->model->listarTodos();
        
        http_response_code(200);
        echo json_encode(ProdutoResponseDTO::renderList($produtos));
    }

    public function buscarPorId(int $id):void{
        $produto = $this->model->buscarPorId($id);
        
        if(!$produto){
            http_response_code(404);
            echo json_encode(["erro" => "Produto não encontrado."]);

            return;
        }

        http_response_code(200);
        echo json_encode([ProdutoResponseDTO::render($produto)]);
    }
}

?>