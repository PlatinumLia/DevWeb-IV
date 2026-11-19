<?php
$temp = $_GET['temp'] ?? null;
$umid = $_GET['umid'] ?? null;

if($temp && $umid){
    $url = "https://aquario-7d5f2-default-rtdb.firebaseio.com/aquario.json?auth=xtMBVwkSiBWh3IsrSeXF6dD5OLIi772tWxT3HUjK";

    $dados = json_encode([
        "temperatura" => (float)$temp,
        "umidade" => (float)$umid
    ]);

    $opcoes = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json\r\n',
            'content' => $dados
        ]
    ];

    $resposta = file_get_contents($url, false, stream_context_create($opcoes));

    echo "Firebase respondeu: " . $resposta;
}else{
    echo "Faltam parâmetros";
}

?>