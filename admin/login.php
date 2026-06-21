<?php
session_start();
//koneksi database
include 'koneksi.php';

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin | Futsal Muntrik</title>
    <link rel="shortcut icon" href="assets/landing/img/futsal-icon.png" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #0d2a1a 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
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

        .admin-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .admin-card {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(29, 185, 84, 0.2);
            border-radius: 16px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .admin-card:hover {
            border-color: rgba(29, 185, 84, 0.5);
            transform: translateY(-5px);
        }

        .admin-header {
            text-align: center;
            padding: 30px 30px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #1DB954, #148a3d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 0 20px rgba(29, 185, 84, 0.3);
        }

        .admin-icon i {
            font-size: 32px;
            color: #0a0a0a;
        }

        .admin-header h2 {
            color: #f5f5f5;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            font-family: 'Rajdhani', sans-serif;
        }

        .admin-header h2 span {
            color: #1DB954;
        }

        .admin-header p {
            color: #888;
            font-size: 0.85rem;
            margin: 0;
        }

        .admin-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
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
            background: #2a2a2a;
            border: 1px solid #333;
            border-radius: 10px;
            color: #f5f5f5;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #1DB954;
            box-shadow: 0 0 0 2px rgba(29, 185, 84, 0.2);
        }

        .form-control-custom::placeholder {
            color: #555;
        }

        .btn-admin {
            width: 100%;
            padding: 14px;
            background: #1DB954;
            border: none;
            border-radius: 10px;
            color: #0a0a0a;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.2s ease;
            margin-top: 10px;
            cursor: pointer;
        }

        .btn-admin:hover {
            background: #148a3d;
            transform: translateY(-2px);
        }

        /* Alert styling */
        .alert {
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-info {
            background: rgba(29, 185, 84, 0.1);
            border: 1px solid #1DB954;
            color: #1DB954;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }

        .alert i {
            font-size: 16px;
        }

        /* Back to website link */
        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #888;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: #1DB954;
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
            background: #1DB954;
            transform: rotate(45deg);
        }

        .shape-2 {
            bottom: 10%;
            right: 5%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: #1DB954;
        }

        .shape-3 {
            top: 50%;
            right: 10%;
            width: 100px;
            height: 100px;
            border-radius: 20px;
            background: #1DB954;
            transform: rotate(15deg);
        }

        @media (max-width: 576px) {
            .admin-body {
                padding: 20px;
            }
            .admin-header {
                padding: 25px 25px 15px;
            }
            .admin-header h2 {
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

    <div class="admin-container">
        <div class="admin-card">
            <div class="admin-header">
                <div class="admin-icon">
                    <i class="fa fa-shield-alt"></i>
                </div>
                <h2>Admin <span>Panel</span></h2>
                <p>Masuk ke dashboard administrator</p>
            </div>

            <div class="admin-body">
                <form role="form" method="POST">
                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fa fa-user input-icon"></i>
                            <input type="text" class="form-control-custom" name="user" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group-custom">
                            <i class="fa fa-lock input-icon"></i>
                            <input type="password" class="form-control-custom" name="pass" placeholder="Password" required>
                        </div>
                    </div>
                    
                    <button class="btn-admin" name="login">
                        <i class="fa fa-sign-in-alt"></i> Login
                    </button>
                    
                    <div class="back-link">
                        <a href="../index.php">
                            <i class="fa fa-arrow-left"></i> Kembali ke Website
                        </a>
                    </div>
                </form>
                
                <?php
                if (isset($_POST['login'])) {
                    $username = $_POST['user'];
                    $password = $_POST['pass'];

                    // Prepared statement to prevent SQL injection
                    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $yangcocok = $result->num_rows;

                    if ($yangcocok == 1) {
                        $_SESSION['admin'] = $result->fetch_assoc();
                        echo "<div class='alert alert-info'>
                                <i class='fa fa-check-circle'></i> Login Sukses! Mengarahkan ke dashboard...
                              </div>";
                        echo "<meta http-equiv='refresh' content='1; url=index.php'>";
                    } else {
                        echo "<div class='alert alert-danger'>
                                <i class='fa fa-exclamation-circle'></i> Login Gagal! Username atau password salah.
                              </div>";
                    }

                    $stmt->close();
                }
                ?>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>