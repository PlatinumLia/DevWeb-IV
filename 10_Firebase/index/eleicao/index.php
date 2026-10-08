
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eleição em Tempo Real</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <h1>Apuração da Eleição em Tempo Real</h1>
    <div class="painel-votos">
        <div class="card-candidato">
            <h3>Joclertano</h3>
            <div id="votos-joclertano" class="total-votos">0</div>
        </div>

        <div class="card-candidato">
            <h3>Anacleto</h3>
            <div id="votos-anacleto" class="total-votos">0</div>
        </div>
    </div>

    <!-- Formulário com dois botões que enviam o nome do candidato no mesmo campo 'candidato' -->
    <form method="POST" action="votos.php">
        <button type="submit" name="candidato" value="joclertano">Votar em Joclertano</button>
        <button type="submit" name="candidato" value="anacleto">Votar em Anacleto</button>
    </form>

    <script type="module" src="funcoes.js"></script>
</body>

</html>