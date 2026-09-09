<?php
$mensagem = $_GET['mensagem'] ?? '';
$erro = '';
$produtos = [];

try {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/index.php?api=1';

    $opcoes = [
        'http' => [
            'method' => 'GET',
            'header' => "Accept: application/json\r\n",
            'ignore_errors' => true
        ]
    ];

    $contexto = stream_context_create($opcoes);
    $resposta = file_get_contents($url, false, $contexto);

    if ($resposta === false) {
        throw new RuntimeException('Não foi possível comunicar com a API.');
    }

    $dados = json_decode($resposta, true);

    if (!is_array($dados)) {
        throw new RuntimeException('A API retornou uma resposta inválida.');
    }

    if (isset($dados['erro'])) {
        $erro = $dados['erro'];
    } else {
        $produtos = $dados;
    }
} catch (Throwable $e) {
    $erro = 'Erro ao carregar produtos: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos</h1>

    <p><a href="form.php">Cadastrar novo produto</a></p>

    <?php if ($mensagem): ?>
        <p><?= $mensagem?></p>
    <?php endif; ?>

    <?php if ($erro): ?>
        <p><?= $erro?></p>
    <?php endif; ?>

    <?php if (empty($produtos)): ?>
        <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= $produto['id'] ?></td>
                        <td><?= $produto['nome'] ?></td>
                        <td>R$ <?= number_format((float) ($produto['preco'] ?? 0), 2, ',', '.') ?></td>
                        <td><?= $produto['estoque']?></td>
                        <td><?= $produto['criado_em'] ?></td>
                        <td>
                            <a href="form.php?id=<?= (int) $produto['id'] ?>">Editar</a>
                            |
                            <a href="excluir.php?id=<?= (int) $produto['id'] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
