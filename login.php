<!doctype html>
<html lang="id">
  <?php
    session_start();
    include 'koneksi.php';
  ?>

  <head>
    <meta charset="utf-8">
    <title>Login | Futsal Muntrik - Sewa Lapangan Futsal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="futsal, login, daftar, sewa lapangan, futsal muntrik">
    <meta name="description" content="Login ke akun Futsal Muntrik untuk melakukan booking lapangan futsal secara online.">

    <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">

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

      h1, h2, h3, h4, h5, h6 {
        font-family: 'Rajdhani', sans-serif !important;
      }

      body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #0a0a0a 0%, #0d2a1a 100%);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
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

      /* Field pattern overlay */
      body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(29,185,84,0.05) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
      }

      .login-container {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .login-card {
        background: rgba(20, 20, 20, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(29, 185, 84, 0.2);
        border-radius: 16px;
        max-width: 450px;
        width: 100%;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease, border-color 0.3s ease;
      }

      .login-card:hover {
        border-color: rgba(29, 185, 84, 0.5);
        transform: translateY(-5px);
      }

      .login-header {
        text-align: center;
        padding: 30px 30px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .login-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--hijau), var(--hijau-gelap));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        box-shadow: 0 0 20px rgba(29, 185, 84, 0.3);
      }

      .login-icon i {
        font-size: 32px;
        color: var(--hitam);
      }

      .login-header h2 {
        color: var(--putih);
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
      }

      .login-header h2 span {
        color: var(--hijau);
      }

      .login-header p {
        color: #888;
        font-size: 0.85rem;
        margin: 0;
      }

      .login-body {
        padding: 30px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-label {
        display: block;
        color: #aaa;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
      }

      .input-group-custom {
        position: relative;
      }

      .input-group-custom i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #555;
        font-size: 16px;
        z-index: 2;
      }

      .form-control-custom {
        width: 100%;
        padding: 12px 15px 12px 45px;
        background: var(--abu-sedang);
        border: 1px solid #333;
        border-radius: 10px;
        color: var(--putih);
        font-size: 0.9rem;
        transition: all 0.2s ease;
      }

      .form-control-custom:focus {
        outline: none;
        border-color: var(--hijau);
        box-shadow: 0 0 0 2px rgba(29, 185, 84, 0.2);
      }

      .form-control-custom::placeholder {
        color: #555;
      }

      .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .form-check-input {
        width: 18px;
        height: 18px;
        background-color: var(--abu-sedang);
        border: 1px solid #444;
        cursor: pointer;
      }

      .form-check-input:checked {
        background-color: var(--hijau);
        border-color: var(--hijau);
      }

      .form-check-label {
        color: #888;
        font-size: 0.85rem;
        cursor: pointer;
      }

      .forgot-link {
        color: var(--hijau);
        font-size: 0.85rem;
        text-decoration: none;
        transition: color 0.2s;
      }

      .forgot-link:hover {
        color: var(--hijau-gelap);
        text-decoration: underline;
      }

      .btn-login {
        width: 100%;
        padding: 14px;
        background: var(--hijau);
        border: none;
        border-radius: 10px;
        color: var(--hitam);
        font-family: 'Rajdhani', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.2s ease;
        margin-top: 10px;
      }

      .btn-login:hover {
        background: var(--hijau-gelap);
        transform: translateY(-2px);
      }

      .register-link {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 10px;
      }

      .register-link p {
        color: #888;
        font-size: 0.85rem;
        margin: 0;
      }

      .register-link a {
        color: var(--hijau);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
      }

      .register-link a:hover {
        color: var(--hijau-gelap);
        text-decoration: underline;
      }

      /* Alert styling */
      .alert-danger {
        background: rgba(231, 76, 60, 0.1);
        border: 1px solid #e74c3c;
        border-radius: 10px;
        color: #e74c3c;
        padding: 12px 15px;
        font-size: 0.85rem;
        margin-bottom: 20px;
      }

      .alert-success {
        background: rgba(29, 185, 84, 0.1);
        border: 1px solid var(--hijau);
        border-radius: 10px;
        color: var(--hijau);
        padding: 12px 15px;
        font-size: 0.85rem;
        margin-bottom: 20px;
      }

      /* Floating shapes decoration */
      .floating-shape {
        position: fixed;
        z-index: 0;
        opacity: 0.05;
        pointer-events: none;
      }

      .shape-1 {
        top: 10%;
        left: 5%;
        width: 150px;
        height: 150px;
        border-radius: 30px;
        background: var(--hijau);
        transform: rotate(45deg);
      }

      .shape-2 {
        bottom: 10%;
        right: 5%;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: var(--hijau);
      }

      .shape-3 {
        top: 50%;
        right: 10%;
        width: 100px;
        height: 100px;
        border-radius: 20px;
        background: var(--hijau);
        transform: rotate(15deg);
      }

      @media (max-width: 576px) {
        .login-body {
          padding: 20px;
        }
        .login-header {
          padding: 25px 25px 15px;
        }
        .login-header h2 {
          font-size: 1.5rem;
        }
      }
    </style>
  </head>

  <body>
    <!-- Decorative floating shapes -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>

    <div class="login-container">
      <div class="login-card wow fadeInUp" data-wow-delay="0.1s">
        <div class="login-header">
          <div class="login-icon">
            <i class="fas fa-futbol"></i>
          </div>
          <h2>FUTSAL <span>MUNTRIK</span></h2>
          <p>Login untuk booking lapangan futsal</p>
        </div>

        <div class="login-body">
          <!-- Error message if any -->
          <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="alert-danger">
              <i class="fas fa-exclamation-circle me-2"></i> Username atau password salah!
            </div>
          <?php endif; ?>

          <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert-success">
              <i class="fas fa-check-circle me-2"></i> Pendaftaran berhasil! Silakan login.
            </div>
          <?php endif; ?>

          <?php if (isset($_GET['logout']) && $_GET['logout'] == 1): ?>
            <div class="alert-success">
              <i class="fas fa-sign-out-alt me-2"></i> Anda berhasil logout.
            </div>
          <?php endif; ?>

          <form action="proses_login.php" method="post">
            <div class="form-group">
              <label class="form-label">Username / Email</label>
              <div class="input-group-custom">
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="form-control-custom" placeholder="Masukkan username atau email" required autofocus>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Password</label>
              <div class="input-group-custom">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control-custom" placeholder="Masukkan password" required>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Ingat Saya</label>
              </div>
              <a href="lupapw.php" class="forgot-link">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-login">
              <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
          </form>

          <div class="register-link">
            <p>Belum punya akun? <a href="daftar.php">Daftar Sekarang</a></p>
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