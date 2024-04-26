<?php
use App\Model\UsuarioModel;
use App\Helper\HelperRoutes;
use App\Service\Usuario\UsuarioService;

if (HelperRoutes::getApi() === 'usuario') {
    include_once 'Service/Usuario/UsuarioService.php';

    if (UsuarioService::verificar()) {
        if (HelperRoutes::getMethod() === "GET") {
          
        }
        if (HelperRoutes::getMethod() === "POST" && !isset($_POST['_method'])) {
            include_once 'Model/UsuarioModel.php';
            $user = (new UsuarioModel($_REQUEST))->getDados();
            if (HelperRoutes::getAction() === 'cadastrar_usuario'){
                echo json_encode(UsuarioService::addUsuario($user));
            }
        }
        if ((HelperRoutes::getMethod() === "POST" && isset($_POST['_method'])) && $_POST['_method'] === "PUT") {
          
        }
        if ((HelperRoutes::getMethod() === "POST" && isset($_POST['_method'])) && $_POST['_method'] === "DELETE") {
            
        }
    }
}
