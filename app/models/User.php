<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email LIMIT 1');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row && password_verify($password, $row->password)) {
            return $row;
        }

        return false;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT id FROM users WHERE email = :email LIMIT 1');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        return $row ? true : false;
    }

    public function findUserByEmailExcludingId($email, $id)
    {
        $this->db->query('SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1');
        $this->db->bind(':email', $email);
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row ? true : false;
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id LIMIT 1');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function updateProfile($data)
    {
        $this->db->query("
            UPDATE users
            SET name = :name,
                email = :email,
                university = :university,
                course = :course,
                profile_image = :profile_image
            WHERE id = :id
        ");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':university', $data['university']);
        $this->db->bind(':course', $data['course']);
        $this->db->bind(':profile_image', $data['profile_image']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function updatePassword($id, $hashedPassword)
    {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function updateUser($data)
    {
        $this->db->query("
            UPDATE users
            SET name = :name,
                email = :email
            WHERE id = :id
        ");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getTotalUsers()
    {
        $this->db->query('SELECT COUNT(*) AS total FROM users');
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function searchUsers($search = '')
    {
        if (!empty($search)) {
            $this->db->query("
                SELECT *
                FROM users
                WHERE name LIKE :search
                   OR email LIKE :search
                   OR university LIKE :search
                   OR course LIKE :search
                ORDER BY created_at DESC
            ");
            $this->db->bind(':search', '%' . $search . '%');
        } else {
            $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        }

        return $this->db->resultSet();
    }

    public function deleteUserById($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}