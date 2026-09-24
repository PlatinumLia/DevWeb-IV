<?php

$payload = [
    'user_id' => 42,
    'nome' => 'Anaclétos',
    'perfil' => 'estudante',
    'exp' => time() + 3600
];

echo "Vetor:<br>";
print_r($payload);

echo "<hr>Vetor -> JSON:<br>";
$json = json_encode($payload);
print_r($json);

echo "<hr>JSON -> Base64:<br>";
$json64 = base64_encode($json);
print_r($json64);

echo "<hr>Base64 -> Base64URL:<br>";
$json64Url = str_replace(['+', '/', '='], ['-', '_', ''], $json64);
print_r($json64Url); 

?>