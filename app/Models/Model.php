<?php

namespace App\Models;

abstract class Model {
    
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    
}