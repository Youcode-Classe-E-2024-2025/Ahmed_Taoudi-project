<?php

class BaseController {
    protected $db;
    protected $user;

    public function __construct() {
        $this->db = new Database();
        $this->checkSession();
    }

    protected function checkSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        }
    }

    protected function requireAuth() {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = 'Please login to continue';
            $this->redirect('/login');
        }
    }

    protected function isLoggedIn() {
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }

    protected function render($view, $data = []) {
        $data['user'] = $this->user;
        $data['isLoggedIn'] = $this->isLoggedIn();
        
        extract($data);
        require "views/{$view}.php";
    }

    protected function redirect($path) {
        header("Location: {$path}");
        exit;
    }

    protected function getRequestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function isPost() {
        return $this->getRequestMethod() === 'POST';
    }

    protected function isGet() {
        return $this->getRequestMethod() === 'GET';
    }

    protected function setFlashMessage($type, $message) {
        $_SESSION[$type] = $message;
    }

    protected function hasFlashMessage($type) {
        return isset($_SESSION[$type]);
    }

    protected function getFlashMessage($type) {
        if ($this->hasFlashMessage($type)) {
            $message = $_SESSION[$type];
            unset($_SESSION[$type]);
            return $message;
        }
        return null;
    }
}
