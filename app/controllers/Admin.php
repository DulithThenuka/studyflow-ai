<?php
class Admin extends Controller
{
    private $adminModel;
    private $userModel;
    private $taskModel;
    private $subjectModel;

    public function __construct()
    {
        $this->adminModel = $this->model('AdminModel');
        $this->userModel = $this->model('User');
        $this->taskModel = $this->model('Task');
        $this->subjectModel = $this->model('Subject');
    }

    public function index()
    {
        if (isAdminLoggedIn()) {
            redirect('admin/dashboard');
        }

        redirect('admin/login');
    }

    public function login()
    {
        if (isAdminLoggedIn()) {
            redirect('admin/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'email' => trim($_POST['email'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'email_err' => '',
                'password_err' => ''
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter admin email';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            $adminExists = $this->adminModel->findAdminByEmail($data['email']);
            if (!$adminExists && empty($data['email_err'])) {
                $data['email_err'] = 'No admin found with that email';
            }

            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInAdmin = $this->adminModel->login($data['email'], $data['password']);

                if ($loggedInAdmin) {
                    $_SESSION['admin_id'] = $loggedInAdmin->id;
                    $_SESSION['admin_email'] = $loggedInAdmin->email;
                    $_SESSION['admin_username'] = $loggedInAdmin->username;
                    redirect('admin/dashboard');
                } else {
                    $data['password_err'] = 'Password is incorrect';
                    $this->view('admin/login', $data);
                }
            } else {
                $this->view('admin/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            $this->view('admin/login', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_username']);
        session_regenerate_id(true);
        redirect('admin/login');
    }

    private function requireAdmin()
    {
        if (!isAdminLoggedIn()) {
            flash('admin_auth_error', 'Please login as admin first.', 'alert-warning');
            redirect('admin/login');
        }
    }

    public function dashboard()
    {
        $this->requireAdmin();

        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $this->userModel->getTotalUsers(),
            'total_tasks' => $this->taskModel->getTotalTasksGlobal(),
            'completed_tasks' => $this->taskModel->getCompletedTasksGlobal(),
            'pending_tasks' => $this->taskModel->getPendingTasksGlobal(),
            'total_subjects' => $this->subjectModel->getTotalSubjectsGlobal(),
            'users' => $this->userModel->getAllUsers(),
            'tasks' => $this->taskModel->getAllTasks(),
            'platform_activity' => $this->taskModel->getPlatformActivityStats()
        ];

        $this->view('admin/dashboard', $data);
    }

    public function users()
    {
        $this->requireAdmin();

        $search = trim($_GET['search'] ?? '');
        $users = $this->userModel->searchUsers($search);

        $data = [
            'title' => 'Manage Users',
            'users' => $users,
            'search' => $search
        ];

        $this->view('admin/users', $data);
    }

    public function tasks()
    {
        $this->requireAdmin();

        $search = trim($_GET['search'] ?? '');
        $status = trim($_GET['status'] ?? '');

        $tasks = $this->taskModel->filterAdminTasks($search, $status);

        $data = [
            'title' => 'Manage Tasks',
            'tasks' => $tasks,
            'search' => $search,
            'status' => $status
        ];

        $this->view('admin/tasks', $data);
    }

    public function deleteUser($id = null)
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !$id || !is_numeric($id)) {
            redirect('admin/users');
        }

        if ($this->userModel->deleteUserById($id)) {
            flash('admin_message', 'User deleted successfully.');
        } else {
            flash('admin_message', 'Failed to delete user.', 'alert-warning');
        }

        redirect('admin/users');
    }

    public function deleteTask($id = null)
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !$id || !is_numeric($id)) {
            redirect('admin/tasks');
        }

        if ($this->taskModel->deleteTask($id)) {
            flash('admin_message', 'Task deleted successfully.');
        } else {
            flash('admin_message', 'Failed to delete task.', 'alert-warning');
        }

        redirect('admin/tasks');
    }
}