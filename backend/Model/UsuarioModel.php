<?php
namespace App\Model;
class UsuarioModel {
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __construct($dados) {
        $this->nome  = $dados['Nome'];
        $this->email = $dados['Email'];
        $this->senha = $dados['Senha'];
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
}