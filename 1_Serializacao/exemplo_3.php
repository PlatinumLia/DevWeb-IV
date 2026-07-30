<?php

$jsonCorrompido = '{"Nome":"A", "Idade":20, "Profissao":"that"}';

try{
    $dadosRecuperadosArray = json_decode($jsonCorrompido, true, 512, JSON_THROW_ON_ERROR);
    $dadosRecuperadosObjeto = json_decode($jsonCorrompido, false, 512, JSON_THROW_ON_ERROR);
    
    echo "Dados Recuperados:<br>";
    echo "Array:<br>";
    var_dump($dadosRecuperadosArray);

    echo "<hr>" . "Objeto:<br>";
    var_dump($dadosRecuperadosObjeto);
}catch(JsonException $je){
    echo $je->getMessage();
}

?>