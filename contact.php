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
        <title>Kontak Kami - Futsal Muntrik | Sewa Lapangan Futsal</title>
        <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="futsal, sewa lapangan futsal, booking lapangan, futsal muntrik, kontak">
        <meta name="description" content="Hubungi Futsal Muntrik untuk informasi lebih lanjut tentang sewa lapangan futsal, booking, dan kerjasama.">

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

            /* ===== CONTACT SECTION ===== */
            .contact-section {
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

            .contact-info-card {
                background: var(--abu-gelap);
                border: 1px solid #252525;
                border-radius: 10px;
                padding: 30px;
                transition: transform 0.25s, border-color 0.25s;
                height: 100%;
            }

            .contact-info-card:hover {
                transform: translateY(-5px);
                border-color: var(--hijau);
            }

            .contact-icon {
                width: 60px;
                height: 60px;
                background: rgba(29, 185, 84, 0.1);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
            }

            .contact-icon i {
                font-size: 28px;
                color: var(--hijau);
            }

            .contact-info-card h4 {
                font-family: 'Rajdhani', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--putih);
                margin-bottom: 12px;
            }

            .contact-info-card p, 
            .contact-info-card a {
                color: #aaa;
                font-size: 0.9rem;
                line-height: 1.6;
                margin: 0;
                text-decoration: none;
                transition: color 0.2s;
            }

            .contact-info-card a:hover {
                color: var(--hijau);
            }

            /* Form Styling */
            .contact-form {
                background: var(--abu-gelap);
                border: 1px solid #252525;
                border-radius: 10px;
                padding: 40px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-control-custom {
                background: var(--abu-sedang) !important;
                border: 1px solid #333 !important;
                color: var(--putih) !important;
                border-radius: 8px !important;
                font-size: 0.9rem;
                padding: 12px 16px;
                width: 100%;
                transition: all 0.2s;
            }

            .form-control-custom:focus {
                border-color: var(--hijau) !important;
                box-shadow: 0 0 0 2px rgba(29, 185, 84, 0.2) !important;
                outline: none;
            }

            .form-control-custom::placeholder {
                color: #555 !important;
            }

            textarea.form-control-custom {
                resize: vertical;
                min-height: 120px;
            }

            .btn-submit {
                background: var(--hijau);
                color: var(--hitam);
                font-family: 'Rajdhani', sans-serif;
                font-weight: 700;
                font-size: 1rem;
                letter-spacing: 1px;
                padding: 14px 30px;
                border-radius: 8px;
                border: none;
                text-transform: uppercase;
                transition: all 0.2s;
                width: 100%;
            }

            .btn-submit:hover {
                background: var(--hijau-gelap);
                transform: translateY(-2px);
            }

            /* Map Styling */
            .map-container {
                background: var(--abu-gelap);
                border: 1px solid #252525;
                border-radius: 10px;
                overflow: hidden;
                height: 100%;
                min-height: 400px;
            }

            .map-container iframe {
                width: 100%;
                height: 100%;
                min-height: 400px;
                border: none;
            }

            /* Social Media Section */
            .social-section {
                background: var(--hitam);
                padding: 60px 0;
                text-align: center;
            }

            .social-icons {
                display: flex;
                justify-content: center;
                gap: 20px;
                flex-wrap: wrap;
            }

            .social-icon {
                width: 60px;
                height: 60px;
                background: var(--abu-gelap);
                border: 1px solid #252525;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s;
                text-decoration: none;
            }

            .social-icon i {
                font-size: 24px;
                color: #aaa;
                transition: color 0.2s;
            }

            .social-icon:hover {
                border-color: var(--hijau);
                transform: translateY(-3px);
            }

            .social-icon:hover i {
                color: var(--hijau);
            }

            /* Alert Message */
            .alert-message {
                background: rgba(29, 185, 84, 0.1);
                border: 1px solid var(--hijau);
                border-radius: 8px;
                padding: 15px 20px;
                margin-bottom: 20px;
                color: var(--hijau);
                font-size: 0.9rem;
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

            @media (max-width: 768px) {
                .section-title {
                    font-size: 2rem;
                }
                .page-header h1 {
                    font-size: 2.2rem;
                }
                .contact-form {
                    padding: 25px;
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
                        <a href="product.php" class="nav-item nav-link">Lapangan</a>
                        <a href="contact.php" class="nav-item nav-link active">Kontak</a>
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
                    <h1 class="mb-3 wow fadeInDown" data-wow-delay="0.1s">Hubungi <span>Kami</span></h1>
                    <nav aria-label="breadcrumb wow fadeInDown" data-wow-delay="0.2s">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header End -->
        </div>

        <!-- Contact Section Start -->
        <div class="contact-section">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-label">Hubungi Kami</div>
                    <h2 class="section-title">Siap <span>Membantu</span> Anda</h2>
                    <p class="about-text mb-5" style="max-width: 700px; margin: 0 auto 48px auto;">
                        Punya pertanyaan tentang lapangan, booking, atau kerjasama? Tim kami siap membantu Anda 24/7.
                        Hubungi kami melalui form di bawah atau kunjungi langsung venue kami.
                    </p>
                </div>

                <div class="row g-4">
                    <!-- Contact Info Cards -->
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4>Alamat Kami</h4>
                            <p>Jl. Muntrik No. 12, Kota Anda</p>
                            <p class="mt-2" style="font-size: 0.85rem; color: #666;">Google Maps: "Futsal Muntrik"</p>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h4>Nomor Telepon</h4>
                            <a href="tel:08128770xxxx">0812-8770-XXXX</a>
                            <p class="mt-2" style="font-size: 0.85rem; color: #666;">(Customer Service)</p>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4>Email</h4>
                            <a href="mailto:futsalmuntrik@gmail.com">futsalmuntrik@gmail.com</a>
                            <p class="mt-2" style="font-size: 0.85rem; color: #666;">Respon dalam 1x24 jam</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    <!-- Contact Form -->
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="contact-form">
                            <h3 class="mb-4" style="font-family: 'Rajdhani', sans-serif; color: var(--putih);">Kirim Pesan <span style="color: var(--hijau);">Sekarang</span></h3>
                            
                            <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
                                <div class="alert-message">
                                    <i class="fas fa-check-circle me-2"></i> Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.
                                </div>
                            <?php endif; ?>

                            <form method="post" action="proses_kontak.php">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control-custom" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control-custom" placeholder="Alamat Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="tel" name="telepon" class="form-control-custom" placeholder="No. WhatsApp">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control-custom" placeholder="Subject" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control-custom" placeholder="Tulis pesan Anda di sini..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-submit">
                                            Kirim Pesan <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Google Maps -->
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15864.531235252402!2d106.87684175000001!3d-6.2462237499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f302d5388fd7%3A0x7fb9848b2f70fba1!2sMontrik%20Futsal%20(M-trik)!5e0!3m2!1sid!2sid!4v1780974962269!5m2!1sid!2sid"" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Section End -->

        <!-- Social Media Section Start -->
        <div class="social-section">
            <div class="container">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-label">Ikuti Kami</div>
                    <h2 class="section-title">Media <span>Sosial</span></h2>
                    <p class="about-text mb-5" style="max-width: 600px; margin: 0 auto 30px auto;">
                        Dapatkan informasi promo terbaru dan update jadwal lapangan melalui media sosial kami
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Social Media Section End -->

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