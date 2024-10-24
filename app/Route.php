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

        $routes['getcourse'] = array (
            'route' => '/getcourse',
            'controller' => 'HomeController',
            'action' => 'getCourse'
        );

        $routes['storecourse'] = array (
            'route' => '/storecourse',
            'controller' => 'HomeController',
            'action' => 'store'
        );

        $routes['updatecourse'] = array (
            'route' => '/updatecourse',
            'controller' => 'HomeController',
            'action' => 'update'
        );

        $routes['deletecourse'] = array (
            'route' => '/deletecourse',
            'controller' => 'HomeController',
            'action' => 'delete'
        );

        $this->setRoutes($routes);
    }
}