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
        <title>Tentang Kami - Futsal Muntrik | Sewa Lapangan Futsal</title>
        <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="futsal, sewa lapangan futsal, booking lapangan, futsal muntrik, tentang kami">
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

            /* ===== ABOUT SECTION ===== */
            .about-section {
                background: var(--hitam-lunak);
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

            .about-img-wrap {
                position: relative;
                border-radius: 10px;
                overflow: hidden;
            }

            .about-img-wrap img {
                width: 100%;
                height: 480px;
                object-fit: cover;
                border-radius: 10px;
                filter: brightness(0.75);
            }

            .about-badge {
                position: absolute;
                bottom: 24px;
                left: 24px;
                background: var(--hijau);
                color: var(--hitam);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 1rem;
                padding: 10px 20px;
                border-radius: 6px;
                letter-spacing: 0.5px;
            }

            .about-text {
                color: #aaa;
                line-height: 1.8;
                font-size: 0.95rem;
            }

            .feature-check {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 14px;
            }

            .check-icon {
                width: 24px;
                height: 24px;
                background: rgba(29, 185, 84, 0.15);
                border: 1.5px solid var(--hijau);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                margin-top: 1px;
            }

            .check-icon i {
                font-size: 11px;
                color: var(--hijau);
            }

            .check-text {
                font-size: 0.9rem;
                color: #ccc;
            }

            .btn-about {
                background: transparent;
                color: var(--hijau);
                border: 1.5px solid var(--hijau);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.95rem;
                letter-spacing: 1px;
                padding: 12px 30px;
                border-radius: 6px;
                text-transform: uppercase;
                transition: all 0.2s;
                text-decoration: none;
                display: inline-block;
                margin-top: 8px;
            }

            .btn-about:hover {
                background: var(--hijau);
                color: var(--hitam);
            }

            /* ===== STAT SECTION ===== */
            .stat-section {
                background: var(--hitam);
                padding: 60px 0;
                border-top: 1px solid #1e1e1e;
                border-bottom: 1px solid #1e1e1e;
            }

            .stat-card {
                background: var(--abu-gelap);
                border-radius: 10px;
                padding: 30px 20px;
                text-align: center;
                transition: transform 0.25s, border-color 0.25s;
                border: 1px solid #252525;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                border-color: var(--hijau);
            }

            .stat-card .stat-icon {
                width: 60px;
                height: 60px;
                background: rgba(29, 185, 84, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
            }

            .stat-card .stat-icon i {
                font-size: 28px;
                color: var(--hijau);
            }

            .stat-card .stat-number {
                font-family: 'Rajdhani', sans-serif;
                font-size: 2.8rem;
                font-weight: 700;
                color: var(--hijau);
                line-height: 1;
            }

            .stat-card .stat-label {
                font-size: 0.85rem;
                color: #888;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-top: 8px;
            }

            /* ===== FASILITAS SECTION ===== */
            .fasilitas-section {
                background: var(--hitam-lunak);
                padding: 80px 0;
            }

            .fasilitas-card {
                background: var(--abu-gelap);
                border-radius: 10px;
                overflow: hidden;
                transition: transform 0.25s, border-color 0.25s;
                border: 1px solid #252525;
                height: 100%;
            }

            .fasilitas-card:hover {
                transform: translateY(-5px);
                border-color: var(--hijau);
            }

            .fasilitas-icon {
                background: rgba(29, 185, 84, 0.1);
                padding: 30px;
                text-align: center;
                border-bottom: 1px solid #252525;
            }

            .fasilitas-icon i {
                font-size: 48px;
                color: var(--hijau);
            }

            .fasilitas-body {
                padding: 24px;
                text-align: center;
            }

            .fasilitas-body h4 {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--putih);
                margin-bottom: 12px;
            }

            .fasilitas-body p {
                color: #aaa;
                font-size: 0.88rem;
                line-height: 1.6;
                margin: 0;
            }

            /* ===== TIMELINE SECTION ===== */
            .timeline-section {
                background: var(--hitam);
                padding: 80px 0;
            }

            .timeline {
                position: relative;
                padding: 20px 0;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                width: 2px;
                height: 100%;
                background: linear-gradient(to bottom, var(--hijau), rgba(29,185,84,0.2));
            }

            .timeline-item {
                position: relative;
                margin-bottom: 50px;
            }

            .timeline-item:last-child {
                margin-bottom: 0;
            }

            .timeline-dot {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                width: 16px;
                height: 16px;
                background: var(--hijau);
                border-radius: 50%;
                border: 3px solid var(--hitam);
                box-shadow: 0 0 0 3px rgba(29,185,84,0.3);
            }

            .timeline-content {
                width: calc(50% - 40px);
                padding: 20px;
                background: var(--abu-gelap);
                border-radius: 10px;
                border: 1px solid #252525;
                transition: transform 0.25s;
            }

            .timeline-content:hover {
                transform: translateY(-3px);
                border-color: var(--hijau);
            }

            .timeline-item:nth-child(odd) .timeline-content {
                margin-left: auto;
            }

            .timeline-year {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--hijau);
                margin-bottom: 8px;
            }

            .timeline-title {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.1rem;
                font-weight: 600;
                color: var(--putih);
                margin-bottom: 10px;
            }

            .timeline-text {
                color: #aaa;
                font-size: 0.85rem;
                line-height: 1.6;
                margin: 0;
            }

            @media (max-width: 768px) {
                .timeline::before {
                    left: 20px;
                }
                .timeline-dot {
                    left: 20px;
                }
                .timeline-content {
                    width: calc(100% - 60px);
                    margin-left: 60px !important;
                }
                .section-title {
                    font-size: 2rem;
                }
                .page-header h1 {
                    font-size: 2.2rem;
                }
            }

            /* ===== CTA SECTION ===== */
            .cta-section {
                background: linear-gradient(135deg, #0d2a1a 0%, #0a0a0a 100%);
                padding: 60px 0;
                text-align: center;
                border-top: 1px solid rgba(29,185,84,0.2);
                border-bottom: 1px solid rgba(29,185,84,0.2);
            }

            .cta-section h2 {
                font-family: 'Rajdhani', sans-serif;
                font-size: 2.2rem;
                font-weight: 700;
                color: var(--putih);
                margin-bottom: 20px;
            }

            .cta-section h2 span {
                color: var(--hijau);
            }

            .cta-section p {
                color: #aaa;
                margin-bottom: 30px;
                font-size: 1rem;
            }

            .btn-cta {
                background: var(--hijau);
                color: var(--hitam) !important;
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 1rem;
                letter-spacing: 1px;
                padding: 14px 36px;
                border-radius: 6px;
                text-transform: uppercase;
                transition: all 0.2s;
                text-decoration: none;
                display: inline-block;
            }

            .btn-cta:hover {
                background: var(--hijau-gelap);
                transform: translateY(-2px);
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
                        <a href="about.php" class="nav-item nav-link active">Tentang Kami</a>
                        <a href="product.php" class="nav-item nav-link">Lapangan</a>
                        <a href="contact.php" class="nav-item nav-link">Kontak</a>
                        <?php if (isset($_SESSION['login'])): ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo htmlspecialchars($_SESSION['foto']); ?>" alt="Profil" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover; border: 2px solid var(--hijau);">
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
                    <h1 class="mb-3 wow fadeInDown" data-wow-delay="0.1s">Tentang <span>Kami</span></h1>
                    <nav aria-label="breadcrumb wow fadeInDown" data-wow-delay="0.2s">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header End -->
        </div>

        <!-- About Section Start -->
        <div class="about-section">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-img-wrap">
                            <img src="assets/landing/img/futsal1.jpg" alt="Futsal Muntrik">
                            <div class="about-badge">✔ 5 Tahun Pengalaman</div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="section-label">Tentang Kami</div>
                        <h2 class="section-title">Venue Futsal <span>Terlengkap</span> di Kota Kami</h2>
                        <p class="about-text mb-4">
                            Futsal Muntrik hadir sebagai solusi terbaik bagi para pecinta futsal yang menginginkan lapangan berkualitas dengan harga bersahabat. Kami menyediakan 4 lapangan futsal indoor dengan fasilitas modern, lantai vinyl anti-licin, pencahayaan LED profesional, dan area tribun penonton yang nyaman.
                        </p>

                        <div class="feature-check">
                            <div class="check-icon"><i class="fa fa-check"></i></div>
                            <div class="check-text">Lantai vinyl anti-slip standar internasional</div>
                        </div>
                        <div class="feature-check">
                            <div class="check-icon"><i class="fa fa-check"></i></div>
                            <div class="check-text">Pencahayaan LED 1500 lux di semua lapangan</div>
                        </div>
                        <div class="feature-check">
                            <div class="check-icon"><i class="fa fa-check"></i></div>
                            <div class="check-text">Ruang ganti, shower, dan loker tersedia</div>
                        </div>
                        <div class="feature-check">
                            <div class="check-icon"><i class="fa fa-check"></i></div>
                            <div class="check-text">Kantin dan area parkir luas</div>
                        </div>
                        <div class="feature-check">
                            <div class="check-icon"><i class="fa fa-check"></i></div>
                            <div class="check-text">Booking online 24/7 tanpa antri</div>
                        </div>

                        <a href="product.php" class="btn-about mt-4">Booking Sekarang →</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Section End -->

        <!-- Stat Section Start -->
        <div class="stat-section">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <div class="stat-number">4</div>
                            <div class="stat-label">Lapangan Futsal</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Member Aktif</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-number">5+</div>
                            <div class="stat-label">Tahun Berdiri</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-smile"></i>
                            </div>
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Kepuasan Pelanggan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stat Section End -->

        <!-- Fasilitas Section Start -->
        <div class="fasilitas-section">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-label">Fasilitas Unggulan</div>
                    <h2 class="section-title">Kenapa Harus <span>Futsal Muntrik</span>?</h2>
                    <p class="about-text mb-5" style="max-width: 700px; margin: 0 auto 48px auto;">Kami menyediakan berbagai fasilitas terbaik untuk kenyamanan bermain Anda</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="fasilitas-card">
                            <div class="fasilitas-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="fasilitas-body">
                                <h4>Lantai Vinyl Anti-Slip</h4>
                                <p>Lantai berkualitas tinggi standar internasional yang aman dan nyaman untuk bermain futsal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="fasilitas-card">
                            <div class="fasilitas-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="fasilitas-body">
                                <h4>Pencahayaan LED Profesional</h4>
                                <p>Pencahayaan 1500 lux di semua lapangan menjamin kenyamanan bermain malam hari</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="fasilitas-card">
                            <div class="fasilitas-icon">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="fasilitas-body">
                                <h4>Ruang Ganti & Shower</h4>
                                <p>Fasilitas ruang ganti, shower, dan loker untuk kenyamanan Anda sebelum dan sesudah bermain</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="fasilitas-card">
                            <div class="fasilitas-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="fasilitas-body">
                                <h4>Kantin & Area Santai</h4>
                                <p>Tersedia kantin dengan berbagai pilihan makanan dan minuman serta area santai yang nyaman</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="fasilitas-card">
                            <div class="fasilitas-icon">
                                <i class="fas fa-parking"></i>
                            </div>
                            <div class="fasilitas-body">
                                <h4>Area Parkir Luas</h4>
                                <p>Parkir yang luas dan aman untuk kendaraan roda dua maupun roda empat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="fasilitas-card">
                            <div class="fasilitas-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="fasilitas-body">
                                <h4>Booking Online 24/7</h4>
                                <p>Sistem booking online yang mudah dan cepat, bisa diakses kapan saja tanpa antri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fasilitas Section End -->

        <!-- Timeline Section Start -->
        <div class="timeline-section">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-label">Perjalanan Kami</div>
                    <h2 class="section-title">Sejarah <span>Futsal Muntrik</span></h2>
                    <p class="about-text mb-5" style="max-width: 700px; margin: 0 auto 48px auto;">Perjalanan panjang kami dalam memberikan layanan futsal terbaik</p>
                </div>
                <div class="timeline">
                    <div class="timeline-item wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2019</div>
                            <div class="timeline-title">Awal Berdiri</div>
                            <div class="timeline-text">Futsal Muntrik resmi berdiri dengan 2 lapangan futsal sederhana namun berkualitas di kawasan Muntrik.</div>
                        </div>
                    </div>
                    <div class="timeline-item wow fadeInRight" data-wow-delay="0.2s">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2021</div>
                            <div class="timeline-title">Ekspansi Lapangan</div>
                            <div class="timeline-text">Menambah 2 lapangan lagi sehingga total menjadi 4 lapangan dengan fasilitas yang semakin lengkap.</div>
                        </div>
                    </div>
                    <div class="timeline-item wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2022</div>
                            <div class="timeline-title">Renovasi Total</div>
                            <div class="timeline-text">Melakukan renovasi total dengan lantai vinyl standar internasional dan pencahayaan LED profesional.</div>
                        </div>
                    </div>
                    <div class="timeline-item wow fadeInRight" data-wow-delay="0.4s">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-year">2024</div>
                            <div class="timeline-title">Booking Online</div>
                            <div class="timeline-text">Meluncurkan sistem booking online 24/7 untuk memudahkan pelanggan dalam melakukan reservasi.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Timeline Section End -->

        <!-- CTA Section Start -->
        <div class="cta-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Siap Bermain <span>Futsal</span>?</h2>
                        <p>Booking lapangan sekarang dan rasakan pengalaman bermain futsal terbaik bersama teman-teman Anda!</p>
                        <a href="product.php" class="btn-cta">Booking Sekarang →</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CTA Section End -->

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
        </script>
    </body>
</html>