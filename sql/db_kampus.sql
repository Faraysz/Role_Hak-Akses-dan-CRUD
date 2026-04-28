-- ============================================
-- Database: db_kampus
-- Workshop Sistem Informasi - Minggu 11
-- RBAC + CRUD Jurusan (PHP OOP)
-- ============================================

CREATE DATABASE IF NOT EXISTS db_kampus;
USE db_kampus;

-- Tabel roles
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL DEFAULT 2,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- Tabel jurusan
CREATE TABLE IF NOT EXISTS jurusan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_jurusan VARCHAR(10) NOT NULL UNIQUE,
    nama_jurusan VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default roles
INSERT INTO roles (role_name) VALUES ('admin'), ('user');

-- Insert default admin user (password: admin123)
-- Hash dihasilkan oleh password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO users (nama, email, password, role_id) VALUES
('Administrator', 'admin@kampus.ac.id', '$2y$10$3g281heLH05LVNnOGzQfbujjfTvVC6ULI/EBkEpvzY57INVxNmugS', 1);

-- Insert sample jurusan data
INSERT INTO jurusan (kode_jurusan, nama_jurusan) VALUES
('TI', 'Teknologi Informasi'),
('TE', 'Teknik Elektro'),
('TM', 'Teknik Mesin'),
('TP', 'Teknik Pertanian'),
('AB', 'Agribisnis');
