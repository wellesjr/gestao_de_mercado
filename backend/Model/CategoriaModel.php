<?php
namespace App\Model;
class CategoriaModel {
    private $id;
    private $nome;
    private $descricao;
    private $usuario_id;

    public function __construct($dados) {
        $this->id    = isset($dados['id'])   ? $dados['id'] : null;
        $this->nome  = isset($dados['nome']) ? $dados['nome'] : null;
        $this->senha = isset($dados['descricao']) ? $dados['descricao'] : null;
        $this->email = isset($dados['usuario_id']) ? $dados['usuario_id'] : null;
    }

    public function getDadosCategoria() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'usuario' => $this->usuario_id,
            'descricao' => $this->descricao
        ];
    }
}