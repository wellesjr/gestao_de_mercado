<?php 
class Usuario {
    public $id;
    public $nome;
    public $email;

    public function __construct($nome, $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }
}
