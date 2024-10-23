<?php

namespace App\Controllers;

use App\Controllers\Action;

class HomeController extends Action
{

    public function index(): void
    {
        $this->view('home/index', 'header');
    }
}