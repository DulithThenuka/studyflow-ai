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
}