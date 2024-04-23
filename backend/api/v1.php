<?php
require_once 'vendor/autoload.php';
require_once 'UsuarioRepository.php';

// Função para criar um novo usuário
function novoUsuario($name, $email) {
    $pdo = getPdoConnection();
    $userRepository = new UserRepository($pdo);
    $novoUsuario = new Usuario($name, $email);
    $usuarioId = $userRepository->save($novoUsuario);

    return $usuarioId;
}
