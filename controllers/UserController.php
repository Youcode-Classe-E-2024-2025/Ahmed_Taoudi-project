<?php

class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User($this->db);
    }

    public function index() {
        $this->requireAuth();
        $users = $this->userModel->read()->fetchAll();
        $this->render('users/index', ['users' => $users]);
    }

    public function profile() {
        $this->requireAuth();
        
        if (isset($_GET['id'])) {
            $user = $this->userModel->read($_GET['id'])->fetch();
            if (!$user) {
                $this->redirect('/users');
            }
        } else {
            $user = $this->user;
        }

        $projects = $this->userModel->getProjects()->fetchAll();
        $tasks = $this->userModel->getTasks()->fetchAll();

        $this->render('users/profile', [
            'user' => $user,
            'projects' => $projects,
            'tasks' => $tasks
        ]);
    }

    public function edit() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->setId(Validator::XSS( $_POST['id']));
            $this->userModel->setName(Validator::XSS( $_POST['name']));
            $this->userModel->setEmail(Validator::XSS( $_POST['email']));
            $this->userModel->setRoleId(Validator::XSS( $_POST['role_id']));

            if ($this->userModel->update()) {
                $_SESSION['message'] = 'Profile updated successfully';
                $this->redirect('/user/profile?id=' . $_POST['id']);
            } else {
                $_SESSION['error'] = 'Failed to update profile';
                $this->redirect('/user/edit?id=' . $_POST['id']);
            }
        }

        $user = $this->userModel->read($_GET['id'])->fetch();
        $this->render('users/edit', ['user' => $user]);
    }
}
