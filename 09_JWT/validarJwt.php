<?php

$chaveSecreta = "IzanagiNoOkamiPicaro";

function base64url_decode($dados){
    return base64_decode(str_replace(['-', '_', ''], ['+', '/', '='], $dados));
}

if(!isset($_COOKIE['meu_jwt'])){
    die("Acesso negado
    <a href='login.php'>Fazer login</a>");
}

$jwt_recebido = $_COOKIE['meu_jwt'];
$partes = explode(".", $jwt_recebido);

if(count($partes)){
    die("Acesso negado; Token inválido
    <a href='login.php'>Fazer login</a>");
}

$headerBase64 = $partes[0];
$payloadBase64 = $partes[1];
$assinaturaCliente = $partes[2];
$assinaturaBruta = hash_hmac('sha256', $headerBase64 . "." . $payloadBase64, $chaveSecreta);
$assinaturaRecalculada = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($assinaturaBruta));

if($assinaturaRecalculada !== $assinaturaCliente){
    die("ALERTA: Token adulterado");
}

$payload = json_decode(base64url_decode($payloadBase64), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Olá <?php echo $payload["nome"]; ?> 
    </h1>
</body>
</html>