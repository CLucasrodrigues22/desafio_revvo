<?php

namespace App\Models;

use PDO;
use PDOException;
use stdClass;

class Course extends Model
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $banner;

    public function getAll(): array
    {
        $query = "SELECT * FROM courses";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // salvar
    public function store(): bool|array
    {
        try {
            $query = "INSERT INTO courses (title, description, banner) values (:title, :description, :banner)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':title', $this->__get('title'));
            $stmt->bindValue(':description', $this->__get('description'));
            $stmt->bindValue(':banner', $this->__get('banner'));
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}