<?php

namespace App\Models;

use PDOException;

class User extends Model
{
    protected int $id;
    protected string $name;
    protected string $email;
    protected string $password;
    protected string $avatar;
    protected bool $first_access;

    public function store(): array
    {
        try {
            $query = "INSERT INTO users (name, email, password, avatar, first_access) VALUES (:name, :email, :password, :avatar, :first_access)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':name', $this->__get('name'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':password', $this->__get('password'));
            $stmt->bindValue(':avatar', $this->__get('avatar'));
            $stmt->bindValue(':first_access', 1, \PDO::PARAM_BOOL);
            $stmt->execute();

            $userId = $this->db->lastInsertId(); // Obtém o ID do novo usuário

            // Consulta para buscar os dados do usuário recém-criado
            $query = "SELECT id, name, email, avatar, first_access FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $userId, \PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC); // Retorna os dados do usuário
        } catch (PDOException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }

    public function validate(): array
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateAccess(int $id): bool
    {
        try {
            $query = "UPDATE users SET first_access = :first_access WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':first_access', $this->__get('first_access'), \PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar o acesso do usuário: " . $e->getMessage());
            return false;
        }
    }


}