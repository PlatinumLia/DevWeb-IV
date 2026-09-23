<?php

class ProdutoService{
    private ConexaoBanco $banco;

    public function __construct(ConexaoBanco $banco){
        $this->banco = $banco;
    }

    function salvar($dados){
        if(empty($dados["nome"])){
            throw new Exception("O campo nome é obrigatorio");
        }

        if(!isset($dados["preco"]) || $dados["preco"] <= 0){
            throw new Exception("O preço do produto deve ser maior que 0");
        }

        return $this->banco->salvar($dados);
    }
}

?>