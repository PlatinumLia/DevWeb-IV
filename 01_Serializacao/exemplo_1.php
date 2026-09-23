<?php

$vetor = [
    "nome" => "Satanael",
    "idade" => 0,
    "profissao" => "pillager"
];

$dadosSerializados = serialize($vetor);
echo "Dados Serializados:<br>";
echo $dadosSerializados . "<hr>";

$dadosRecuperados = unserialize($dadosSerializados);
echo "Dados Recuperados:<br>";
var_dump($dadosRecuperados);

?>