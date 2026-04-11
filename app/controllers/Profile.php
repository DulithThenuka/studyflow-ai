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
            'title' => 'Profile',
            'user' => $user,
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'image_err' => ''
        ];

        $this->view('profile/index', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('profile');
        }

        $currentUser = $this->userModel->getUserById($_SESSION['user_id']);

        $data = [
            'id' => $_SESSION['user_id'],
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'university' => trim($_POST['university'] ?? ''),
            'course' => trim($_POST['course'] ?? ''),
            'profile_image' => $currentUser->profile_image ?? 'avatar-default.png',
            'new_password' => trim($_POST['new_password'] ?? ''),
            'confirm_password' => trim($_POST['confirm_password'] ?? ''),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'image_err' => ''
        ];

        if (empty($data['name'])) {
            $data['name_err'] = 'Please enter your name';
        }

        if (empty($data['email'])) {
            $data['email_err'] = 'Please enter your email';
        }

        if (!empty($_FILES['profile_image']['name'])) {
            $file = $_FILES['profile_image'];

            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $maxSize = 2 * 1024 * 1024;

            if (!in_array($file['type'], $allowedTypes)) {
                $data['image_err'] = 'Only JPG, PNG, and WEBP images are allowed';
            } elseif ($file['size'] > $maxSize) {
                $data['image_err'] = 'Image size must be less than 2MB';
            } elseif ($file['error'] !== 0) {
                $data['image_err'] = 'Error uploading image';
            } else {
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = 'profile_' . $_SESSION['user_id'] . '_' . time() . '.' . strtolower($extension);
                $targetDir = dirname(APPROOT) . '/public/uploads/profiles/';
                $targetPath = $targetDir . $newFileName;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                    $data['profile_image'] = $newFileName;
                } else {
                    $data['image_err'] = 'Failed to save uploaded image';
                }
            }
        }

        if (!empty($data['new_password']) || !empty($data['confirm_password'])) {
            if (strlen($data['new_password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            if ($data['new_password'] !== $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            }
        }

        if (
            empty($data['name_err']) &&
            empty($data['email_err']) &&
            empty($data['password_err']) &&
            empty($data['confirm_password_err']) &&
            empty($data['image_err'])
        ) {
            if ($this->userModel->updateProfile($data)) {
                $_SESSION['user_name'] = $data['name'];
                $_SESSION['user_email'] = $data['email'];

                if (!empty($data['new_password'])) {
                    $hashedPassword = password_hash($data['new_password'], PASSWORD_DEFAULT);
                    $this->userModel->updatePassword($data['id'], $hashedPassword);
                }

                flash('profile_msg', 'Profile updated successfully.');
                redirect('profile');
            } else {
                die('Something went wrong while updating profile');
            }
        } else {
            $data['user'] = $this->userModel->getUserById($_SESSION['user_id']);
            $this->view('profile/index', $data);
        }
    }
}