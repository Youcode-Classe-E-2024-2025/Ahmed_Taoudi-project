<?php 

class Role 
{

    private $table = 'roles';

    private $name;
    private $conn;


    public function create($array){
        $query = "INSERT INTO " . $this->table . "(name) VALUES (:name)";
        $this->conn->query($query,['name'=>$this->name]);

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
        $this->conn->query($query,$params);
    }




}