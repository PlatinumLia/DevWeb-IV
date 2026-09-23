<?php

class ProdutoController{
    private $service;

    public function __construct(ProdutoService $service){
        $this->service = $service;
    }

    public function respostaJSON($dados, $statusCode=200){
        http_response_code($statusCode);
        header('Content-Type: application/json');
        return json_encode($dados);

    }

    public function criar($dadosRequisicao){
        try{
            $resultado = $this->service->salvar($dadosRequisicao);
            return $this->respostaJSON(["sucesso" => true, "dados"=>$resultado], 201);
        }
        catch(Exception $e){
            return $this->respostaJSON(["sucesso"=>false, "Erro"=>$e->getMessage()], 400);
        }
    }
}

?>