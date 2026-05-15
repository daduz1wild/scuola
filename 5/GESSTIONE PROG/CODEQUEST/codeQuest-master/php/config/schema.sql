-- CodeQuest Database Schema

CREATE DATABASE IF NOT EXISTS codequest;
USE codequest;

-- Teachers Table
CREATE TABLE IF NOT EXISTS teachers (
    teacher_id VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Classes Table
CREATE TABLE IF NOT EXISTS classes (
    class_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    class_code VARCHAR(20) NOT NULL UNIQUE,
    teacher_id VARCHAR(20) NOT NULL,
    class_name VARCHAR(100) NOT NULL,
    CONSTRAINT fk_class_teacher FOREIGN KEY (teacher_id) 
        REFERENCES teachers(teacher_id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Students Table
CREATE TABLE IF NOT EXISTS students (
    student_id VARCHAR(50) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    class_id INT(11),
    CONSTRAINT fk_student_class FOREIGN KEY (class_id) 
        REFERENCES classes(class_id) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Chapters Table
CREATE TABLE IF NOT EXISTS chapters (
    chapter_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Student Progress Table
CREATE TABLE IF NOT EXISTS student_chapter_progress (
    student_id VARCHAR(50) NOT NULL,
    chapter_id INT(11) NOT NULL,
    mission_1_completed TINYINT(1) DEFAULT 0,
    mission_2_completed TINYINT(1) DEFAULT 0,
    mission_3_completed TINYINT(1) DEFAULT 0,
    mission_4_completed TINYINT(1) DEFAULT 0,
    boss_completed TINYINT(1) DEFAULT 0,
    PRIMARY KEY (student_id, chapter_id),
    CONSTRAINT fk_progress_student FOREIGN KEY (student_id) 
        REFERENCES students(student_id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_progress_chapter FOREIGN KEY (chapter_id) 
        REFERENCES chapters(chapter_id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Initial Data
INSERT IGNORE INTO chapters (chapter_id, titolo) VALUES 
(1, 'HTML & CSS Foundations'),
(2, 'JavaScript Logic'),
(3, 'Backend with PHP & MySQL'),
(4, 'Terminal & Shell Scripting'),
(5, 'The Core: C++ & Systems');
