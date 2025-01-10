<?php 

class Permission 
{

    private $table = 'permission';
    private $conn;

    private $id = NULL;
    private $name;
    private $desc;

    public function __construct($db){
        $this->conn = $db;
    }
    
    // setters
    public function setId($id){
        $this->id = $id ;
    }
    public function setName($name){
        $this->name = $name ;
    }
    
    public function setDesc($desc){
        $this->desc = $desc ;
    }

    public function getId(){
        return $this->id  ;
    }

    public function getName(){
        return $this->name  ;
    }
    
    public function getDesc(){
        return $this->desc  ;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table . "(name,description) VALUES (:name,:desc)";
        return $this->conn->query($query,['name'=>$this->name ,'desc'=>$this->desc]);
    }
    

    public function getAllPermissions(){
        $query = "SELECT * FROM ".$this->table ;
       return $this->conn->query($query);
    }




}