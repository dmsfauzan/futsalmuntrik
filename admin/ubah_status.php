<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_order = $_POST['id_order'];
    $status   = $_POST['status'];

    // Update status pemesanan
    $stmt = $koneksi->prepare("UPDATE `order` SET status = ? WHERE id_order = ?");
    $stmt->bind_param('si', $status, $id_order);
    $stmt->execute();
}

// Kembali ke halaman order
header('Location: index.php?halaman=orderproduk');
exit;
