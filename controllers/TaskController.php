<?php
require_once "controllers/BaseController.php";
require_once "core/Validator.php";
// require_once "models/Project.php";
require_once "models/Task.php";
require_once "models/Role.php";
require_once "models/Category.php";
require_once "controllers/PermissionChecker.php";
require_once "models/Tag.php";
class TaskController extends BaseController {
    private $taskModel;
    private $roleModel;
    private $permissionChecker;
    private $categoryModel;
    private $tagModel;

    public function __construct() {
        parent::__construct();
        $this->taskModel = new Task($this->db);
        $this->roleModel = new Role($this->db);
        $this->categoryModel = new Category($this->db);
        $this->tagModel = new Tag($this->db);
        $this->permissionChecker = new PermissionChecker();
    }

    public function index() {
        $this->requireAuth();
        
        if (isset($_GET['project_id'])) {
            $this->taskModel->setProjectId($_GET['project_id']);
            $tasks = $this->taskModel->getTasksByProject($_GET['project_id'])->fetchAll();
            $this->render('tasks', ['tasks' => $tasks]);
        } else {
            $tasks['todo'] = $this->taskModel->getTasksByUser($this->user['id'],'todo')->fetchAll();
            $tasks['doing'] = $this->taskModel->getTasksByUser($this->user['id'],'in_progress')->fetchAll();
            $tasks['review'] = $this->taskModel->getTasksByUser($this->user['id'],'review')->fetchAll();
            $tasks['done'] = $this->taskModel->getTasksByUser($this->user['id'],'done')->fetchAll();
            $this->render('tasks', ['tasks' => $tasks]);
        }
    }


    public function show() {
        if (isset($_GET['id'])) {
          $task = $this->taskModel->read($_GET['id'])->fetch();
        if (!$task) {
            $this->redirect('/tasks');
        }
        
        // Check if it's an AJAX request
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($task);
            exit;
        }
        
        $assignees = $this->taskModel->getAssignedUsers()->fetchAll();
        
        $this->render('task', [
            'task' => $task,
            'assignees' => $assignees
            ]);

        } else {
            $this->redirect('/tasks');
        }
   }

    public function create() {
        $this->requireAuth();
        
        if ($this->isPost()) {
            // $this->permissionChecker->requirePermission($_POST['project_id'],"write");
            $this->taskModel->setProjectId(Validator::XSS($_POST['project_id']));
            $this->taskModel->setTitle(Validator::XSS($_POST['title'])) ;
            $this->taskModel->setDescription(Validator::XSS($_POST['description']));
            $this->taskModel->setStatus('todo');
            $this->taskModel->setDueDate(Validator::XSS($_POST['due_date']));
            
            // Set category if provided
            if (!empty($_POST['category_id'])) {
                $this->taskModel->setCategoryId(Validator::XSS($_POST['category_id']));
            }
            
            // Handle assigned users
            if (isset($_POST['assigned_users']) && is_array($_POST['assigned_users'])) {
                $this->taskModel->setAssignedUsers($_POST['assigned_users']);
            }
            
            // Handle tags
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                $this->taskModel->setTags(array_map('Validator::XSS', $_POST['tags']));
            }

            if ($this->taskModel->create()) {
                $_SESSION['message'] = 'Task created successfully';
                $this->redirect('/projects?id=' . $_POST['project_id']);
            } else {
                $_SESSION['error'] = 'Failed to create task';
                $this->redirect('/projects?id=' . $_POST['project_id']);
            }
        } else {
            $this->_404();
        }
    }
    public function taskJS() {
        $this->requireAuth();
        if ($this->isPost()) {
            // Get JSON data from request body
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            
            if (isset($data['taskId'])) {
                $this->taskModel->setId($data['taskId']);
                $task = $this->taskModel->read($data['taskId'])->fetch();
                if ($task) {
                    // Add assigned users to the response
                    $task['assigned_users'] = $this->taskModel->getAssignedUsers()->fetchAll();
                    // Add category and tags
                    $task['category'] = $this->categoryModel->getCategoryName($task['category_id']);
                    $task['tags'] = $this->tagModel->getTagsByTask($task['id'])->fetchAll();
                    
                    header('Content-Type: application/json');
                    echo json_encode($task);
                    exit;
                }
            }
        }
        
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        exit;
    }

    public function updateStatus() {
        $this->requireAuth();
        if ($this->isPost()) {
            // $this->permissionChecker->requirePermission($_POST['project_id'],"read");
            // dd($_POST);
            $this->taskModel->setId($_POST['task_id']) ;
            $this->taskModel->setStatus($_POST['status']);
            if ($this->taskModel->updateStatus()) {
                $_SESSION['message'] = 'Task updated successfully';
                $this->redirect('/tasks');
            } else {
                $_SESSION['error'] = 'Failed to update task';
                $this->redirect('/tasks');
            }
        }

        $task = $this->taskModel->read($_GET['id'])->fetch();
        $assignees = $this->taskModel->getAssignedUsers()->fetchAll();
        $this->render('tasks/edit', [
            'task' => $task,
            'assignees' => $assignees
        ]);
    }

    public function edit() {
        $this->requireAuth();
        if ($this->isPost()) {
            // $this->permissionChecker->requirePermission($_POST['project_id'],"edit");

            $this->taskModel->setId($_POST['id']) ;
            $this->taskModel->setTitle($_POST['title']) ;
            $this->taskModel->setDescription($_POST['description']);
            $this->taskModel->setStatus($_POST['status']);
            $this->taskModel->setDueDate($_POST['due_date']);
            
            // Set category if provided
            if (!empty($_POST['category_id'])) {
                $this->taskModel->setCategoryId(Validator::XSS($_POST['category_id']));
            }
            
            // Handle assigned users
            if (isset($_POST['assigned_users']) && is_array($_POST['assigned_users'])) {
                $this->taskModel->setAssignedUsers(array_map('Validator::XSS', $_POST['assigned_users']));
            }
            
            // Handle tags
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                $this->taskModel->setTags(array_map('Validator::XSS', $_POST['tags']));
            }

            if ($this->taskModel->update()) {
                $_SESSION['message'] = 'Task updated successfully';
                $this->redirect('/projects?id=' . $_POST['project_id']);
            } else {
                $_SESSION['error'] = 'Failed to update task';
                $this->redirect('/projects?id=' . $_POST['project_id']);
            }
        }

        $task = $this->taskModel->read($_GET['id'])->fetch();
        $assignees = $this->taskModel->getAssignedUsers()->fetchAll();
        $this->render('tasks/edit', [
            'task' => $task,
            'assignees' => $assignees
        ]);
    }

    public function delete() {
        $this->requireAuth();

        if (isset($_POST['task_id'])) {
            // dd($_POST);
            // $this->permissionChecker->requirePermission($_POST['project_id'],"edit");

            $this->taskModel->setId($_POST['task_id']);
            if ($this->taskModel->delete()) {
                $_SESSION['message'] = 'Task deleted successfully';
                $this->redirect('/projects?id=' . $_POST['project_id']);
            } else {
                $_SESSION['error'] = 'Failed to delete task';
                $this->redirect('/projects?id=' . $_POST['project_id']);
            }
        }else{
            $this->_404();
        }
    }


}
