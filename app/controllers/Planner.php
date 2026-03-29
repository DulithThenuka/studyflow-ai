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

        $recommendedTasks = $this->taskModel->getRecommendedTasksByUser($userId);
        $plannerSummary = $this->taskModel->getPlannerSummary($userId);
        $burnoutWarning = $this->taskModel->getBurnoutWarning($userId);

        $data = [
            'title' => 'Smart Planner',
            'recommendedTasks' => $recommendedTasks,
            'plannerSummary' => $plannerSummary,
            'burnoutWarning' => $burnoutWarning
        ];

        $this->view('planner/index', $data);
    }
}