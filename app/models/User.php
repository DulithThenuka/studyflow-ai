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
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row && password_verify($password, $row->password)) {
            return $row;
        }

        return false;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row ? true : false;
    }
}