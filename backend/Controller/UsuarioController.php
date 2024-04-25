<?php
use App\Service\Usuario\UsuarioService;
if ($api == 'usuario') {
    include_once 'Service/Usuario/UsuarioService.php';
   print_r('teste');
    if(UsuarioService::verificar()){
        if($requestMethod == "GET"){
            UsuarioService::_get();
        }
        if($method == "POST" && !isset($_POST['_method'])){
            UsuarioService::_post();
        }
        if(($method == "POST" && isset($_POST['_method'])) && $_POST['_method'] == "PUT"){
            UsuarioService::_put();
        }
        if(($method == "POST" && isset($_POST['_method'])) && $_POST['_method'] == "DELETE"){
            UsuarioService::_delete();
        }

    }
}
