<?php
namespace App\Config;

use \PDO;
use PDOException;

class Database {

    private $connection;
    public function __construct() {
        $this->setConnection();
    }
    function setConnection() {
        try {

            $dsn = "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";user=" . $_ENV['DB_USERNAME'] . ";password=" . $_ENV['DB_PASSWORD'] . ";";

            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            return ("Erro de conexão: " . $e->getMessage());
        }

    }
}