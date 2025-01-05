<?php
require_once "controllers/BaseController.php";
require_once "models/Project.php";
require_once "models/Task.php";
class HomeController extends BaseController {
    private $projectModel;

    public function __construct() {
        parent::__construct();
        $this->projectModel = new Project($this->db);
    }

    public function index() {
        $publicProjects = $this->projectModel->getPublicProjects()->fetchAll();
        
        if (!$this->isLoggedIn()) {
            $this->render('home', [
                'publicProjects' => $publicProjects
            ]);
        } else {
            $totalProjects = 12;
            $activeProjects = 5;
            $totalTasks = 48;
            $completedTasks = 32;
            $this->render('dashboard', [
                'totalProjects' => $totalProjects,
                'activeProjects' => $activeProjects,
                'totalTasks' => $totalTasks,
                'completedTasks' => $completedTasks,
                'publicProjects' => $publicProjects
            ]);
        }
        
    }
}
