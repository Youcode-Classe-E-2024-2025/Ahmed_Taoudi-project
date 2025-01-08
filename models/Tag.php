<?php

class Tag {
    private $conn;
    private $table = 'tags';

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

        $query = "SELECT t.* FROM tasks t 
                 JOIN task_tags tt ON t.id = tt.task_id 
                 WHERE tt.tag_id = :tag_id";
        return $this->conn->query($query, [':tag_id' => $this->id]);
    }

    public function attachToTask($task_id) {
        if (!$this->id) return false;

        $query = "INSERT INTO task_tags (task_id, tag_id) VALUES (:task_id, :tag_id)";
        return $this->conn->query($query, [
            ':task_id' => $task_id,
            ':tag_id' => $this->id
        ]);
    }

    public function detachFromTask($task_id) {
        if (!$this->id) return false;

        $query = "DELETE FROM task_tags WHERE task_id = :task_id AND tag_id = :tag_id";
        return $this->conn->query($query, [
            ':task_id' => $task_id,
            ':tag_id' => $this->id
        ]);
    }

    // Utility methods
    public function getAllTags() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name";
        return $this->conn->query($query);
    }

    public function getTagsByTask($task_id) {
        $query = "SELECT t.* FROM " . $this->table . " t
                 JOIN task_tags tt ON t.id = tt.tag_id
                 WHERE tt.task_id = :task_id
                 ORDER BY t.name";
        return $this->conn->query($query, [':task_id' => $task_id]);
    }
}
