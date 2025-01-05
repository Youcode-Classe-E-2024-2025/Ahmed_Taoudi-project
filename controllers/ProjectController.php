<?php
require_once "controllers/BaseController.php";
require_once "models/Project.php";
require_once "models/Task.php";
require_once "core/Validator.php" ;
class ProjectController extends BaseController {
    private $projectModel;


    public function __construct() {
        parent::__construct();
        $this->projectModel = new Project($this->db);
    }

    public function index() {
        $this->requireAuth();
        
        if (isset($_GET['id'])) {
            $project = $this->projectModel->read($this->user['id'],$_GET['id'])->fetch();
            if (!$project) {
                $this->redirect('/projects');
            }
            $this->projectModel->setId($_GET['id']);
            $tasks['todo'] = $this->projectModel->getTasksByStatus('todo')->fetchAll();
            $tasks['doing'] = $this->projectModel->getTasksByStatus('in_progress')->fetchAll();
            $tasks['review'] = $this->projectModel->getTasksByStatus('review')->fetchAll();
            $tasks['done'] = $this->projectModel->getTasksByStatus('done')->fetchAll();
            $team = $this->projectModel->getTeamMembers()->fetchAll();
            $stats = $this->projectModel->getTaskStats();
            
            $this->render('project', [
                'project' => $project,
                'tasks' => $tasks,
                'team' => $team,
                'stats' => $stats
            ]);
        } else {
            $projects = $this->projectModel->read($this->user['id'])->fetchAll();
            $this->render('projects', ['projects' => $projects]);
        }
    }

    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo $this->user['id'] ;
            // dd($_POST);
            $this->projectModel->setName(Validator::XSS($_POST['name']));
            $this->projectModel->setDescription(Validator::XSS($_POST['description'])) ;
            $this->projectModel->setStartDate(Validator::XSS($_POST['start_date'])) ;
            $this->projectModel->setEndDate(Validator::XSS($_POST['end_date']));
            $this->projectModel->setStatus('planning');
            $this->projectModel->setCreatedBy($this->user['id']) ;

            if ($this->projectModel->create()) {
                $_SESSION['message'] = 'Project created successfully';
                $this->redirect('/projects');
            } else {
                $_SESSION['error'] = 'Failed to create project';
                $this->redirect('/projects');
            }
        }

        $this->redirect('/projects');
    }

    public function edit() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->projectModel->setId($_POST['id']);
            $this->projectModel->setName(Validator::XSS($_POST['name']));
            $this->projectModel->setDescription(Validator::XSS($_POST['description'])) ;
            $this->projectModel->setStartDate(Validator::XSS($_POST['start_date'])) ;
            $this->projectModel->setEndDate(Validator::XSS($_POST['end_date']));
            $this->projectModel->setStatus(Validator::XSS($_POST['status']));

            if ($this->projectModel->update()) {
                $_SESSION['message'] = 'Project updated successfully';
                $this->redirect('/projects?id=' . $_POST['id']);
            } else {
                $_SESSION['error'] = 'Failed to update project';
                $this->redirect('/project/edit?id=' . $_POST['id']);
            }
        }

        $project = $this->projectModel->read($_GET['id'])->fetch();
        $this->render('projects/edit', ['project' => $project]);
    }

    public function delete() {
        $this->requireAuth();

        if (isset($_GET['id'])) {
            if ($this->projectModel->delete($_GET['id'])) {
                $_SESSION['message'] = 'Project deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete project';
            }
        }
        
        $this->redirect('/projects');
    }

    public function updateVisibility() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projectId = Validator::XSS($_POST['project_id']);
            $visibility = Validator::XSS($_POST['visibility']);
            
            if (!in_array($visibility, ['public', 'private'])) {
                $_SESSION['error'] = "Visibilité invalide";
                $this->redirect('/projects?id=' . $projectId);
                return;
            }
            
            if ($this->projectModel->updateVisibility($projectId, $visibility)) {
                $_SESSION['message'] = "Visibilité du projet mise à jour";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de la visibilité";
            }
            
            $this->redirect('/projects?id=' . $projectId);
        }
    }
}
