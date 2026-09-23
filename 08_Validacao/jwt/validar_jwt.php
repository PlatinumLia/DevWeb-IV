<?php

$chave_secreta = "minhaSenhaSecreta";

$jwt_recebido = "eyJhbGciOiJIMjU2IiwidHlwIjoiSldUIn0.eyJ1c2VyX2lkIjo0Miwibm9tZSI6IkFuYWNsZXRvIiwicGVyZmlsIjoiZXN0dWRhbnRlIiwiZXhwIjoxNzg5NjA4NjM1fQ.Z9SfOoWMuK4FVkytamVaAQElZ4lbk4CiHIg10cVFrbE";

function base64URL_encode($dados){
    /* Codifica os dados depois substitui os caracteres[+ , /, =] para serem usado na web, evitando conflito com caracteres com funções especificas */
    return str_replace(['+', "/", "="], ["-", "_", ""], base64_encode($dados));
}

function base64URL_decode($dados){
    /* Codifica os dados depois substitui os caracteres[+ , /, =] para serem usado na web, evitando conflito com caracteres com funções especificas */
    return str_replace(["-", "_", ""], ['+', "/", "="], base64_decode($dados));
}

$partes = explode(".", $jwt_recebido);

if(count($partes) !== 3){
    die("Formato do token invalido!");
}

/* Separando os elementos do jwt */
$header_base64 = $partes[0];
$payload_base64 = $partes[1];
$assinatura_cliente_base64 = $partes[2];

$conteudo_para_assinar = $header_base64 . "." . $payload_base64; // recria o conteudo para validar com a assinatura recebida

$assinatura_recalculada = hash_hmac("sha256", $conteudo_para_assinar, $chave_secreta, true); 

$assinatura_recalculada_base64 = base64URL_encode($assinatura_recalculada);

if($assinatura_cliente_base64 !== $assinatura_recalculada_base64){
    die("ERRO: Token invalido!");
}

$decode = base64URL_decode(($payload_base64));
$payload = json_decode($decode, true);

if(isset($payload['exp']) && $payload['exp'] < time()){
    die("ERRO: Token expirado");
}

echo "Usuario autenticado: " . $payload['nome'] . "<br>";

?>