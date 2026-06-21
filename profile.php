<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

$query = $koneksi->query("SELECT * FROM users WHERE id = '$id_user'");
$user = $query->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);

    if ($_FILES['foto']['name'] != '') {
        $namaFile = $_FILES['foto']['name'];
        $lokasiTmp = $_FILES['foto']['tmp_name'];
        $ekstensi = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaBaru = 'uploads/user_' . time() . '.' . $ekstensi;

        // Buat folder uploads jika belum ada
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        move_uploaded_file($lokasiTmp, $namaBaru);

        if ($user['foto'] && file_exists($user['foto']) && $user['foto'] != 'assets/landing/img/avatar.png') {
            unlink($user['foto']);
        }

        $koneksi->query("UPDATE users SET nama='$nama', email='$email', foto='$namaBaru' WHERE id='$id_user'");
        $_SESSION['foto'] = $namaBaru;
    } else {
        $koneksi->query("UPDATE users SET nama='$nama', email='$email' WHERE id='$id_user'");
    }

    $_SESSION['nama'] = $nama;
    echo "<script>alert('Profil berhasil diperbarui'); window.location='profile.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Profil Saya - Futsal Muntrik</title>
    <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="futsal, profil, user, futsal muntrik">
    <meta name="description" content="Halaman profil pengguna Futsal Muntrik">

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

        /* Profile Container */
        .profile-container {
            position: relative;
            z-index: 1;
            padding: 80px 0;
        }

        .profile-card {
            background: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(29, 185, 84, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            border-color: rgba(29, 185, 84, 0.5);
            transform: translateY(-5px);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--abu-sedang), var(--abu-gelap));
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(29, 185, 84, 0.2);
        }

        .profile-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--hijau);
            box-shadow: 0 0 20px rgba(29, 185, 84, 0.3);
            background: var(--abu-sedang);
        }

        .profile-header h3 {
            color: var(--putih);
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .profile-header p {
            color: var(--hijau);
            margin: 0;
            font-size: 0.9rem;
        }

        .profile-body {
            padding: 30px;
        }

        .form-label {
            color: var(--putih-lunak);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-label i {
            color: var(--hijau);
            margin-right: 8px;
        }

        .form-control-custom {
            background: var(--abu-sedang);
            border: 1px solid #333;
            border-radius: 10px;
            color: var(--putih);
            font-size: 0.95rem;
            padding: 12px 16px;
            width: 100%;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: var(--hijau);
            box-shadow: 0 0 0 2px rgba(29, 185, 84, 0.2);
            outline: none;
        }

        .form-control-custom::placeholder {
            color: #555;
        }

        input[type="file"] {
            background: var(--abu-sedang);
            border: 1px solid #333;
            border-radius: 10px;
            color: var(--putih-lunak);
            padding: 10px;
            width: 100%;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: var(--hijau);
            border: none;
            border-radius: 6px;
            padding: 6px 15px;
            margin-right: 15px;
            color: var(--hitam);
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background: var(--hijau-gelap);
        }

        .btn-custom {
            padding: 12px 28px;
            border-radius: 10px;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.2s;
            min-width: 140px;
        }

        .btn-primary-custom {
            background: var(--hijau);
            border: none;
            color: var(--hitam);
        }

        .btn-primary-custom:hover {
            background: var(--hijau-gelap);
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background: var(--abu-sedang);
            border: 1px solid #444;
            color: var(--putih-lunak);
        }

        .btn-secondary-custom:hover {
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

        hr {
            border-color: rgba(29, 185, 84, 0.2);
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 40px 20px;
            }
            .btn-custom {
                min-width: 120px;
                padding: 10px 20px;
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

    <!-- Profile Content -->
    <div class="profile-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <div class="profile-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="profile-header">
                            <img src="<?php echo htmlspecialchars($user['foto'] ?: 'assets/landing/img/avatar.png'); ?>" class="profile-img" alt="Foto Profil">
                            <h3><?php echo htmlspecialchars($user['nama']); ?></h3>
                            <p><i class="fas fa-map-marker-alt"></i> Member Futsal Muntrik</p>
                        </div>
                        <div class="profile-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <label class="form-label"><i class="fas fa-camera"></i> Ganti Foto Profil</label>
                                    <input type="file" name="foto" class="form-control-custom" accept="image/*" style="padding: 10px;">
                                    <small class="text-muted" style="color: #666 !important; font-size: 0.7rem;">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control-custom" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"><i class="fas fa-envelope"></i> Alamat Email</label>
                                    <input type="email" name="email" class="form-control-custom" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between gap-3">
                                    <a href="index.php" class="btn btn-secondary-custom btn-custom">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary-custom btn-custom">
                                        <i class="fas fa-save me-2"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
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