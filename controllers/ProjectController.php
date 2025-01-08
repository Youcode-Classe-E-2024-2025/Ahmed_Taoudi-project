<?php
require_once "controllers/BaseController.php";
require_once "models/Project.php";
require_once "models/Role.php";
require_once "models/Task.php";
require_once "core/Validator.php" ;
class ProjectController extends BaseController {
    private $projectModel;
    private $roleModel;


    public function __construct() {
        parent::__construct();
        $this->projectModel = new Project($this->db);
        $this->roleModel = new Role($this->db);
    }

    public function index() {
        $this->requireAuth();
        
        if (isset($_GET['id'])) {
            $project = $this->projectModel->read($this->user['id'],$_GET['id'])->fetch();
            // dd($project);
            if (!$project) {
                $this->redirect('/projects');
            }
            $this->projectModel->setId($_GET['id']);
            $tasks['todo'] = $this->projectModel->getTasksByStatus('todo')->fetchAll();
            $tasks['doing'] = $this->projectModel->getTasksByStatus('in_progress')->fetchAll();
            $tasks['review'] = $this->projectModel->getTasksByStatus('review')->fetchAll();
            $tasks['done'] = $this->projectModel->getTasksByStatus('done')->fetchAll();
            $availableUsers = $this->projectModel->getAvailableUsers()->fetchAll();
            $team = $this->projectModel->getTeamMembers()->fetchAll();
            $stats = $this->projectModel->getTaskStats();
            $this->roleModel->setName($project['user_role_for_project']);
            $permissions = $this->roleModel->getPermissions()->fetchAll();
            $this->render('project', [
                'project' => $project,
                'tasks' => $tasks,
                'team' => $team,
                'availableUsers'=>$availableUsers,
                'stats' => $stats,
                'permissions'=>$permissions
            ]);
        } else {
            $projects = $this->projectModel->read($this->user['id'])->fetchAll();
            $this->render('projects', ['projects' => $projects]);
        }
    }

    public function create() {
        $this->requireAuth();

        if ($this->isPost()) {
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
                // dd(222);
                $this->redirect('/projects');
            } else {
                // dd(333);
                $_SESSION['error'] = 'Failed to create project';
                $this->redirect('/projects');
            }
        }

        $this->redirect('/projects');
    }

    public function edit() {
        $this->requireAuth();

        if ($this->isPost()) {
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
        
        if ($this->isPost()) {
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
        }else{
           return $this->_404();
        }
    }
    public function addMember(){
        $this->requireAuth();
        // dd($_POST);
        if ($this->isPost()) {
            $projectId = Validator::XSS($_POST['project_id']);
            $user_ids = $_POST['user_ids'];
            if (empty($user_ids)) {
                $_SESSION['error'] = "Invalide Request";
                $this->redirect('/projects?id=' . $projectId);
                return;
            }
            $this->projectModel->setId($projectId) ;
            foreach($user_ids as $uid ){
             $this->projectModel->addTeamMember($uid) ;
             }
            $this->redirect('/projects?id=' . $projectId);
        }else{
           return $this->_404();
        }
    }

}
