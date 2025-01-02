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
}