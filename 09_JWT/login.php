<?php

$chaveSecreta = "IzanagiNoOkamiPicaro";

function base64url_encode($dados){
    return str_replace(['+', '/', '='], ['-', '_', '='], base64_encode($dados));
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST["usuario"] ?? "";
    $passwd = $_POST["senha"] ?? "";

    if($user == "admin" && $passwd = "123"){
        $header = base64url_encode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
        $payload = base64url_encode(json_encode([
            'user_id' => 90,
            'nome' => 'Anacléto',
            'exp' => time() + 3600
        ]));
        $assinaturaBruta = hash_hmac('sha256', $header . "." . $payload, $chaveSecreta, true);
        $assinatura = base64_encode($assinaturaBruta);
        $jwt = $header . "." . $payload . "." . $assinatura;
        
        setcookie("meu_jwt", $jwt, time() + 3600, "/");
        header("location: validar_jwt.php");
        exit;
    }else{
        echo "Usuário ou senha incorreta.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Usuário: </label>
        <input type="text" name="usuario"><br>

        <label for="">Senha: </label>
        <input type="text" name="senha"><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>