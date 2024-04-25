<?php
namespace App\Http;
require __DIR__ . '/Request.php';
require __DIR__ . '/Response.php';

use \Closure;
use \Exception;
use \ReflectionFunction;
use App\Http\Request;
use App\Http\Response;

class Router {
    private $url;
    private $prefix = '';
    private $routes = [];
    private $request;

    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url     = $url;
        $this->setPrefix();
    }

    private function addRoute($method, $route, $params = [])
    {
        foreach ($params as $key => $values) {
            if ($values instanceof Closure) {
                $params['controller'] = $values;
                unset($params[$key]);
                continue;
            }
        }

        $params['variables'] = [];

        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        $paternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        $this->routes[$paternRoute][$method] = $params;
    }


    private function setPrefix()
    {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? ' ';
    }

    public function get($routes, $params = [])
    {
        return $this->addRoute('GET', $routes, $params);
    }

    public function post($routes, $params = [])
    {
        return $this->addRoute('POST', $routes, $params);
    }

    public function put($routes, $params = [])
    {
        return $this->addRoute('PUT', $routes, $params);
    }


    public function delete($routes, $params = [])
    {
        return $this->addRoute('DELETE', $routes, $params);
    }


    private function getUri()
    {
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($xUri);
    }

    private function getRoute()
    {
        $uri = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();

        foreach ($this->routes as $paternRoute => $methods) {
            if (preg_match($paternRoute, $uri, $matches)) {
                if (isset($methods[$httpMethod])) {
                    unset($matches[0]);
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    return $methods[$httpMethod];
                }
                throw new Exception("Método não permitido", 405);
            }
        }

        throw new Exception("Página não encontrada!", 404);
    }

    public function run()
    {
        try {
            $route = $this->getRoute();
            if (!isset($route['controller'])) {
                throw new Exception("URL não pode ser processada!", 500);
            }

            $args = [];
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}