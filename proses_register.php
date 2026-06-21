<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $email    = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Upload foto
    $namaFile = $_FILES['foto']['name'];
    $tmpFile  = $_FILES['foto']['tmp_name'];
    $folder   = 'uploads/';

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true); // Buat folder jika belum ada
    }

    if (!empty($namaFile)) {
        $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaBaru = uniqid('user_', true) . '.' . $ext;
        move_uploaded_file($tmpFile, $folder . $namaBaru);
        $foto = $folder . $namaBaru;
    } else {
        $foto = 'uploads/default.png'; // Jika tidak upload foto
    }

    // Cek apakah username/email sudah terdaftar
    $cek = $koneksi->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
    if ($cek->num_rows > 0) {
        echo "<script>alert('Username atau Email sudah digunakan'); window.location='register.php';</script>";
        exit;
    }

    // Simpan ke database
    $simpan = $koneksi->query("INSERT INTO users (nama, username, email, password, foto)
                                VALUES ('$nama', '$username', '$email', '$password', '$foto')");

    if ($simpan) {
        echo "<script>alert('Registrasi berhasil, silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data.'); window.location='register.php';</script>";
    }
}
?>
