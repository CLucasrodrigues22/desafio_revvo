<?php

namespace App\Models;

use App\Connection;

class Container {

    public static function getModel($model)
    {

        // Retornar o modelo instanciado, já com a conexão estabelecida
        $class = "\\App\\Models\\".ucfirst($model);

        $conn = Connection::getDb();

        return new $class($conn);
    }
}