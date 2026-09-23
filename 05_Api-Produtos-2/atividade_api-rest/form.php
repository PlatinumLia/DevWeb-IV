<?php

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$modoEdicao = $id > 0;

$nome = '';
$preco = '';
$estoque = '';
$erros = [];
$mensagem = '';

function chamarApi(string $metodo, string $url, ?array $dados = null): array{
    $cabecalho = "Accept: application/json";

    $opcoes = [
        'http' => [
            'method' => $metodo,
            'header' => $cabecalho,
            'ignore_errors' => true
        ]
    ];

    if($dados !== null){
        $json = json_encode($dados, JSON_UNESCAPED_UNICODE);

        $opcoes['http']['header'] .= "Content-Type: application/json";
        $opcoes['http']['content'] = $json;
    }

    $contexto = stream_context_create($opcoes);
    $resposta = file_get_contents($url, false, $contexto);

    if($resposta === false){
        throw new RuntimeException('Não foi possível comunicar com a API.');
    }

    $resultado = json_decode($resposta, true);

    if(!is_array($resultado)){
        throw new RuntimeException('A API retornou uma resposta inválida.');
    }

    return $resultado;
}

$baseApi = 'http://' . $_SERVER['HTTP_HOST']. rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'). '/index.php?api=1';

if($modoEdicao && $_SERVER['REQUEST_METHOD'] === 'GET'){
    try{
        $produto = chamarApi('GET', $baseApi . '&id=' . $id);

        if(isset($produto['id'])){
            $nome = $produto['nome'] ?? '';
            $preco = $produto['preco'] ?? '';
            $estoque = $produto['estoque'] ?? '';
        }else{
            $erros[] = $produto['erro'] ?? 'Produto não encontrado.';
        }
    }catch(Throwable $e){
        $erros[] = 'Erro ao carregar o produto: ' . $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = trim($_POST['nome'] ?? '');
    $preco = $_POST['preco'] ?? '';
    $estoque = $_POST['estoque'] ?? '';

    $dados = [
        'nome' => $nome,
        'preco' => $preco,
        'estoque' => $estoque
    ];

    try{
        if($modoEdicao){
            $resultado = chamarApi('PUT', $baseApi . '&id=' . $id, $dados);
        }else{
            $resultado = chamarApi('POST', $baseApi, $dados);
        }

        if(isset($resultado['erros'])){
            $erros = $resultado['erros'];
        }else if(isset($resultado['erro'])){
            $erros[] = $resultado['erro'];
        }else{
            $mensagem = $modoEdicao ? 'Produto atualizado com sucesso!' : 'Produto cadastrado com sucesso!';

            header('Location: produtos.php?mensagem=' . urlencode($mensagem));
            
            exit;
        }
    }catch(Throwable $e){
        $erros[] = 'Erro ao salvar o produto: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $modoEdicao ? 'Editar produto' : 'Cadastrar produto' ?></title>
</head>
<body>
    <h1><?= $modoEdicao ? 'Editar produto' : 'Cadastrar produto' ?></h1>

    <p><a href="produtos.php">Voltar para a lista</a></p>

    <?php if(!empty($erros)): ?>
        <div>
            <h3>Erros:</h3>
            <ul>
                <?php foreach($erros as $erro): ?>
                    <li><?= $erro ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <?php if($modoEdicao): ?>
            <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif; ?>

        <label for="nome">Nome:</label>
        <br>
        <input type="text" id="nome" name="nome"
               value="<?= $nome ?>" required>
        <br><br>

        <label for="preco">Preço:</label>
        <br>
        <input type="number" id="preco" name="preco"
               value="<?= (string) $preco ?>"
               step="0.01" min="0.01" required>
        <br><br>

        <label for="estoque">Estoque:</label>
        <br>
        <input type="number" id="estoque" name="estoque"
               value="<?= (string) $estoque ?>"
               min="0" required>
        <br><br>

        <button type="submit">
            <?= $modoEdicao ? 'Atualizar' : 'Cadastrar' ?>
        </button>
    </form>
</body>
</html>
