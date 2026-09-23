<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(200);
    exit;
}

require_once '../usuarioService.php';

try{
    $pdo = new PDO('mysql:host=localhost;dbname=aula_servicos', 'root', 'bancodedados');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $usuarioService = new UsuarioService($pdo);

    $metodo = $_SERVER['REQUEST_METHOD'];

    switch($metodo){
        case 'POST':
            $dados = json_decode(file_get_contents('php://input'), true);
            $dto = $usuarioService->cadastrarComDTO(
                $dados['nome'] ?? '',
                $dados['email'] ?? '',
                $dados['senha'] ?? ''
            );

            http_response_code(201);
            echo json_encode(['sucesso' => true, 'dados' => $dto->toArray()]);

            break;

        case 'GET':
            $listaDTOs = $usuarioService->listarTodos();

            $resposta = array_map(fn($dto) => $dto->toArray(), $listaDTOs);

            http_response_code(200);
            echo json_encode(['sucesso' => true, 'dados' => $resposta]);

            break;

        case 'DELETE':
            $id = $_GET['id'] ?? null;

            if(!$id){
                http_response_code(400);
                echo json_encode(['sucesso' => false, 'erro' => 'Informe o ID na URL! (ex: usuarios.php?id=1)']);

                exit;
            }

            $usuarioService->deletar((int)$id);
            http_response_code(200);
            echo json_encode(['sucesso' => true, 'mensagem' => "Usuário $id removido com sucesso!"]);

            break;

        default:
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(['erro' => 'Método HTTP não permitido!']);

            break;
    }

}catch (Exception $e){
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
}

?>