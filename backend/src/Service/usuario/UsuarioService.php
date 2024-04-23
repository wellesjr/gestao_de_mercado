<?php
require 'UsuarioRepository.php';

class UsuarioService {
    private $usuarioRepository;

    public function __construct() {
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function addUsuario($nome, $email, $senha) {
        try {
            if ($this->usuarioRepository->findByEmail($email) !== null) {
                return [
                    'success' => false,
                    'message' => 'Email já cadastrado.'
                ];
            }
    
            $novoUsuario = new Usuario($nome, $email, $senha);
            if (!$this->usuarioRepository->save($novoUsuario)) {
                return [
                    'success' => false,
                    'message' => 'Erro ao cadastrar usuário.'
                ];
            }
    
            return [
                'success' => true,
                'message' => "Usuário cadastrado com sucesso!"
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
}
