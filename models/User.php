<?php

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
}