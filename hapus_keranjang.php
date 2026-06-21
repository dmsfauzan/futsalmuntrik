<?php
session_start();
include 'koneksi.php';

// Check if the product ID is set in the URL
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Check if the product exists in the session's shopping cart
    if (isset($_SESSION['keranjang'][$id_produk])) {
        // Remove the product from the shopping cart
        unset($_SESSION['keranjang'][$id_produk]);
    }
}

// Redirect back to the cart page
header('Location: keranjang.php');
exit();
?>
