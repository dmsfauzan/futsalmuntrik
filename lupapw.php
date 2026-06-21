<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password | LANUD Halim Perdana Kusuma</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/landing/css/bootstrap.min.css">
  <style>
    body {
      background: url('assets/landing/img/halim.jpeg') no-repeat center center fixed;
      background-size: cover;
    }
    .reset-box {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      padding: 2rem;
      max-width: 450px;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="container min-vh-100 d-flex align-items-center">
    <div class="reset-box shadow-lg w-100">
      <div class="text-center mb-4">
        <img src="assets/landing/img/symbol-travel-logolove-fly-isolated-vector-design.png" style="height: 60px;" alt="">
        <h4 class="text-primary">LANUD HALIM PERDANA KUSUMA</h4>
        <p class="text-muted">Masukkan email Anda untuk mengatur ulang password</p>
      </div>
      <form action="proses_lupa_password.php" method="post">
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required placeholder="Masukkan email terdaftar">
        </div>
        <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
        <p class="mt-3 text-center"><a href="login.php">Kembali ke Login</a></p>
      </form>
    </div>
  </div>
</body>
</html>
