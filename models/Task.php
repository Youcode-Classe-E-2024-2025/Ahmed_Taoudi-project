<?php

class Task {
    private $conn;
    private $table = 'tasks';

    public $id;
    public $title;
    public $description;
    public $project_id;
    public $status;
    public $due_date;
    public $created_at;
    public $assigned_users = [];

    public function __construct($db) {
        $this->conn = $db;
    }
}