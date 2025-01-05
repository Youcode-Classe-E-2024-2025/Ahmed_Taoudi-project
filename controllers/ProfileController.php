<?php
session_start();
require_once __DIR__ . '/../config/database.php';

class ProfileController {
    private $db;

    public function __construct() {

    }

    public function getUserProfile($userId) {
        try {
            // Get user information
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return null;
            }

            // Get user skills
            $stmt = $this->db->prepare("SELECT skill_name FROM user_skills WHERE user_id = ?");
            $stmt->execute([$userId]);
            $user['skills'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Get user projects
            $stmt = $this->db->prepare("
                SELECT p.*, 
                    (SELECT COUNT(*) FROM tasks WHERE project_id = p.id) as tasks_count,
                    (SELECT COUNT(*) FROM tasks WHERE project_id = p.id AND status = 'completed') / 
                    (SELECT COUNT(*) FROM tasks WHERE project_id = p.id) * 100 as progress
                FROM projects p
                JOIN project_members pm ON p.id = pm.project_id
                WHERE pm.user_id = ?
                ORDER BY p.created_at DESC
                LIMIT 5
            ");
            $stmt->execute([$userId]);
            $user['projects'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get recent activities
            $stmt = $this->db->prepare("
                SELECT a.*, 
                    CASE 
                        WHEN a.type = 'task_created' THEN 'task-line'
                        WHEN a.type = 'task_completed' THEN 'check-line'
                        WHEN a.type = 'comment_added' THEN 'message-2-line'
                        WHEN a.type = 'file_uploaded' THEN 'file-upload-line'
                        ELSE 'notification-line'
                    END as icon
                FROM activities a
                WHERE a.user_id = ?
                ORDER BY a.created_at DESC
                LIMIT 10
            ");
            $stmt->execute([$userId]);
            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Format activity timestamps
            foreach ($activities as &$activity) {
                $activity['time_ago'] = $this->getTimeAgo(strtotime($activity['created_at']));
            }
            $user['activities'] = $activities;

            return $user;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function updateProfile($userId, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET name = ?, phone = ?, location = ?
                WHERE id = ?
            ");
            return $stmt->execute([
                $data['name'],
                $data['phone'],
                $data['location'],
                $userId
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateAvatar($userId, $avatarPath) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            return $stmt->execute([$avatarPath, $userId]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function addSkill($userId, $skill) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO user_skills (user_id, skill_name) 
                VALUES (?, ?)
            ");
            return $stmt->execute([$userId, $skill]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function removeSkill($userId, $skill) {
        try {
            $stmt = $this->db->prepare("
                DELETE FROM user_skills 
                WHERE user_id = ? AND skill_name = ?
            ");
            return $stmt->execute([$userId, $skill]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    private function getTimeAgo($timestamp) {
        $difference = time() - $timestamp;
        
        if ($difference < 60) {
            return "À l'instant";
        } elseif ($difference < 3600) {
            $minutes = round($difference / 60);
            return "Il y a " . $minutes . " minute" . ($minutes > 1 ? 's' : '');
        } elseif ($difference < 86400) {
            $hours = round($difference / 3600);
            return "Il y a " . $hours . " heure" . ($hours > 1 ? 's' : '');
        } elseif ($difference < 604800) {
            $days = round($difference / 86400);
            return "Il y a " . $days . " jour" . ($days > 1 ? 's' : '');
        } else {
            return date('d/m/Y', $timestamp);
        }
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $profile = new ProfileController();
    $response = ['success' => false];

    switch ($_POST['action']) {
        case 'update_profile':
            if (isset($_SESSION['user_id'])) {
                $success = $profile->updateProfile($_SESSION['user_id'], [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'location' => $_POST['location']
                ]);
                $response['success'] = $success;
            }
            break;

        case 'add_skill':
            if (isset($_SESSION['user_id']) && isset($_POST['skill'])) {
                $success = $profile->addSkill($_SESSION['user_id'], $_POST['skill']);
                $response['success'] = $success;
            }
            break;

        case 'remove_skill':
            if (isset($_SESSION['user_id']) && isset($_POST['skill'])) {
                $success = $profile->removeSkill($_SESSION['user_id'], $_POST['skill']);
                $response['success'] = $success;
            }
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
