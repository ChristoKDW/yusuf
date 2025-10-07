<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../config/database.php';

$db = new Database();
$conn = $db->getConnection();

// Handle status update
if (isset($_POST['update_status'])) {
    $peserta_id = $_POST['peserta_id'];
    $new_status = $_POST['new_status'];
    
    $stmt = $conn->prepare("UPDATE peserta SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $peserta_id]);
    
    header('Location: dashboard.php?updated=1');
    exit();
}

// Handle delete participant
if (isset($_POST['delete_participant'])) {
    $peserta_id = $_POST['peserta_id'];
    
    $stmt = $conn->prepare("DELETE FROM peserta WHERE id = ?");
    $stmt->execute([$peserta_id]);
    
    header('Location: dashboard.php?deleted=1');
    exit();
}

// Get statistics
$totalPeserta = $conn->query("SELECT COUNT(*) FROM peserta")->fetchColumn();
$menunggu = $conn->query("SELECT COUNT(*) FROM peserta WHERE status = 'Menunggu'")->fetchColumn();
$disetujui = $conn->query("SELECT COUNT(*) FROM peserta WHERE status = 'Disetujui'")->fetchColumn();
$ditolak = $conn->query("SELECT COUNT(*) FROM peserta WHERE status = 'Ditolak'")->fetchColumn();

// Get all participants
$stmt = $conn->prepare("SELECT * FROM peserta ORDER BY tanggal_daftar DESC");
$stmt->execute();
$peserta = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Digital Business Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        .stats-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .btn-action {
            padding: 5px 10px;
            font-size: 12px;
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-laptop-code me-2"></i>
                        Admin Panel
                    </h5>
                    <small>Digital Business Tech</small>
                </div>
                <hr class="text-white">
                <div class="px-3">
                    <div class="nav flex-column">
                        <a class="nav-link text-white active" href="dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white" href="../index.php" target="_blank">
                            <i class="fas fa-globe me-2"></i>Lihat Website
                        </a>
                        <a class="nav-link text-white" href="logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
                <div class="mt-auto p-3">
                    <small>
                        <i class="fas fa-user me-1"></i>
                        <?php echo $_SESSION['admin_nama']; ?>
                    </small>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto">
                <div class="p-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold">Dashboard Admin</h2>
                        <div class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <?php echo date('d F Y'); ?>
                        </div>
                    </div>

                    <!-- Alerts -->
                    <?php if (isset($_GET['updated'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            Status peserta berhasil diperbarui!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['deleted'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-trash me-2"></i>
                            Peserta berhasil dihapus!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card stats-card text-center p-3" style="background: linear-gradient(45deg, #4facfe, #00f2fe);">
                                <div class="text-white">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <h3 class="mb-0"><?php echo $totalPeserta; ?></h3>
                                    <small>Total Peserta</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card stats-card text-center p-3" style="background: linear-gradient(45deg, #ffecd2, #fcb69f);">
                                <div class="text-dark">
                                    <i class="fas fa-clock fa-2x mb-2"></i>
                                    <h3 class="mb-0"><?php echo $menunggu; ?></h3>
                                    <small>Menunggu</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card stats-card text-center p-3" style="background: linear-gradient(45deg, #a8edea, #fed6e3);">
                                <div class="text-dark">
                                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                                    <h3 class="mb-0"><?php echo $disetujui; ?></h3>
                                    <small>Disetujui</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card stats-card text-center p-3" style="background: linear-gradient(45deg, #ff9a9e, #fecfef);">
                                <div class="text-dark">
                                    <i class="fas fa-times-circle fa-2x mb-2"></i>
                                    <h3 class="mb-0"><?php echo $ditolak; ?></h3>
                                    <small>Ditolak</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participants Table -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-list me-2"></i>
                                Daftar Peserta
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Sekolah</th>
                                            <th>Tingkat</th>
                                            <th>Kategori</th>
                                            <th>Email</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($peserta)): ?>
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i><br>
                                                    Belum ada peserta yang mendaftar.
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($peserta as $index => $p): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td>
                                                        <strong><?php echo htmlspecialchars($p['nama']); ?></strong>
                                                        <br><small class="text-muted"><?php echo htmlspecialchars($p['no_telepon']); ?></small>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($p['asal_sekolah']); ?></td>
                                                    <td>
                                                        <span class="badge bg-secondary"><?php echo $p['tingkat_pendidikan']; ?></span>
                                                    </td>
                                                    <td><?php echo $p['kategori_lomba']; ?></td>
                                                    <td><?php echo htmlspecialchars($p['email']); ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($p['tanggal_daftar'])); ?></td>
                                                    <td>
                                                        <span class="badge bg-<?php echo $p['status'] == 'Disetujui' ? 'success' : ($p['status'] == 'Ditolak' ? 'danger' : 'warning'); ?>">
                                                            <?php echo $p['status']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <!-- View Detail Button -->
                                                        <button type="button" class="btn btn-info btn-action" 
                                                                data-bs-toggle="modal" data-bs-target="#detailModal<?php echo $p['id']; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        
                                                        <!-- Status Update Dropdown -->
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-warning btn-action dropdown-toggle" 
                                                                    data-bs-toggle="dropdown">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <?php 
                                                                $statuses = ['Menunggu', 'Disetujui', 'Ditolak'];
                                                                foreach ($statuses as $status): 
                                                                    if ($status != $p['status']):
                                                                ?>
                                                                    <li>
                                                                        <form method="POST" class="d-inline">
                                                                            <input type="hidden" name="peserta_id" value="<?php echo $p['id']; ?>">
                                                                            <input type="hidden" name="new_status" value="<?php echo $status; ?>">
                                                                            <button type="submit" name="update_status" class="dropdown-item">
                                                                                <i class="fas fa-check me-2"></i><?php echo $status; ?>
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                <?php 
                                                                    endif;
                                                                endforeach; 
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        
                                                        <!-- Delete Button -->
                                                        <button type="button" class="btn btn-danger btn-action" 
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $p['id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Detail Modal -->
                                                <div class="modal fade" id="detailModal<?php echo $p['id']; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background: linear-gradient(45deg, #667eea, #764ba2); color: white;">
                                                                <h5 class="modal-title">Detail Peserta</h5>
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

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal<?php echo $p['id']; ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus peserta <strong><?php echo htmlspecialchars($p['nama']); ?></strong>?</p>
                                                                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <form method="POST" class="d-inline">
                                                                    <input type="hidden" name="peserta_id" value="<?php echo $p['id']; ?>">
                                                                    <button type="submit" name="delete_participant" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>