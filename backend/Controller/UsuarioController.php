<?php
use App\Model\UsuarioModel;
use App\Helper\HelperRoutes;
use App\Service\UsuarioService;

if (HelperRoutes::getApi() === 'usuarios') {
    include_once 'Service/UsuarioService.php';

    if (UsuarioService::verificar()) {
        if (HelperRoutes::getMethod() === "GET") {
          
        }
        if (HelperRoutes::getMethod() === "POST" && !isset($_POST['_method'])) {
            include_once 'Model/UsuarioModel.php';
            $dados = json_decode(file_get_contents("php://input"), true);
            $user = (new UsuarioModel($dados))->getDados();

            if (HelperRoutes::getAction() === 'cadastrar_usuario'){
                echo json_encode(UsuarioService::addUsuario($user));
            }
            if (HelperRoutes::getAction() === 'login'){
                echo json_encode(UsuarioService::login($user));
            }
        }
        if ((HelperRoutes::getMethod() === "POST" && isset($_POST['_method'])) && $_POST['_method'] === "DELETE") {
            
        }
    }
}
