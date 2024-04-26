<?php
namespace App\Service\Usuario;

include_once 'Repository/UsuarioRepository.php';

use App\Repository\UsuarioRepository;
use Exception;

class UsuarioService {
    public static function verificar(){return true;}

    public static function addUsuario($newUser): array {
        try {
            if (!filter_var($newUser['email'], FILTER_VALIDATE_EMAIL)) {
                return [
                    'success' => false,
                    'message' => 'Formato de email inválido.'
                ];
            }

            $getUserbyEmail = (new UsuarioRepository())->findByEmail($newUser['email']);
            if ($getUserbyEmail !== null) {
                return [
                    'success' => false,
                    'message' => 'Email já cadastrado.'
                ];
            }
            $newUser = (new UsuarioRepository())->save($newUser);
            if (empty($newUser)) {
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
