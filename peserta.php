<?php
require_once 'config/database.php';

$db = new Database();
$conn = $db->getConnection();

// Get all participants
$stmt = $conn->prepare("SELECT * FROM peserta ORDER BY tanggal_daftar DESC");
$stmt->execute();
$peserta = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count participants by category
$stmtStats = $conn->prepare("SELECT kategori_lomba, COUNT(*) as jumlah FROM peserta GROUP BY kategori_lomba");
$stmtStats->execute();
$stats = $stmtStats->fetchAll(PDO::FETCH_ASSOC);

// Count by education level
$stmtEdu = $conn->prepare("SELECT tingkat_pendidikan, COUNT(*) as jumlah FROM peserta GROUP BY tingkat_pendidikan");
$stmtEdu->execute();
$eduStats = $stmtEdu->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta - Digital Business Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
        }
        .card-participant {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-participant:hover {
            transform: translateY(-5px);
        }
        .badge-category {
            background: linear-gradient(45deg, #667eea, #764ba2);
        }
        .stats-card {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
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
                <a class="nav-link" href="daftar.php">
                    <i class="fas fa-user-plus me-1"></i>Daftar
                </a>
                <a class="nav-link active" href="peserta.php">
                    <i class="fas fa-users me-1"></i>Peserta
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-users me-3"></i>
                        Daftar Peserta
                    </h1>
                    <p class="lead">Digital Business Technology Competition 2025</p>
                    <p class="mb-0">Total Peserta: <strong><?php echo count($peserta); ?></strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-4">
                    <h2 class="fw-bold">Statistik Peserta</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="stats-card p-4">
                        <h5 class="mb-3">
                            <i class="fas fa-chart-pie me-2"></i>
                            Per Kategori Lomba
                        </h5>
                        <?php foreach ($stats as $stat): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo $stat['kategori_lomba']; ?></span>
                                <span class="badge bg-light text-dark"><?php echo $stat['jumlah']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="stats-card p-4">
                        <h5 class="mb-3">
                            <i class="fas fa-graduation-cap me-2"></i>
                            Per Tingkat Pendidikan
                        </h5>
                        <?php foreach ($eduStats as $edu): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><?php echo $edu['tingkat_pendidikan']; ?></span>
                                <span class="badge bg-light text-dark"><?php echo $edu['jumlah']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Participants List -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold">Semua Peserta</h2>
                        <a href="daftar.php" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Daftar Lomba
                        </a>
                    </div>
                </div>
            </div>
            
            <?php if (empty($peserta)): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Belum ada peserta yang mendaftar.
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($peserta as $p): ?>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card card-participant">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-user text-primary me-2"></i>
                                            <?php echo htmlspecialchars($p['nama']); ?>
                                        </h5>
                                        <span class="badge badge-category"><?php echo $p['tingkat_pendidikan']; ?></span>
                                    </div>
                                    
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-school me-2"></i>
                                        <?php echo htmlspecialchars($p['asal_sekolah']); ?>
                                    </p>
                                    
                                    <p class="mb-2">
                                        <i class="fas fa-trophy me-2 text-warning"></i>
                                        <strong><?php echo $p['kategori_lomba']; ?></strong>
                                    </p>
                                    
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-lightbulb me-2"></i>
                                        <?php echo htmlspecialchars(substr($p['deskripsi_ide'], 0, 100)); ?>
                                        <?php if (strlen($p['deskripsi_ide']) > 100): ?>...<?php endif; ?>
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?php echo date('d/m/Y', strtotime($p['tanggal_daftar'])); ?>
                                        </small>
                                        <span class="badge bg-<?php echo $p['status'] == 'Disetujui' ? 'success' : ($p['status'] == 'Ditolak' ? 'danger' : 'warning'); ?>">
                                            <?php echo $p['status']; ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Modal Trigger -->
                                    <button type="button" class="btn btn-outline-primary btn-sm mt-2 w-100" 
                                            data-bs-toggle="modal" data-bs-target="#modal<?php echo $p['id']; ?>">
                                        <i class="fas fa-eye me-1"></i>Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="modal<?php echo $p['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white;">
                                        <h5 class="modal-title">
                                            <i class="fas fa-user me-2"></i>
                                            Detail Peserta
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Nama:</strong> <?php echo htmlspecialchars($p['nama']); ?></p>
                                                <p><strong>Email:</strong> <?php echo htmlspecialchars($p['email']); ?></p>
                                                <p><strong>Telepon:</strong> <?php echo htmlspecialchars($p['no_telepon']); ?></p>
                                                <p><strong>Sekolah:</strong> <?php echo htmlspecialchars($p['asal_sekolah']); ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Tingkat:</strong> <?php echo $p['tingkat_pendidikan']; ?></p>
                                                <p><strong>Kategori:</strong> <?php echo $p['kategori_lomba']; ?></p>
                                                <p><strong>Status:</strong> 
                                                    <span class="badge bg-<?php echo $p['status'] == 'Disetujui' ? 'success' : ($p['status'] == 'Ditolak' ? 'danger' : 'warning'); ?>">
                                                        <?php echo $p['status']; ?>
                                                    </span>
                                                </p>
                                                <p><strong>Tanggal Daftar:</strong> <?php echo date('d/m/Y H:i', strtotime($p['tanggal_daftar'])); ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <h6><strong>Deskripsi Ide:</strong></h6>
                                                <p><?php echo nl2br(htmlspecialchars($p['deskripsi_ide'])); ?></p>
                                                
                                                <h6><strong>Teknologi yang Digunakan:</strong></h6>
                                                <p><?php echo nl2br(htmlspecialchars($p['teknologi_digunakan'])); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>&copy; 2025 Digital Business Technology Competition. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>