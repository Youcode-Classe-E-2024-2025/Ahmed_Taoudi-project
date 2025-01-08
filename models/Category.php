<?php

class Category {
    private $conn;
    private $table = 'categories';

    private $id;
    private $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }



    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    // CRUD Operations
    public function create() {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt = $this->conn->query($query, [':name' => $this->name]);
        
        if ($stmt) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function read($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $result = $this->conn->query($query, [':id' => $id])->fetch();
        
        if ($result) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            return true;
        }
        return false;
    }

    public function update() {
        if (!$this->id) return false;

        $query = "UPDATE " . $this->table . " SET name = :name WHERE id = :id";
        return $this->conn->query($query, [
            ':name' => $this->name,
            ':id' => $this->id
        ]);
    }

    public function delete() {
        if (!$this->id) return false;

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->conn->query($query, [':id' => $this->id]);
    }

    // Relationship methods
    public function getTasks() {
        if (!$this->id) return false;

        $query = "SELECT * FROM tasks WHERE category_id = :category_id";
        return $this->conn->query($query, [':category_id' => $this->id]);
    }

    // Utility methods
    public function getAllCategories() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name";
        return $this->conn->query($query);
    }

    public function getCategoryName($category_id) {
        if (!$category_id) return null;
        
        $query = "SELECT name FROM " . $this->table . " WHERE id = :id";
        $result = $this->conn->query($query, [':id' => $category_id])->fetch();
        return $result ? $result['name'] : null;
    }
}
