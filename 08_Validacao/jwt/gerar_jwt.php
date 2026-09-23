<?php

$chave_secreta = "minhaSenhaSecreta";

$header = [ // Cabeçalho: algoritmo de cripto, tipo de dados
    "alg" => "H256",
    "typ" => "JWT",
];

$payload = [ // Dados do usuario, usado por diferentes sistema para valida-lo
    "user_id" => 42,
    "nome" => "Anacleto",
    "perfil" => "estudante",
    "exp" => time() + 3600 // Define o tempo para expirar a permissão da validação
];

function base64URL_encode($dados){
    /* Codifica os dados depois substitui os caracteres[+ , /, =] para serem usado na web, evitando conflito com caracteres com funções especificas */
    return str_replace(['+', "/", "="], ["-", "_", ""], base64_encode($dados));
}

$header_base64 = base64URL_encode(json_encode($header));
$payload_base64 = base64URL_encode(json_encode($payload));

$conteudo_para_assinar = $header_base64 . "." . $payload_base64;

/* Criando o JWT(header(criptografado) + payload(criptografado) + assinatura(criptografada)) */

$assinatura_bruta = hash_hmac("sha256", $conteudo_para_assinar, $chave_secreta, true); // true: indica que a ASSINATURA SERA BINARIO
$assinatura_base64 = base64URL_encode($assinatura_bruta);

$jwt = $header_base64 . "." . $payload_base64 . "." . $assinatura_base64;

echo "<textarea cols='100' row='5'>{$jwt}</textarea>";

?>