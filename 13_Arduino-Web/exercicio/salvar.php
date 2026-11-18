<?php
$temp = $_GET['temp'] ?? null;
$umid = $_GET['umid'] ?? null;

if ($temp !== null && $umid !== null) {
    $linha = date('Y-m-d H:i:s') . " - Temp: {$temp}°C | Umid: {$umid}%\n";
    file_put_contents('dados.txt', $linha, FILE_APPEND);
    echo "OK: Dados salvos com sucesso!";
} else {
    echo "ERRO: Parametros ausentes.";
}
?>