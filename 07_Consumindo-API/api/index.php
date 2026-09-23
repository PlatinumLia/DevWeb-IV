<?php

require_once __DIR__ . '/Infra/ConexaoBanco.php';
require_once __DIR__ . '/Controller/ProdutoController.php';
require_once __DIR__ . '/Service/ProdutoService.php';

$dadosPost = json_decode(file_get_contents('php://input'), true);

$banco = new ConexaoBanco();
$service = new ProdutoService($banco);
$controller = new ProdutoController($service);

echo $controller->criar($dadosPost);


?>