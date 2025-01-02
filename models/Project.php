<?php

class Project {
    private $conn;
    private $table = 'projects';

    public $id;
    public $name;
    public $description;
    public $start_date;
    public $end_date;
    public $status;
    public $created_by;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;

    }
}