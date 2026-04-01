<?php
class Task
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTotalTasksByUser($userId)
    {
        $this->db->query('SELECT COUNT(*) AS total FROM tasks WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function getCompletedTasksByUser($userId)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM tasks WHERE user_id = :user_id AND status = 'Completed'");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function getPendingTasksByUser($userId)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM tasks WHERE user_id = :user_id AND status != 'Completed'");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function getUpcomingTasksByUser($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
              AND t.status != 'Completed'
              AND t.deadline IS NOT NULL
            ORDER BY t.deadline ASC
            LIMIT 5
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getRecentTasksByUser($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
            ORDER BY t.created_at DESC
            LIMIT 5
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getTasksByUser($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
            ORDER BY
                CASE t.status
                    WHEN 'Pending' THEN 1
                    WHEN 'In Progress' THEN 2
                    WHEN 'Completed' THEN 3
                    ELSE 4
                END,
                t.deadline IS NULL,
                t.deadline ASC,
                t.score DESC,
                t.created_at DESC
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getTaskById($id)
    {
        $this->db->query('SELECT * FROM tasks WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function addTask($data)
    {
        $this->db->query("
            INSERT INTO tasks
            (user_id, subject_id, title, description, task_type, priority, difficulty, status, deadline, estimated_hours, score)
            VALUES
            (:user_id, :subject_id, :title, :description, :task_type, :priority, :difficulty, :status, :deadline, :estimated_hours, :score)
        ");

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':subject_id', $data['subject_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':task_type', $data['task_type']);
        $this->db->bind(':priority', $data['priority']);
        $this->db->bind(':difficulty', $data['difficulty']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':deadline', !empty($data['deadline']) ? $data['deadline'] : null);
        $this->db->bind(':estimated_hours', $data['estimated_hours']);
        $this->db->bind(':score', $data['score']);

        return $this->db->execute();
    }

    public function updateTask($data)
    {
        $this->db->query("
            UPDATE tasks
            SET subject_id = :subject_id,
                title = :title,
                description = :description,
                task_type = :task_type,
                priority = :priority,
                difficulty = :difficulty,
                status = :status,
                deadline = :deadline,
                estimated_hours = :estimated_hours,
                score = :score
            WHERE id = :id
        ");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':subject_id', $data['subject_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':task_type', $data['task_type']);
        $this->db->bind(':priority', $data['priority']);
        $this->db->bind(':difficulty', $data['difficulty']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':deadline', !empty($data['deadline']) ? $data['deadline'] : null);
        $this->db->bind(':estimated_hours', $data['estimated_hours']);
        $this->db->bind(':score', $data['score']);

        return $this->db->execute();
    }

    public function deleteTask($id)
    {
        $this->db->query('DELETE FROM tasks WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function markTaskCompleted($id)
    {
        $this->db->query("UPDATE tasks SET status = 'Completed' WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function getRandomMotivationMessage()
    {
        $this->db->query('SELECT message FROM motivation_messages ORDER BY RAND() LIMIT 1');
        $row = $this->db->single();

        return $row ? $row->message : 'Keep going. Small progress is still progress.';
    }

    public function calculateTaskScore($data)
    {
        $score = 0;

        if (!empty($data['deadline'])) {
            $today = new DateTime();
            $deadline = new DateTime($data['deadline']);
            $daysLeft = (int)$today->diff($deadline)->format('%r%a');

            if ($daysLeft <= 1) {
                $score += 50;
            } elseif ($daysLeft <= 3) {
                $score += 40;
            } elseif ($daysLeft <= 7) {
                $score += 25;
            } elseif ($daysLeft <= 14) {
                $score += 15;
            } else {
                $score += 5;
            }
        }

        switch ($data['priority']) {
            case 'High':
                $score += 30;
                break;
            case 'Medium':
                $score += 20;
                break;
            case 'Low':
                $score += 10;
                break;
        }

        switch ($data['difficulty']) {
            case 'Hard':
                $score += 20;
                break;
            case 'Medium':
                $score += 12;
                break;
            case 'Easy':
                $score += 6;
                break;
        }

        if ($data['status'] === 'Pending') {
            $score += 10;
        } elseif ($data['status'] === 'In Progress') {
            $score += 5;
        }

        if (is_numeric($data['estimated_hours'])) {
            if ($data['estimated_hours'] >= 5) {
                $score += 12;
            } elseif ($data['estimated_hours'] >= 3) {
                $score += 8;
            } else {
                $score += 4;
            }
        }

        return $score;
    }

    public function getRecommendedTasksByUser($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
              AND t.status != 'Completed'
            ORDER BY t.score DESC, t.deadline IS NULL, t.deadline ASC
            LIMIT 10
        ");
        $this->db->bind(':user_id', $userId);

        $tasks = $this->db->resultSet();

        foreach ($tasks as $task) {
            $task->recommendation_note = $this->buildRecommendationNote($task);
        }

        return $tasks;
    }

    public function getPlannerSummary($userId)
    {
        $this->db->query("
            SELECT
                COUNT(*) AS total_active,
                COALESCE(SUM(estimated_hours), 0) AS total_hours,
                SUM(CASE WHEN priority = 'High' THEN 1 ELSE 0 END) AS high_priority_count,
                SUM(CASE WHEN deadline IS NOT NULL AND deadline <= DATE_ADD(CURDATE(), INTERVAL 3 DAY) THEN 1 ELSE 0 END) AS urgent_count
            FROM tasks
            WHERE user_id = :user_id
              AND status != 'Completed'
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->single();
    }

    public function getBurnoutWarning($userId)
    {
        $this->db->query("
            SELECT COALESCE(SUM(estimated_hours), 0) AS total_hours
            FROM tasks
            WHERE user_id = :user_id
              AND status != 'Completed'
              AND deadline IS NOT NULL
              AND deadline <= DATE_ADD(CURDATE(), INTERVAL 1 DAY)
        ");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        if ($row && $row->total_hours >= 8) {
            return 'Your upcoming workload looks heavy. Consider spreading some tasks across multiple sessions.';
        }

        return '';
    }

    private function buildRecommendationNote($task)
    {
        $reasons = [];

        if (!empty($task->deadline)) {
            $today = new DateTime();
            $deadline = new DateTime($task->deadline);
            $daysLeft = (int)$today->diff($deadline)->format('%r%a');

            if ($daysLeft <= 1) {
                $reasons[] = 'deadline is very close';
            } elseif ($daysLeft <= 3) {
                $reasons[] = 'deadline is approaching soon';
            }
        }

        if ($task->priority === 'High') {
            $reasons[] = 'high priority';
        }

        if ($task->difficulty === 'Hard') {
            $reasons[] = 'hard difficulty';
        }

        if ((float)$task->estimated_hours >= 3) {
            $reasons[] = 'needs more study time';
        }

        if ($task->status === 'Pending') {
            $reasons[] = 'not started yet';
        }

        if (empty($reasons)) {
            return 'A good task to continue based on your current study plan.';
        }

        return 'Recommended because ' . implode(', ', $reasons) . '.';
    }

    public function getOverallProgressStats($userId)
    {
        $this->db->query("
            SELECT
                COUNT(*) AS total_tasks,
                SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS completed_tasks,
                SUM(CASE WHEN status != 'Completed' THEN 1 ELSE 0 END) AS pending_tasks,
                COALESCE(SUM(estimated_hours), 0) AS total_estimated_hours
            FROM tasks
            WHERE user_id = :user_id
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->single();
    }

    public function getSubjectProgressByUser($userId)
    {
        $this->db->query("
            SELECT
                s.id,
                s.subject_name,
                s.color,
                COUNT(t.id) AS total_tasks,
                SUM(CASE WHEN t.status = 'Completed' THEN 1 ELSE 0 END) AS completed_tasks
            FROM subjects s
            LEFT JOIN tasks t ON s.id = t.subject_id
            WHERE s.user_id = :user_id
            GROUP BY s.id, s.subject_name, s.color
            ORDER BY s.created_at DESC
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getAllTasks()
    {
        $this->db->query("
            SELECT t.*, u.name AS user_name
            FROM tasks t
            INNER JOIN users u ON t.user_id = u.id
            ORDER BY t.created_at DESC
        ");

        return $this->db->resultSet();
    }

    public function getTotalTasksGlobal()
    {
        $this->db->query('SELECT COUNT(*) AS total FROM tasks');
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function getCompletedTasksGlobal()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM tasks WHERE status = 'Completed'");
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }
        public function getUpcomingDeadlineAlerts($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
              AND t.status != 'Completed'
              AND t.deadline IS NOT NULL
              AND t.deadline BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 DAY)
            ORDER BY t.deadline ASC
            LIMIT 5
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getOverdueTasksByUser($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
              AND t.status != 'Completed'
              AND t.deadline IS NOT NULL
              AND t.deadline < CURDATE()
            ORDER BY t.deadline ASC
            LIMIT 5
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getBestTaskForToday($userId)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
              AND t.status != 'Completed'
            ORDER BY t.score DESC, t.deadline IS NULL, t.deadline ASC
            LIMIT 1
        ");
        $this->db->bind(':user_id', $userId);

        $task = $this->db->single();

        if ($task) {
            $task->recommendation_note = $this->buildRecommendationNote($task);
        }

        return $task;
    }
        public function getRecommendedTasksByAvailableTime($userId, $availableHours)
    {
        $this->db->query("
            SELECT t.*, s.subject_name, s.color
            FROM tasks t
            INNER JOIN subjects s ON t.subject_id = s.id
            WHERE t.user_id = :user_id
              AND t.status != 'Completed'
              AND t.estimated_hours <= :available_hours
            ORDER BY t.score DESC, t.deadline IS NULL, t.deadline ASC
            LIMIT 10
        ");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':available_hours', $availableHours);

        $tasks = $this->db->resultSet();

        foreach ($tasks as $task) {
            $task->recommendation_note = $this->buildRecommendationNote($task);
        }

        return $tasks;
    }
        public function getPendingTasksGlobal()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM tasks WHERE status != 'Completed'");
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function filterAdminTasks($search = '', $status = '')
    {
        $sql = "
            SELECT t.*, u.name AS user_name
            FROM tasks t
            INNER JOIN users u ON t.user_id = u.id
            WHERE 1 = 1
        ";

        if (!empty($search)) {
            $sql .= " AND (t.title LIKE :search OR u.name LIKE :search OR t.task_type LIKE :search)";
        }

        if (!empty($status)) {
            $sql .= " AND t.status = :status";
        }

        $sql .= " ORDER BY t.created_at DESC";

        $this->db->query($sql);

        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }

        if (!empty($status)) {
            $this->db->bind(':status', $status);
        }

        return $this->db->resultSet();
    }

    public function getPlatformActivityStats()
    {
        $this->db->query("
            SELECT
                COUNT(*) AS total_tasks,
                SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS completed_tasks,
                SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending_tasks,
                SUM(CASE WHEN status = 'In Progress' THEN 1 ELSE 0 END) AS in_progress_tasks,
                COALESCE(SUM(estimated_hours), 0) AS total_estimated_hours
            FROM tasks
        ");

        return $this->db->single();
    }
}