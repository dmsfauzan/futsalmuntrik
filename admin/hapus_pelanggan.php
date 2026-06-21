<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];
    $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    
    echo "<script>alert('Data pelanggan telah dihapus');</script>";
    echo "<script>location='pelanggan.php';</script>";
} else {
    echo "<script>alert('ID pelanggan tidak ditemukan');</script>";
    echo "<script>location='pelanggan.php';</script>";
}
?>
