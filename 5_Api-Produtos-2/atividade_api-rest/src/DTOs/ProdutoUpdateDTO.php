<?php

require_once __DIR__ . '/ProdutoCreateDTO.php';

class ProdutoUpdateDTO extends ProdutoCreateDTO{
    public function __construct(array $dados){
        parent::__construct($dados);
    }
}

?>