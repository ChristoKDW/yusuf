# Digital Business Technology Competition

Aplikasi web native sederhana untuk lomba Digital Business Technology (Web & Apps) untuk tingkat SMP - SMA/K sederajat.

## Fitur Aplikasi

### Frontend (User)
- **Halaman Utama** (`index.php`) - Landing page dengan informasi lomba
- **Pendaftaran** (`daftar.php`) - Form pendaftaran peserta lomba
- **Daftar Peserta** (`peserta.php`) - Menampilkan semua peserta yang telah mendaftar

### Backend (Admin)
- **Login Admin** (`admin/login.php`) - Sistem autentikasi admin
- **Dashboard Admin** (`admin/dashboard.php`) - Panel admin untuk mengelola peserta
- **Manajemen Status** - Mengubah status peserta (Menunggu/Disetujui/Ditolak)
- **CRUD Peserta** - Melihat detail dan menghapus peserta

## Struktur Database

### Tabel `peserta`
- `id` - Primary key auto increment
- `nama` - Nama lengkap peserta
- `asal_sekolah` - Asal sekolah peserta
- `tingkat_pendidikan` - Enum: SMP, SMA, SMK
- `email` - Email unik peserta
- `no_telepon` - Nomor telepon peserta
- `kategori_lomba` - Kategori lomba yang dipilih
- `deskripsi_ide` - Deskripsi ide aplikasi
- `teknologi_digunakan` - Teknologi yang akan digunakan
- `tanggal_daftar` - Timestamp pendaftaran
- `status` - Enum: Menunggu, Disetujui, Ditolak

### Tabel `admin`
- `id` - Primary key auto increment
- `username` - Username admin
- `password` - Password admin (hashed)
- `nama` - Nama admin
- `created_at` - Timestamp pembuatan

## Instalasi dan Setup

### 1. Persiapan Database
1. Buka phpMyAdmin atau MySQL client
2. Import file `database/setup.sql` untuk membuat database dan tabel
3. Atau jalankan SQL script secara manual

### 2. Konfigurasi Database
Edit file `config/database.php` sesuai pengaturan MySQL Anda:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'digital_business_lomba');
```

### 3. Login Admin Default
- Username: `admin`
- Password: `password`

## Kategori Lomba

1. **Aplikasi Bisnis** - Aplikasi mobile atau web untuk solusi bisnis digital
2. **Sistem Manajemen Usaha** - Aplikasi untuk mengelola bisnis kecil dan menengah
3. **Marketplace Mini** - Platform jual beli online untuk UMKM lokal
4. **Aplikasi Keuangan** - Aplikasi untuk mengelola keuangan pribadi atau bisnis
5. **Platform Edukasi** - Platform pembelajaran online untuk edukasi bisnis

## Teknologi yang Digunakan

- **Backend**: PHP Native dengan PDO
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **UI Framework**: Bootstrap 5
- **Icons**: Font Awesome 6
- **Session Management**: PHP Sessions

## Keamanan

- Password admin di-hash menggunakan `password_hash()`
- Input sanitization dengan `htmlspecialchars()`
- Prepared statements untuk mencegah SQL injection
- Session management untuk autentikasi admin

## File Structure

```
educourse2/
├── config/
│   └── database.php          # Konfigurasi database
├── database/
│   └── setup.sql            # SQL script untuk setup database
├── admin/
│   ├── login.php           # Login admin
│   ├── dashboard.php       # Dashboard admin
│   └── logout.php          # Logout admin
├── index.php               # Halaman utama
├── daftar.php             # Form pendaftaran
├── peserta.php            # Daftar peserta
└── README.md              # Dokumentasi
```

## Cara Menjalankan

1. Pastikan XAMPP/WAMP/LAMP sudah terinstall dan berjalan
2. Copy folder `educourse2` ke dalam folder `htdocs` (XAMPP) atau `www` (WAMP)
3. Buat database menggunakan file `database/setup.sql`
4. Akses aplikasi melalui browser: `http://localhost/educourse2`
5. Untuk admin: `http://localhost/educourse2/admin/login.php`

## Screenshot dan Demo

Aplikasi ini memiliki desain yang responsive dan modern dengan gradient color scheme yang menarik. Semua halaman sudah mobile-friendly dan menggunakan Bootstrap untuk layout yang konsisten.

---

**Dibuat untuk Digital Business Technology Competition 2025**# yusuf
