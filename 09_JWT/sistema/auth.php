<?php
/**
 * ============================================================================
 * GUIA DE IMPLEMENTAÇÃO: auth.php (Guarda de Rotas / Middleware)
 * ============================================================================
 * Este arquivo atua como o "Guarda de Trânsito" do sistema. Qualquer página
 * privada deve dar 'require_once __DIR__ . "/auth.php";' na PRIMEIRA LINHA.
 *
 * PASSO A PASSO PARA O ALUNO IMPLEMENTAR:
 *
 * 1. Inclua o arquivo de utilitários: require_once __DIR__ . '/jwt_helper.php';
 *
 * 2. Tente capturar o JWT vindo da requisição:
 *    - Exemplo: $token = $_COOKIE['meu_jwt'] ?? null;
 *
 * 3. Se $token for nulo (usuário não enviou o cookie):
 *    - Redirecione para a tela de login: header('Location: login.php?erro=nao_autenticado');
 *    - Interrompa a execução com exit;
 *
 * 4. Se existir um $token, valide-o chamando a função do helper:
 *    - $usuario_logado = validar_jwt($token);
 *
 * 5. Se $usuario_logado for igual a false (token alterado ou expirado):
 *    - Limpe o cookie expirado: setcookie('meu_jwt', '', time() - 3600, '/');
 *    - Redirecione: header('Location: login.php?erro=sessao_invalida');
 *    - Interrompa com exit;
 *
 * 6. Se passar por todas as verificações:
 *    - A execução continua normalmente! A variável $usuario_logado estará
 *      disponível para a página restrita que chamou este arquivo.
 * ============================================================================
 */

require_once __DIR__ . '/jwt_helper.php';

