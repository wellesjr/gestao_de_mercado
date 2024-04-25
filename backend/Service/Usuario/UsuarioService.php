<?php
namespace App\Service\Usuario;

use App\Repository\UsuarioRepository;
use Exception;

class UsuarioService {
    private $getUserbyEmail;
    private $newUser;

    public static function verificar(){return true;}
    public static function _get(){
        echo json_encode([
            'success' => true,
            'message' => 'Rota encontrada.'
        ]);
    }
    public static function _post(){}
    public static function _put(){}
    public static function _delete(){}

    // public static function addUsuario($dados): array{
    //     try {
    //         $getUserbyEmail = (new UsuarioRepository('usuario'))->findByEmail($dados->getEmail());
    //         if ($getUserbyEmail !== null) {
    //             return [
    //                 'success' => false,
    //                 'message' => 'Email já cadastrado.'
    //             ];
    //         }
    //         $newUser = (new UsuarioRepository('usuario'))->save($dados);
    //         if ($newUser) {
    //             return [
    //                 'success' => false,
    //                 'message' => 'Erro ao cadastrar usuário.'
    //             ];
    //         }
    //         return [
    //             'success' => true,
    //             'message' => "Usuário cadastrado com sucesso!"
    //         ];
    //     } catch (Exception $e) {
    //         return [
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ];
    //     }
    // }
        // function createUser() {
       
    //         $newUser = new UsuarioModel($_POST);

    //         if (!filter_var($newUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
    //             echo json_encode([
    //                 'success' => false,
    //                 'message' => 'Formato de email inválido.'
    //             ]);
    //             exit;
    //         }

    //         $successMessage = UsuarioService::addUsuario($newUser);
    //         echo json_encode([
    //             'success' => $successMessage['success'],
    //             'message' => $successMessage['message']
    //         ]);
       
    // }
}
