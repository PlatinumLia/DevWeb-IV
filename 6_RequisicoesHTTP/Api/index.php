<?php

$dadosPost = json_encode(file_get_contents('php://input'), false);
$banco = new ConexaoBanco();
$produtoService = new ProdutoService($banco);
$controller = new ProdutoController($produtoService);

echo $controller->criar($dadosPost);

?>