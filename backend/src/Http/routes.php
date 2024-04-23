<?php
require 'UsuarioController.php';
require 'middleware.php';

// Função wrapper para o controlador
function handleRequest() {
    $controller = new UsuarioController();
    $controller->addUsuario();
}

// Definição de rotas
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Definição da rota /api/v1/funcao
if ($uri === '/api/v1/funcao' && $method == 'POST') {
    checkPostRequest('handleRequest');
} else {
    header("HTTP/1.1 404 Not Found");
    exit('404 Not Found');
}