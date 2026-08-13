<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(200);
    exit;
}

require_once '../usuarioService.php';
require_once 'usuario_DTO.php';

header('Content-Type: application/json');

$jsonRecebido = file_get_contents('php://input');
$dados = json_decode($jsonRecebido, true);

if(!$dados){
    echo json_encode(['sucesso' => false, 'erro' => 'Payload JSON inválido ou vazio']);
    exit;
}

$nome  = $dados['nome'] ?? '';
$email = $dados['email'] ?? '';
$senha = $dados['senha'] ?? '';

try{
    $pdo = new PDO('mysql:host=localhost;dbname=aula_servicos', 'root', 'bancodedados');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $usuarioService = new UsuarioService($pdo);
    $usuarioDTO = $usuarioService->cadastrarComDTO($nome, $email, $senha);
    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Usuário cadastrado com sucesso!',
        'dados' => $usuarioDTO->toArray()
    ]);

}catch (Exception $e){
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
}

?>