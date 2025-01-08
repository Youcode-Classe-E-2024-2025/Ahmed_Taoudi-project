<?php

class User {
    private $conn;
    private $table = 'users';

    private $id;
    private $name;
    private $email;
    private $password;
    // private $role_id;
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
//    public function getRoleId() {
//        return $this->role_id;
//    }
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
//    public function setRoleId($role_id) {
//        $this->role_id = $role_id; 
//    }
   //create
   public function create() {
        $query = "INSERT INTO " . $this->table . " 
                (name, email, password)
                VALUES 
                (:name, :email, :password)";

        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => password_hash($this->password, PASSWORD_DEFAULT)
        ];

    return $this->conn->query($query, $params);
    }

    public function read($id = null) {
        $query = "SELECT u.*, r.name as role_name 
                FROM " . $this->table . " u
                LEFT JOIN roles r ON u.role_id = r.id";
        
        $params = [];
        if($id) {
            $query .= " WHERE u.id = :id";
            $params[':id'] = $id;
        }
        
        return $this->conn->query($query, $params);
    }

    public function update() {
        $query = "UPDATE " . $this->table . "
                SET name = :name,
                    email = :email
                WHERE id = :id";

        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':id' => $this->id
        ];

        return $this->conn->query($query, $params);
    }
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->conn->query($query, [':id' => $this->id]);
    }

    public function login($email, $password) {
        $query = "SELECT u.*
                FROM " . $this->table . " u
                WHERE u.email = :email";

        $result = $this->conn->query($query, [':email' => $email]);
        $user = $result->fetch();
        
        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    public function getProjects() {
        $query = "SELECT p.*, up.joined_at
                FROM projects p
                JOIN user_projects up ON p.id = up.project_id
                WHERE up.user_id = :user_id";

        return $this->conn->query($query, [':user_id' => $this->id]);
    }
    
    public function getTasks() {
        $query = "SELECT t.*, p.name as project_name
                FROM tasks t
                JOIN task_users tu ON t.id = tu.task_id
                LEFT JOIN projects p ON t.project_id = p.id
                WHERE tu.user_id = :user_id";

        return $this->conn->query($query, [':user_id' => $this->id]);
    }

    public  function isIndatabase($email)
    {
        $query = "select * from ". $this->table ." where email = :email" ;
       $result = $this->conn->query($query
          ,
          ['email' => $email]
       );
       return $result->rowCount();
    }

}