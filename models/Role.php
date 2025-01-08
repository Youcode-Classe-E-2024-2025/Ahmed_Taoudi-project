<?php 

class Role 
{

    private $table = 'roles';
    private $conn;

    private $name;
    private $desc;

    public function __construct($db){
        $this->conn = $db;
    }
    
    // setters
    public function setName($name){
        $this->name = $name ;
    }
    
    public function setDesc($desc){
        $this->desc = $desc ;
    }

    public function getName(){
        return $this->name  ;
    }
    
    public function getDesc(){
        return $this->desc  ;
    }

    public function create($array){
        $query = "INSERT INTO " . $this->table . "(name,description) VALUES (:name,:desc)";
        $this->conn->query($query,['name'=>$this->name ,'desc'=>$this->desc]);

        foreach($array as $permission){
            $this->addPermission($permission);
        }
    }

    public function addPermission($permission){
        $query = " INSERT INTO role_permission(role, permission ) VALUES (:role , :permission )" ;
        $params = ['name'=>$this->name,'permission' => $permission];
        $this->conn->query($query,$params);
    }

    public function removePermission($permission){
        $query="DELETE FROM role_permission rp 
                WHERE rp.role = :rolename 
                AND rp.permission = :permission";
        $params= ['rolename'=>$this->name ,'permission' =>$permission];
        return  $this->conn->query($query,$params);
    }

    public function getPermissions(){
        $query = "SELECT p.name FROM permission p 
                JOIN role_permission rp  
                ON p.id = rp.permission
                where rp.role = :name
        " ;
        $params = ['name'=>$this->name];
       return $this->conn->query($query,$params);
    }




}