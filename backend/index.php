<?php
include(__DIR__ . '/Http/Routers.php');

use App\Http\Router;

define('URL', 'http://localhost');

$obRouter = new Router(URL);

include(__DIR__ . '/Routes/api.php');


$obRouter->run()->sendResponse();