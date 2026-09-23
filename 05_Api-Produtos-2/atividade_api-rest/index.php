<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/src/controller/ProdutoController.php';

if($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['api'])){
    header('Location: produtos.php');

    exit;
}

header('Content-Type: application/json; charset=UTF-8');

$controller = new ProdutoController();
$metodo = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

try{
    switch($metodo){
        case 'GET':
            if($id){
                $controller->buscarPorId($id);
            }else{
                $controller->listar();
            }

            break;

        case 'POST':
            $controller->criar();
            
            break;

        case 'PUT':
        case 'PATCH':
            if(!$id){
                http_response_code(400);
                echo json_encode(['erro' => 'Informe o id do produto'], JSON_UNESCAPED_UNICODE);
                
                break;
            }
            
            $controller->atualizar($id);
            
            break;

        case 'DELETE':
            if(!$id){
                http_response_code(400);
                echo json_encode(['erro' => 'Informe o id do produto'], JSON_UNESCAPED_UNICODE);
                
                break;
            }

            $controller->excluir($id);
            
            break;

        default:
            http_response_code(405);
            header('Allow: GET, POST, PUT, PATCH, DELETE');
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
    }
}catch(Exception $e){
    http_response_code(500);
    echo json_encode(['erro' => 'Erro interno do servidor', 'detalhes' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

?>