<?php
class Focus extends Controller
{
    private $studySessionModel;
    private $taskModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->studySessionModel = $this->model('StudySession');
        $this->taskModel = $this->model('Task');
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];

        $tasks = $this->taskModel->getRecommendedTasksByUser($userId);
        $todayFocusMinutes = $this->studySessionModel->getTodayStudyMinutesByUser($userId);
        $recentSessions = $this->studySessionModel->getRecentSessionsByUser($userId);

        $data = [
            'title' => 'Focus Mode',
            'tasks' => $tasks,
            'todayFocusMinutes' => $todayFocusMinutes,
            'recentSessions' => $recentSessions
        ];

        $this->view('focus/index', $data);
    }

    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('focus');
        }

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = [
            'user_id' => $_SESSION['user_id'],
            'task_id' => !empty($_POST['task_id']) ? $_POST['task_id'] : null,
            'session_date' => date('Y-m-d'),
            'duration_minutes' => (int)($_POST['duration_minutes'] ?? 25),
            'session_type' => trim($_POST['session_type'] ?? 'Focus'),
            'notes' => trim($_POST['notes'] ?? '')
        ];

        if ($data['duration_minutes'] > 0) {
            $this->studySessionModel->addSession($data);
            flash('focus_message', 'Focus session saved successfully.');
        }

        redirect('focus');
    }
}