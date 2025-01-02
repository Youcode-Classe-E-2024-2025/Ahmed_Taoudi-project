<?php

class Task {
    private $conn;
    private $table = 'tasks';

    private $id;
    private $title;
    private $description;
    private $project_id;
    private $status;
    private $due_date;
    private $created_at;
    private $assigned_users = [];

    public function __construct($db) {
        $this->conn = $db;
    }
    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getProjectId() {
        return $this->project_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDueDate() {
        return $this->due_date;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getAssignedUsers() {
        return $this->assigned_users;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setProjectId($project_id) {
        $this->project_id = $project_id;
    }

    public function setStatus($status) {
        $valid_statuses = ['todo', 'in_progress', 'review', 'done'];
        $this->status = in_array($status, $valid_statuses) ? $status : 'todo';
    }

    public function setDueDate($date) {
        if ($date instanceof DateTime) {
            $this->due_date = $date->format('Y-m-d');
        } else {
            $this->due_date = date('Y-m-d', strtotime($date));
        }
    } 
    
    
    // create
    public function create() {
        // Start transaction
        $this->conn->connection->beginTransaction();

        try {
            
            $query = "INSERT INTO " . $this->table . " 
                    (title, description, project_id, status, due_date)
                    VALUES 
                    (:title, :description, :project_id, :status, :due_date)";

            $params = [
                ':title' => $this->title,
                ':description' => $this->description,
                ':project_id' => $this->project_id,
                ':status' => $this->status,
                ':due_date' => $this->due_date
            ];

            $stmt = $this->conn->query($query, $params);
            $this->id = $this->conn->lastInsertId();

            // Assign users 
            if (!empty($this->assigned_users)) {
                $query = "INSERT INTO task_users (task_id, user_id) 
                        VALUES (:task_id, :user_id)";
                
                foreach ($this->assigned_users as $user_id) {
                    $params = [
                        ':task_id' => $this->id,
                        ':user_id' => $user_id
                    ];
                    $this->conn->query($query, $params);
                }
            }

            // Commit transaction
            $this->conn->connection->commit();
            return true;
        } catch (Exception $e) {
            // Rollback
            $this->conn->connection->rollBack();
            return false;
        }
    }
    // read
    public function read($id = null) {
        $query = "SELECT t.*
                FROM " . $this->table . " t";
        
        $params = [];
        if ($id) {
            $query .= " WHERE t.id = :id";
            $params[':id'] = $id;
        }
        
        return $this->conn->query($query, $params);
    }

    public function assignUser($user_id) {
        $query = "INSERT INTO task_users (task_id, user_id)
                VALUES (:task_id, :user_id)";

        $params = [
            ':task_id' => $this->id,
            ':user_id' => $user_id
        ];

        return $this->conn->query($query, $params);
    }

}