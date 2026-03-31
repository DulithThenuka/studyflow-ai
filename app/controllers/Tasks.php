<?php
class Tasks extends Controller
{
    private $taskModel;
    private $subjectModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->taskModel = $this->model('Task');
        $this->subjectModel = $this->model('Subject');
    }

    public function index()
    {
        $tasks = $this->taskModel->getTasksByUser($_SESSION['user_id']);

        $data = [
            'title' => 'Tasks',
            'tasks' => $tasks
        ];

        $this->view('tasks/index', $data);
    }

    public function add()
    {
        $subjects = $this->subjectModel->getSubjectsByUser($_SESSION['user_id']);

        if (empty($subjects)) {
            flash('task_message', 'Please add a subject first before creating tasks.', 'alert-warning');
            redirect('subjects/add');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'subject_id' => trim($_POST['subject_id'] ?? ''),
                'title' => trim($_POST['title'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'task_type' => trim($_POST['task_type'] ?? 'Other'),
                'priority' => trim($_POST['priority'] ?? 'Medium'),
                'difficulty' => trim($_POST['difficulty'] ?? 'Medium'),
                'status' => trim($_POST['status'] ?? 'Pending'),
                'deadline' => trim($_POST['deadline'] ?? ''),
                'estimated_hours' => trim($_POST['estimated_hours'] ?? '1'),
                'subjects' => $subjects,
                'subject_id_err' => '',
                'title_err' => '',
                'estimated_hours_err' => ''
            ];

            if (empty($data['subject_id'])) {
                $data['subject_id_err'] = 'Please select a subject';
            }

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter task title';
            }

            if ($data['estimated_hours'] === '' || !is_numeric($data['estimated_hours']) || $data['estimated_hours'] <= 0) {
                $data['estimated_hours_err'] = 'Please enter valid estimated hours';
            }

            if (
                empty($data['subject_id_err']) &&
                empty($data['title_err']) &&
                empty($data['estimated_hours_err'])
            ) {
                $data['user_id'] = $_SESSION['user_id'];
                $data['score'] = $this->taskModel->calculateTaskScore($data);

                if ($this->taskModel->addTask($data)) {
                    flash('task_message', 'Task added successfully');
                    redirect('tasks');
                } else {
                    die('Something went wrong while adding task');
                }
            } else {
                $this->view('tasks/add', $data);
            }
        } else {
            $data = [
                'subject_id' => '',
                'title' => '',
                'description' => '',
                'task_type' => 'Other',
                'priority' => 'Medium',
                'difficulty' => 'Medium',
                'status' => 'Pending',
                'deadline' => '',
                'estimated_hours' => '1',
                'subjects' => $subjects,
                'subject_id_err' => '',
                'title_err' => '',
                'estimated_hours_err' => ''
            ];

            $this->view('tasks/add', $data);
        }
    }

    public function edit($id = null)
    {
        if (!$id || !is_numeric($id)) {
            redirect('tasks');
        }

        $task = $this->taskModel->getTaskById($id);
        $subjects = $this->subjectModel->getSubjectsByUser($_SESSION['user_id']);

        if (!$task || $task->user_id != $_SESSION['user_id']) {
            redirect('tasks');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'subject_id' => trim($_POST['subject_id'] ?? ''),
                'title' => trim($_POST['title'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'task_type' => trim($_POST['task_type'] ?? 'Other'),
                'priority' => trim($_POST['priority'] ?? 'Medium'),
                'difficulty' => trim($_POST['difficulty'] ?? 'Medium'),
                'status' => trim($_POST['status'] ?? 'Pending'),
                'deadline' => trim($_POST['deadline'] ?? ''),
                'estimated_hours' => trim($_POST['estimated_hours'] ?? '1'),
                'subjects' => $subjects,
                'subject_id_err' => '',
                'title_err' => '',
                'estimated_hours_err' => ''
            ];

            if (empty($data['subject_id'])) {
                $data['subject_id_err'] = 'Please select a subject';
            }

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter task title';
            }

            if ($data['estimated_hours'] === '' || !is_numeric($data['estimated_hours']) || $data['estimated_hours'] <= 0) {
                $data['estimated_hours_err'] = 'Please enter valid estimated hours';
            }

            if (
                empty($data['subject_id_err']) &&
                empty($data['title_err']) &&
                empty($data['estimated_hours_err'])
            ) {
                $data['score'] = $this->taskModel->calculateTaskScore($data);

                if ($this->taskModel->updateTask($data)) {
                    flash('task_message', 'Task updated successfully');
                    redirect('tasks');
                } else {
                    die('Something went wrong while updating task');
                }
            } else {
                $this->view('tasks/edit', $data);
            }
        } else {
            $data = [
                'id' => $task->id,
                'subject_id' => $task->subject_id,
                'title' => $task->title,
                'description' => $task->description,
                'task_type' => $task->task_type,
                'priority' => $task->priority,
                'difficulty' => $task->difficulty,
                'status' => $task->status,
                'deadline' => $task->deadline,
                'estimated_hours' => $task->estimated_hours,
                'subjects' => $subjects,
                'subject_id_err' => '',
                'title_err' => '',
                'estimated_hours_err' => ''
            ];

            $this->view('tasks/edit', $data);
        }
    }

    public function delete($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('tasks');
        }

        if (!$id || !is_numeric($id)) {
            redirect('tasks');
        }

        $task = $this->taskModel->getTaskById($id);

        if (!$task || $task->user_id != $_SESSION['user_id']) {
            redirect('tasks');
        }

        if ($this->taskModel->deleteTask($id)) {
            flash('task_message', 'Task deleted successfully');
            redirect('tasks');
        } else {
            die('Something went wrong while deleting task');
        }
    }

    public function complete($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('tasks');
        }

        if (!$id || !is_numeric($id)) {
            redirect('tasks');
        }

        $task = $this->taskModel->getTaskById($id);

        if (!$task || $task->user_id != $_SESSION['user_id']) {
            redirect('tasks');
        }

        if ($this->taskModel->markTaskCompleted($id)) {
            flash('task_message', 'Task marked as completed');
            redirect('tasks');
        } else {
            die('Something went wrong while updating task status');
        }
    }
    public function getAllTasks()
{
    $this->db->query("
        SELECT t.*, u.name as user_name
        FROM tasks t
        INNER JOIN users u ON t.user_id = u.id
        ORDER BY t.created_at DESC
    ");
    return $this->db->resultSet();
}

public function getTotalTasksGlobal()
{
    $this->db->query('SELECT COUNT(*) as total FROM tasks');
    return $this->db->single()->total;
}

public function getCompletedTasksGlobal()
{
    $this->db->query("SELECT COUNT(*) as total FROM tasks WHERE status='Completed'");
    return $this->db->single()->total;
}
}