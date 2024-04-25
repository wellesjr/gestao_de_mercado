<?php

namespace App\Http;

class Request {
    private $router;
    private $httpMethod;
    private $uri;
    private $queriParams = [];
    private $postVars = [];
    private $headers = [];

    public function __construct($router)
    {
        $this->router      = $router;
        $this->queriParams = $_GET ?? [];
        $this->postVars    = $_POST ?? [];
        $this->headers     = getallheaders();
        $this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

    private function setUri()
    {
        $this->uri         = $_SERVER['REQUEST_URI'] ?? '';
        $xUris = explode('?', $this->uri);
        $this->uri = $xUris[0];
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getheaders()
    {
        return $this->headers;
    }
    public function getQueryParams()
    {
        return $this->queriParams;
    }
    public function getPostVars()
    {
        return $this->postVars;
    }
}