<?php

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if($id <= 0){
    header('Location: produtos.php?mensagem=' . urlencode('ID do produto inválido.'));
    exit;
}

try{
    $url = 'http://' . $_SERVER['HTTP_HOST']. rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'). '/index.php?api=1&id=' . $id;

    $opcoes = [
        'http' => [
            'method' => 'DELETE',
            'header' => "Accept: application/json",
            'ignore_errors' => true
        ]
    ];

    $contexto = stream_context_create($opcoes);

    $resposta = file_get_contents($url, false, $contexto);

    if($resposta === false){
        throw new RuntimeException('Não foi possível comunicar com a API.');
    }

    $resultado = json_decode($resposta, true);

    if(!is_array($resultado)){
        throw new RuntimeException('A API retornou uma resposta inválida.');
    }

    if(isset($resultado['mensagem'])){
        header('Location: produtos.php?mensagem=' . urlencode($resultado['mensagem']));

        exit;
    }

    $erro = $resultado['erro'] ?? 'Não foi possível excluir o produto.';

    header('Location: produtos.php?mensagem=' . urlencode($erro)
    );

    exit;

}catch(Throwable $e){
    header('Location: produtos.php?mensagem=' . urlencode('Erro ao excluir o produto: ' . $e->getMessage()));
    
    exit;
}

?>