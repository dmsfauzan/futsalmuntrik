<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// Koneksi ke database
include 'koneksi.php';
?>

    <head>
        <meta charset="utf-8">
        <title>LANUD HALIM PERDANA KUSUMA</title>
        <link rel="shortcut icon" href="assets/landing/img/symbol-travel-logolove-fly-isolated-vector-design.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="bengkel motor, layanan motor, perawatan motor, bengkel terbaik">
        <meta name="description" content="AJM adalah bengkel motor terbaik yang menyediakan layanan perawatan dan perbaikan berkualitas tinggi untuk kendaraan Anda.">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,800;1,300;1,400;1,600;1,800&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

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
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0 fixed-top bg-white shadow-sm">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="text-primary fs-5">
                        <img src="assets/landing/img/symbol-travel-logolove-fly-isolated-vector-design.png" alt="AJM Logo" class="me-3" style="height: 2em;">LANUD HALIM PERDANA KUSUMA
                    </h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link text-dark">Home</a>
                        <a href="about.php" class="nav-item nav-link text-dark">Tentang Kami</a>
                        <a href="product.php" class="nav-item nav-link text-dark">Produk</a>
                        <a href="contact.php" class="nav-item nav-link text-dark">Kontak</a>
                        <?php if (isset($_SESSION['login'])): ?>
                        <a href="logout.php" class="nav-item nav-link text-dark">Logout</a>
                        <?php else: ?>
                        <a href="login.php" class="nav-item nav-link text-dark">Login/Daftar</a>
                        <?php endif; ?>
                        <a href="keranjang.php" class="nav-item nav-link text-dark active"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Main Content Start -->
        <main class="container mx-auto px-4 py-16" style="padding-top: 120px;">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Keranjang Belanja</h2>
            <?php if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) { ?>
            <div class="bg-white shadow-lg rounded-lg p-8">
                <table class="table table-hover">
                    <thead style="background-color: #4a90e2; color: white;">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = $id_produk");
                            $pecah = $ambil->fetch_assoc();
                            $subtotal = $pecah['harga_produk'] * $jumlah;
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $pecah['nama_produk']; ?></td>
                            <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp. <?php echo number_format($subtotal); ?></td>
                            <td><a href="hapus_keranjang.php?id=<?php echo $id_produk; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td colspan="2">Rp. <?php echo number_format($total); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex justify-content-between mt-4">
                    <a href="product.php" class="btn btn-secondary">Lanjutkan Belanja</a>
                    <a href="checkout.php" class="btn btn-warning">Checkout</a>
                </div>
            </div>
            <?php } else { ?>
            <div class="text-center">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Keranjang Anda Kosong</h3>
                <a href="product.php" class="btn btn-warning">Belanja Sekarang</a>
            </div>
            <?php } ?>
        </main>
        <!-- Main Content End -->




        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/landing/lib/wow/wow.min.js"></script>
        <script src="assets/landing/lib/easing/easing.min.js"></script>
        <script src="assets/landing/lib/waypoints/waypoints.min.js"></script>
        <script src="assets/landing/lib/counterup/counterup.min.js"></script>
        <script src="assets/landing/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="assets/landing/js/main.js"></script>
    </body>

</html>
