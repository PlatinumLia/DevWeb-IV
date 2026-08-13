<?php

require_once '../exemplo2/usuario_DTO.php';

class usuarioService{
    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $email, $senha){
        if(empty($nome) || empty($email) || empty($senha)){
            throw new Exception("Preencha todos os campos!");
        }

        $stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);

        if($stmt->fetch()){
            throw new Exception("Este e-mail já está cadastrado!");
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $email, $senhaHash]);

        return "Usuário cadastrado com sucesso!";
    }

    public function cadastrarComDTO($nome, $email, $senha): UsuarioDTO{
        if(empty($nome) || empty($email) || empty($senha)){
            throw new Exception("Preencha todos os campos!");
        }

        $stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);

        if($stmt->fetch()){
            throw new Exception("Este e-mail já está cadastrado!");
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $email, $senhaHash]);
        $idGerado = (int) $this->pdo->lastInsertId();

        return new UsuarioDTO($idGerado, $nome, $email);
    }

    public function listarTodos(): array{
        $stmt = $this->pdo->query('SELECT id, nome, email FROM usuarios');
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach($usuarios as $u){
            $dtos[] = new UsuarioDTO((int)$u['id'], $u['nome'], $u['email']);
        }

        return $dtos;
    }

    public function deletar(int $id): bool{
        $stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);

        if(!$stmt->fetch()){
            throw new Exception("Usuário não encontrado!");
        }

        $stmt = $this->pdo->prepare('DELETE FROM usuarios WHERE id = ?');

        return $stmt->execute([$id]);
    }
}
?>