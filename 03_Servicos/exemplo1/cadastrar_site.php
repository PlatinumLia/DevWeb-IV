<?php

$nome  = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

try{
    $pdo = new PDO('mysql:host=localhost;dbname=aula_servicos', 'root', 'bancodedados');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo json_encode(['sucesso' => false, 'erro' => 'Erro no banco de dados']);
    exit;
}

if(empty($nome) || empty($email) || empty($senha)){
    echo json_encode(['sucesso' => false, 'erro' => 'Preencha todos os campos!']);
    exit;
}

$stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
$stmt->execute([$email]);

if($stmt->fetch()){
    echo json_encode(['sucesso' => false, 'erro' => 'Este e-mail já está cadastrado!']);
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
$stmt->execute([$nome, $email, $senhaHash]);

echo json_encode(['sucesso' => true, 'mensagem' => 'Usuário cadastrado com sucesso!']);

?>