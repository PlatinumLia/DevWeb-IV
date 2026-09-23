<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/Database.php';

class ProdutoModel{
    private PDO $db;

    public function __construct(){
        $this->db = DataBase::getConnection();
    }

    public function criar(ProdutoCreateDTO $dto):int{
        $sql = "INSERT INTO produtos (nome, preco, estoque) values" . "(:nome, :preco, :estoque)";

        $stm = $this->db->prepare($sql);
        $stm->bindValue(':nome', $dto->nome);
        $stm->bindValue(':preco', $dto->preco);
        $stm->bindValue(':estoque', $dto->estoque);
        $stm->execute();

        return (int) $this->db->lastInsertId();
    }

    public function buscarPorId(int $id):?array{
        $sql = "SELECT * FROM produtos WHERE id = :id AND ativo = 1";

        $stm = $this->db->prepare($sql);
        $stm->bindValue(':id', PDO::PARAM_INT);
        $stm->execute();

        $produto = $stm->fetch();

        return $produto ?: null;
    }
}

?>