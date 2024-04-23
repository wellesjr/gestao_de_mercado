<?php
require 'UsuarioController.php';

$controller = new UsuarioController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->addUsuario();
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Método não suportado.']);
}