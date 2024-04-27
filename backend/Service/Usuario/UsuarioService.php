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
    public static function login ($user): array {
        try {
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                return [
                    'success' => false,
                    'message' => 'Formato de email inválido.'
                ];
            }
            $getUserbyEmailandPassword = (new UsuarioRepository())->findByEmail($user['email']);
            if(!empty($getUserbyEmailandPassword)){
                if( password_verify($user['senha'], $getUserbyEmailandPassword['senha'])){
                    return [
                        'success' => true,
                        'message' => 'Usuário logado com sucesso!'
                    ];
                } 
                return [
                    'success' => false,
                    'message' => 'E-mail ou senha incorretos!'
                ];
            }
            return [
                'success' => false,
                'message' => 'Usuário não encontrado!'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
