CREATE DATABASE IF NOT EXISTS studyflow_ai;
USE studyflow_ai;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- =========================
-- 1) USERS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) DEFAULT 'avatar-default.png',
    university VARCHAR(150) DEFAULT NULL,
    course VARCHAR(150) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- 2) ADMINS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- 3) SUBJECTS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject_name VARCHAR(120) NOT NULL,
    subject_code VARCHAR(50) DEFAULT NULL,
    color VARCHAR(20) DEFAULT '#4f8cff',
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_subject_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- 4) TASKS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT DEFAULT NULL,
    task_type ENUM('Assignment', 'Exam', 'Quiz', 'Revision', 'Presentation', 'Lab', 'Other') DEFAULT 'Other',
    priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    difficulty ENUM('Easy', 'Medium', 'Hard') DEFAULT 'Medium',
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    deadline DATE DEFAULT NULL,
    estimated_hours DECIMAL(5,2) DEFAULT 1.00,
    score INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_task_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_task_subject FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
);

-- =========================
-- 5) STUDY SESSIONS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS study_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task_id INT DEFAULT NULL,
    session_date DATE NOT NULL,
    duration_minutes INT NOT NULL DEFAULT 25,
    session_type ENUM('Focus', 'Short Break', 'Long Break') DEFAULT 'Focus',
    notes VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_session_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_session_task FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE SET NULL
);

-- =========================
-- 6) STUDY STREAKS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS study_streaks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    current_streak INT NOT NULL DEFAULT 0,
    longest_streak INT NOT NULL DEFAULT 0,
    last_study_date DATE DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_streak_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- 7) MOTIVATION MESSAGES TABLE
-- =========================
CREATE TABLE IF NOT EXISTS motivation_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message VARCHAR(255) NOT NULL
);

-- =========================
-- 8) PLANNER LOGS TABLE
-- =========================
CREATE TABLE IF NOT EXISTS planner_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    generated_score INT NOT NULL DEFAULT 0,
    recommendation_note VARCHAR(255) DEFAULT NULL,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_planner_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_planner_task FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
);

-- =========================
-- DEFAULT MOTIVATION DATA
-- =========================
INSERT INTO motivation_messages (message) VALUES
('Keep going. Small progress is still progress.'),
('Plan smarter. Study better.'),
('One task at a time. You are getting closer.'),
('Consistency beats last-minute panic.'),
('Focus on progress, not perfection.'),
('Your future self will thank you.'),
('Start now, improve later.'),
('You are capable of more than you think.');

-- =========================
-- DEFAULT ADMIN
-- Username: admin
-- Password: admin123
-- NOTE: this password is already hashed
-- =========================
INSERT INTO admins (username, email, password) VALUES
('admin', 'admin@studyflowai.com', '$2y$10$wHjvJ0m8lJQx1yWmJ0m8lOoD6R0w8u8HqV7n9JxVx1wR7mA1mYw7K');

COMMIT;