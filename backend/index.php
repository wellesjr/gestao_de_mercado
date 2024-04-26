<?php
require_once 'Helper/HelperRoutes.php';
require_once 'vendor/autoload.php';

use App\Helper\HelperRoutes;

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

HelperRoutes::getSegments();

if (!empty(HelperRoutes::getApi())) {
    require_once 'Controller/UsuarioController.php';
} else {
    echo json_encode(['success' => false, 'message' => 'Rota não encontrada']);
}
