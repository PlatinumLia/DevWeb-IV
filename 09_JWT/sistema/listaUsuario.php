<?php
// Em produção, esta página incluiria 'auth.php' no topo
// require_once __DIR__ . '/auth.php';

require_once __DIR__ . '/conexao.php';

// Busca os dados cadastrados
$stmt = $pdo->query("SELECT id, nome, email, perfil, criado_em FROM usuarios ORDER BY id ASC");
$usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h2>Usuários Cadastrados</h2>
            <a href="principal.php">← Voltar ao Painel</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Data Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id']; ?></td>
                        <td><?= htmlspecialchars($u['nome']); ?></td>
                        <td><?= htmlspecialchars($u['email']); ?></td>
                        <td><?= htmlspecialchars($u['perfil']); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($u['criado_em'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
