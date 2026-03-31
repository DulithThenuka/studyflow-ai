<?php
class AdminModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findAdminByEmail($email)
    {
        $this->db->query('SELECT * FROM admins WHERE email = :email');
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM admins WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row && password_verify($password, $row->password)) {
            return $row;
        }

        return false;
    }
}