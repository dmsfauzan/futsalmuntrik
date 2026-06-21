<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

// Ambil email user dari database
$getUser = $koneksi->query("SELECT * FROM users WHERE id = '$id_user'");
$dataUser = $getUser->fetch_assoc();
$email = $dataUser['email'] ?? '';
$nama_user = $dataUser['nama'] ?? '';

// Ambil data order berdasarkan email user dengan join ke tabel produk dan booking_jadwal
$query = $koneksi->query("
    SELECT o.*, p.nama_produk, 
           bj.jam_mulai, bj.jam_selesai, 
           TIMESTAMPDIFF(HOUR, bj.jam_mulai, bj.jam_selesai) as durasi_jam
    FROM `order` o 
    LEFT JOIN produk p ON o.id_produk = p.id_produk
    LEFT JOIN booking_jadwal bj ON o.id_order = bj.id_order
    WHERE o.email = '$email' 
    ORDER BY o.tanggal_order DESC
");
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Status Booking - Futsal Muntrik</title>
        <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="assets/landing/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
        
        <style>
            :root {
                --hijau: #1DB954;
                --hijau-gelap: #148a3d;
                --hijau-tua: #0d5c29;
                --hitam: #0a0a0a;
                --hitam-lunak: #141414;
                --abu-gelap: #1e1e1e;
                --abu-sedang: #2a2a2a;
                --putih: #f5f5f5;
                --putih-lunak: #cccccc;
            }

            * {
                font-family: 'Inter', sans-serif;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Rajdhani', sans-serif !important;
            }

            body {
                background: linear-gradient(135deg, var(--hitam) 0%, var(--hitam-lunak) 100%);
                min-height: 100vh;
                position: relative;
            }

            /* Background pattern */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image: repeating-linear-gradient(
                    -45deg,
                    transparent,
                    transparent 40px,
                    rgba(29,185,84,0.03) 40px,
                    rgba(29,185,84,0.03) 41px
                );
                pointer-events: none;
                z-index: 0;
            }

            /* Navbar */
            .navbar {
                background-color: rgba(10, 10, 10, 0.97) !important;
                border-bottom: 2px solid var(--hijau);
                padding: 14px 2rem !important;
                position: sticky;
                top: 0;
                z-index: 1000;
            }

            .navbar-brand h1 {
                color: var(--hijau) !important;
                font-size: 1.5rem !important;
                letter-spacing: 1px;
                font-weight: 700 !important;
            }

            .navbar-brand span.brand-icon {
                display: inline-block;
                width: 36px;
                height: 36px;
                background: var(--hijau);
                border-radius: 6px;
                text-align: center;
                line-height: 36px;
                margin-right: 10px;
                font-size: 1.2rem;
            }

            .nav-link {
                color: var(--putih-lunak) !important;
                font-weight: 500;
                font-size: 0.9rem;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                transition: color 0.2s;
                padding: 8px 14px !important;
            }

            .nav-link:hover,
            .nav-link.active {
                color: var(--hijau) !important;
            }

            .btn-login-nav {
                background: var(--hijau) !important;
                color: var(--hitam) !important;
                font-weight: 600;
                border-radius: 6px !important;
                padding: 8px 20px !important;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
            }

            /* Status Container */
            .status-container {
                position: relative;
                z-index: 1;
                padding: 60px 0;
            }

            .status-card {
                background: rgba(30, 30, 30, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                border: 1px solid rgba(29, 185, 84, 0.2);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                overflow: hidden;
            }

            .status-header {
                background: linear-gradient(135deg, var(--abu-sedang), var(--abu-gelap));
                padding: 25px 30px;
                border-bottom: 1px solid rgba(29, 185, 84, 0.2);
            }

            .status-header h3 {
                color: var(--putih);
                margin: 0;
                font-weight: 700;
            }

            .status-header h3 i {
                color: var(--hijau);
                margin-right: 10px;
            }

            .status-header p {
                color: var(--putih-lunak);
                margin: 8px 0 0;
                font-size: 0.9rem;
            }

            .status-body {
                padding: 30px;
            }

            /* Table Styling */
            .table-custom {
                width: 100%;
                color: var(--putih-lunak);
                border-collapse: collapse;
            }

            .table-custom th {
                background: var(--abu-sedang);
                color: var(--hijau);
                font-weight: 600;
                padding: 15px;
                border-bottom: 2px solid var(--hijau);
                text-transform: uppercase;
                font-size: 0.8rem;
                letter-spacing: 0.5px;
            }

            .table-custom td {
                padding: 12px 15px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                vertical-align: middle;
            }

            .table-custom tr:hover {
                background: rgba(29, 185, 84, 0.05);
            }

            /* Badge Status */
            .badge-status {
                padding: 6px 15px;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                display: inline-block;
            }

            .badge-pending {
                background: rgba(241, 196, 15, 0.15);
                color: #f1c40f;
                border: 1px solid rgba(241, 196, 15, 0.3);
            }

            .badge-proses {
                background: rgba(52, 152, 219, 0.15);
                color: #3498db;
                border: 1px solid rgba(52, 152, 219, 0.3);
            }

            .badge-selesai {
                background: rgba(46, 204, 113, 0.15);
                color: #2ecc71;
                border: 1px solid rgba(46, 204, 113, 0.3);
            }

            .badge-success {
                background: rgba(46, 204, 113, 0.15);
                color: #2ecc71;
                border: 1px solid rgba(46, 204, 113, 0.3);
            }

            .badge-danger {
                background: rgba(231, 76, 60, 0.15);
                color: #e74c3c;
                border: 1px solid rgba(231, 76, 60, 0.3);
            }

            .badge-gagal {
                background: rgba(231, 76, 60, 0.15);
                color: #e74c3c;
                border: 1px solid rgba(231, 76, 60, 0.3);
            }

            .badge-secondary {
                background: rgba(149, 165, 166, 0.15);
                color: #95a5a6;
                border: 1px solid rgba(149, 165, 166, 0.3);
            }

            /* Badge Durasi */
            .badge-durasi {
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 0.7rem;
                font-weight: 600;
                display: inline-block;
                background: rgba(52, 152, 219, 0.15);
                color: #3498db;
                border: 1px solid rgba(52, 152, 219, 0.3);
            }

            /* Empty State */
            .empty-state {
                text-align: center;
                padding: 60px 20px;
            }

            .empty-state i {
                font-size: 64px;
                color: var(--hijau);
                opacity: 0.5;
                margin-bottom: 20px;
            }

            .empty-state h4 {
                color: var(--putih);
                margin-bottom: 10px;
            }

            .empty-state p {
                color: #888;
            }

            /* Buttons */
            .btn-back {
                background: var(--abu-sedang);
                border: 1px solid #444;
                color: var(--putih-lunak);
                padding: 12px 28px;
                border-radius: 10px;
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                transition: all 0.2s;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 10px;
            }

            .btn-back:hover {
                background: var(--abu-gelap);
                border-color: var(--hijau);
                color: var(--hijau);
                transform: translateY(-2px);
            }

            /* Dropdown */
            .dropdown-menu {
                background: var(--abu-gelap) !important;
                border: 1px solid #2a2a2a !important;
                border-radius: 8px !important;
            }

            .dropdown-item {
                color: #ccc !important;
                font-size: 0.88rem;
            }

            .dropdown-item:hover {
                background: rgba(29, 185, 84, 0.1) !important;
                color: var(--hijau) !important;
            }

            .dropdown-divider {
                border-color: #2a2a2a !important;
            }

            /* Jam & Durasi styling di tabel */
            .jam-info {
                font-size: 0.85rem;
                color: var(--putih-lunak);
            }

            .jam-info i {
                color: var(--hijau);
                margin-right: 4px;
            }

            @media (max-width: 768px) {
                .status-container {
                    padding: 30px 15px;
                }
                .status-body {
                    padding: 20px;
                }
                .table-custom th,
                .table-custom td {
                    padding: 8px 10px;
                    font-size: 0.75rem;
                }
                .table-responsive {
                    overflow-x: auto;
                }
                .jam-info {
                    font-size: 0.7rem;
                }
            }
        </style>
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark px-4 px-lg-5">
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="mb-0">
                    <span class="brand-icon">⚽</span>FUTSAL MUNTRIK
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 align-items-center gap-1">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">Tentang Kami</a>
                    <a href="product.php" class="nav-item nav-link">Lapangan</a>
                    <a href="contact.php" class="nav-item nav-link">Kontak</a>
                    <?php if (isset($_SESSION['login'])): ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo htmlspecialchars($_SESSION['foto'] ?? 'assets/landing/img/avatar.png'); ?>" alt="Profil" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover; border: 2px solid var(--hijau);">
                                <span class="ms-2" style="font-size:0.88rem;"><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <li><a class="dropdown-item" href="status_order.php"><i class="fas fa-calendar-check me-2"></i>Status Booking</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="nav-item nav-link btn-login-nav ms-2">Login / Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Status Content -->
        <div class="status-container">
            <div class="container">
                <div class="status-card wow fadeInUp" data-wow-delay="0.1s">
                    <div class="status-header">
                        <h3><i class="fas fa-calendar-check"></i> Status Booking Saya</h3>
                        <p>Halo, <?php echo htmlspecialchars($nama_user); ?>! Berikut adalah daftar pemesanan lapangan Anda</p>
                    </div>
                    <div class="status-body">
                        <?php if ($query && $query->num_rows > 0): ?>
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lapangan</th>
                                            <th>Nama</th>
                                            <th>Tanggal Main</th>
                                            <th>Jam Main</th>
                                            <th>Durasi</th>
                                            <th>No. WhatsApp</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php while ($row = $query->fetch_assoc()): ?>
                                            <?php
                                            // Inisialisasi variabel dengan nilai default
                                            $nama_lapangan = $row['nama_produk'] ?? 'Lapangan Futsal';
                                            $nama_pelanggan = $row['nama'] ?? '';
                                            $telepon = $row['telepon_pelanggan'] ?? '';
                                            $tanggal_main = $row['tanggal_main'] ?? '';
                                            $jam_mulai = $row['jam_mulai'] ?? '';
                                            $jam_selesai = $row['jam_selesai'] ?? '';
                                            $durasi_jam = $row['durasi_jam'] ?? 0;
                                            $status = strtolower(trim($row['status'] ?? 'pending'));
                                            
                                            // Format tanggal main
                                            $tanggal_main_formatted = '-';
                                            if (!empty($tanggal_main) && $tanggal_main !== '0000-00-00') {
                                                $tanggal_main_formatted = date('d/m/Y', strtotime($tanggal_main));
                                            }
                                            
                                            // Format jam main
                                            $jam_info = '-';
                                            if (!empty($jam_mulai) && !empty($jam_selesai)) {
                                                $jam_info = date('H:i', strtotime($jam_mulai)) . ' - ' . date('H:i', strtotime($jam_selesai));
                                            }
                                            
                                            // Format durasi
                                            $durasi_info = '-';
                                            if ($durasi_jam > 0) {
                                                $durasi_info = '<span class="badge-durasi">' . $durasi_jam . ' Jam</span>';
                                            }
                                            
                                            // Tentukan badge class dan text berdasarkan status
                                            $badge_class = 'badge-secondary';
                                            $status_text = ucfirst($status);
                                            
                                            if ($status == 'pending') {
                                                $badge_class = 'badge-pending';
                                                $status_text = 'Menunggu Konfirmasi';
                                            } elseif ($status == 'proses') {
                                                $badge_class = 'badge-proses';
                                                $status_text = 'Diproses';
                                            } elseif ($status == 'selesai') {
                                                $badge_class = 'badge-selesai';
                                                $status_text = 'Selesai';
                                            } elseif ($status == 'success') {
                                                $badge_class = 'badge-success';
                                                $status_text = 'Berhasil';
                                            } elseif ($status == 'gagal') {
                                                $badge_class = 'badge-gagal';
                                                $status_text = 'Gagal';
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($nama_lapangan); ?></td>
                                                <td><?= htmlspecialchars($nama_pelanggan); ?></td>
                                                <td><?= $tanggal_main_formatted; ?></td>
                                                <td class="jam-info">
                                                    <?php if ($jam_info != '-'): ?>
                                                        <i class="fas fa-clock"></i> <?= $jam_info; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $durasi_info; ?></td>
                                                <td><?= !empty($telepon) ? htmlspecialchars($telepon) : '<span class="text-muted">-</span>'; ?></td>
                                                <td>
                                                    <span class="badge-status <?= $badge_class; ?>"><?= $status_text; ?></span>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h4>Belum Ada Booking</h4>
                                <p>Anda belum melakukan pemesanan lapangan. Yuk booking sekarang!</p>
                                <a href="product.php" class="btn-back" style="margin-top: 20px; display: inline-flex;">
                                    <i class="fas fa-futbol"></i> Booking Sekarang
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-4 text-center">
                            <a href="index.php" class="btn-back">
                                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/landing/lib/wow/wow.min.js"></script>
        <script src="assets/landing/lib/easing/easing.min.js"></script>
        <script src="assets/landing/lib/waypoints/waypoints.min.js"></script>
        <script src="assets/landing/lib/counterup/counterup.min.js"></script>
        <script src="assets/landing/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="assets/landing/js/main.js"></script>

        <script>
            new WOW().init();
        </script>
    </body>
</html>