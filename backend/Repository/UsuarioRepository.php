<?php
namespace App\Repository;

use PDO;
use PDOException;
use App\Model\UsuarioModel;

class UsuarioRepository {
    private $connection;

    public function __construct() {
        $this->setConnection();
    }

    private function setConnection() {
        try {
            $this->connection = new PDO('pgsql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . $_ENV['DB_USER'] . $_ENV['DB_PASS']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(("Erro de conexão: " . $e->getMessage()));
        }
    }
    public function findByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM usuario WHERE email LIKE = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch();

        if ($userData) {
            return new UsuarioModel($userData);
        }
        return null;
    }

    public function save(UsuarioModel $usuario) {
        $stmt = $this->connection->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$usuario->getNome(), $usuario->getEmail(), password_hash($usuario->getSenha(), PASSWORD_DEFAULT)]);
    }
}