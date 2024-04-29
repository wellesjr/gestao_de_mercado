<?php
namespace App\Repository;

use PDO;
use PDOException;

class UsuarioRepository {
    private $connection;

    public function __construct() {
        $this->setConnection();
    }

    private function setConnection() {
        $dsn = "pgsql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        try {
            $this->connection = new PDO($dsn, $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(("Erro de conexão: " . $e->getMessage()));
        }
    }
    public function findByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch();

        if (!empty($userData)) {
            return $userData;
        }
        return null;
    }
    public function loginUser($user) {
        $stmt = $this->connection->prepare("SELECT * FROM usuario WHERE email = ? ");
        $stmt->execute([$user['email']]);
        $userData = $stmt->fetch();

        if (!empty($userData)) {
            return $userData;
        }
        return null;
    }

    public function save($user) {
        $stmt = $this->connection->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$user['nome'], $user['email'], password_hash($user['senha'], PASSWORD_DEFAULT)]);
    }
}