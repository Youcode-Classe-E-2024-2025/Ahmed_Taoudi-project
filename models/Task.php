<?php

class Task {
    private $conn;
    private $table = 'tasks';

    private $id;
    private $title;
    private $description;
    private $project_id;
    private $status;
    private $due_date;
    private $created_at;
    private $assigned_users = [];
    private $category_id;
    private $tags = [];

    public function __construct($db) {
        $this->conn = $db;
    }
    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getProjectId() {
        return $this->project_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDueDate() {
        return $this->due_date;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getAssignedUserIds() {
        $query = "SELECT user_id FROM task_users WHERE task_id = :task_id";
        $result = $this->conn->query($query, [':task_id' => $this->id])->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }
    
    public function getAssignedUsers() {
        $query = "SELECT u.* FROM users u 
                 JOIN task_users tu ON u.id = tu.user_id 
                 WHERE tu.task_id = :task_id";
        return $this->conn->query($query, [':task_id' => $this->id]);
    }

    // Category methods
    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getCategory() {
        if (!isset($this->category_id)) return null;
        
        $query = "SELECT * FROM categories WHERE id = :category_id";
        return $this->conn->query($query, [':category_id' => $this->category_id])->fetch();
    }

    // Tag methods
    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function getTags() {
        $query = "SELECT t.* FROM tags t 
                 JOIN task_tags tt ON t.id = tt.tag_id 
                 WHERE tt.task_id = :task_id";
        return $this->conn->query($query, [':task_id' => $this->id]);
    }

    public function addTag($tag_id) {
        $query = "INSERT INTO task_tags (task_id, tag_id) VALUES (:task_id, :tag_id)";
        return $this->conn->query($query, [
            ':task_id' => $this->id,
            ':tag_id' => $tag_id
        ]);
    }

    public function removeTag($tag_id) {
        $query = "DELETE FROM task_tags WHERE task_id = :task_id AND tag_id = :tag_id";
        return $this->conn->query($query, [
            ':task_id' => $this->id,
            ':tag_id' => $tag_id
        ]);
    }

    public function removeAllTags() {
        $query = "DELETE FROM task_tags WHERE task_id = :task_id";
        return $this->conn->query($query, [':task_id' => $this->id]);
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        
    }

    public function setTitle($title) {
        $this->title = $title;
        
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setProjectId($project_id) {
        $this->project_id = $project_id;
    }

    public function setStatus($status) {
        $valid_statuses = ['todo', 'in_progress', 'review', 'done'];
        $this->status = in_array($status, $valid_statuses) ? $status : 'todo';
    }

    public function setDueDate($date) {
        if ($date instanceof DateTime) {
            $this->due_date = $date->format('Y-m-d');
        } else {
            $this->due_date = date('Y-m-d', strtotime($date));
        }
    } 



    public function setAssignedUsers($assigned_users) {
        $this->assigned_users = $assigned_users;
    }

    // create
    public function create() {
        $this->conn->connection->beginTransaction();
        try {
            
            $query = "INSERT INTO " . $this->table . " 
                    (title, description, status, due_date, project_id, category_id) 
                    VALUES 
                    (:title, :description, :status, :due_date, :project_id, :category_id)";
            
            $result = $this->conn->query($query, [
                ':title' => $this->title,
                ':description' => $this->description,
                ':status' => $this->status,
                ':due_date' => $this->due_date,
                ':project_id' => $this->project_id,
                ':category_id' => $this->category_id
            ]);
            
            if ($result) {
                $this->id = $this->conn->lastInsertId();
                
                // Handle user assignments
                if (!empty($this->assigned_users)) {
                    $this->assignUsers($this->assigned_users);
                }
                
                // Handle tags
                if (!empty($this->tags)) {
                    foreach ($this->tags as $tag_id) {
                        $this->addTag($tag_id);
                    }
                }
                
                $this->conn->connection->commit();
                return true;
            }
            
            if ($this->conn->connection->inTransaction()) {
                $this->conn->connection->rollback();
            }
            return false;
        } catch (Exception $e) {
            if ($this->conn->connection->inTransaction()) {
                $this->conn->connection->rollback();
            }
            error_log('Error during task creation: ' . $e->getMessage());
            return false;
        }
    }
    
    public function getTasksTeamStatus($user_id) {
        $query = "SELECT 
                        SUM(CASE WHEN t.status = 'todo' THEN 1 ELSE 0 END) AS 'Todo',
                        SUM(CASE WHEN t.status = 'in_progress' THEN 1 ELSE 0 END) AS 'In Progress',
                        SUM(CASE WHEN t.status = 'review' THEN 1 ELSE 0 END) AS 'Review',
                        SUM(CASE WHEN t.status = 'done' THEN 1 ELSE 0 END) AS 'Done'
                    FROM {$this->table} t
                    left JOIN projects p ON t.project_id = p.id 
                    where p.id in (
                        select pr.project_id
                           from user_projects pr 
                           where pr.user_id = :user_id )";
        $params = ['user_id' => $user_id];
        return $this->conn->query($query, $params);
    }
    
    public function getTasksStatusForUser($uid) {
        $query = "SELECT 
                    SUM(CASE WHEN t.status = 'todo' THEN 1 ELSE 0 END) AS 'Todo',
                    SUM(CASE WHEN t.status = 'in_progress' THEN 1 ELSE 0 END) AS 'In Progress',
                    SUM(CASE WHEN t.status = 'review' THEN 1 ELSE 0 END) AS 'Review',
                    SUM(CASE WHEN t.status = 'done' THEN 1 ELSE 0 END) AS 'Done'
                FROM " . $this->table . " t
                JOIN task_users tu ON t.id = tu.task_id

                WHERE tu.user_id = :user_id";
        $params = ['user_id' => $uid];
        return $this->conn->query($query, $params);
        
    }

    public function getTasksByUser($user_id ,$task_status = 'all') {
        $query = "SELECT t.*
                FROM " . $this->table . " t
                JOIN task_users tu ON t.id = tu.task_id
                WHERE tu.user_id = :user_id";
        $params = ['user_id' => $user_id];
        if ($task_status !== 'all') {
            $query .= " AND t.status = :task_status";
            $params = ['user_id' => $user_id, 'task_status' => $task_status];
        }

        return $this->conn->query($query, $params);
    }
    // read
    public function read($id = null) {
        $query = "SELECT t.*
                FROM " . $this->table . " t";
        
        $params = [];
        if ($id) {
            $query .= " WHERE t.id = :id";
            $params =['id'=>$id]; ;
        }else{
            $query .= " WHERE t.project_id = :project_id";
            $params = ['project_id'=>$this->project_id];
        }
        
        return $this->conn->query($query, $params);
    }
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->conn->query($query, [':id' => $this->id]);
    }

    public function assignUsers($user_ids) {
    
            // First remove all existing assignments
            $query = "DELETE FROM task_users WHERE task_id = :task_id";
            $this->conn->query($query, [':task_id' => $this->id]);
            
            // Then add new assignments
            if (!empty($user_ids)) {
                $query = "INSERT INTO task_users (task_id, user_id) VALUES (:task_id, :user_id)";
                foreach ($user_ids as $user_id) {
                    $this->conn->query($query, [
                        ':task_id' => $this->id,
                        ':user_id' => $user_id
                    ]);
                }
            }

        
    }

    public function removeTaskAssignee($user_id,$project_id) {

        $query = "DELETE tu
                    FROM task_users tu
                    JOIN tasks t ON tu.task_id = t.id
                    LEFT JOIN projects p ON t.project_id = p.id
                    WHERE p.id = :project_id
                    AND tu.user_id = :user_id";
        return $this->conn->query($query, [':project_id' => $project_id, ':user_id' => $user_id]);
    }

    public function update() {
        $this->conn->connection->beginTransaction();
        try {
            
            $query = "UPDATE " . $this->table . " 
                    SET title = :title, 
                        description = :description, 
                        status = :status, 
                        due_date = :due_date,
                        category_id = :category_id
                    WHERE id = :id";
            
            $result = $this->conn->query($query, [
                ':title' => $this->title,
                ':description' => $this->description,
                ':status' => $this->status,
                ':due_date' => $this->due_date,
                ':category_id' => $this->category_id,
                ':id' => $this->id
            ]);
            
            if ($result) {
                // Handle user assignments
                if (!empty($this->assigned_users)) {
                    $this->assignUsers($this->assigned_users);
                }
                // Update tags if they've been set
                if (!empty($this->tags)) {
                    $this->removeAllTags();
                    foreach ($this->tags as $tag_id) {
                        $this->addTag($tag_id);
                    }
                }
                
                $this->conn->connection->commit();
                return true;
            }
            
            if ($this->conn->connection->inTransaction()) {
                $this->conn->connection->rollback();
            }
            return false;
        } catch (Exception $e) {
            if ($this->conn->connection->inTransaction()) {
                $this->conn->connection->rollback();
            }
            error_log('Error during task update: ' . $e->getMessage());
            return false;
        }
    }

    public function updateStatus() {
        $query = "UPDATE " . $this->table . " 
                SET status = :status 
                WHERE id = :id";

        return $this->conn->query($query, [':status' => $this->status, ':id' => $this->id]);
    }
    public function getTasksByStatus($status = 'all') {
        $query = "SELECT t.*, p.name as project_name, c.name as category_name
                FROM " . $this->table . " t
                LEFT JOIN projects p ON t.project_id = p.id
                LEFT JOIN categories c ON t.category_id = c.id";
        
        $params = [];
        if ($status !== 'all') {
            $query .= " WHERE t.status = :status";
            $params[':status'] = $status;
        }
        
        $query .= " ORDER BY t.due_date ASC";
        $tasks = $this->conn->query($query, $params)->fetchAll();
        
        // Add tags for each task
        foreach ($tasks as &$task) {
            $tagQuery = "SELECT t.* FROM tags t 
                        JOIN task_tags tt ON t.id = tt.tag_id 
                        WHERE tt.task_id = :task_id
                        ORDER BY t.name";
            $task['tags'] = $this->conn->query($tagQuery, [':task_id' => $task['id']])->fetchAll();
        }
        
        return $tasks;
    }
    public function getTasksByProject($project_id) {
        $query = "SELECT t.*, u.name as assigned_to, c.name as category_name
                FROM " . $this->table . " t
                LEFT JOIN task_users tu ON t.id = tu.task_id
                LEFT JOIN users u ON tu.user_id = u.id
                LEFT JOIN categories c ON t.category_id = c.id
                WHERE t.project_id = :project_id
                ORDER BY t.status, t.due_date ASC";

        $tasks = $this->conn->query($query, [':project_id' => $project_id])->fetchAll();
        
        // Add tags for each task
        foreach ($tasks as &$task) {
            $tagQuery = "SELECT t.* FROM tags t 
                        JOIN task_tags tt ON t.id = tt.tag_id 
                        WHERE tt.task_id = :task_id
                        ORDER BY t.name";
            $task['tags'] = $this->conn->query($tagQuery, [':task_id' => $task['id']])->fetchAll();
        }
        
        return $tasks;
    }
}