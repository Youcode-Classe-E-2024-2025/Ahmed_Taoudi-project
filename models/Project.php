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
}