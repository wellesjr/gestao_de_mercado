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

    public function getCategoriaByNome($nome) {
        $sql = "SELECT * FROM" . TABELA_CATEGORIA . " WHERE nome = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nome]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }

    public function getCategoriaById($id) {
        $sql = "SELECT * FROM" . TABELA_CATEGORIA . " WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }

    public function getImpostoByNomeAndCategoria($nome, $categoria_id) {
        $sql = "SELECT * FROM" . TABELA_IMPOSTO . " WHERE nome = ? AND categoria_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nome, $categoria_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }

    public function save($dados, $table) {
        switch($table){
            case TABELA_CATEGORIA:
                $sql = "INSERT INTO" . TABELA_CATEGORIA  . " (nome, descricao, usuario_id) VALUES (?, ?, ?)";
                $value = [$dados['nome'], $dados['descricao'], $dados['usuario_id']];
            case TABELA_IMPOSTO:
                $sql = "INSERT INTO" . TABELA_IMPOSTO . " (usuario_id, categoria_id, percentual) VALUES (?, ?, ?)";
                $value = [$dados['usuario_id'], $dados['categoria_id'], $dados['percentual']];
            case TABELA_PRODUTO:
                $sql = "INSERT INTO" . TABELA_PRODUTO . " (nome, usuario_id, categoria_id, descricao) VALUES (?, ?, ?, ?)";
                $value = [$dados['nome'], $dados['usuario_id'], $dados['categoria_id'], $dados['descricao']];
            case TABELA_VENDA:
                $sql = "INSERT INTO" . TABELA_VENDA . " (usuario_id, produto_id, quantidade, valo_unitario, valor_imposto) VALUES (?, ?, ?, ?, ?)";
                $value = [$dados['usuario_id'], $dados['produto_id'], $dados['quantidade'], $dados['valor_unitario'], $dados['valor_imposto']];
        }

        $stmt = $this->connection->prepare($sql);
        $data = $stmt->execute($value);
        $this->closeConnection();
        return $data;
    }
}