<!DOCTYPE html>
<html lang="id">
    <?php
    session_start();
    include 'koneksi.php';

    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = $koneksi->query("SELECT * FROM users WHERE id = '$id'");
        $users = $query->fetch_assoc();
    } else {
        $users = null;
    }
    ?>
    <head>
        <meta charset="utf-8">
        <title>Lapangan Futsal - Futsal Muntrik | Sewa Lapangan Futsal</title>
        <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="futsal, sewa lapangan futsal, booking lapangan, futsal muntrik, lapangan futsal">
        <meta name="description" content="Futsal Muntrik menyediakan lapangan futsal berkualitas tinggi dengan fasilitas lengkap dan harga terjangkau. Booking sekarang!">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="assets/landing/lib/animate/animate.min.css" rel="stylesheet">
        <link href="assets/landing/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="assets/landing/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="assets/landing/css/style.css" rel="stylesheet">

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

            h1, h2, h3, h4, h5, h6,
            .navbar-brand h1 {
                font-family: 'Rajdhani', sans-serif !important;
            }

            body {
                background-color: var(--hitam);
                color: var(--putih);
            }

            /* ===== NAVBAR ===== */
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

            .btn-login-nav:hover {
                background: var(--hijau-gelap) !important;
            }

            /* ===== PAGE HEADER ===== */
            .page-header {
                background: linear-gradient(135deg, #0a0a0a 0%, #0d2a1a 100%);
                padding: 80px 0;
                position: relative;
                overflow: hidden;
                border-bottom: 1px solid rgba(29,185,84,0.2);
            }

            .page-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: repeating-linear-gradient(
                    -45deg,
                    transparent,
                    transparent 40px,
                    rgba(29,185,84,0.02) 40px,
                    rgba(29,185,84,0.02) 41px
                );
                pointer-events: none;
            }

            .page-header h1 {
                font-size: 3.5rem;
                font-weight: 700;
                color: var(--putih);
                position: relative;
                z-index: 2;
            }

            .page-header h1 span {
                color: var(--hijau);
            }

            .page-header .breadcrumb {
                background: transparent;
                padding: 0;
                position: relative;
                z-index: 2;
            }

            .page-header .breadcrumb-item a {
                color: var(--putih-lunak);
                text-decoration: none;
                transition: color 0.2s;
            }

            .page-header .breadcrumb-item a:hover {
                color: var(--hijau);
            }

            .page-header .breadcrumb-item.active {
                color: var(--hijau);
            }

            .page-header .breadcrumb-item::before {
                color: var(--putih-lunak);
            }

            /* ===== LAPANGAN SECTION ===== */
            .lapangan-section {
                background: var(--hitam);
                padding: 80px 0;
            }

            .section-label {
                font-size: 0.8rem;
                font-weight: 600;
                letter-spacing: 3px;
                text-transform: uppercase;
                color: var(--hijau);
                margin-bottom: 12px;
            }

            .section-title {
                font-family: 'Rajdhani', sans-serif;
                font-size: 3rem;
                font-weight: 700;
                color: var(--putih);
                line-height: 1.15;
                margin-bottom: 20px;
            }

            .section-title span {
                color: var(--hijau);
            }

            .product-card {
                background: var(--abu-gelap);
                border: 1px solid #252525;
                border-radius: 10px;
                overflow: hidden;
                transition: transform 0.25s, border-color 0.25s;
                height: 100%;
            }

            .product-card:hover {
                transform: translateY(-6px);
                border-color: var(--hijau);
            }

            .product-card img {
                width: 100%;
                height: 240px;
                object-fit: cover;
                display: block;
            }

            .product-body {
                padding: 24px;
            }

            .product-tag {
                display: inline-block;
                font-size: 0.72rem;
                font-weight: 600;
                letter-spacing: 1px;
                text-transform: uppercase;
                background: rgba(29, 185, 84, 0.12);
                color: var(--hijau);
                padding: 4px 12px;
                border-radius: 4px;
                margin-bottom: 14px;
            }

            .product-name {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.35rem;
                font-weight: 700;
                color: var(--putih);
                margin-bottom: 12px;
            }

            .product-desc {
                color: #aaa;
                font-size: 0.85rem;
                line-height: 1.6;
                margin-bottom: 20px;
            }

            .btn-detail {
                background: var(--hijau);
                color: var(--hitam) !important;
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.9rem;
                letter-spacing: 0.5px;
                padding: 10px 24px;
                border-radius: 6px;
                border: none;
                text-transform: uppercase;
                transition: background 0.2s;
                width: 100%;
            }

            .btn-detail:hover {
                background: var(--hijau-gelap);
            }

            /* ===== MODAL ===== */
            .modal-content {
                background: var(--abu-gelap) !important;
                border: 1px solid #2a2a2a;
                border-radius: 12px;
                color: var(--putih);
            }

            .modal-header {
                background: var(--abu-sedang) !important;
                border-bottom: 1px solid #333 !important;
                border-radius: 12px 12px 0 0;
            }

            .modal-title {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--putih) !important;
            }

            .modal-footer {
                border-top: 1px solid #333 !important;
                background: var(--abu-sedang) !important;
                border-radius: 0 0 12px 12px;
            }

            .modal-body label {
                font-size: 0.82rem;
                font-weight: 500;
                color: #aaa;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 6px;
            }

            .form-control {
                background: var(--abu-sedang) !important;
                border: 1px solid #333 !important;
                color: var(--putih) !important;
                border-radius: 6px !important;
                font-size: 0.9rem;
                padding: 10px 14px;
            }

            .form-control:focus {
                border-color: var(--hijau) !important;
                box-shadow: 0 0 0 2px rgba(29, 185, 84, 0.2) !important;
            }

            .form-control::placeholder {
                color: #555 !important;
            }

            .form-control:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .btn-pesan {
                background: var(--hijau);
                color: var(--hitam);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.95rem;
                letter-spacing: 0.5px;
                padding: 12px 26px;
                border-radius: 6px;
                border: none;
                text-transform: uppercase;
                transition: background 0.2s;
                width: 100%;
            }

            .btn-pesan:hover {
                background: var(--hijau-gelap);
            }

            .btn-pesan:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .btn-close {
                filter: invert(1);
            }

            .modal p strong {
                color: var(--hijau);
                font-weight: 600;
            }

            .modal-img {
                width: 100%;
                border-radius: 8px;
                height: 200px;
                object-fit: cover;
            }

            /* ===== FOOTER ===== */
            .footer {
                background: var(--hitam-lunak) !important;
                border-top: 1px solid #1e1e1e;
                padding: 60px 0 !important;
            }

            .footer-brand {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.4rem;
                font-weight: 700;
                color: var(--hijau) !important;
                letter-spacing: 0.5px;
            }

            .footer-desc {
                color: #666;
                font-size: 0.88rem;
                line-height: 1.7;
                margin-top: 10px;
            }

            .footer-heading {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.05rem;
                font-weight: 700;
                color: #fff !important;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-bottom: 18px !important;
            }

            .footer-item a {
                color: #666 !important;
                font-size: 0.88rem;
                text-decoration: none;
                display: block;
                padding: 4px 0;
                transition: color 0.2s;
            }

            .footer-item a:hover {
                color: var(--hijau) !important;
            }

            .jam-label {
                font-size: 0.78rem;
                color: #555;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin: 0 !important;
            }

            .jam-time {
                color: #ccc !important;
                font-weight: 500;
                font-size: 0.9rem;
                margin: 0 !important;
                margin-bottom: 12px !important;
            }

            .jam-libur {
                color: #e74c3c !important;
                font-weight: 500;
                font-size: 0.9rem;
                margin: 0 !important;
                margin-bottom: 12px !important;
            }

            .btn-sosmed {
                background: #1e1e1e !important;
                border: 1px solid #2a2a2a !important;
                color: #666 !important;
                transition: all 0.2s !important;
            }

            .btn-sosmed:hover {
                border-color: var(--hijau) !important;
                color: var(--hijau) !important;
            }

            .copyright {
                background: var(--hitam) !important;
                border-top: 1px solid #1a1a1a;
                padding: 18px 0 !important;
            }

            .copyright span,
            .copyright a {
                color: #444 !important;
                font-size: 0.82rem;
            }

            .copyright a:hover {
                color: var(--hijau) !important;
            }

            .back-to-top {
                background: var(--hijau) !important;
                color: var(--hitam) !important;
                border: none !important;
            }

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

            /* Harga styling */
            .product-price {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--hijau);
                margin-bottom: 15px;
            }

            .product-price small {
                font-size: 0.7rem;
                color: #888;
                font-weight: 400;
            }

            /* Duration options */
            .duration-option {
                background: var(--abu-sedang);
                border: 2px solid #333;
                border-radius: 8px;
                padding: 12px;
                margin-bottom: 10px;
                cursor: pointer;
                transition: all 0.2s;
            }

            .duration-option:hover {
                border-color: var(--hijau);
                background: rgba(29,185,84,0.05);
            }

            .duration-option.selected {
                border-color: var(--hijau);
                background: rgba(29,185,84,0.1);
            }

            .duration-hour {
                font-size: 1rem;
                font-weight: 700;
                color: var(--putih);
            }

            .duration-price {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--hijau);
            }

            .total-price {
                background: linear-gradient(135deg, var(--hijau-tua), var(--hijau-gelap));
                border-radius: 10px;
                padding: 15px;
                text-align: center;
                margin-top: 15px;
            }

            .total-price-label {
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: rgba(255,255,255,0.7);
            }

            .total-price-amount {
                font-size: 1.8rem;
                font-weight: 800;
                color: white;
            }

            .whatsapp-link {
                background: #25D366;
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-weight: 600;
                transition: all 0.2s;
                width: 100%;
                justify-content: center;
            }

            .whatsapp-link:hover {
                background: #128C7E;
                color: white;
                transform: translateY(-2px);
            }

            .durasi-lama {
                background: rgba(255, 193, 7, 0.1);
                border: 1px solid #ffc107;
                border-radius: 10px;
                padding: 15px;
                margin-top: 10px;
                text-align: center;
            }

            .durasi-lama p {
                color: #ffc107;
                margin-bottom: 10px;
            }

            /* Jam select styling */
            .jam-unavailable {
                border-color: #e74c3c !important;
                background: rgba(231, 76, 60, 0.1) !important;
            }

            .loading-spinner {
                display: inline-block;
                width: 14px;
                height: 14px;
                border: 2px solid rgba(255,255,255,0.2);
                border-radius: 50%;
                border-top-color: var(--hijau);
                animation: spin 0.7s ease-in-out infinite;
            }

            @keyframes spin {
                to { transform: rotate(360deg); }
            }

            @media (max-width: 768px) {
                .section-title {
                    font-size: 2rem;
                }
                .page-header h1 {
                    font-size: 2.2rem;
                }
            }
        </style>
    </head>

    <body>

        <!-- Navbar -->
        <div class="container-fluid position-relative p-0">
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
                        <a href="product.php" class="nav-item nav-link active">Lapangan</a>
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

            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container text-center py-5">
                    <h1 class="mb-3 wow fadeInDown" data-wow-delay="0.1s">Pilih <span>Lapangan</span></h1>
                    <nav aria-label="breadcrumb wow fadeInDown" data-wow-delay="0.2s">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lapangan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header End -->
        </div>

        <!-- Lapangan Section Start -->
        <div class="lapangan-section">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-label">Booking Sekarang</div>
                    <h2 class="section-title">Lapangan <span>Futsal Tersedia</span></h2>
                    <p class="about-text mb-5" style="max-width: 600px; margin: 0 auto 48px auto;">Pilih lapangan futsal favorit Anda dan lakukan booking secara online dengan mudah</p>
                </div>

                <div class="row g-4">
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM produk ORDER BY id_produk ASC");
                    while ($perproduk = $ambil->fetch_assoc()) {
                        $harga_per_jam = $perproduk['harga_produk'];
                    ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-card">
                                <img src="foto_produk/<?php echo htmlspecialchars($perproduk['foto_produk']); ?>" alt="<?php echo htmlspecialchars($perproduk['nama_produk']); ?>">
                                <div class="product-body">
                                    <span class="product-tag">⚽ Lapangan Futsal</span>
                                    <div class="product-name"><?php echo htmlspecialchars($perproduk['nama_produk']); ?></div>
                                    <div class="product-price">
                                        Rp <?php echo number_format($harga_per_jam, 0, ',', '.'); ?><small>/jam</small>
                                    </div>
                                    <div class="product-desc">
                                        <?php 
                                        $deskripsi = strip_tags($perproduk['deskripsi_produk']);
                                        echo strlen($deskripsi) > 100 ? substr($deskripsi, 0, 100) . '...' : $deskripsi;
                                        ?>
                                    </div>
                                    <button type="button" class="btn-detail" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $perproduk['id_produk']; ?>">
                                        Booking Lapangan →
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Booking -->
                        <div class="modal fade" id="modal_<?php echo $perproduk['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_<?php echo $perproduk['id_produk']; ?>_label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal_<?php echo $perproduk['id_produk']; ?>_label">
                                            ⚽ Booking — <?php echo htmlspecialchars($perproduk['nama_produk']); ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="background: var(--abu-gelap);">
                                        <div class="row g-4">
                                            <div class="col-md-5">
                                                <img src="foto_produk/<?php echo htmlspecialchars($perproduk['foto_produk']); ?>" alt="<?php echo htmlspecialchars($perproduk['nama_produk']); ?>" class="modal-img">
                                                <div class="mt-3">
                                                    <p style="font-size: 0.82rem; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Deskripsi Lapangan</p>
                                                    <p style="font-size: 0.9rem; color: #ccc; line-height: 1.6;"><?php echo nl2br(htmlspecialchars($perproduk['deskripsi_produk'])); ?></p>
                                                </div>
                                                <div class="mt-3">
                                                    <p style="font-size: 0.82rem; color: var(--hijau); font-weight: 600;">Harga Normal</p>
                                                    <p style="font-size: 1.2rem; font-weight: 700; color: var(--putih);">Rp <?php echo number_format($harga_per_jam, 0, ',', '.'); ?><span style="font-size: 0.8rem;">/jam</span></p>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <!-- NOTES PEMBAYARAN -->
                                                <div style="background: rgba(29, 185, 84, 0.1); border: 1px solid var(--hijau); border-radius: 10px; padding: 15px; margin-bottom: 20px;">
                                                    <p style="color: var(--hijau); font-weight: 700; margin-bottom: 10px; font-size: 0.85rem;">
                                                        <i class="fas fa-credit-card"></i> Informasi Pembayaran
                                                    </p>
                                                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                                        <div style="flex: 1; min-width: 120px;">
                                                            <p style="margin: 0; font-size: 0.75rem; color: #888;">BCA</p>
                                                            <p style="margin: 0; font-weight: 700; color: var(--putih); font-size: 0.9rem;">123 456 7890</p>
                                                            <p style="margin: 0; font-size: 0.7rem; color: #aaa;">a.n FUTSAL MUNTRIK</p>
                                                        </div>
                                                        <div style="flex: 1; min-width: 120px;">
                                                            <p style="margin: 0; font-size: 0.75rem; color: #888;">DANA</p>
                                                            <p style="margin: 0; font-weight: 700; color: var(--putih); font-size: 0.9rem;">0812-8770-2628</p>
                                                            <p style="margin: 0; font-size: 0.7rem; color: #aaa;">a.n FUTSAL MUNTRIK</p>
                                                        </div>
                                                    </div>
                                                    <hr style="margin: 12px 0; border-color: rgba(29,185,84,0.2);">
                                                    <p style="margin: 0; font-size: 0.7rem; color: #f1c40f;">
                                                        <i class="fas fa-info-circle"></i> Setelah transfer, upload bukti pembayaran di bawah!
                                                    </p>
                                                </div>

                                                <p style="font-size: 0.82rem; color: var(--hijau); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px;">Isi Data Booking</p>
                                                
                                                <form method="post" action="beli.php?id=<?php echo $perproduk['id_produk']; ?>" enctype="multipart/form-data" id="form_<?php echo $perproduk['id_produk']; ?>">
                                                    <input type="hidden" name="durasi" id="durasi_<?php echo $perproduk['id_produk']; ?>">
                                                    <input type="hidden" name="total_harga" id="total_harga_<?php echo $perproduk['id_produk']; ?>">
                                                    
                                                    <div class="row g-3">
                                                        <div class="col-md-12">
                                                            <label>Pilih Durasi Sewa</label>
                                                            <div id="duration_options_<?php echo $perproduk['id_produk']; ?>">
                                                                <?php
                                                                $durasi_options = [
                                                                    1 => $harga_per_jam,
                                                                    2 => $harga_per_jam * 2,
                                                                    3 => $harga_per_jam * 3
                                                                ];
                                                                foreach ($durasi_options as $jam => $total):
                                                                ?>
                                                                    <div class="duration-option" data-durasi="<?php echo $jam; ?>" data-total="<?php echo $total; ?>" onclick="selectDuration(<?php echo $perproduk['id_produk']; ?>, <?php echo $jam; ?>, <?php echo $total; ?>)">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <div class="duration-hour">⚽ <?php echo $jam; ?> Jam</div>
                                                                                <small style="color: #888;">Rp <?php echo number_format($harga_per_jam, 0, ',', '.'); ?> / jam</small>
                                                                            </div>
                                                                            <div class="duration-price">Rp <?php echo number_format($total, 0, ',', '.'); ?></div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                
                                                                <div class="durasi-lama" id="durasi_lama_<?php echo $perproduk['id_produk']; ?>">
                                                                    <p><i class="fab fa-whatsapp"></i> Booking lebih dari 3 jam?</p>
                                                                    <a href="https://wa.me/6281287702628?text=Halo%20Futsal%20Muntrik%2C%20saya%20ingin%20booking%20<?php echo urlencode($perproduk['nama_produk']); ?>%20lebih%20dari%203%20jam.%20Mohon%20info%20lebih%20lanjut." 
                                                                    class="whatsapp-link" target="_blank">
                                                                        <i class="fab fa-whatsapp fa-lg"></i> Booking via WhatsApp
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12" id="total_display_<?php echo $perproduk['id_produk']; ?>" style="display: none;">
                                                            <div class="total-price">
                                                                <div class="total-price-label">Total yang harus dibayar</div>
                                                                <div class="total-price-amount" id="total_amount_<?php echo $perproduk['id_produk']; ?>">Rp 0</div>
                                                            </div>
                                                        </div>

                                                        <!-- PILIH JAM MAIN -->
                                                        <div class="col-md-12">
                                                            <label>Pilih Jam Main <span class="text-danger">*</span></label>
                                                            <select name="jam_main" class="form-control" id="jam_main_<?php echo $perproduk['id_produk']; ?>" required disabled>
                                                                <option value="">-- Pilih durasi terlebih dahulu --</option>
                                                            </select>
                                                            <small class="text-secondary" id="jam_info_<?php echo $perproduk['id_produk']; ?>">Pilih durasi terlebih dahulu untuk melihat jam tersedia</small>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" value="<?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : ''; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" name="email" class="form-control" placeholder="email@contoh.com" value="<?php echo isset($users['email']) ? htmlspecialchars($users['email']) : ''; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>No. WhatsApp</label>
                                                            <input type="tel" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Tanggal Main</label>
                                                            <input type="date" name="tanggal" class="form-control" id="tanggal_main_<?php echo $perproduk['id_produk']; ?>" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Bukti Pembayaran (PDF / JPG / PNG)</label>
                                                            <input type="file" name="bukti_pembayaran" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                                                            <small style="color: #555; font-size: 0.7rem;">Upload bukti transfer sesuai nominal total</small>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn-pesan" id="submit_btn_<?php echo $perproduk['id_produk']; ?>" disabled>
                                                            ✔ Konfirmasi Booking
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="background: #333; border: none; color: #ccc;">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Lapangan Section End -->

        <!-- Footer Start -->
        <div class="container-fluid footer wow fadeIn" data-wow-delay="0.2s">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <div class="footer-brand mb-2">⚽ FUTSAL MUNTRIK</div>
                            <p class="footer-desc">Venue futsal terbaik dengan fasilitas modern dan harga terjangkau. Yuk main bareng!</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="footer-heading">Navigasi</h4>
                            <a href="about.php"><i class="fas fa-angle-right me-2"></i> Tentang Kami</a>
                            <a href="product.php"><i class="fas fa-angle-right me-2"></i> Pilih Lapangan</a>
                            <a href="contact.php"><i class="fas fa-angle-right me-2"></i> Hubungi Kami</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Syarat & Ketentuan</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="footer-heading">Jam Operasional</h4>
                            <div>
                                <p class="jam-label">Senin – Kamis</p>
                                <p class="jam-time">09.00 – 23.00 WIB</p>
                                <p class="jam-label">Jumat</p>
                                <p class="jam-libur">Tutup</p>
                                <p class="jam-label">Sabtu – Minggu</p>
                                <p class="jam-time">08.00 – 24.00 WIB</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="footer-heading">Kontak</h4>
                            <a href="#"><i class="fa fa-map-marker-alt me-2"></i> Jl. Permata No.33, RT.5/RW.5, Kb. Pala, Kec. Makasar, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13650</a>
                            <a href="mailto:futsalmuntrik@gmail.com"><i class="fas fa-envelope me-2"></i> futsalmuntrik@gmail.com</a>
                            <a href="tel:08128770xxxx"><i class="fas fa-phone me-2"></i> (021) 80887639</a>
                            <div class="d-flex align-items-center mt-4 gap-2">
                                <a class="btn btn-sosmed btn-md-square rounded-circle" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sosmed btn-md-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-sosmed btn-md-square rounded-circle" href="#"><i class="fab fa-whatsapp"></i></a>
                                <a class="btn btn-sosmed btn-md-square rounded-circle" href="#"><i class="fab fa-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <span class="text-body"><a href="#"><i class="fas fa-copyright me-2"></i>Futsal Muntrik</a> — Semua hak dilindungi.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed by DimasF
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

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

            let selectedDuration = {};
            
            // Fungsi untuk generate pilihan jam sesuai durasi
            function generateJamOptions(productId, duration) {
                const select = $(`#jam_main_${productId}`);
                select.empty();
                select.append('<option value="">-- Pilih Jam --</option>');
                
                // Jam operasional 08:00 - 22:00
                const maxStartHour = 22 - duration + 1;
                
                for (let i = 8; i <= maxStartHour; i++) {
                    const jamMulai = i;
                    const jamSelesai = i + duration;
                    
                    const jamMulaiStr = String(jamMulai).padStart(2, '0') + ':00';
                    const jamSelesaiStr = String(jamSelesai).padStart(2, '0') + ':00';
                    
                    const option = document.createElement('option');
                    option.value = jamMulaiStr;
                    option.textContent = jamMulaiStr + ' - ' + jamSelesaiStr + ' (' + duration + ' jam)';
                    select.append(option);
                }
                
                select.prop('disabled', false);
                $(`#jam_info_${productId}`).text('Pilih jam mulai (' + duration + ' jam, selesai ' + duration + ' jam kemudian)');
            }
            
            function selectDuration(productId, duration, totalPrice) {
                // Hapus class selected dari semua option
                $(`#duration_options_${productId} .duration-option`).removeClass('selected');
                
                // Tambah class selected ke yang dipilih
                $(`#duration_options_${productId} .duration-option[data-durasi="${duration}"]`).addClass('selected');
                
                // Simpan nilai durasi dan total
                selectedDuration[productId] = {
                    durasi: duration,
                    total: totalPrice
                };
                
                // Set nilai hidden input
                $(`#durasi_${productId}`).val(duration);
                $(`#total_harga_${productId}`).val(totalPrice);
                
                // Tampilkan total
                $(`#total_display_${productId}`).show();
                $(`#total_amount_${productId}`).text(formatRupiah(totalPrice));
                
                // GENERATE PILIHAN JAM SESUAI DURASI
                generateJamOptions(productId, duration);
                
                // Reset jam jika sudah dipilih
                $(`#jam_main_${productId}`).val('');
                $(`#submit_btn_${productId}`).prop('disabled', true);
                $(`#jam_main_${productId}`).removeClass('jam-unavailable');
                
                // Tambahkan minimal tanggal (besok)
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                const minDate = tomorrow.toISOString().split('T')[0];
                $(`#tanggal_main_${productId}`).attr('min', minDate);
            }

            function checkAvailability(productId, date, jam) {
                if (!selectedDuration[productId]) return;
                
                const durasi = selectedDuration[productId].durasi;
                
                // Tampilkan loading
                $(`#jam_info_${productId}`).html('<span class="loading-spinner"></span> Mengecek ketersediaan...');
                
                $.ajax({
                    url: 'cek_ketersediaan.php',
                    type: 'POST',
                    data: {
                        id_produk: productId,
                        tanggal: date,
                        jam: jam,
                        durasi: durasi
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.available) {
                            $(`#jam_info_${productId}`).html('<span class="text-success"><i class="fas fa-check-circle"></i> Jam tersedia! (' + durasi + ' jam)</span>');
                            $(`#submit_btn_${productId}`).prop('disabled', false);
                            $(`#jam_main_${productId}`).removeClass('jam-unavailable');
                        } else {
                            $(`#jam_info_${productId}`).html('<span class="text-danger"><i class="fas fa-times-circle"></i> Maaf, jam sudah dibooking: ' + response.booking_info + '</span>');
                            $(`#submit_btn_${productId}`).prop('disabled', true);
                            $(`#jam_main_${productId}`).addClass('jam-unavailable');
                            $(`#jam_main_${productId}`).val('');
                        }
                    },
                    error: function() {
                        $(`#jam_info_${productId}`).html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Gagal mengecek ketersediaan</span>');
                    }
                });
            }
            
            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Event listener untuk perubahan tanggal atau jam
            $(document).on('change', 'input[type="date"][id^="tanggal_main_"], select[name="jam_main"]', function() {
                const id = $(this).attr('id');
                if (!id) return;
                
                let productId;
                if ($(this).is('input[type="date"]')) {
                    productId = id.replace('tanggal_main_', '');
                } else {
                    productId = id.replace('jam_main_', '');
                }
                
                const date = $(`#tanggal_main_${productId}`).val();
                const jam = $(`#jam_main_${productId}`).val();
                
                if (date && jam && selectedDuration[productId]) {
                    checkAvailability(productId, date, jam);
                }
            });
            
            // Reset modal saat ditutup
            $('.modal').on('hidden.bs.modal', function() {
                const modalId = $(this).attr('id');
                const productId = modalId.split('_')[1];
                
                // Reset semua state
                $(`#duration_options_${productId} .duration-option`).removeClass('selected');
                $(`#total_display_${productId}`).hide();
                $(`#submit_btn_${productId}`).prop('disabled', true);
                $(`#durasi_${productId}`).val('');
                $(`#total_harga_${productId}`).val('');
                $(`#jam_main_${productId}`).prop('disabled', true);
                $(`#jam_main_${productId}`).val('');
                $(`#jam_main_${productId}`).removeClass('jam-unavailable');
                $(`#jam_info_${productId}`).text('Pilih durasi terlebih dahulu untuk melihat jam tersedia');
                
                // Kosongkan pilihan jam
                $(`#jam_main_${productId}`).empty();
                $(`#jam_main_${productId}`).append('<option value="">-- Pilih durasi terlebih dahulu --</option>');
                
                selectedDuration[productId] = null;
                
                // Reset form
                $(`#form_${productId}`)[0].reset();
            });
            
            // Validasi form sebelum submit
            $('form[id^="form_"]').on('submit', function(e) {
                const formId = $(this).attr('id');
                const productId = formId.split('_')[1];
                
                // Cek durasi
                if (!selectedDuration[productId]) {
                    e.preventDefault();
                    alert('Silakan pilih durasi sewa terlebih dahulu!');
                    return false;
                }
                
                // Cek jam
                const jam = $(`#jam_main_${productId}`).val();
                if (!jam) {
                    e.preventDefault();
                    alert('Silakan pilih jam main!');
                    return false;
                }
                
                // Cek tanggal
                const tanggal = $(`#tanggal_main_${productId}`).val();
                if (!tanggal) {
                    e.preventDefault();
                    alert('Silakan pilih tanggal main!');
                    return false;
                }
                
                // Cek file
                const fileInput = $(this).find('input[name="bukti_pembayaran"]')[0];
                if (fileInput.files.length === 0) {
                    e.preventDefault();
                    alert('Silakan upload bukti pembayaran!');
                    return false;
                }
                
                // Check if jam is available
                const isAvailable = $(`#jam_info_${productId}`).find('.text-success').length > 0;
                if (!isAvailable) {
                    e.preventDefault();
                    alert('Maaf, jam yang dipilih tidak tersedia. Silakan pilih jam lain.');
                    return false;
                }
                
                return true;
            });
        </script>
    </body>
</html>