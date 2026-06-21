<?php
include 'koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);

    // Cek apakah email terdaftar
    $cek = $koneksi->query("SELECT * FROM users WHERE email='$email'");
    if ($cek->num_rows > 0) {
        // Simulasi: Redirect ke halaman reset (bisa ditambahkan token di produksi nyata)
        echo "<script>alert('Link reset password telah dikirim ke email Anda (simulasi).'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Email tidak ditemukan dalam sistem.'); window.location='lupa-password.php';</script>";
    }
}
?>
