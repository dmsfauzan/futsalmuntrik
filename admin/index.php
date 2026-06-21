<?php
session_start();
//koneksi ke database
include 'koneksi.php';

if (!isset($_SESSION['admin'])){
    echo "<script>location='login.php'</script>";
    header('location:login.php');
    exit();
}

// Ambil data admin yang login
$admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
    <meta charset="utf-8" />
    <title>Dashboard Admin | Futsal Muntrik</title>
    <link rel="shortcut icon" href="../assets/landing/img/futsal-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="admin, futsal, dashboard, futsal muntrik">
    <meta name="description" content="Dashboard Admin Futsal Muntrik">
    
    <!-- Bootstrap & Font Awesome CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
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
            background-color: var(--hitam);
        }

        /* Navbar Top Styling */
        .navbar-default.navbar-cls-top {
            background: linear-gradient(135deg, var(--hitam) 0%, var(--hitam-lunak) 100%);
            border-bottom: 2px solid var(--hijau);
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            margin-bottom: 0;
        }

        .navbar-brand {
            color: var(--hijau) !important;
            font-family: 'Rajdhani', sans-serif !important;
            font-weight: 700 !important;
            font-size: 1.5rem !important;
            letter-spacing: 1px;
        }

        .navbar-brand:hover {
            color: var(--hijau-gelap) !important;
        }

        /* Sidebar Styling */
        .navbar-side {
            background: var(--hitam-lunak);
            border-right: 1px solid rgba(29,185,84,0.2);
            position: fixed;
            top: 62px;
            left: 0;
            width: 260px;
            height: calc(100% - 62px);
            z-index: 100;
            overflow-y: auto;
        }

        .navbar-side .nav > li > a {
            color: var(--putih-lunak);
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.2s;
            padding: 15px 20px;
        }

        .navbar-side .nav > li > a:hover,
        .navbar-side .nav > li > a:focus {
            background-color: rgba(29,185,84,0.1);
            color: var(--hijau);
        }

        .navbar-side .nav > li.active > a {
            background-color: var(--hijau);
            color: var(--hitam);
        }

        .navbar-side .nav > li > a > i {
            color: var(--hijau);
            margin-right: 15px;
            width: 25px;
        }

        .navbar-side .nav > li.active > a > i {
            color: var(--hitam);
        }

        .navbar-side .nav > li > a:hover > i {
            color: var(--hijau-gelap);
        }

        /* User image styling */
        .user-image {
            border: 3px solid var(--hijau);
            border-radius: 50%;
            padding: 5px;
            margin: 20px auto 10px;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        /* Page wrapper */
        #page-wrapper {
            background: var(--hitam);
            margin-left: 260px;
            padding: 15px;
            min-height: 100vh;
        }

        #page-inner {
            background: var(--hitam);
            padding: 20px;
        }

        /* Card styling for content */
        .panel-default {
            background: var(--abu-gelap);
            border: 1px solid rgba(29,185,84,0.2);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .panel-default > .panel-heading {
            background: var(--abu-sedang);
            color: var(--putih);
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            border-bottom: 1px solid var(--hijau);
            border-radius: 10px 10px 0 0;
            padding: 15px 20px;
        }

        .panel-body {
            color: var(--putih-lunak);
            padding: 20px;
        }

        /* Table styling */
        .table {
            color: var(--putih-lunak);
            margin-bottom: 0;
        }

        .table > thead > tr > th {
            border-bottom: 2px solid var(--hijau);
            color: var(--hijau);
            font-weight: 600;
            padding: 12px;
        }

        .table > tbody > tr > td {
            border-top: 1px solid rgba(255,255,255,0.1);
            vertical-align: middle;
            padding: 12px;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: rgba(255,255,255,0.03);
        }

        .table-hover > tbody > tr:hover {
            background-color: rgba(29,185,84,0.05);
        }

        /* Badge styling untuk status */
        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background: #f39c12;
            color: #000;
        }

        .badge-success {
            background: #27ae60;
            color: #fff;
        }

        .badge-gagal {
            background: #e74c3c;
            color: #fff;
        }

        /* Button styling */
        .btn-primary {
            background: var(--hijau);
            border: none;
            color: var(--hitam);
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: var(--hijau-gelap);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e74c3c;
            border: none;
            transition: all 0.2s;
        }

        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #27ae60;
            border: none;
            transition: all 0.2s;
        }

        .btn-success:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: #f39c12;
            border: none;
            transition: all 0.2s;
        }

        .btn-warning:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .btn-info {
            background: #3498db;
            border: none;
            transition: all 0.2s;
        }

        .btn-info:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Form styling */
        .form-control {
            background: var(--abu-sedang);
            border: 1px solid #333;
            color: var(--putih);
            border-radius: 6px;
        }

        .form-control:focus {
            border-color: var(--hijau);
            box-shadow: 0 0 0 2px rgba(29,185,84,0.2);
            color: var(--putih);
        }

        .form-control::placeholder {
            color: #555;
        }

        label {
            color: var(--putih-lunak);
            font-weight: 500;
        }

        /* Modal styling */
        .modal-content {
            background: var(--abu-gelap);
            border: 1px solid var(--hijau);
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(29,185,84,0.3);
            background: var(--abu-sedang);
            border-radius: 12px 12px 0 0;
        }

        .modal-title {
            color: var(--hijau);
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
        }

        .modal-footer {
            border-top: 1px solid rgba(29,185,84,0.3);
        }

        .close {
            color: var(--putih);
            opacity: 0.8;
        }

        .close:hover {
            color: var(--hijau);
        }

        /* Alert styling */
        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            border: 1px solid #27ae60;
            color: #27ae60;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }

        .alert-info {
            background: rgba(29, 185, 84, 0.1);
            border: 1px solid var(--hijau);
            color: var(--hijau);
        }

        /* Pagination styling */
        .pagination > li > a,
        .pagination > li > span {
            background: var(--abu-sedang);
            border-color: #333;
            color: var(--putih-lunak);
        }

        .pagination > li > a:hover,
        .pagination > li > span:hover {
            background: var(--hijau);
            border-color: var(--hijau);
            color: var(--hitam);
        }

        .pagination > .active > a,
        .pagination > .active > span {
            background: var(--hijau);
            border-color: var(--hijau);
            color: var(--hitam);
        }

        /* Statistik card */
        .stat-box {
            background: var(--abu-gelap);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(29,185,84,0.2);
            transition: all 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            border-color: var(--hijau);
        }

        .stat-icon {
            font-size: 40px;
            color: var(--hijau);
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--putih);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--putih-lunak);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--hitam-lunak);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--hijau);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--hijau-gelap);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-side {
                width: 100%;
                position: relative;
                top: 0;
                height: auto;
            }
            #page-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- NAVBAR TOP -->
        <nav class="navbar navbar-default navbar-cls-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <i class="fa fa-futbol"></i> FUTSAL MUNTRIK - Admin
                </a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 0; float: right; font-size: 14px;">
                <i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($admin['username']); ?>
            </div>
        </nav>
        
        <!-- NAVBAR SIDE -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" alt="Admin Photo"/>
                        <h4 style="color: var(--hijau); margin-top: 5px;"><?php echo htmlspecialchars($admin['username']); ?></h4>
                        <hr style="border-color: rgba(29,185,84,0.3); width: 80%;">
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="fa fa-home fa-2x"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="index.php?halaman=produk">
                            <i class="fa fa-futbol fa-2x"></i> Lapangan
                        </a>
                    </li>
                    <li>
                        <a href="index.php?halaman=orderproduk">
                            <i class="fa fa-calendar-check fa-2x"></i> Booking
                        </a>
                    </li>
                    <li>
                        <a href="index.php?halaman=logout">
                            <i class="fa fa-sign-out-alt fa-2x"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>    
        </nav>  
        
        <!-- PAGE WRAPPER -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman'])){
                    if ($_GET['halaman'] == "produk"){
                        include 'produk.php';
                    } elseif ($_GET['halaman'] == "tambahproduk") {
                        include 'tambahproduk.php';
                    } elseif ($_GET['halaman'] == "hapusproduk") {
                        include 'hapusproduk.php';
                    } elseif ($_GET['halaman'] == "editproduk") {
                        include 'editproduk.php';
                    } elseif ($_GET['halaman'] == "orderproduk") {
                        include 'order.php';
                    } elseif ($_GET['halaman'] == "logout") {
                        include 'logout.php';
                    } else {
                        include 'home.php';
                    }
                } else {
                    include 'home.php';
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
    
    <script>
        // Active menu highlighting
        $(document).ready(function() {
            var url = window.location.href;
            $('#main-menu li a').each(function() {
                if (url.indexOf($(this).attr('href')) !== -1 && $(this).attr('href') !== 'index.php') {
                    $(this).parent().addClass('active');
                }
            });
            if (url.indexOf('index.php') !== -1 && url.indexOf('halaman') === -1) {
                $('#main-menu li:first-child').addClass('active');
            }
            
            // Toggle sidebar on mobile
            $('.navbar-toggle').click(function() {
                $('.navbar-side').toggleClass('visible');
            });
        });
    </script>
</body>
</html>