<?php
// session_start();
// dd($_SESSION);
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class AuthController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User($this->db);
    }

    public function index() {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }
        $this->redirect('/login');
    }

    public function login() {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // CSRF
             $token = $_POST['csrf_token'] ?? 'hh';
            if(!$this->isCSRFTokenValid($token)){
                $_SESSION['error'] = 'CSRF token validation failed. Possible CSRF attack.';
                $this->redirect('/login');
            };
            $this->destroyCSRFToken();

            $email = Validator::XSS($_POST['email']);;
            $password = $_POST['password'];


            $user = $this->userModel->login($email, $password);
            
            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_name'] = $user['role_name'];
                
                $_SESSION['message'] = 'Welcome back, ' . $user['name'];
                $this->redirect('/');
            } else {
                $_SESSION['error'] = 'Invalid email or password';
                $this->redirect('/login');
            }
        }
// dd("login");
        $this->render('login', [
            'title' => 'Login - TeamFlow'
        ]);
    }

    public function register() {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // CSRF
             $token = $_POST['csrf_token'] ?? 'hh';
            if(!$this->isCSRFTokenValid($token)){
                $_SESSION['error'] = 'CSRF token validation failed. Possible CSRF attack.';
                $this->redirect('/register');
            };
            $this->destroyCSRFToken();
            $name = Validator::XSS($_POST['name']);
            $email = Validator::XSS($_POST['email']);;
            $password = $_POST['password'];

            // Check if email exists
            $existingUser = $this->userModel->isIndatabase($email);
            if ($existingUser) {
                $_SESSION['error'] = 'you can not use this email';
                $this->redirect('/register');
            }

            $this->userModel->setName($name);
            $this->userModel->setEmail($email);
            $this->userModel->setPassword($password);

            if ($this->userModel->create()) {
                $_SESSION['message'] = 'Registration successful. Please login.';
                $this->redirect('/login');
            } else {
                $_SESSION['error'] = 'Registration failed. Please try again.';
                $this->redirect('/register');
            }
        }

        $this->render('register', [
            'title' => 'Register - TeamFlow'
        ]);
    }

    public function logout() {
        if ($this->isLoggedIn()) {
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['message'] = 'You have been logged out successfully';
        }
        $this->redirect('/login');
    }



}
