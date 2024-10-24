<?php

namespace App\Models;

abstract class Model {
    
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
}