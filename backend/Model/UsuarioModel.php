<?php
namespace App\Model;
class UsuarioModel {
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __construct($dados) {
        $this->nome  = isset($dados['nome'])  ? $dados['nome'] : null;
        $this->email = isset($dados['email']) ? $dados['email'] : null;
        $this->senha = isset($dados['senha']) ? $dados['senha'] : null;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }
    public function getDados() {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ];
    }
}