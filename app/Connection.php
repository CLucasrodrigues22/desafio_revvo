<?php

namespace App;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connection
{
    public static function getDb()
    {
        // carrega as variáveis do .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        try {
            return new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";charset=utf8",
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD']
            );
        } catch (PDOException $e) {
            echo 'Erro na conexão com o banco: ' . $e->getMessage();
        }
    }
}
