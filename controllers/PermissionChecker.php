<?php 
require_once "models/Role.php";
require_once "controllers/BaseController.php";
class PermissionChecker extends BaseController {

    private $roleModel;

    public function __construct() {
        parent::__construct();
        $this->roleModel = new Role($this->db);
    }

    public function checkPermission($projectId,$permission){
        if(!isset($_SESSION['user'])) return false;
        $userId = $_SESSION['user']['id'];
        $roleName = $this->roleModel->getRoleByUserId($userId, $projectId);
        if($roleName == null) return false;
        $permissions = $this->roleModel->getRolePermissions($roleName)->fetchAll();
        $permissionsNames = array_map(function($permission) {
            return $permission['name'];
        }, $permissions);
        // dd($permissionsNames);
       return $this->hasPermission($permissionsNames,$permission);

    }
    public function requirePermission($projectId,$permission){
        if (!$this->checkPermission($projectId,$permission)) {
            $_SESSION['error'] = "Permission Denied";
            $this->redirect('/projects?id=' . $projectId);
        }
    }

}