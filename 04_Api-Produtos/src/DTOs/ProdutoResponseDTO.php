<?php

class ProdutoResponseDTO{
    public static function render(array $produto):array{
        return [
            'id' => (int)$produto['id'],
            'nome' => $produto['nome'],
            'preco' => (float)$produto['preco'],
            'estoque' => (int)$produto['estoque'],
            'criado_em' => $produto['criado_em']
        ];
    }

    public static function renderList(array $produto):array{
        return array_map([self::class, 'render'], $produto);
    }
}

?>