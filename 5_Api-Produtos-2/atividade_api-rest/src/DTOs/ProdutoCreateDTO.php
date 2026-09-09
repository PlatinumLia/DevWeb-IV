<?php

class ProdutoCreateDTO{
    public string $nome;
    public float $preco;
    public int $estoque;
    
    public function __construct(array $dados) {
        $this->nome = trim($dados['nome'] ?? '');
        $this->preco = (float)($dados['preco'] ?? 0);
        $this->estoque = (int)($dados['estoque'] ?? 0);

    }
    
    public function validar():array {
        $erros = [];

        if(empty($this->nome)){
            $erros[]="O campo nome é obrigatorio";
        }

        if($this->preco<=0){
            $erros[]="O preço deve ser maior que zero";
        }

        if($this->estoque<0){
            $erros[]="O estoque não pode ser negativo";
        }

        return $erros;
    }
}

?>