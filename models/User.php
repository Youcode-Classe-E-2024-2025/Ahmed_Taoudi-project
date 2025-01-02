<?php

class User {
    private $conn;
    private $table = 'users';

    private $id;
    private $name;
    private $email;
    private $password;
    private $role_id;
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
   public function getEmail() {
       return $this->email;
   }
   public function getRoleId() {
       return $this->role_id;
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
   public function setEmail($email) {
       $this->email =$email; 
   }
   public function setPassword($password) {
       $this->password = $password; 
   }
   public function setRoleId($role_id) {
       $this->role_id = $role_id; 
   }
   //create
   public function create() {
    $query = "INSERT INTO " . $this->table . " 
            (name, email, password, role_id)
            VALUES 
            (:name, :email, :password, :role_id)";

    $params = [
        ':name' => $this->name,
        ':email' => $this->email,
        ':password' => password_hash($this->password, PASSWORD_DEFAULT),
        ':role_id' => $this->role_id
    ];

    return $this->conn->query($query, $params);
}
}