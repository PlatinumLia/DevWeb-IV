<?php

require_once '../usuarioService.php';
header('Content-Type: application/json');

$nome  = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

try{
    $pdo = new PDO('mysql:host=localhost;dbname=aula_servicos', 'root', 'bancodedados');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo json_encode(['sucesso' => false, 'erro' => 'Erro interno no banco de dados']);
    exit;
}

try{
    $usuarioService = new UsuarioService($pdo);
    $mensagem = $usuarioService->cadastrar($nome, $email, $senha);

    echo json_encode(['sucesso' => true, 'mensagem' => $mensagem]);
}catch(Exception $e){
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
}

?>