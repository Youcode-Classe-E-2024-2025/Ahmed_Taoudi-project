<?php

class BaseController {
    protected $db;
    protected $user;

    public function __construct() {
        $this->db = new Database();
        $this->checkSession();
    }

    protected function checkSession() {
        session_start();
        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        }
    }

    protected function requireAuth() {
        if (!$this->user) {
            header('Location: /login');
            exit;
        }
    }

    protected function render($view, $data = []) {
        extract($data);
        require "views/{$view}.php";
    }

    protected function redirect($path) {
        header("Location: {$path}");
        exit;
    }

}
