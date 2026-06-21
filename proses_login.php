<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = $koneksi->query("SELECT * FROM users WHERE username='$username'");

    if ($cek->num_rows > 0) {
        $user = $cek->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['foto'] = $user['foto'];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Password salah'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan'); window.location='login.php';</script>";
    }
}
?>