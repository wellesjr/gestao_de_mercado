<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

define('message_erro', json_encode(['message' => 'Rota não encontrada']));

var_dump($_SERVER['REQUEST_METHOD']);  

if(isset($_GET['string'])) {
    $path = explode('/', $_GET['path']);
} else {
   echo message_erro ;
    return;
}

if (isset($path[0])) {
    $api = $path[0];
} else {
   echo message_erro; 
    return;
}

$acao = isset($path[1]) ? $path[1] : '';
$param = isset($path[2]) ? $path[2] : '';

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once 'Controller/UsuarioController.php';