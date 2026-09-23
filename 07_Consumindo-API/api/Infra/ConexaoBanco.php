<?php

class ConexaoBanco{
    private static $host = "localhost";
    private static $db_name = "sistema_teste";
    private static $username = "root";
    private static $password = "bancodedados";
    private $pdo = null;

    function getConexao(){
        if($this->pdo ==null){
            $this->pdo = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username, self::$password);
        }

        return $this->pdo;
    }

    function salvar($dados){
        $sql = "INSERT INTO produtos(nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->getConexao()->prepare($sql);
        $stmt->execute([":nome"=>$dados["nome"], ":preco"=>$dados["preco"]]);
        return [
            "id" => $this->getConexao()->lastInsertId(),
            "nome" => $dados["nome"],
            "preco"=> $dados["preco"]
        ];
    }
}

?>