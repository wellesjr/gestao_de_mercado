<?php
namespace App\Repository;

use PDO;
use PDOException;

class ProdutoRepository {
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
    private public function closeConnection() {
        $this->connection = null;
    }

    public function save($dados, $table) {
        switch($table){
            case TABELA_CATEGORIA:
                $sql = "INSERT INTO" . TABELA_CATEGORIA  . " (nome, descricao, usuario_id) VALUES (?, ?, ?)";
                $value = [$dados['nome'], $dados['descricao'], $dados['usuario_id']];
                break;
            case TABELA_IMPOSTO:
                $sql = "INSERT INTO" . TABELA_IMPOSTO . " (nome, categoria_id) VALUES (?, ?)";
                $value = [$dados['nome'], $dados['categoria_id']];
                break;
            case TABELA_PRODUTO:
                $sql = "INSERT INTO" . TABELA_PRODUTO . " (nome, preco, categoria_id) VALUES (?, ?, ?)";
                $value = [$dados['nome'], $dados['preco'], $dados['categoria_id']];
                break;
            case TABELA_VENDA:
                $sql = "INSERT INTO" . TABELA_VENDA . " (produto_id, quantidade, data_venda) VALUES (?, ?, ?)";
                $value = [$dados['produto_id'], $dados['quantidade'], $dados['data_venda']];
                break;
        }

        $stmt = $this->connection->prepare($sql);
        $data = $stmt->execute($value);
        $this->closeConnection();
        return $data;
    }
}