<?php
//
//namespace App;
//
//class Connection {
//
//    public static function getDb() {
//        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '../');
//        $dotenv->load();
//
//        try {
//            // use .env
//            return new \PDO(
//                sprintf(
//                    "mysql:host=%s;dbname=%s;charset=utf8",
//                    getenv('DB_HOST'),
//                    getenv('DB_DATABASE')
//                ),
//                getenv('DB_USERNAME'),
//                getenv('DB_PASSWORD')
//            );
//        } catch (\PDOException $e) {
//            echo 'Erro: ' . $e->getMessage();
//        }
//    }
//}

namespace App;

class Connection
{
    public static function getDb()
    {
        try {
            $conn = new \PDO(
                "mysql:host=db;dbname=revvo_desafio;charset=utf8",
                "root",
                "password"
            );
            return $conn;
        } catch (\PDOException $e) {
            echo 'Erro na conexão com o banco: ' . $e->getMessage();
        }
    }
}