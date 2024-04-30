<?php
namespace App\Model;
class ProdutoModel {
    private $id;
    private $nome;
    private $descricao;
    private $usuario_id;
    private $categoria_id;

    public function __construct($dados) {
        $this->id    = isset($dados['id'])    ? $dados['id']   : null;
        $this->nome  = isset($dados['nome'])  ? $dados['nome'] : null;
        $this->senha = isset($dados['descricao'])    ? $dados['descricao']    : null;
        $this->email = isset($dados['usuario_id'])   ? $dados['usuario_id']   : null;
        $this->senha = isset($dados['categoria_id']) ? $dados['categoria_id'] : null;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDados() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'usuario' => $this->usuario_id,
            'categoria' => $this->categoria_id,
            'descricao' => $this->descricao
        ];
    }
}