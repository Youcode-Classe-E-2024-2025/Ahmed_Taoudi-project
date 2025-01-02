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
    public function read($id = null) {
        $query = "SELECT p.*, u.name as creator_name
                FROM " . $this->table . " p
                LEFT JOIN users u ON p.created_by = u.id
                LEFT JOIN user_projects up ON p.id = up.project_id ";
        
        $params = [];
        if ($id) {
            $query .= " WHERE p.id = :id";
            $params[':id'] = $id;
        }
        
        $query .= " GROUP BY p.id";
        
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
}