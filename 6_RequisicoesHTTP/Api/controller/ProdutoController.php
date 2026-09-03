<?php

class ProdutoController{
    private $service;

    public function __construct($service){
        $this->service = $service; 
    }

    function respotasJson($dados, $statusCode = 200){
        http_response_code($statusCode);
        header('Content-type: application/json');
        echo json_encode($dados);
    
        exit;
    }

    public function criar($dadosRequisicao){
        try{
            $resultado = $this->service->salvar($dadosRequisicao);

            return $this->respotasJson(['sucesso' => true, 'dados' => $resultado], 201);
        }catch(Exception $e){
            return $this->respotasJson(['sucesso' => false, 'erro' => $e->getMessage()], 400); 
        }
    }
}

?>