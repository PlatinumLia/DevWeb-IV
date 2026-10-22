<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento de Aquário em Tempo Real</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container">
    <h1 >Painel do Aquário</h1>
    <label id="painel"></label>

    <!-- Dashboard com os 3 cards dos sensores -->
    <div class="dashboard">
        <div class="card">
            <h3>pH</h3>
            <div class="valor" id="card-ph">--</div>
        </div>
        <div class="card">
            <h3>Temperatura</h3>
            <div class="valor" id="card-temp">-- °C</div>
        </div>
        <div class="card">
            <h3>Turbidez</h3>
            <div class="valor" id="card-turb">-- NTU</div>
        </div>
    </div>

    <!-- Tabela de Histórico das Leituras -->
    <div class="tabela-container">
        <h2>Histórico de Leituras</h2>
        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Leitura</th>
                <th>Gerenciar</th>
            </tr>
            </thead>
            <tbody id="tabela-leituras">
            <!-- As leituras do banco serão carregadas aqui dinamicamente -->
            </tbody>
        </table>
    </div>
</div>


<script type="module" src="js/app.js"></script>

</body>
</html>