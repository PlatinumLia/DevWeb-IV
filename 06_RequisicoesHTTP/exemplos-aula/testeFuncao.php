<?php

require_once './exemplos-aula/respostasJSON.php';

try{
    $nome = "";

    if(empty($nome)){
        throw new Exception("O campo nome não pode ficar vazio.");
    }

    respotasJson(['Sucesso' => true, 'Mensagem' => 'Dados inseridos.'], 200);
}catch(Exception $e){
    respotasJson(['Sucesso' => false, 'Erro: ' => $e->getMessage()], 400);
}

?>