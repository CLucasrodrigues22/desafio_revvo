<?php

namespace App;

abstract class Init {

    private $routes;

    abstract protected function initRoutes();

    // metodo construtor
    public function __construct()
    {   
        $this->initRoutes();
        $this->run($this->getUrl());
    }
    
    // gets e sets de rotas
    public function getRoutes() {
        return $this->routes;
    }

    public function setRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    // Função para percorrer o array de rotas e definir o controller a ser iniciado
    protected function run($url): void
    {
        foreach($this->getRoutes() as $key => $route) {
            if($url == $route['route']) {
                // criando a classe
                $classController = "App\\Controllers\\".$route['controller']; 

                // instanciando a classe
                $controller = new $classController;

                // resgatando a action do controller de acordo com a rota requisitada
                $action = $route['action'];

                // executando a action 
                $controller->$action();
            }
        }
    }
    // Obtendo o path atual do usuário
    protected function getUrl(): false|array|int|string|null
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}