<?php

require_once __DIR__ . '/../../config/Database.php';

class ProdutoModel{
    private PDO $conn;

    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public function criar(ProdutoCreateDTO $dto): int{
        $sql = "INSERT INTO produtos (nome, preco, estoque) VALUES (:nome, :preco, :estoque)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $dto->nome);
        $stmt->bindValue(":preco", $dto->preco);
        $stmt->bindValue(":estoque", $dto->estoque, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();
    }

    public function listarTodos(): array{
        $stmt = $this->conn->query(
            "SELECT id, nome, preco, estoque, criado_em
             FROM produtos
             WHERE ativo = 1
             ORDER BY id DESC"
        );

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array{
        $sql = "SELECT id, nome, preco, estoque, criado_em
                FROM produtos
                WHERE id = :id AND ativo = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $produto = $stmt->fetch();

        return $produto ?: null;
    }

    public function atualizar(int $id, ProdutoUpdateDTO $dto): bool{
        $sql = "UPDATE produtos
                SET nome = :nome, preco = :preco, estoque = :estoque
                WHERE id = :id AND ativo = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":nome", $dto->nome);
        $stmt->bindValue(":preco", $dto->preco);
        $stmt->bindValue(":estoque", $dto->estoque, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    public function excluir(int $id): bool{
        /* Exclusão lógica, mantendo o registro no banco */
        $sql = "UPDATE produtos SET ativo = 0 WHERE id = :id AND ativo = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
