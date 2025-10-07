<?php
require_once 'config/database.php';

$message = '';
$messageType = '';

if ($_POST) {
    $db = new Database();
    $conn = $db->getConnection();
    
    $nama = $_POST['nama'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $tingkat_pendidikan = $_POST['tingkat_pendidikan'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $kategori_lomba = $_POST['kategori_lomba'];
    $deskripsi_ide = $_POST['deskripsi_ide'];
    $teknologi_digunakan = $_POST['teknologi_digunakan'];
    
    try {
        // Check if email already exists
        $checkEmail = $conn->prepare("SELECT id FROM peserta WHERE email = ?");
        $checkEmail->execute([$email]);
        
        if ($checkEmail->rowCount() > 0) {
            $message = 'Email sudah terdaftar! Silakan gunakan email lain.';
            $messageType = 'danger';
        } else {
            // Insert new participant
            $stmt = $conn->prepare("INSERT INTO peserta (nama, asal_sekolah, tingkat_pendidikan, email, no_telepon, kategori_lomba, deskripsi_ide, teknologi_digunakan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            
            if ($stmt->execute([$nama, $asal_sekolah, $tingkat_pendidikan, $email, $no_telepon, $kategori_lomba, $deskripsi_ide, $teknologi_digunakan])) {
                $message = 'Pendaftaran berhasil! Terima kasih telah mendaftar.';
                $messageType = 'success';
            } else {
                $message = 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.';
                $messageType = 'danger';
            }
        }
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
        $messageType = 'danger';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lomba - Digital Business Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 50px 0;
        }
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .form-header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 30px;
            text-align: center;
        }
        .btn-primary-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            width: 100%;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(45deg, #764ba2, #667eea);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-laptop-code me-2"></i>
                Digital Business Tech
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home me-1"></i>Beranda
                </a>
                <a class="nav-link" href="peserta.php">
                    <i class="fas fa-users me-1"></i>Peserta
                </a>
            </div>
        </div>
    </nav>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-card">
                        <div class="form-header">
                            <h2 class="mb-0">
                                <i class="fas fa-user-plus me-2"></i>
                                Pendaftaran Lomba
                            </h2>
                            <p class="mb-0 mt-2">Digital Business Technology Competition</p>
                        </div>
                        <div class="p-4">
                            <?php if ($message): ?>
                                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <?php echo $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">
                                            <i class="fas fa-user me-1"></i>Nama Lengkap
                                        </label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-1"></i>Email
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="asal_sekolah" class="form-label">
                                            <i class="fas fa-school me-1"></i>Asal Sekolah
                                        </label>
                                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tingkat_pendidikan" class="form-label">
                                            <i class="fas fa-graduation-cap me-1"></i>Tingkat Pendidikan
                                        </label>
                                        <select class="form-select" id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                                            <option value="">Pilih Tingkat</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_telepon" class="form-label">
                                            <i class="fas fa-phone me-1"></i>No. Telepon
                                        </label>
                                        <input type="tel" class="form-control" id="no_telepon" name="no_telepon">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="kategori_lomba" class="form-label">
                                            <i class="fas fa-trophy me-1"></i>Kategori Lomba
                                        </label>
                                        <select class="form-select" id="kategori_lomba" name="kategori_lomba" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Aplikasi Bisnis">Aplikasi Bisnis</option>
                                            <option value="Sistem Manajemen Usaha">Sistem Manajemen Usaha</option>
                                            <option value="Marketplace Mini">Marketplace Mini</option>
                                            <option value="Aplikasi Keuangan">Aplikasi Keuangan</option>
                                            <option value="Platform Edukasi">Platform Edukasi</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi_ide" class="form-label">
                                        <i class="fas fa-lightbulb me-1"></i>Deskripsi Ide Aplikasi
                                    </label>
                                    <textarea class="form-control" id="deskripsi_ide" name="deskripsi_ide" rows="4" 
                                              placeholder="Jelaskan ide aplikasi yang akan Anda buat..." required></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="teknologi_digunakan" class="form-label">
                                        <i class="fas fa-code me-1"></i>Teknologi yang Akan Digunakan
                                    </label>
                                    <textarea class="form-control" id="teknologi_digunakan" name="teknologi_digunakan" rows="3" 
                                              placeholder="Contoh: HTML, CSS, JavaScript, PHP, MySQL, React, Flutter, dll." required></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-primary-custom">
                                        <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>