<?php
// Em produção, esta página incluiria 'auth.php' no topo
// require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Principal</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; padding: 0; }
        .nav { background: #333; padding: 15px; color: white; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 800px; margin: 40px auto; padding: 20px; background: white; border-radius: 8px; }
        .cards { display: flex; gap: 20px; margin-top: 20px; }
        .card { flex: 1; padding: 20px; border: 1px solid #ddd; border-radius: 6px; text-align: center; }
        .btn { display: inline-block; padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="nav">
        <h2>Sistema Laboratório JWT</h2>
        <div>Área Restrita</div>
    </div>

    <div class="container">
        <h1>Bem-vindo à Área Inicial!</h1>
        <p>Login efetuado com sucesso. Selecione uma opção abaixo para navegar pelo sistema:</p>

        <div class="cards">
            <div class="card">
                <h3>Cadastrar Novo Usuário</h3>
                <p>Acessar o formulário público de inserção de novos registros.</p>
                <a href="cadastro.php" class="btn">Ir para Cadastro</a>
            </div>
            <div class="card">
                <h3>Tabela de Usuários</h3>
                <p>Visualizar todos os 50 registros cadastrados no banco de dados.</p>
                <a href="listaUsuario.php" class="btn" style="background: #28a745;">Ver Tabela</a>
            </div>
        </div>
    </div>
</body>
</html>
