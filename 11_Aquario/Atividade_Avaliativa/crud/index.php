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

    <!-- Bloco de Filtro por Data -->
    <div class="card-filtro" style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;">
        <h4 style="margin-top: 0; color: #333;">Filtrar Histórico por Período</h4>
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div>
                <label for="data-inicio" style="font-size: 14px; font-weight: bold;">Data Inicial:</label><br>
                <input type="date" id="data-inicio" style="padding: 6px; border-radius: 4px; border: 1px solid #ccc;">
            </div>
            <div>
                <label for="data-fim" style="font-size: 14px; font-weight: bold;">Data Final:</label><br>
                <input type="date" id="data-fim" style="padding: 6px; border-radius: 4px; border: 1px solid #ccc;">
            </div>
            <div style="margin-top: 18px;">
                <button id="btn-filtrar" class="btn-acao" style="background-color: #0d6efd; color: white; padding: 7px 15px; border: none; border-radius: 4px; cursor: pointer;">Filtrar</button>
                <button id="btn-limpar-filtro" class="btn-acao" style="background-color: #6c757d; color: white; padding: 7px 15px; border: none; border-radius: 4px; cursor: pointer; margin-left: 5px;">Mostrar Todos</button>
            </div>
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
<script type="module" src="js/filtrar.js"></script>

</body>
</html>