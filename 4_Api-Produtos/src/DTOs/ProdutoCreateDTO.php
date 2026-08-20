<?php

class ProdutoCreateDTO{
    public string $nome;
    public float $preco;
    public int $estoque;

    public function __construct(array $dados){
        $this->nome = trim($dados['nome']) ?? '';
        $this->preco = (float)($dados['preco']) ?? 0;
        $this->estoque = (int)($dados['estoque'] )?? 0;
    }

    public function validar():array{
        $erros = [];

        if(empty($this->nome)){
            $erros[] = "O nome é obrigatório."; 
        }
            
        if($this->preco <= 0){
            $erros[] = "Preço deve ser maior que 0.";     
        }
        
        if($this->estoque < 0){
            $erros[] = "Estoque deve ser igual ou maior que 0.";     
        }

        return $erros;
    }
}

?>