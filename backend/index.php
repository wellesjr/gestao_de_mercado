<?php
require_once 'Helper/HelperRoutes.php';
require_once 'vendor/autoload.php';

use App\Helper\HelperRoutes;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    exit(0);
}
date_default_timezone_set("America/Sao_Paulo");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

HelperRoutes::getSegments();

if (!empty(HelperRoutes::getApi())) {
    require_once 'Controller/UsuarioController.php';
    require_once 'Controller/ProdutoController.php';
} else {
    echo json_encode(['success' => false, 'message' => 'Rota não encontrada']);
}
