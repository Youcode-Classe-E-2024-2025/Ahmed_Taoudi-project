<?php
require_once "controllers/BaseController.php";
require_once "models/User.php";
require_once "models/Role.php";
require_once "models/Project.php";
require_once "core/Validator.php";

class AdminController extends BaseController 
{
    private $userModel;
    private $roleModel;
    private $projectModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User($this->db);
        $this->roleModel = new Role($this->db);
        $this->projectModel = new Project($this->db);
    }

    public function index() {
        // $this->requireAdmin();
        
        $stats = [
            'total_users' => $this->userModel->countUsers(),
            'active_projects' => $this->projectModel->countActiveProjects(),
            'total_roles' => $this->roleModel->countRoles()
        ];

        $users = $this->userModel->getAllUsersWithRoles();
        $roles = $this->roleModel->getAllRoles();
        $permissions = $this->roleModel->getAllPermissions();

        $this->render('admin/admin_dashboard', [
            'stats' => $stats,
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $_SESSION['user'] ?? null
        ]);
    }

    // User Management
    public function createUser() {
        $this->requireAdmin();

        if ($this->isPost()) {
            $this->userModel->setName(Validator::XSS($_POST['name']));
            $this->userModel->setEmail(Validator::XSS($_POST['email']));
            $this->userModel->setPassword($_POST['password']);

            if ($this->userModel->create()) {
                $_SESSION['message'] = 'User created successfully';
            } else {
                $_SESSION['error'] = 'Failed to create user';
            }
        }

        $this->redirect('/admin');
    }

    public function updateUser() {
        $this->requireAdmin();

        if ($this->isPost()) {
            $this->userModel->setId($_POST['user_id']);
            $this->userModel->setName(Validator::XSS($_POST['name']));
            $this->userModel->setEmail(Validator::XSS($_POST['email']));

            if ($this->userModel->update()) {
                $_SESSION['message'] = 'User updated successfully';
            } else {
                $_SESSION['error'] = 'Failed to update user';
            }
        }

        $this->redirect('/admin');
    }

    public function deleteUser() {
        $this->requireAdmin();

        if (isset($_GET['id'])) {
            $this->userModel->setId($_GET['id']);
            
            if ($this->userModel->delete()) {
                $_SESSION['message'] = 'User deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete user';
            }
        }

        $this->redirect('/admin');
    }

    public function users() {
        $this->requireAdmin();
        
        $users = $this->userModel->getAllUsersWithRoles();
        $roles = $this->roleModel->getAllRoles();
        
        $this->render('admin/users', [
            'users' => $users,
            'roles' => $roles,
            'user' => $_SESSION['user'] ?? null
        ]);
    }

    // Role Management
    private function getAllRoles() {
        $roles = $this->db->query("SELECT * FROM roles")->fetchAll();
        foreach ($roles as &$role) {
            $this->roleModel->setName($role['name']);
            $role['permissions'] = $this->roleModel->getPermissions()->fetchAll();
        }
        return $roles;
    }

    private function getAllPermissions() {
        return $this->db->query("SELECT * FROM permission")->fetchAll();
    }

    public function roles() {
        $this->requireAdmin();
        
        $roles = $this->roleModel->getAllRoles();
        $permissions = $this->roleModel->getAllPermissions();
        
        $this->render('admin/roles', [
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $_SESSION['user'] ?? null
        ]);
    }

    public function createRole() {
        $this->requireAdmin();
        
        if ($this->isPost()) {
            $this->roleModel->setName(Validator::XSS($_POST['name']));
            $this->roleModel->setDesc(Validator::XSS($_POST['description']));
            
            if ($this->roleModel->create($_POST['permissions'] ?? [])) {
                $_SESSION['message'] = 'Role created successfully';
            } else {
                $_SESSION['error'] = 'Failed to create role';
            }
        }
        
        $this->redirect('/admin');
    }

    public function editRole() {
        $this->requireAdmin();
        
        if ($this->isPost()) {
            $this->roleModel->setName(Validator::XSS($_POST['name']));
            $this->roleModel->setDesc(Validator::XSS($_POST['description']));
            
            if ($this->roleModel->update($_POST['permissions'] ?? [])) {
                $_SESSION['message'] = 'Role updated successfully';
            } else {
                $_SESSION['error'] = 'Failed to update role';
            }
        }
        
        $this->redirect('/admin');
    }

    public function deleteRole() {
        $this->requireAdmin();
        
        if (isset($_GET['name'])) {
            $this->roleModel->setName($_GET['name']);
            
            if ($this->roleModel->delete()) {
                $_SESSION['message'] = 'Role deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete role';
            }
        }
        
        $this->redirect('/admin');
    }

    private function requireAdmin() {
        // if (!isset($this->user) || $this->user['role'] !== 'admin') {
        //     $this->redirect('/');
        // }
        return true;
    }
}