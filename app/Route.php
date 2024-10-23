<?php

namespace App;

use App\Init;

class Route extends Init
{
    // função para iniciar rotas
    protected function initRoutes(): void
    {
        $routes['home'] = array (
            'route' => '/',
            'controller' => 'HomeController',
            'action' => 'index'
        );

        $this->setRoutes($routes);
    }
}