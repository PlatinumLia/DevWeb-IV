<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="POST">
        <input type="text" name="nome" placeholder="Nome">
        <input type="number" step="0.01" name="preco" placeholder="Preço">
        <input type="number" name="estoque" placeholder="Estoque">
        <button type="submit">Enviar</button>
    </form>

    <div>
        <?php
            require_once 'src/DTOs/ProdutoResponseDTO.php';

            echo json_encode(["mensagem" => "Produto cadastrado.", "dados" => ProdutoResponseDTO::render($produto)]) ?? '';
        ?>
    </div>
</body>

</html>