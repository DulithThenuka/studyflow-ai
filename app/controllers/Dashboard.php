<?php
class Dashboard extends Controller
{
    private $subjectModel;
    private $taskModel;
    private $studySessionModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->subjectModel = $this->model('Subject');
        $this->taskModel = $this->model('Task');
        $this->studySessionModel = $this->model('StudySession');
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];

        $totalSubjects = $this->subjectModel->getTotalSubjectsByUser($userId);
        $totalTasks = $this->taskModel->getTotalTasksByUser($userId);
        $completedTasks = $this->taskModel->getCompletedTasksByUser($userId);
        $pendingTasks = $this->taskModel->getPendingTasksByUser($userId);
        $upcomingTasks = $this->taskModel->getUpcomingTasksByUser($userId);
        $recentTasks = $this->taskModel->getRecentTasksByUser($userId);
        $studyMinutesToday = $this->studySessionModel->getTodayStudyMinutesByUser($userId);
        $motivationMessage = $this->taskModel->getRandomMotivationMessage();

        $completionRate = 0;
        if ($totalTasks > 0) {
            $completionRate = round(($completedTasks / $totalTasks) * 100);
        }

        $data = [
            'title' => 'Dashboard',
            'totalSubjects' => $totalSubjects,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'pendingTasks' => $pendingTasks,
            'upcomingTasks' => $upcomingTasks,
            'recentTasks' => $recentTasks,
            'studyMinutesToday' => $studyMinutesToday,
            'motivationMessage' => $motivationMessage,
            'completionRate' => $completionRate
        ];

        $this->view('dashboard/index', $data);
    }
}