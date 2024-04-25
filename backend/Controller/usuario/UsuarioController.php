<?php
require '../../Service/usuario/UsuarioService.php';

class UsuarioController {
    private $usuarioService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }

    public function addUsuario() {
        header('Content-Type: application/json');

        try {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return [
                    'success' => false,
                    'message' => 'Formato de email inválido.'
                ];
            }

            $successMessage = $this->usuarioService->addUsuario($nome, $email, $senha);
            return[
                'success' => $successMessage['success'],
                'message' => $successMessage['message']
            ];

        } catch (Exception $e) {
            http_response_code(500);
            return[
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
