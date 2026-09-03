<?php

class ProdutoService{
    private $banco;

    public function __construct($banco){
        $this->banco = $banco;
    }
    
    public function salvar($dados){
        if(empty($dados["nome"])){
            throw new Exception("O campo nome é obrigatório.");
        }

        if(!isset($dados["preco"]) || $dados["preco"] <= 0){
            throw new Exception("O preço deve ser maior que 0.");
        }

        return $this->banco->salvar($dados);
    }
}


?>