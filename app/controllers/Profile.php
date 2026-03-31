<?php
class Profile extends Controller
{
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        $data = [
            'user' => $user
        ];

        $this->view('profile/index', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email'])
            ];

            $this->userModel->updateUser($data);

            flash('profile_msg', 'Profile updated!');
            redirect('profile');
        }
    }
}