<?php
class Planner extends Controller
{
    private $taskModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->taskModel = $this->model('Task');
    }

    public function index()
    {
        $userId = $_SESSION['user_id'];
        $availableHours = isset($_GET['hours']) ? (float)$_GET['hours'] : 0;

        if ($availableHours > 0) {
            $recommendedTasks = $this->taskModel->getRecommendedTasksByAvailableTime($userId, $availableHours);
        } else {
            $recommendedTasks = $this->taskModel->getRecommendedTasksByUser($userId);
        }

        $plannerSummary = $this->taskModel->getPlannerSummary($userId);
        $burnoutWarning = $this->taskModel->getBurnoutWarning($userId);
        $bestTaskForToday = $this->taskModel->getBestTaskForToday($userId);

        $data = [
            'title' => 'Smart Planner',
            'recommendedTasks' => $recommendedTasks,
            'plannerSummary' => $plannerSummary,
            'burnoutWarning' => $burnoutWarning,
            'availableHours' => $availableHours,
            'bestTaskForToday' => $bestTaskForToday
        ];

        $this->view('planner/index', $data);
    }
}