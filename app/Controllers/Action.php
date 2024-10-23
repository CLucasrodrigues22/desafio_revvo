<?php

namespace App\Controllers;

abstract class Action {
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass();
    }

    // renderiza o layout da aplicação passada por parametro no controller
    protected  function view($view, $layout): void
    {
        $this->view->page = $view;

        //validando se o layout existe
        if(file_exists("../resources/layouts/".$layout.".phtml")) {
            require_once "../resources/layouts/".$layout.".phtml";
        } else {
            echo 'Layout não encontrado';
        }
    }
    
    // localiza e renderinza a view passada por parametro no controller
    protected function content(): void
    {   // $this->view('dir/view');
        require_once "../resources/views/".$this->view->page.".phtml";
    }
}
