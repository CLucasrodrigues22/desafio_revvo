<?php

namespace App;

use App\Init;

class Route extends Init
{
    // função para iniciar rotas
    protected function initRoutes(): void
    {
        // rotas de autenticação
        $routes['auth'] = array(
            'route' => '/auth',
            'controller' => 'UserController',
            'action' => 'auth',
        );

        $routes['newaccount'] = array(
            'route' => '/newaccount',
            'controller' => 'UserController',
            'action' => 'newaccount',
        );

        $routes['logout'] = array(
            'route' => '/logout',
            'controller' => 'UserController',
            'action' => 'logout',
        );

        // rotas de cursos
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'HomeController',
            'action' => 'index'
        );

        $routes['getcourse'] = array(
            'route' => '/getcourse',
            'controller' => 'HomeController',
            'action' => 'getCourse'
        );

        $routes['storecourse'] = array(
            'route' => '/storecourse',
            'controller' => 'HomeController',
            'action' => 'store'
        );

        $routes['updatecourse'] = array(
            'route' => '/updatecourse',
            'controller' => 'HomeController',
            'action' => 'update'
        );

        $routes['deletecourse'] = array(
            'route' => '/deletecourse',
            'controller' => 'HomeController',
            'action' => 'destroy'
        );

        $this->setRoutes($routes);
    }
}