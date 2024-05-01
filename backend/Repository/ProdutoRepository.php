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
    private function closeConnection() {
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

   public function listar($table) {
        $sql = "SELECT * FROM " . $table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }
    public function listarImposto($table) {
        $sql = "SELECT categoria.nome, imposto.* FROM " . $table . " JOIN categoria ON " . $table . ".categoria_id = categoria.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }
    
    public function listarProdutos($table) {
        $sql = "SELECT categoria.nome as nomeCategoria, 
                       ROUND($table.valor, 2) as originalValue, 
                       imposto.percentual as taxPercent,
                       ROUND($table.valor * (1 + imposto.percentual / 100.0), 2) as valorImposto, 
                       $table.* 
                FROM $table 
                JOIN categoria ON $table.categoria_id = categoria.id 
                JOIN imposto ON imposto.categoria_id = categoria.id 
                GROUP BY categoria.nome, $table.id, imposto.percentual, $table.valor";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }

     public function save($dados, $table) {
        switch($table){
            case TABELA_CATEGORIA:
                $sql = "INSERT INTO ".TABELA_CATEGORIA." (nome, descricao, usuario_id) VALUES (?, ?, ?)";
                $value = [$dados['nome'], $dados['descricao'], $dados['usuario_id']];
                break;
            case TABELA_IMPOSTO:
                $sql = "INSERT INTO ".TABELA_IMPOSTO." (usuario_id, categoria_id, percentual) VALUES (?, ?, ?)";
                $value = [$dados['usuario_id'], $dados['categoria_id'], $dados['percentual']];
                break;
            case TABELA_PRODUTO:
                $sql = "INSERT INTO ".TABELA_PRODUTO." (nome, usuario_id, categoria_id, descricao) VALUES (?, ?, ?, ?)";
                $value = [$dados['nome'], $dados['usuario_id'], $dados['categoria_id'], $dados['descricao']];
                break;
            case TABELA_VENDA:
                $sql = "INSERT INTO ".TABELA_VENDA." (usuario_id, produto_id, quantidade, valor_unitario, valor_imposto) VALUES (?, ?, ?, ?, ?)";
                $value = [$dados['usuario_id'], $dados['produto_id'], $dados['quantidade'], $dados['valor_unitario'], $dados['valor_imposto']];
                break;
        }

        $stmt = $this->connection->prepare($sql);
        $data = $stmt->execute($value);
        $this->closeConnection();
        return $data;
    }


    public function listarVendas($table) {
        $sql = "SELECT categoria.nome as nomeCategoria,
        produtos.nome as nomeProduto,
        produtos.descricao,
        ROUND(produtos.valor, 2) as originalValue, 
        imposto.percentual as taxPercent,
        ROUND(produtos.valor * (1 + imposto.percentual / 100.0), 2) as valorImposto, 
        ROUND(ROUND(produtos.valor * (1 + imposto.percentual / 100.0), 2) * " . $table . ".quantidade, 2) as valorTotal,
        ".$table.".* 
           FROM ".$table."
           JOIN produtos ON ".$table.".produto_id = produtos.id 
           JOIN categoria ON produtos.categoria_id = categoria.id 
           JOIN imposto ON imposto.categoria_id = categoria.id 
           GROUP BY ".$table.".id, categoria.nome, produtos.nome, produtos.valor, imposto.percentual, vendas.quantidade, produtos.descricao";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }
}