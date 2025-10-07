<?php
// Auto setup database script
// Jalankan file ini sekali untuk membuat database dan tabel secara otomatis

$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server (without database)
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Setting up Database...</h2>";
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS digital_business_lomba");
    echo "<p>✓ Database 'digital_business_lomba' created successfully</p>";
    
    // Use the database
    $pdo->exec("USE digital_business_lomba");
    
    // Create peserta table
    $sqlPeserta = "
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
    )";
    
    $pdo->exec($sqlPeserta);
    echo "<p>✓ Table 'peserta' created successfully</p>";
    
    // Create admin table
    $sqlAdmin = "
    CREATE TABLE IF NOT EXISTS admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        nama VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sqlAdmin);
    echo "<p>✓ Table 'admin' created successfully</p>";
    
    // Insert default admin (check if exists first)
    $checkAdmin = $pdo->query("SELECT COUNT(*) FROM admin WHERE username = 'admin'")->fetchColumn();
    
    if ($checkAdmin == 0) {
        $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin (username, password, nama) VALUES (?, ?, ?)");
        $stmt->execute(['admin', $hashedPassword, 'Administrator']);
        echo "<p>✓ Default admin created successfully</p>";
        echo "<p><strong>Login Admin:</strong> Username: admin | Password: password</p>";
    } else {
        echo "<p>✓ Admin already exists</p>";
    }
    
    // Insert sample data
    $checkPeserta = $pdo->query("SELECT COUNT(*) FROM peserta")->fetchColumn();
    
    if ($checkPeserta == 0) {
        $sampleData = [
            ['Ahmad Rizki', 'SMA Negeri 1 Jakarta', 'SMA', 'ahmad.rizki@email.com', '081234567890', 'Marketplace Mini', 'Aplikasi marketplace untuk UMKM lokal dengan fitur pembayaran digital', 'PHP, MySQL, Bootstrap'],
            ['Siti Nurhaliza', 'SMK Informatika Bandung', 'SMK', 'siti.nurhaliza@email.com', '082345678901', 'Aplikasi Keuangan', 'Aplikasi manajemen keuangan pribadi untuk remaja', 'Flutter, Firebase'],
            ['Budi Santoso', 'SMP Negeri 5 Surabaya', 'SMP', 'budi.santoso@email.com', '083456789012', 'Platform Edukasi', 'Platform pembelajaran online untuk siswa SMP', 'HTML, CSS, JavaScript']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO peserta (nama, asal_sekolah, tingkat_pendidikan, email, no_telepon, kategori_lomba, deskripsi_ide, teknologi_digunakan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($sampleData as $data) {
            $stmt->execute($data);
        }
        
        echo "<p>✓ Sample data inserted successfully</p>";
    } else {
        echo "<p>✓ Sample data already exists</p>";
    }
    
    echo "<h3 style='color: green;'>Database setup completed successfully!</h3>";
    echo "<p><a href='index.php'>Go to Website</a> | <a href='admin/login.php'>Go to Admin Panel</a></p>";
    
} catch(PDOException $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>";
    echo "<p>Please check your database configuration in config/database.php</p>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - Digital Business Technology</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        h2, h3 { color: #667eea; }
        p { margin: 10px 0; }
        a { color: #667eea; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Digital Business Technology Competition</h1>
    <p>Database Setup Script</p>
    <hr>
</body>
</html>