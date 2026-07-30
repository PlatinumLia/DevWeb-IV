<?php

class Serializadora{
    public $nome;
    public $idade;
    public $profissao;

    public function __construct(string $nome, int $idade, string $profissao){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
    }
}

$objeto = new Serializadora("Cibelle", 20, "that");
$objetoSerializado = serialize($objeto);
echo "Objeto Serializado:<br>";
echo $objetoSerializado . "<hr>";

$dadosRecuperados = unserialize($objetoSerializado);
echo "Dados Recuperados:<br>";
var_dump($dadosRecuperados);

?>