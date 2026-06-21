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
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <title>Futsal Muntrik - Sewa Lapangan Futsal</title>
        <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="futsal, sewa lapangan futsal, booking lapangan, futsal muntrik">
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

            /* ===== HERO SECTION ===== */
            .hero-section {
                position: relative;
                min-height: 90vh;
                display: flex;
                align-items: center;
                overflow: hidden;
                background: #080e09;
            }

            .hero-bg {
                position: absolute;
                inset: 0;
                z-index: 0;
            }

            .hero-bg svg {
                width: 100%;
                height: 100%;
                opacity: 0.07;
            }

            .hero-glow {
                position: absolute;
                inset: 0;
                z-index: 1;
                background: radial-gradient(ellipse 70% 60% at 60% 50%, rgba(29,185,84,0.13) 0%, transparent 70%);
            }

            .hero-texture {
                position: absolute;
                inset: 0;
                z-index: 1;
                background-image: repeating-linear-gradient(-45deg, transparent, transparent 40px, rgba(29,185,84,0.02) 40px, rgba(29,185,84,0.02) 41px);
            }

            .hero-accent-bar {
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 4px;
                background: var(--hijau);
                z-index: 3;
            }

            .hero-content {
                position: relative;
                z-index: 5;
                width: 100%;
            }

            .hero-inner {
                max-width: 700px;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: rgba(29,185,84,0.12);
                border: 1px solid rgba(29,185,84,0.35);
                color: var(--hijau);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.82rem;
                letter-spacing: 2px;
                text-transform: uppercase;
                padding: 6px 16px;
                border-radius: 4px;
                margin-bottom: 1.4rem;
            }

            .hero-badge::before {
                content: '';
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: var(--hijau);
                animation: pulse-dot 2s infinite;
            }

            @keyframes pulse-dot {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(0.7); }
            }

            .hero-title {
                font-family: 'Rajdhani', sans-serif !important;
                font-size: 4.5rem;
                font-weight: 700;
                color: #fff;
                line-height: 1.1;
                margin-bottom: 1.2rem;
                letter-spacing: -1px;
            }

            .hero-title span {
                color: var(--hijau);
                display: block;
            }

            .hero-sub {
                font-size: 1rem;
                color: #888;
                margin-bottom: 2rem;
                font-weight: 400;
                line-height: 1.7;
                max-width: 520px;
            }

            .hero-cta-row {
                display: flex;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .btn-hero {
                background: var(--hijau);
                color: var(--hitam) !important;
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.95rem;
                letter-spacing: 1px;
                padding: 12px 32px;
                border-radius: 6px;
                border: none;
                text-transform: uppercase;
                transition: all 0.2s;
                text-decoration: none;
                display: inline-block;
            }

            .btn-hero:hover {
                background: var(--hijau-gelap);
                transform: translateY(-2px);
            }

            .btn-hero-outline {
                background: transparent;
                color: #ccc !important;
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.95rem;
                letter-spacing: 1px;
                padding: 11px 28px;
                border-radius: 6px;
                border: 1.5px solid #333;
                text-transform: uppercase;
                transition: all 0.2s;
                text-decoration: none;
                display: inline-block;
            }

            .btn-hero-outline:hover {
                border-color: var(--hijau);
                color: var(--hijau) !important;
            }

            .hero-field-graphic {
                position: absolute;
                right: -40px;
                top: 50%;
                transform: translateY(-50%);
                width: 480px;
                z-index: 4;
                opacity: 0.5;
            }

            @media (max-width: 991px) {
                .hero-field-graphic { display: none; }
                .hero-title { font-size: 2.8rem; }
            }

            /* ===== STAT BAR ===== */
            .stat-bar {
                background: var(--abu-gelap);
                border-top: 1px solid #222;
                border-bottom: 1px solid #222;
                padding: 25px 0;
            }

            .stat-item {
                text-align: center;
                padding: 0 20px;
            }

            .stat-number {
                font-family: 'Rajdhani', sans-serif;
                font-size: 2.2rem;
                font-weight: 700;
                color: var(--hijau);
                line-height: 1;
            }

            .stat-label {
                font-size: 0.75rem;
                color: #888;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-top: 4px;
            }

            .stat-divider {
                width: 1px;
                height: 45px;
                background: #333;
            }

            /* ===== ABOUT ===== */
            .about {
                background: var(--hitam-lunak);
                padding: 70px 0;
            }

            .section-label {
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 3px;
                text-transform: uppercase;
                color: var(--hijau);
                margin-bottom: 12px;
            }

            .section-title {
                font-family: 'Rajdhani', sans-serif;
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--putih);
                line-height: 1.2;
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
                height: 420px;
                object-fit: cover;
                border-radius: 10px;
                filter: brightness(0.75);
            }

            .about-badge {
                position: absolute;
                bottom: 20px;
                left: 20px;
                background: var(--hijau);
                color: var(--hitam);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.9rem;
                padding: 8px 18px;
                border-radius: 6px;
            }

            .about-text {
                color: #aaa;
                line-height: 1.7;
                font-size: 0.9rem;
            }

            .feature-check {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 12px;
            }

            .check-icon {
                width: 22px;
                height: 22px;
                background: rgba(29, 185, 84, 0.15);
                border: 1.5px solid var(--hijau);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .check-icon i {
                font-size: 10px;
                color: var(--hijau);
            }

            .check-text {
                font-size: 0.85rem;
                color: #ccc;
            }

            .btn-about {
                background: transparent;
                color: var(--hijau);
                border: 1.5px solid var(--hijau);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.85rem;
                letter-spacing: 1px;
                padding: 10px 28px;
                border-radius: 6px;
                text-transform: uppercase;
                transition: all 0.2s;
                text-decoration: none;
                display: inline-block;
            }

            .btn-about:hover {
                background: var(--hijau);
                color: var(--hitam);
            }

            /* ===== LAPANGAN SECTION ===== */
            .section-lapangan {
                background: var(--hitam);
                padding: 70px 0;
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
                transform: translateY(-5px);
                border-color: var(--hijau);
            }

            .product-card img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                display: block;
            }

            .product-body {
                padding: 18px;
            }

            .product-tag {
                display: inline-block;
                font-size: 0.65rem;
                font-weight: 600;
                letter-spacing: 1px;
                text-transform: uppercase;
                background: rgba(29, 185, 84, 0.12);
                color: var(--hijau);
                padding: 3px 10px;
                border-radius: 4px;
                margin-bottom: 10px;
            }

            .product-name {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--putih);
                margin-bottom: 8px;
            }

            .product-price {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--hijau);
                margin-bottom: 10px;
            }

            .product-price small {
                font-size: 0.65rem;
                color: #888;
                font-weight: 400;
            }

            .product-desc {
                color: #aaa;
                font-size: 0.8rem;
                line-height: 1.5;
                margin-bottom: 15px;
            }

            .btn-detail {
                background: var(--hijau);
                color: var(--hitam) !important;
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 0.8rem;
                letter-spacing: 0.5px;
                padding: 8px 18px;
                border-radius: 6px;
                border: none;
                text-transform: uppercase;
                transition: background 0.2s;
                width: 100%;
            }

            .btn-detail:hover {
                background: var(--hijau-gelap);
            }

            .view-all-link {
                color: var(--hijau);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 600;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                text-decoration: none;
                border-bottom: 1px solid var(--hijau);
                padding-bottom: 2px;
            }

            .view-all-link:hover {
                opacity: 0.75;
                color: var(--hijau);
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
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--putih) !important;
            }

            .modal-body label {
                font-size: 0.7rem;
                font-weight: 500;
                color: #aaa;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 4px;
            }

            .form-control {
                background: var(--abu-sedang) !important;
                border: 1px solid #333 !important;
                color: var(--putih) !important;
                border-radius: 6px !important;
                font-size: 0.85rem;
                padding: 8px 12px;
            }

            .form-control:focus {
                border-color: var(--hijau) !important;
                box-shadow: 0 0 0 2px rgba(29, 185, 84, 0.2) !important;
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
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                padding: 10px 20px;
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

            .modal-img {
                width: 100%;
                border-radius: 8px;
                height: 160px;
                object-fit: cover;
            }

            /* Duration options */
            .duration-option {
                background: var(--abu-sedang);
                border: 2px solid #333;
                border-radius: 8px;
                padding: 8px 12px;
                margin-bottom: 8px;
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
                font-size: 0.9rem;
                font-weight: 700;
                color: var(--putih);
            }

            .duration-price {
                font-size: 0.95rem;
                font-weight: 700;
                color: var(--hijau);
            }

            .total-price {
                background: linear-gradient(135deg, var(--hijau-tua), var(--hijau-gelap));
                border-radius: 10px;
                padding: 12px;
                text-align: center;
                margin-top: 12px;
            }

            .total-price-label {
                font-size: 0.7rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: rgba(255,255,255,0.7);
            }

            .total-price-amount {
                font-size: 1.3rem;
                font-weight: 800;
                color: white;
            }

            .whatsapp-link {
                background: #25D366;
                color: white;
                padding: 8px 15px;
                border-radius: 8px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-weight: 600;
                font-size: 0.8rem;
                transition: all 0.2s;
                width: 100%;
                justify-content: center;
            }

            .whatsapp-link:hover {
                background: #128C7E;
                color: white;
            }

            .durasi-lama {
                background: rgba(255, 193, 7, 0.1);
                border: 1px solid #ffc107;
                border-radius: 10px;
                padding: 12px;
                margin-top: 8px;
                text-align: center;
            }

            .durasi-lama p {
                color: #ffc107;
                margin-bottom: 8px;
                font-size: 0.8rem;
            }

            /* Jam unavailable style */
            .jam-unavailable {
                color: #e74c3c !important;
                background: rgba(231, 76, 60, 0.1) !important;
                border-color: #e74c3c !important;
            }

            .jam-available {
                color: var(--hijau) !important;
            }

            /* Loading spinner */
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

            /* ===== FOOTER ===== */
            .footer {
                background: var(--hitam-lunak) !important;
                border-top: 1px solid #1e1e1e;
                padding: 50px 0 !important;
            }

            .footer-brand {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--hijau) !important;
            }

            .footer-desc {
                color: #666;
                font-size: 0.85rem;
                line-height: 1.6;
                margin-top: 10px;
            }

            .footer-heading {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1rem;
                font-weight: 700;
                color: #fff !important;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-bottom: 15px !important;
            }

            .footer-item a {
                color: #666 !important;
                font-size: 0.85rem;
                text-decoration: none;
                display: block;
                padding: 4px 0;
                transition: color 0.2s;
            }

            .footer-item a:hover {
                color: var(--hijau) !important;
            }

            .jam-label {
                font-size: 0.7rem;
                color: #555;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .jam-time {
                color: #ccc !important;
                font-weight: 500;
                font-size: 0.85rem;
                margin-bottom: 10px !important;
            }

            .jam-libur {
                color: #e74c3c !important;
                font-weight: 500;
                font-size: 0.85rem;
                margin-bottom: 10px !important;
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
                padding: 15px 0 !important;
            }

            .copyright span,
            .copyright a {
                color: #444 !important;
                font-size: 0.75rem;
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
            }

            .dropdown-item {
                color: #ccc !important;
                font-size: 0.85rem;
            }

            .dropdown-item:hover {
                background: rgba(29, 185, 84, 0.1) !important;
                color: var(--hijau) !important;
            }

            @media (max-width: 768px) {
                .hero-title { font-size: 2.2rem; }
                .section-title { font-size: 1.8rem; }
                .stat-divider { display: none; }
                .about-img-wrap img { height: 300px; }
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
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">Tentang Kami</a>
                        <a href="product.php" class="nav-item nav-link">Lapangan</a>
                        <a href="contact.php" class="nav-item nav-link">Kontak</a>
                        <?php if (isset($_SESSION['login'])): ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <img src="<?php echo htmlspecialchars($_SESSION['foto'] ?? 'assets/landing/img/avatar.png'); ?>" alt="Profil" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover; border: 2px solid var(--hijau);">
                                    <span class="ms-2" style="font-size:0.85rem;"><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
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
        </div>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-bg">
                <svg viewBox="0 0 1400 800" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#1DB954" stroke-width="1.5">
                    <rect x="200" y="100" width="1000" height="600" rx="0"/>
                    <line x1="700" y1="100" x2="700" y2="700"/>
                    <circle cx="700" cy="400" r="80"/>
                    <circle cx="700" cy="400" r="5" fill="#1DB954" stroke="none"/>
                    <rect x="200" y="267" width="180" height="266"/>
                    <rect x="200" y="317" width="90" height="166"/>
                    <circle cx="380" cy="400" r="5" fill="#1DB954" stroke="none"/>
                    <rect x="1020" y="267" width="180" height="266"/>
                    <rect x="1110" y="317" width="90" height="166"/>
                    <circle cx="1020" cy="400" r="5" fill="#1DB954" stroke="none"/>
                    <rect x="160" y="350" width="40" height="100"/>
                    <rect x="1200" y="350" width="40" height="100"/>
                    <path d="M200,120 A20,20 0 0,1 220,100"/>
                    <path d="M1180,100 A20,20 0 0,1 1200,120"/>
                    <path d="M1200,680 A20,20 0 0,1 1180,700"/>
                    <path d="M220,700 A20,20 0 0,1 200,680"/>
                    <circle cx="700" cy="400" r="3" fill="#1DB954" stroke="none"/>
                </svg>
            </div>
            <div class="hero-glow"></div>
            <div class="hero-texture"></div>
            <div class="hero-accent-bar"></div>

            <div class="hero-field-graphic">
                <svg viewBox="0 0 480 320" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <rect x="10" y="10" width="460" height="300" rx="4" fill="rgba(29,185,84,0.06)" stroke="rgba(29,185,84,0.3)" stroke-width="1.5"/>
                    <rect x="10" y="10" width="46" height="300" fill="rgba(29,185,84,0.04)"/>
                    <rect x="102" y="10" width="46" height="300" fill="rgba(29,185,84,0.04)"/>
                    <rect x="194" y="10" width="46" height="300" fill="rgba(29,185,84,0.04)"/>
                    <rect x="286" y="10" width="46" height="300" fill="rgba(29,185,84,0.04)"/>
                    <rect x="378" y="10" width="46" height="300" fill="rgba(29,185,84,0.04)"/>
                    <line x1="240" y1="10" x2="240" y2="310" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
                    <circle cx="240" cy="160" r="50" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
                    <circle cx="240" cy="160" r="4" fill="rgba(255,255,255,0.8)"/>
                    <rect x="10" y="107" width="90" height="106" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
                    <rect x="10" y="127" width="45" height="66" stroke="rgba(255,255,255,0.35)" stroke-width="1"/>
                    <circle cx="100" cy="160" r="3" fill="rgba(255,255,255,0.7)"/>
                    <rect x="380" y="107" width="90" height="106" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
                    <rect x="425" y="127" width="45" height="66" stroke="rgba(255,255,255,0.35)" stroke-width="1"/>
                    <circle cx="380" cy="160" r="3" fill="rgba(255,255,255,0.7)"/>
                    <rect x="0" y="135" width="10" height="50" fill="rgba(29,185,84,0.3)" stroke="rgba(29,185,84,0.6)" stroke-width="1"/>
                    <rect x="470" y="135" width="10" height="50" fill="rgba(29,185,84,0.3)" stroke="rgba(29,185,84,0.6)" stroke-width="1"/>
                    <circle cx="160" cy="0" r="6" fill="rgba(29,185,84,0.8)"/>
                    <circle cx="240" cy="0" r="6" fill="rgba(29,185,84,0.8)"/>
                    <circle cx="320" cy="0" r="6" fill="rgba(29,185,84,0.8)"/>
                    <circle cx="160" cy="320" r="6" fill="rgba(29,185,84,0.8)"/>
                    <circle cx="240" cy="320" r="6" fill="rgba(29,185,84,0.8)"/>
                    <circle cx="320" cy="320" r="6" fill="rgba(29,185,84,0.8)"/>
                </svg>
            </div>

            <div class="container hero-content">
                <div class="hero-inner">
                    <div class="hero-badge">Futsal Muntrik — Booking Online</div>
                    <h1 class="hero-title">
                        Lapangan Terbaik,
                        <span>Permainan Terhebat</span>
                    </h1>
                    <p class="hero-sub">
                        Fasilitas premium, lantai vinyl anti-slip, pencahayaan LED profesional.<br>
                        Reservasi mudah 24 jam, langsung konfirmasi otomatis.
                    </p>
                    <div class="hero-cta-row">
                        <a class="btn-hero" href="#lapangan">⚽ Booking Sekarang</a>
                        <a class="btn-hero-outline" href="about.php">Lihat Fasilitas →</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stat Bar -->
        <div class="stat-bar">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">
                    <div class="stat-item">
                        <div class="stat-number">4</div>
                        <div class="stat-label">Lapangan</div>
                    </div>
                    <div class="stat-divider d-none d-md-block"></div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Member Aktif</div>
                    </div>
                    <div class="stat-divider d-none d-md-block"></div>
                    <div class="stat-item">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                    <div class="stat-divider d-none d-md-block"></div>
                    <div class="stat-item">
                        <div class="stat-number">09.00</div>
                        <div class="stat-label">Buka Setiap Hari</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="about">
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
                        <a href="about.php" class="btn-about mt-4">Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lapangan Section -->
        <div class="section-lapangan" id="lapangan">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-label">Booking Sekarang</div>
                    <h2 class="section-title">Lapangan <span>Futsal Tersedia</span></h2>
                    <p class="about-text mb-5" style="max-width: 600px; margin: 0 auto 40px auto;">Pilih lapangan futsal favorit Anda dan lakukan booking secara online dengan mudah</p>
                </div>

                <div class="row g-4">
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM produk LIMIT 3");
                    while ($perproduk = $ambil->fetch_assoc()):
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
                                        echo strlen($deskripsi) > 80 ? substr($deskripsi, 0, 80) . '...' : $deskripsi;
                                        ?>
                                    </div>
                                    <button type="button" class="btn-detail" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $perproduk['id_produk']; ?>">
                                        Booking Lapangan →
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL BOOKING -->
                        <div class="modal fade" id="modal_<?php echo $perproduk['id_produk']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">⚽ Booking — <?php echo htmlspecialchars($perproduk['nama_produk']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-4">
                                            <div class="col-md-5">
                                                <img src="foto_produk/<?php echo htmlspecialchars($perproduk['foto_produk']); ?>" class="modal-img">
                                                <div class="mt-3">
                                                    <p class="text-muted small mb-1">Deskripsi Lapangan</p>
                                                    <p class="small"><?php echo nl2br(htmlspecialchars(substr($perproduk['deskripsi_produk'], 0, 150))); ?></p>
                                                </div>
                                                <div class="mt-3">
                                                    <p class="text-muted small mb-1">Harga</p>
                                                    <p class="fw-bold text-success">Rp <?php echo number_format($harga_per_jam, 0, ',', '.'); ?> <small class="text-muted">/jam</small></p>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <!-- Info Bank -->
                                                <div class="bg-dark p-3 rounded mb-3">
                                                    <p class="text-success fw-bold mb-2"><i class="fas fa-credit-card"></i> Informasi Pembayaran</p>
                                                    <div class="d-flex gap-3 flex-wrap">
                                                        <div>
                                                            <small class="text-secondary">BCA</small>
                                                            <p class="fw-bold mb-0">123 456 7890</p>
                                                            <small class="text-secondary">a.n FUTSAL MUNTRIK</small>
                                                        </div>
                                                        <div>
                                                            <small class="text-secondary">DANA</small>
                                                            <p class="fw-bold mb-0">0812-8770-2628</p>
                                                            <small class="text-secondary">a.n FUTSAL MUNTRIK</small>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                    <small class="text-warning"><i class="fas fa-info-circle"></i> Upload bukti transfer setelah booking</small>
                                                </div>

                                                <form method="post" action="beli.php?id=<?php echo $perproduk['id_produk']; ?>" enctype="multipart/form-data" id="form_<?php echo $perproduk['id_produk']; ?>">
                                                    <input type="hidden" name="durasi" id="durasi_<?php echo $perproduk['id_produk']; ?>">
                                                    <input type="hidden" name="total_harga" id="total_harga_<?php echo $perproduk['id_produk']; ?>">
                                                    
                                                    <div class="mb-3">
                                                        <label>Pilih Durasi Sewa</label>
                                                        <div id="duration_options_<?php echo $perproduk['id_produk']; ?>">
                                                            <?php foreach ([1,2,3] as $jam): ?>
                                                                <div class="duration-option" data-durasi="<?php echo $jam; ?>" data-total="<?php echo $harga_per_jam * $jam; ?>" onclick="selectDuration(<?php echo $perproduk['id_produk']; ?>, <?php echo $jam; ?>, <?php echo $harga_per_jam * $jam; ?>)">
                                                                    <div class="d-flex justify-content-between">
                                                                        <span class="duration-hour">⚽ <?php echo $jam; ?> Jam</span>
                                                                        <span class="duration-price">Rp <?php echo number_format($harga_per_jam * $jam, 0, ',', '.'); ?></span>
                                                                    </div>
                                                                    <small>Rp <?php echo number_format($harga_per_jam, 0, ',', '.'); ?> / jam</small>
                                                                </div>
                                                            <?php endforeach; ?>
                                                            <div class="durasi-lama">
                                                                <p><i class="fab fa-whatsapp"></i> Booking lebih dari 3 jam?</p>
                                                                <a href="https://wa.me/6281287702628?text=Halo%20Futsal%20Muntrik%2C%20saya%20ingin%20booking%20<?php echo urlencode($perproduk['nama_produk']); ?>%20lebih%20dari%203%20jam." class="whatsapp-link" target="_blank">
                                                                    <i class="fab fa-whatsapp"></i> Booking via WhatsApp
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="total_display_<?php echo $perproduk['id_produk']; ?>" style="display:none;" class="mb-3">
                                                        <div class="total-price">
                                                            <div class="total-price-label">Total yang harus dibayar</div>
                                                            <div class="total-price-amount" id="total_amount_<?php echo $perproduk['id_produk']; ?>">Rp 0</div>
                                                        </div>
                                                    </div>

                                                    <!-- PILIH JAM MAIN -->
                                                    <div class="mb-3">
                                                        <label>Pilih Jam Main <span class="text-danger">*</span></label>
                                                        <select name="jam_main" class="form-control" id="jam_main_<?php echo $perproduk['id_produk']; ?>" required disabled>
                                                            <option value="">-- Pilih durasi terlebih dahulu --</option>
                                                        </select>
                                                        <small class="text-secondary" id="jam_info_<?php echo $perproduk['id_produk']; ?>">Pilih durasi terlebih dahulu untuk melihat jam tersedia</small>
                                                    </div>
                                                    
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($_SESSION['nama'] ?? ''); ?>" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Email</label>
                                                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($users['email'] ?? ''); ?>" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label>No. WhatsApp</label>
                                                            <input type="tel" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Tanggal Main</label>
                                                            <input type="date" name="tanggal" class="form-control" id="tanggal_main_<?php echo $perproduk['id_produk']; ?>" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Bukti Pembayaran</label>
                                                            <input type="file" name="bukti_pembayaran" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                                                            <small class="text-secondary">Upload bukti transfer (max 2MB)</small>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn-pesan mt-3" id="submit_btn_<?php echo $perproduk['id_produk']; ?>" disabled>✔ Konfirmasi Booking</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="text-center mt-5">
                    <a href="product.php" class="view-all-link">Lihat Semua Lapangan →</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
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

        <!-- Copyright -->
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <span><i class="fas fa-copyright me-2"></i><?php echo date('Y'); ?> Futsal Muntrik — Semua hak dilindungi.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed by DimasF
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/landing/lib/wow/wow.min.js"></script>
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
                // Maksimal jam mulai agar selesai <= 24:00
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
                
                // Enable select
                select.prop('disabled', false);
                $(`#jam_info_${productId}`).text('Pilih jam mulai (' + duration + ' jam, selesai ' + duration + ' jam kemudian)');
            }
            
            function selectDuration(productId, duration, totalPrice) {
                // Hapus class selected dari semua option
                $(`#duration_options_${productId} .duration-option`).removeClass('selected');
                
                // Tambah class selected ke yang dipilih
                $(event.currentTarget).addClass('selected');
                
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
                $(`#total_amount_${productId}`).text('Rp ' + totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                
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
                if (!modalId) return;
                
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
                const form = $(`#form_${productId}`)[0];
                if (form) form.reset();
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
                if (fileInput && fileInput.files.length === 0) {
                    e.preventDefault();
                    alert('Silakan upload bukti pembayaran!');
                    return false;
                }
                
                // Check if jam is available (re-check before submit)
                const isAvailable = $(`#jam_info_${productId}`).find('.text-success').length > 0;
                if (!isAvailable) {
                    e.preventDefault();
                    alert('Maaf, jam yang dipilih tidak tersedia. Silakan pilih jam lain.');
                    return false;
                }
                
                return true;
            });

            // Smooth scroll untuk tombol booking
            $('.btn-hero[href="#lapangan"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('#lapangan').offset().top - 80
                }, 800);
            });
        </script>
    </body>
</html>