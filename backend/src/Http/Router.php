<?php
require 'Middleware.php';
require 'Api';

class Router {
    private $middleware;

    public function __construct() {
        $this->middleware = new Middleware();
    }

    private function routes() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        return (object) [
            'controller' => $uri[1],
            'version' => $uri[2],
            'action' => $uri[3]
        ];
    }
    public function index(){
        $routes = $this->routes();

        if ($routes->controller === 'api' || $routes->version === 'v1' || $routes->action === 'cadastrar_usuario') {
            $middleware = new Middleware();
            $result = $middleware->checkPostRequest();

            if ($result['sucess']) {
                $controller = new UsuarioController();
                $cadastraUsuario = $controller->addUsuario();
                echo json_encode([
                    'sucess' => $cadastraUsuario,
                    'message' => $cadastraUsuario['message']
                ]);
                return;
            }
            echo json_encode([
                'sucess' => $result['sucess'],
                'message' => $result['message']
            ]);
            return;
        }

        header('HTTP/1.1 404 Not Found');
        echo json_encode([
            'sucess' => false,
            'message' => 'Rota não encontrada.'
        ]);
        return;
    }
}
