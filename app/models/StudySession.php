<?php
class StudySession
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTodayStudyMinutesByUser($userId)
    {
        $this->db->query("
            SELECT COALESCE(SUM(duration_minutes), 0) AS total_minutes
            FROM study_sessions
            WHERE user_id = :user_id
              AND session_date = CURDATE()
              AND session_type = 'Focus'
        ");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        return $row ? (int)$row->total_minutes : 0;
    }

    public function addSession($data)
    {
        $this->db->query("
            INSERT INTO study_sessions (user_id, task_id, session_date, duration_minutes, session_type, notes)
            VALUES (:user_id, :task_id, :session_date, :duration_minutes, :session_type, :notes)
        ");

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':task_id', $data['task_id']);
        $this->db->bind(':session_date', $data['session_date']);
        $this->db->bind(':duration_minutes', $data['duration_minutes']);
        $this->db->bind(':session_type', $data['session_type']);
        $this->db->bind(':notes', $data['notes']);

        return $this->db->execute();
    }

    public function getRecentSessionsByUser($userId)
    {
        $this->db->query("
            SELECT ss.*, t.title
            FROM study_sessions ss
            LEFT JOIN tasks t ON ss.task_id = t.id
            WHERE ss.user_id = :user_id
            ORDER BY ss.created_at DESC
            LIMIT 8
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function getWeeklyStudyMinutesByUser($userId)
    {
        $this->db->query("
            SELECT COALESCE(SUM(duration_minutes), 0) AS total_minutes
            FROM study_sessions
            WHERE user_id = :user_id
              AND session_type = 'Focus'
              AND session_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
        ");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        return $row ? (int)$row->total_minutes : 0;
    }

    public function getLast7DaysStudyBreakdown($userId)
    {
        $this->db->query("
            SELECT session_date, COALESCE(SUM(duration_minutes), 0) AS total_minutes
            FROM study_sessions
            WHERE user_id = :user_id
              AND session_type = 'Focus'
              AND session_date >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY session_date
            ORDER BY session_date ASC
        ");
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }
}