<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Leitura - Monitoramento de Aquário</title>
    <link rel="stylesheet" href="css\estilo_form.css">
</head>
<body>

<div class="container">
    <h2>Editar Leitura</h2>

    <form id="form-editar">
        <div class="campo">
            <label for="ph">pH:</label>
            <input type="number" step="0.1" id="ph" required>
        </div>

        <div class="campo">
            <label for="temperatura">Temperatura (°C):</label>
            <input type="number" step="0.1" id="temperatura" required>
        </div>

        <div class="campo">
            <label for="turbidez">Turbidez (NTU):</label>
            <input type="number" step="0.1" id="turbidez" required>
        </div>

        <div class="botoes">
            <button type="submit">Salvar Alterações</button>
            <a href="index.html" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>

<script type="module" src="js/app.js"></script>
</body>
</html>