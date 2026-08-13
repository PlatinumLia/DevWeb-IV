<?php

class ProdutoDTO{
    private int $id;
    private string $nome;
    private float $preco;
    private int $estoque;

    public function __construct(int $id, string $nome, float $preco){
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function toArray(): array{
        return [
            'id' => $this->id, 
            'nome' => $this->nome, 
            'preco' => $this->preco, 
        ];
    }
}

?>