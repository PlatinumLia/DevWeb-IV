<?php

class UsuarioDTO {
    public int $id;
    public string $nome;
    public string $email;

    public function __construct(int $id, string $nome, string $email){
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        // A SENHA NÃO ENTRA AQUI DE JEITO NENHUM!
    }

    public function toArray(): array{
        return[
            'id'    => $this->id,
            'nome'  => $this->nome,
            'email' => $this->email
        ];
    }
}

?>