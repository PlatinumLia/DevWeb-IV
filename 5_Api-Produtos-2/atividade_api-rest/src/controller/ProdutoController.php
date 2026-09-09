<?php

require_once __DIR__ . '/../models/ProdutoModel.php';
require_once __DIR__ . '/../DTOs/ProdutoCreateDTO.php';
require_once __DIR__ . '/../DTOs/ProdutoUpdateDTO.php';
require_once __DIR__ . '/../DTOs/ProdutoResponseDTO.php';

class ProdutoController{
    private ProdutoModel $model;

    public function __construct(){
        $this->model = new ProdutoModel();
    }

    private function dadosDaRequisicao(): array{
        $json = file_get_contents('php://input');
        $dados = json_decode($json, true);

        return is_array($dados) ? $dados : $_POST;
    }

    private function responder(array $dados, int $status = 200): void{
        http_response_code($status);
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    }

    public function criar(): void{
        $dto = new ProdutoCreateDTO($this->dadosDaRequisicao());
        $erros = $dto->validar();

        if($erros){
            $this->responder(['erros' => $erros], 400);
            return;
        }

        $id = $this->model->criar($dto);
        $produto = $this->model->buscarPorId($id);

        $this->responder(ProdutoResponseDTO::render($produto), 201);
    }

    public function listar(): void{
        $produtos = $this->model->listarTodos();
        $this->responder(ProdutoResponseDTO::renderList($produtos));
    }

    public function buscarPorId(int $id): void{
        $produto = $this->model->buscarPorId($id);

        if(!$produto){
            $this->responder(['erro' => 'Produto não encontrado'], 404);
            return;
        }

        $this->responder(ProdutoResponseDTO::render($produto));
    }

    public function atualizar(int $id): void{
        if(!$this->model->buscarPorId($id)){
            $this->responder(['erro' => 'Produto não encontrado'], 404);

            return;
        }

        $dto = new ProdutoUpdateDTO($this->dadosDaRequisicao());
        $erros = $dto->validar();

        if($erros){
            $this->responder(['erros' => $erros], 400);
            return;
        }

        $this->model->atualizar($id, $dto);
        $produto = $this->model->buscarPorId($id);

        $this->responder(ProdutoResponseDTO::render($produto));
    }

    public function excluir(int $id): void{
        if(!$this->model->excluir($id)){
            $this->responder(['erro' => 'Produto não encontrado'], 404);

            return;
        }

        $this->responder(['mensagem' => 'Produto excluído com sucesso']);
    }
}

?>