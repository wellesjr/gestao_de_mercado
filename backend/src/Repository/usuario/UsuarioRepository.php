<?php

require_once 'UsuarioInterface.php';
require_once 'Usuario.php';

class UserRepository implements UsuarioInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Usuario $user)
    {
        $sql = 'INSERT INTO users (name, email) VALUES (:name, :email)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $user->nome);
        $stmt->bindParam(':email', $user->email);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
