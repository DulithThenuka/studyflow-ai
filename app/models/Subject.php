<?php
class Subject
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTotalSubjectsByUser($userId)
    {
        $this->db->query('SELECT COUNT(*) AS total FROM subjects WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        return $row ? (int)$row->total : 0;
    }

    public function getSubjectsByUser($userId)
    {
        $this->db->query('SELECT * FROM subjects WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    public function addSubject($data)
    {
        $this->db->query('
            INSERT INTO subjects (user_id, subject_name, subject_code, color, description)
            VALUES (:user_id, :subject_name, :subject_code, :color, :description)
        ');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':subject_name', $data['subject_name']);
        $this->db->bind(':subject_code', $data['subject_code']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':description', $data['description']);

        return $this->db->execute();
    }

    public function getSubjectById($id)
    {
        $this->db->query('SELECT * FROM subjects WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function updateSubject($data)
    {
        $this->db->query('
            UPDATE subjects
            SET subject_name = :subject_name,
                subject_code = :subject_code,
                color = :color,
                description = :description
            WHERE id = :id
        ');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':subject_name', $data['subject_name']);
        $this->db->bind(':subject_code', $data['subject_code']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':description', $data['description']);

        return $this->db->execute();
    }

    public function deleteSubject($id)
    {
        $this->db->query('DELETE FROM subjects WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}