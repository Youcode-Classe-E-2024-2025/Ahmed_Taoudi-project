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
        
    }

    public function setTitle($title) {
        $this->title = $title;
        
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
    public function getTasksByUser($user_id ,$task_status = 'all') {
        $query = "SELECT t.*
                FROM " . $this->table . " t
                JOIN task_users tu ON t.id = tu.task_id
                WHERE tu.user_id = :user_id";
        $params = ['user_id' => $user_id];
        if ($task_status !== 'all') {
            $query .= " AND t.status = :task_status";
            $params = ['user_id' => $user_id, 'task_status' => $task_status];
        }

        return $this->conn->query($query, $params);
    }
    public function read($id = null) {
        $query = "SELECT t.*
                FROM " . $this->table . " t";
        
        $params = [];
        if ($id) {
            $query .= " WHERE t.id = :id";
            $params =['id'=>$id]; ;
        }else{
            $query .= " WHERE t.project_id = :project_id";
            $params = ['project_id'=>$this->project_id];
        }
        
        return $this->conn->query($query, $params);
    }
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->conn->query($query, [':id' => $this->id]);
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

    public function removeUser($user_id) {
        $query = "DELETE FROM task_users 
                WHERE task_id = :task_id AND user_id = :user_id";

        $params = [
            ':task_id' => $this->id,
            ':user_id' => $user_id
        ];

        return $this->conn->query($query, $params);
    }
    private function removeAllAssignedUsers() {
        $query = "DELETE FROM task_users WHERE task_id = :task_id";
        return $this->conn->query($query, [':task_id' => $this->id]);
    }
    public function getAssignedUsersDetails() {
        $query = "SELECT u.* 
                FROM users u
                JOIN task_users tu ON u.id = tu.user_id
                WHERE tu.task_id = :task_id";

        return $this->conn->query($query, [':task_id' => $this->id]);
    }

    public function update() {
        $this->conn->connection->beginTransaction();

        try {
            $query = "UPDATE " . $this->table . " 
                    SET title = :title, 
                        description = :description, 
                        status = :status, 
                        due_date = :due_date 
                    WHERE id = :id";

            $params = [
                ':id' => $this->id,
                ':title' => $this->title,
                ':description' => $this->description,
                ':status' => $this->status,
                ':due_date' => $this->due_date
            ];

            $this->conn->query($query, $params);
            
            // Handle assigned users if they exist
            if (!empty($this->assigned_users)) {
                $this->removeAllAssignedUsers();
                foreach ($this->assigned_users as $user_id) {
                    $this->assignUser($user_id);
                }
            }

            $this->conn->connection->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->connection->rollBack();
            return false;
        }
    }

    public function updateStatus() {
        $query = "UPDATE " . $this->table . " 
                SET status = :status 
                WHERE id = :id";

        return $this->conn->query($query, [':status' => $this->status, ':id' => $this->id]);
    }
    public function getTasksByStatus($status = 'all') {
        $query = "SELECT t.*, p.name as project_name 
                FROM " . $this->table . " t
                LEFT JOIN projects p ON t.project_id = p.id";
        
        $params = [];
        if ($status !== 'all') {
            $query .= " WHERE t.status = :status";
            $params[':status'] = $status;
        }
        
        $query .= " ORDER BY t.due_date ASC";
        return $this->conn->query($query, $params);
    }
    public function getTasksByProject($project_id) {
        $query = "SELECT t.*, u.name as assigned_to
                FROM " . $this->table . " t
                LEFT JOIN task_users tu ON t.id = tu.task_id
                LEFT JOIN users u ON tu.user_id = u.id
                WHERE t.project_id = :project_id
                ORDER BY t.status, t.due_date ASC";

        return $this->conn->query($query, [':project_id' => $project_id]);
    }
}