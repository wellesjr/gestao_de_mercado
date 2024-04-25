<?php
namespace App\Repository\Usuario;

use App\Model\Usuario\Usuario;
use App\Config\Database;

class UsuarioRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = setConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch();

        if ($userData) {
            return new Usuario($userData['nome'], $userData['email'], $userData['senha']);
        }
        return null;
    }

    public function save(Usuario $usuario) {
        $stmt = $this->pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$usuario->getNome(), $usuario->getEmail(), password_hash($usuario->getSenha(), PASSWORD_DEFAULT)]);
    }
}