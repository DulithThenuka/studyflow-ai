<?php
class Subjects extends Controller
{
    private $subjectModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->subjectModel = $this->model('Subject');
    }

    public function index()
    {
        $subjects = $this->subjectModel->getSubjectsByUser($_SESSION['user_id']);

        $data = [
            'title' => 'Subjects',
            'subjects' => $subjects
        ];

        $this->view('subjects/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'subject_name' => trim($_POST['subject_name'] ?? ''),
                'subject_code' => trim($_POST['subject_code'] ?? ''),
                'color' => trim($_POST['color'] ?? '#4f8cff'),
                'description' => trim($_POST['description'] ?? ''),
                'subject_name_err' => ''
            ];

            if (empty($data['subject_name'])) {
                $data['subject_name_err'] = 'Please enter subject name';
            }

            if (empty($data['subject_name_err'])) {
                $data['user_id'] = $_SESSION['user_id'];

                if ($this->subjectModel->addSubject($data)) {
                    flash('subject_message', 'Subject added successfully');
                    redirect('subjects');
                } else {
                    die('Something went wrong while adding subject');
                }
            } else {
                $this->view('subjects/add', $data);
            }
        } else {
            $data = [
                'subject_name' => '',
                'subject_code' => '',
                'color' => '#4f8cff',
                'description' => '',
                'subject_name_err' => ''
            ];

            $this->view('subjects/add', $data);
        }
    }

    public function edit($id = null)
    {
        if (!$id || !is_numeric($id)) {
            redirect('subjects');
        }

        $subject = $this->subjectModel->getSubjectById($id);

        if (!$subject || $subject->user_id != $_SESSION['user_id']) {
            redirect('subjects');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'subject_name' => trim($_POST['subject_name'] ?? ''),
                'subject_code' => trim($_POST['subject_code'] ?? ''),
                'color' => trim($_POST['color'] ?? '#4f8cff'),
                'description' => trim($_POST['description'] ?? ''),
                'subject_name_err' => ''
            ];

            if (empty($data['subject_name'])) {
                $data['subject_name_err'] = 'Please enter subject name';
            }

            if (empty($data['subject_name_err'])) {
                if ($this->subjectModel->updateSubject($data)) {
                    flash('subject_message', 'Subject updated successfully');
                    redirect('subjects');
                } else {
                    die('Something went wrong while updating subject');
                }
            } else {
                $this->view('subjects/edit', $data);
            }
        } else {
            $data = [
                'id' => $subject->id,
                'subject_name' => $subject->subject_name,
                'subject_code' => $subject->subject_code,
                'color' => $subject->color,
                'description' => $subject->description,
                'subject_name_err' => ''
            ];

            $this->view('subjects/edit', $data);
        }
    }

    public function delete($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('subjects');
        }

        if (!$id || !is_numeric($id)) {
            redirect('subjects');
        }

        $subject = $this->subjectModel->getSubjectById($id);

        if (!$subject || $subject->user_id != $_SESSION['user_id']) {
            redirect('subjects');
        }

        if ($this->subjectModel->deleteSubject($id)) {
            flash('subject_message', 'Subject deleted successfully', 'alert-success');
            redirect('subjects');
        } else {
            die('Something went wrong while deleting subject');
        }
    }
}