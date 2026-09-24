<?php
require_once __DIR__ . '/conexao.php';

$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Hash seguro de senha usando Bcrypt nativo do PHP
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)");
            $stmt->execute([
                'nome'       => $nome,
                'email'      => $email,
                'senha_hash' => $senha_hash
            ]);

            $mensagem = "Usuário cadastrado com sucesso! <a href='login.php'>Clique aqui para fazer login</a>";
            $tipo_mensagem = "sucesso";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Erro de duplicidade de email
                $mensagem = "O e-mail informado já está cadastrado.";
            } else {
                $mensagem = "Erro ao cadastrar: " . $e->getMessage();
            }
            $tipo_mensagem = "erro";
        }
    } else {
        $mensagem = "Preencha todos os campos do formulário.";
        $tipo_mensagem = "erro";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .box { max-width: 400px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .msg { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .sucesso { background: #d4edda; color: #155724; }
        .erro { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Criar Conta</h2>
        <?php if ($mensagem): ?>
            <div class="msg <?= $tipo_mensagem; ?>"><?= $mensagem; ?></div>
        <?php endif; ?>

        <form method="POST" action="cadastro.php">
            <div class="form-group">
                <label>Nome Completo:</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        <p style="text-align: center; margin-top: 15px;">
            Já tem uma conta? <a href="login.php">Fazer Login</a>
        </p>
    </div>
</body>
</html>
