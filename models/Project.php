<?php

class Project {
    private $conn;
    private $table = 'projects';

    private $id;
    private $name;
    private $description;
    private $start_date;
    private $end_date;
    private $status;
    private $created_by;
    private $created_at;

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

    public function getDescription() {
        return $this->description;
    }

    public function getStartDate() {
        return $this->start_date;
    }

    public function getEndDate() {
        return $this->end_date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedBy() {
        return $this->created_by;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStartDate($date) {
        if ($date instanceof DateTime) {
            $this->start_date = $date->format('Y-m-d');
        } else {
            $this->start_date = date('Y-m-d', strtotime($date));
        }
    }

    public function setEndDate($date) {
        if ($date instanceof DateTime) {
            $this->end_date = $date->format('Y-m-d');
        } else {
            $this->end_date = date('Y-m-d', strtotime($date));
        }
    }

    public function setStatus($status) {
        $valid_statuses = ['planning', 'in_progress', 'on_hold', 'completed'];
        $this->status = in_array($status, $valid_statuses) ? $status : 'planning';
    }

    public function setCreatedBy($user_id) {
        $this->created_by = $user_id ;
    }

    // create
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                (name, description, start_date, end_date, status, created_by)
                VALUES 
                (:name, :description, :start_date, :end_date, :status, :created_by)";

        $params = [
            ':name' => $this->name,
            ':description' => $this->description,
            ':start_date' => $this->start_date,
            ':end_date' => $this->end_date,
            ':status' => $this->status ?? 'planning',
            ':created_by' => $this->created_by
        ];

       $this->conn->query($query, $params);
    // TODO  :  return id 
    }
    public function read($uid,$id = null) {
        $query = "SELECT p.*, u.name as creator_name
                FROM " . $this->table . " p
                LEFT JOIN users u ON p.created_by = u.id
               
               ";
        
        if ($id) {
            $query .= " WHERE p.id = :id and p.created_by = :uid";
            $params=['uid'=>$uid , 'id' => $id];
        }else{
            $query .= " WHERE p.created_by = :uid";
            $params = ['uid'=>$uid]; 
        }
        
        // $query .= " GROUP BY p.id";
        
        return $this->conn->query($query, $params);
    }
    public function update() {
        $query = "UPDATE " . $this->table . "
                SET name = :name,
                    description = :description,
                    start_date = :start_date,
                    end_date = :end_date,
                    status = :status
                WHERE id = :id";

        $params = [
            ':name' => $this->name,
            ':description' => $this->description,
            ':start_date' => $this->start_date,
            ':end_date' => $this->end_date,
            ':status' => $this->status,
            ':id' => $this->id
        ];

        return $this->conn->query($query, $params);
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->conn->query($query, [':id' => $this->id]);
    }

    public function getTeamMembers() {
        $query = "SELECT u.*, up.joined_at
                FROM users u
                JOIN user_projects up ON u.id = up.user_id
                WHERE up.project_id = :project_id";

        return $this->conn->query($query, [':project_id' => $this->id]);
    }
    public function getAvailableUsers() {
        $query = "SELECT u.*, up.joined_at
                FROM users u
                LEFT JOIN user_projects up ON u.id = up.user_id
                WHERE up.project_id IS NULL";

        return $this->conn->query($query);
    }

    public function addTeamMember($user_id) {
        $query = "INSERT INTO user_projects (project_id, user_id)
                VALUES (:project_id, :user_id)";

        $params = [
            ':project_id' => $this->id,
            ':user_id' => $user_id
        ];

        return $this->conn->query($query, $params);
    }

    public function removeTeamMember($user_id) {
        $query = "DELETE FROM user_projects 
                WHERE project_id = :project_id AND user_id = :user_id";

        $params = [
            ':project_id' => $this->id,
            ':user_id' => $user_id
        ];

        return $this->conn->query($query, $params);
    }

    public function getTasks() {
        $query = "SELECT t.*, 
                        GROUP_CONCAT(u.name) as assignee_names
                FROM tasks t
                LEFT JOIN task_users tu ON t.id = tu.task_id
                LEFT JOIN users u ON tu.user_id = u.id
                WHERE t.project_id = :project_id
                GROUP BY t.id";

        return $this->conn->query($query, [':project_id' => $this->id]);
    }
    public function getTasksByStatus($status) {
        $query = "SELECT t.*, 
                        GROUP_CONCAT(u.name) as assignee_names
                FROM tasks t
                LEFT JOIN task_users tu ON t.id = tu.task_id
                LEFT JOIN users u ON tu.user_id = u.id
                WHERE t.project_id = :project_id AND t.status = :status
                GROUP BY t.id";

        return $this->conn->query($query, [':project_id' => $this->id, ':status' => $status]);
    }
    public function getTaskStats() {
        $query = "SELECT 
                    COUNT(*) as total_tasks,
                    SUM(CASE WHEN status = 'done' THEN 1 ELSE 0 END) as completed_tasks,
                    SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as in_progress_tasks,
                    SUM(CASE WHEN status = 'todo' THEN 1 ELSE 0 END) as todo_tasks,
                    SUM(CASE WHEN status = 'review' THEN 1 ELSE 0 END) as review_tasks
                FROM tasks 
                WHERE project_id = :project_id";

        return $this->conn->query($query, [':project_id' => $this->id])->fetch();
    }


    public function updateVisibility($projectId, $visibility) {
        $query = "UPDATE projects SET visibility = :visibility WHERE id = :project_id";
        return $this->conn->query($query, [
            ':visibility' => $visibility,
            ':project_id' => $projectId
        ]);
    }

    public function getPublicProjects() {
        $query = "SELECT p.*, u.name as creator_name 
                 FROM projects p 
                 LEFT JOIN users u ON p.created_by = u.id 
                 WHERE p.visibility = 'public'
                 ORDER BY p.created_at DESC";
        return $this->conn->query($query);
    }
}