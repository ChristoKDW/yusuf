<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Business Technology Competition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        .card-lomba {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .card-lomba:hover {
            transform: translateY(-5px);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
        .btn-primary-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(45deg, #764ba2, #667eea);
        }
        .feature-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-laptop-code me-2"></i>
                Digital Business Tech
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kategori">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Digital Business Technology</h1>
                    <h3 class="mb-3">Lomba Web & Apps</h3>
                    <p class="lead mb-4">
                        Jenjang: SMP - SMA/K Sederajat<br>
                        Format: Individu
                    </p>
                    <div class="bg-white bg-opacity-10 p-4 rounded mb-4">
                        <h5 class="mb-3">Ruang Lingkup Lomba</h5>
                        <p class="mb-2">
                            <i class="fas fa-check-circle me-2"></i>
                            Peserta membuat aplikasi web atau aplikasi mobile sederhana yang berhubungan dengan solusi bisnis digital.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-arrow-right me-2"></i>Aplikasi bisa berupa sistem manajemen usaha, marketplace mini, aplikasi keuangan sederhana, atau platform edukasi bisnis.</li>
                        </ul>
                        <p class="mt-3">
                            <i class="fas fa-lightbulb me-2"></i>
                            <strong>Fokus pada kreativitas ide, penerapan teknologi, dan dampak bagi dunia usaha/masyarakat.</strong>
                        </p>
                    </div>
                    <a href="daftar.php" class="btn btn-light btn-lg btn-primary-custom">
                        <i class="fas fa-rocket me-2"></i>Daftar Sekarang
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://via.placeholder.com/500x400/667eea/ffffff?text=Digital+Business+Tech" class="img-fluid rounded shadow" alt="Digital Business">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="display-5 fw-bold">Tentang Lomba</h2>
                    <p class="lead">Kompetisi untuk mengembangkan solusi teknologi bisnis digital</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Format Individu</h4>
                    <p>Setiap peserta berkomPetisi secara individu untuk mengembangkan ide terbaik mereka.</p>
                </div>
                <div class="col-lg-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>SMP - SMA/K</h4>
                    <p>Terbuka untuk semua siswa dari tingkat SMP hingga SMA/SMK sederajat.</p>
                </div>
                <div class="col-lg-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4>Inovasi Digital</h4>
                    <p>Fokus pada pengembangan aplikasi yang memberikan solusi bisnis digital.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section id="kategori" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="display-5 fw-bold">Kategori Lomba</h2>
                    <p class="lead">Pilih kategori yang sesuai dengan ide Anda</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card card-lomba h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Sistem Manajemen Usaha</h5>
                            <p class="card-text">Aplikasi untuk mengelola bisnis kecil dan menengah dengan fitur inventory, penjualan, dan laporan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card card-lomba h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-shopping-cart fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Marketplace Mini</h5>
                            <p class="card-text">Platform jual beli online untuk UMKM lokal dengan fitur katalog produk dan sistem pembayaran.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card card-lomba h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-wallet fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Aplikasi Keuangan</h5>
                            <p class="card-text">Aplikasi untuk mengelola keuangan pribadi atau bisnis dengan fitur budgeting dan tracking.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card card-lomba h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-book fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Platform Edukasi Bisnis</h5>
                            <p class="card-text">Platform pembelajaran online untuk edukasi bisnis dan kewirausahaan bagi remaja.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card card-lomba h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt fa-3x text-danger mb-3"></i>
                            <h5 class="card-title">Aplikasi Bisnis</h5>
                            <p class="card-text">Aplikasi mobile atau web untuk solusi bisnis digital lainnya yang inovatif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center text-white">
                    <h2 class="display-5 fw-bold mb-4">Siap untuk Berkomepetisi?</h2>
                    <p class="lead mb-4">Daftarkan diri Anda sekarang dan tunjukkan kreativitas digital Anda!</p>
                    <a href="daftar.php" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-user-plus me-2"></i>Daftar Lomba
                    </a>
                    <a href="peserta.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-list me-2"></i>Lihat Peserta
                    </a>
                </div>
            </div>
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
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>