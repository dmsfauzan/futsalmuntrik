<!DOCTYPE html>
<html lang="id">
<?php
session_start();
?>
<head>
  <meta charset="UTF-8">
  <title>Daftar | Futsal Muntrik - Sewa Lapangan Futsal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="futsal, daftar, register, sewa lapangan, futsal muntrik">
  <meta name="description" content="Daftar akun Futsal Muntrik untuk melakukan booking lapangan futsal secara online dengan mudah.">

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

    .register-container {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    .register-card {
      background: rgba(20, 20, 20, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(29, 185, 84, 0.2);
      border-radius: 16px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .register-card:hover {
      border-color: rgba(29, 185, 84, 0.5);
      transform: translateY(-5px);
    }

    .register-header {
      text-align: center;
      padding: 30px 30px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .register-icon {
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

    .register-icon i {
      font-size: 32px;
      color: var(--hitam);
    }

    .register-header h2 {
      color: var(--putih);
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .register-header h2 span {
      color: var(--hijau);
    }

    .register-header p {
      color: #888;
      font-size: 0.85rem;
      margin: 0;
    }

    .register-body {
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

    /* File input styling */
    .file-input-wrapper {
      position: relative;
    }

    .file-input-wrapper i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #555;
      font-size: 16px;
      z-index: 2;
    }

    input[type="file"] {
      width: 100%;
      padding: 12px 15px 12px 45px;
      background: var(--abu-sedang);
      border: 1px solid #333;
      border-radius: 10px;
      color: var(--putih);
      font-size: 0.85rem;
      cursor: pointer;
    }

    input[type="file"]::-webkit-file-upload-button {
      background: var(--hijau);
      border: none;
      border-radius: 6px;
      padding: 6px 12px;
      margin-right: 10px;
      color: var(--hitam);
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
      background: var(--hijau-gelap);
    }

    .btn-register {
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

    .btn-register:hover {
      background: var(--hijau-gelap);
      transform: translateY(-2px);
    }

    .login-link {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      margin-top: 10px;
    }

    .login-link p {
      color: #888;
      font-size: 0.85rem;
      margin: 0;
    }

    .login-link a {
      color: var(--hijau);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .login-link a:hover {
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

    .alert-warning {
      background: rgba(241, 196, 15, 0.1);
      border: 1px solid #f1c40f;
      border-radius: 10px;
      color: #f1c40f;
      padding: 12px 15px;
      font-size: 0.85rem;
      margin-bottom: 20px;
    }

    /* Password strength indicator */
    .password-strength {
      margin-top: 8px;
      height: 4px;
      border-radius: 2px;
      transition: all 0.2s;
    }

    .strength-weak {
      width: 33%;
      background: #e74c3c;
    }

    .strength-medium {
      width: 66%;
      background: #f1c40f;
    }

    .strength-strong {
      width: 100%;
      background: var(--hijau);
    }

    .strength-text {
      font-size: 0.7rem;
      margin-top: 5px;
      color: #666;
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
      .register-body {
        padding: 20px;
      }
      .register-header {
        padding: 25px 25px 15px;
      }
      .register-header h2 {
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

  <div class="register-container">
    <div class="register-card wow fadeInUp" data-wow-delay="0.1s">
      <div class="register-header">
        <div class="register-icon">
          <i class="fas fa-futbol"></i>
        </div>
        <h2>Daftar <span>Akun</span></h2>
        <p>Buat akun untuk booking lapangan futsal</p>
      </div>

      <div class="register-body">
        <!-- Error message if any -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
          <div class="alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> Username atau email sudah terdaftar!
          </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == 2): ?>
          <div class="alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> Password tidak sesuai! Minimal 6 karakter.
          </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == 3): ?>
          <div class="alert-warning">
            <i class="fas fa-info-circle me-2"></i> Terjadi kesalahan saat upload foto. Silakan coba lagi.
          </div>
        <?php endif; ?>

        <form action="proses_register.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <div class="input-group-custom">
              <i class="fas fa-user"></i>
              <input type="text" name="nama" class="form-control-custom" placeholder="Masukkan nama lengkap" required autofocus>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Username</label>
            <div class="input-group-custom">
              <i class="fas fa-at"></i>
              <input type="text" name="username" class="form-control-custom" placeholder="Masukkan username" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group-custom">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" class="form-control-custom" placeholder="email@contoh.com" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-group-custom">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" class="form-control-custom" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="password-strength" id="passwordStrength"></div>
            <div class="strength-text" id="strengthText"></div>
          </div>

          <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <div class="input-group-custom">
              <i class="fas fa-check-circle"></i>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control-custom" placeholder="Ketik ulang password" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Foto Profil (Opsional)</label>
            <div class="file-input-wrapper">
              <i class="fas fa-camera"></i>
              <input type="file" name="foto" class="form-control-custom" accept="image/*" style="padding-left: 45px;">
            </div>
            <small style="color: #555; font-size: 0.7rem;">Format: JPG, PNG, GIF. Maksimal 2MB</small>
          </div>

          <button type="submit" class="btn-register" id="submitBtn">
            <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
          </button>
        </form>

        <div class="login-link">
          <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
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

    // Password strength checker
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const strengthDiv = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    const submitBtn = document.getElementById('submitBtn');

    function checkPasswordStrength(password) {
      let strength = 0;
      if (password.length >= 6) strength++;
      if (password.length >= 8) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[0-9]/.test(password)) strength++;
      if (/[^A-Za-z0-9]/.test(password)) strength++;
      
      if (password.length === 0) return 0;
      if (strength <= 2) return 1;
      if (strength <= 4) return 2;
      return 3;
    }

    function updateStrengthIndicator() {
      const password = passwordInput.value;
      const strength = checkPasswordStrength(password);
      
      strengthDiv.className = 'password-strength';
      strengthText.innerHTML = '';
      
      if (password.length === 0) {
        strengthDiv.style.background = '#333';
        return;
      }
      
      if (strength === 1) {
        strengthDiv.classList.add('strength-weak');
        strengthText.innerHTML = 'Password lemah';
        strengthText.style.color = '#e74c3c';
      } else if (strength === 2) {
        strengthDiv.classList.add('strength-medium');
        strengthText.innerHTML = 'Password sedang';
        strengthText.style.color = '#f1c40f';
      } else {
        strengthDiv.classList.add('strength-strong');
        strengthText.innerHTML = 'Password kuat';
        strengthText.style.color = '#1DB954';
      }
    }

    function validateForm() {
      const password = passwordInput.value;
      const confirm = confirmInput.value;
      
      if (password !== confirm) {
        confirmInput.style.borderColor = '#e74c3c';
        return false;
      } else {
        confirmInput.style.borderColor = '#1DB954';
        return true;
      }
    }

    passwordInput.addEventListener('input', updateStrengthIndicator);
    
    confirmInput.addEventListener('input', function() {
      if (passwordInput.value !== confirmInput.value) {
        confirmInput.style.borderColor = '#e74c3c';
      } else {
        confirmInput.style.borderColor = '#1DB954';
      }
    });

    // Form validation on submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
      if (passwordInput.value !== confirmInput.value) {
        e.preventDefault();
        alert('Password dan Konfirmasi Password tidak sama!');
      }
    });
  </script>
</body>
</html>