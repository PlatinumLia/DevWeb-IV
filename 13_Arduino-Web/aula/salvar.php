<?php
$temp = $_GET['temp'] ?? null;
$umid = $_GET['umid'] ?? null;

if ($temp !== null && $umid !== null) {
    $linha = date('Y-m-d H:i:s') . " - Temp: {$temp}°C | Umid: {$umid}%\n";
    echo '<script type="module" src="firebase.js"></script>';
    echo "OK: Dados salvos com sucesso!";
} else {
    echo "ERRO: Parametros ausentes.";
}
?>
