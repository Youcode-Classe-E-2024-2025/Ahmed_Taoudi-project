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

    public function countRoles() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAllRoles() {
        $query = "SELECT r.*, GROUP_CONCAT(p.name) as permissions 
                 FROM " . $this->table . " r 
                 LEFT JOIN role_permission rp ON r.name = rp.role 
                 LEFT JOIN permission p ON rp.permission = p.id 
                 GROUP BY r.name";
        return $this->conn->query($query);
    }

    public function getAllPermissions() {
        $query = "SELECT * FROM permission";
        return $this->conn->query($query);
    }

    public function getRolePermissions($roleName) {
        $query = "SELECT p.* FROM permission p 
                 JOIN role_permission rp ON p.id = rp.permission 
                 WHERE rp.role = :role";
        return $this->conn->query($query, ['role' => $roleName]);
    }

    public function update($permissions = []) {
        $query = "UPDATE " . $this->table . " SET description = :desc WHERE name = :name";
        $result = $this->conn->query($query, ['name' => $this->name, 'desc' => $this->desc]);
        
        if ($result) {
            // Remove old permissions
            $query = "DELETE FROM role_permission WHERE role = :role";
            $this->conn->query($query, ['role' => $this->name]);
            
            // Add new permissions
            foreach ($permissions as $permission) {
                $this->addPermission($permission);
            }
            return true;
        }
        return false;
    }

    public function delete() {
        // Delete role permissions first
        $query = "DELETE FROM role_permission WHERE role = :role";
        $this->conn->query($query, ['role' => $this->name]);
        
        // Delete role
        $query = "DELETE FROM " . $this->table . " WHERE name = :name";
        return $this->conn->query($query, ['name' => $this->name]);
    }
    public function getRoleByUserId($userId, $projectId ) {
        $query = "SELECT role_name FROM user_projects up
                 WHERE user_id = :userId AND project_id = :projectId";
        return $this->conn->query($query, ['userId' => $userId, 'projectId' => $projectId])->fetchColumn();
    }
}