<?php
class Progress extends Controller
{
    private $taskModel;
    private $studySessionModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->taskModel = $this->model('Task');
        $this->studySessionModel = $this->model('StudySession');
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];

        $overallStats = $this->taskModel->getOverallProgressStats($userId);
        $subjectProgress = $this->taskModel->getSubjectProgressByUser($userId);
        $weeklyStudyMinutes = $this->studySessionModel->getWeeklyStudyMinutesByUser($userId);
        $recentSessions = $this->studySessionModel->getRecentSessionsByUser($userId);

        $completionRate = 0;
        if (!empty($overallStats) && (int)$overallStats->total_tasks > 0) {
            $completionRate = round(((int)$overallStats->completed_tasks / (int)$overallStats->total_tasks) * 100);
        }

        $data = [
            'title' => 'Progress',
            'overallStats' => $overallStats,
            'subjectProgress' => $subjectProgress,
            'weeklyStudyMinutes' => $weeklyStudyMinutes,
            'recentSessions' => $recentSessions,
            'completionRate' => $completionRate
        ];

        $this->view('progress/index', $data);
    }
}