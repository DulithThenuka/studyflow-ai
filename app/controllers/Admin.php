<?php
class Admin extends Controller
{
    private $userModel;
    private $taskModel;
    private $subjectModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->taskModel = $this->model('Task');
        $this->subjectModel = $this->model('Subject');
    }

    public function index()
    {
        redirect('admin/dashboard');
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $this->userModel->getTotalUsers(),
            'total_tasks' => $this->taskModel->getTotalTasksGlobal(),
            'completed_tasks' => $this->taskModel->getCompletedTasksGlobal(),
            'total_subjects' => $this->subjectModel->getTotalSubjectsGlobal(),
            'users' => $this->userModel->getAllUsers(),
            'tasks' => $this->taskModel->getAllTasks()
        ];

        $this->view('admin/dashboard', $data);
    }

    public function users()
    {
        $data = [
            'title' => 'Manage Users',
            'users' => $this->userModel->getAllUsers()
        ];

        $this->view('admin/users', $data);
    }

    public function tasks()
    {
        $data = [
            'title' => 'Manage Tasks',
            'tasks' => $this->taskModel->getAllTasks()
        ];

        $this->view('admin/tasks', $data);
    }
}