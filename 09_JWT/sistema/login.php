<?php
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/jwt_helper.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            // Se as funções JWT do aluno já estiverem implementadas:
            if (function_exists('gerar_jwt')) {
                $payload = [
                    'user_id' => $usuario['id'],
                    'nome'    => $usuario['nome'],
                    'email'   => $usuario['email'],
                    'perfil'  => $usuario['perfil'],
                    'exp'     => time() + 3600
                ];
                $jwt = gerar_jwt($payload);
                setcookie('meu_jwt', $jwt, time() + 3600, '/');
            }
            header('Location: principal.php');
            exit;
        } else {
            $mensagem = 'E-mail ou senha inválidos.';
        }
    } else {
        $mensagem = 'Preencha todos os campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema JWT</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .box { max-width: 380px; margin: 50px auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="email"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .msg { padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Acesso ao Sistema</h2>
        <?php if ($mensagem): ?>
            <div class="msg"><?= $mensagem; ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" required placeholder="ex: anacleto@email.com">
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required placeholder="Senha padrão: 123456">
            </div>
            <button type="submit">Entrar</button>
        </form>
        <p style="text-align: center; margin-top: 15px;">
            Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
        </p>
    </div>
</body>
</html>
