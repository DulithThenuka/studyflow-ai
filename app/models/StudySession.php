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

        $saved = $this->db->execute();

        if ($saved && $data['session_type'] === 'Focus') {
            $this->updateStudyStreak($data['user_id'], $data['session_date']);
        }

        return $saved;
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

    public function getStudyStreakByUser($userId)
    {
        $this->db->query("
            SELECT *
            FROM study_streaks
            WHERE user_id = :user_id
        ");
        $this->db->bind(':user_id', $userId);

        $row = $this->db->single();

        if (!$row) {
            $this->db->query("
                INSERT INTO study_streaks (user_id, current_streak, longest_streak, last_study_date)
                VALUES (:user_id, 0, 0, NULL)
            ");
            $this->db->bind(':user_id', $userId);
            $this->db->execute();

            $this->db->query("
                SELECT *
                FROM study_streaks
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $userId);
            $row = $this->db->single();
        }

        return $row;
    }

    private function updateStudyStreak($userId, $sessionDate)
    {
        $streak = $this->getStudyStreakByUser($userId);

        $lastDate = $streak->last_study_date;
        $currentStreak = (int)$streak->current_streak;
        $longestStreak = (int)$streak->longest_streak;

        if ($lastDate === $sessionDate) {
            return;
        }

        if ($lastDate === null) {
            $currentStreak = 1;
        } else {
            $last = new DateTime($lastDate);
            $current = new DateTime($sessionDate);
            $diff = (int)$last->diff($current)->format('%a');

            if ($diff === 1) {
                $currentStreak++;
            } elseif ($diff > 1) {
                $currentStreak = 1;
            }
        }

        if ($currentStreak > $longestStreak) {
            $longestStreak = $currentStreak;
        }

        $this->db->query("
            UPDATE study_streaks
            SET current_streak = :current_streak,
                longest_streak = :longest_streak,
                last_study_date = :last_study_date
            WHERE user_id = :user_id
        ");

        $this->db->bind(':current_streak', $currentStreak);
        $this->db->bind(':longest_streak', $longestStreak);
        $this->db->bind(':last_study_date', $sessionDate);
        $this->db->bind(':user_id', $userId);

        $this->db->execute();
    }
}