<?php
require_once "controllers/BaseController.php";
require_once "models/Project.php";
require_once "models/Task.php";
class HomeController extends BaseController {
    private $projectModel;
    private $taskModel;

    public function __construct() {
        parent::__construct();
        $this->projectModel = new Project($this->db);
        $this->taskModel = new Task($this->db);
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
    public function getChartData() {
        $this->requireAuth();
        // Fetch data for Project Progress Chart
        $projectProgressData = [
            'labels' => ['Planning', 'In Progress', 'Completed'],
            'data' => []
        ];
        $result = $this->projectModel->getProjectStatus($this->user['id'])->fetch();

        if ($result) {
            $projectProgressData['data'] = [
                $result['planning'],
                $result['in_progress'],
                $result['completed']
            ];
        }
    
        // Fetch data for Team Productivity Chart (based on task status of projects assigned to the user)

        $teamProductivityData = [
            'data' => $this->taskModel->getTasksTeamStatus($this->user['id'])->fetch()
        ];
    
        // Fetch data for Task Completion Chart
        $taskCompletionData = [

            'data' => $this->taskModel->getTasksStatusForUser($this->user['id'])->fetch()
        ];


        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode([
            'projectProgress' => $projectProgressData,
            'teamProductivity' => $teamProductivityData,
            'taskCompletion' => $taskCompletionData
        ]);
    }
}
