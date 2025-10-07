-- Database: digital_business_lomba
CREATE DATABASE IF NOT EXISTS digital_business_lomba;
USE digital_business_lomba;

-- Tabel untuk peserta lomba
CREATE TABLE IF NOT EXISTS peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    asal_sekolah VARCHAR(255) NOT NULL,
    tingkat_pendidikan ENUM('SMP', 'SMA', 'SMK') NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    no_telepon VARCHAR(20),
    kategori_lomba ENUM('Aplikasi Bisnis', 'Sistem Manajemen Usaha', 'Marketplace Mini', 'Aplikasi Keuangan', 'Platform Edukasi') NOT NULL,
    deskripsi_ide TEXT,
    teknologi_digunakan TEXT,
    tanggal_daftar DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Menunggu', 'Disetujui', 'Ditolak') DEFAULT 'Menunggu'
);

-- Tabel untuk admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert admin default
INSERT INTO admin (username, password, nama) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator');
-- Password default: password

-- Insert data contoh peserta
INSERT INTO peserta (nama, asal_sekolah, tingkat_pendidikan, email, no_telepon, kategori_lomba, deskripsi_ide, teknologi_digunakan) VALUES
('Ahmad Rizki', 'SMA Negeri 1 Jakarta', 'SMA', 'ahmad.rizki@email.com', '081234567890', 'Marketplace Mini', 'Aplikasi marketplace untuk UMKM lokal dengan fitur pembayaran digital', 'PHP, MySQL, Bootstrap'),
('Siti Nurhaliza', 'SMK Informatika Bandung', 'SMK', 'siti.nurhaliza@email.com', '082345678901', 'Aplikasi Keuangan', 'Aplikasi manajemen keuangan pribadi untuk remaja', 'Flutter, Firebase'),
('Budi Santoso', 'SMP Negeri 5 Surabaya', 'SMP', 'budi.santoso@email.com', '083456789012', 'Platform Edukasi', 'Platform pembelajaran online untuk siswa SMP', 'HTML, CSS, JavaScript');