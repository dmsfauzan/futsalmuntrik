<?php
include 'koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['available' => false, 'error' => 'Method not allowed']);
    exit;
}

$id_produk = (int)$_POST['id_produk'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$durasi = (int)($_POST['durasi'] ?? 1);

$jam_mulai = date('H:i:s', strtotime($jam));
$jam_selesai = date('H:i:s', strtotime("+$durasi hours", strtotime($jam)));

// Cek ketersediaan
$stmt = $koneksi->prepare("
    SELECT bj.jam_mulai, bj.jam_selesai, o.nama 
    FROM booking_jadwal bj
    JOIN `order` o ON bj.id_order = o.id_order
    WHERE bj.id_produk = ? 
    AND bj.tanggal_main = ?
    AND bj.status = 'active'
    AND o.status != 'gagal'
    AND (
        (bj.jam_mulai < ? AND bj.jam_selesai > ?) OR
        (bj.jam_mulai < ? AND bj.jam_selesai > ?) OR
        (bj.jam_mulai >= ? AND bj.jam_selesai <= ?)
    )
");

$stmt->bind_param(
    "isssssss",
    $id_produk,
    $tanggal,
    $jam_selesai,
    $jam_mulai,
    $jam_selesai,
    $jam_mulai,
    $jam_mulai,
    $jam_selesai
);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $booking_info = [];
    while ($row = $result->fetch_assoc()) {
        $booking_info[] = date('H:i', strtotime($row['jam_mulai'])) . '-' . 
                         date('H:i', strtotime($row['jam_selesai'])) . 
                         ' (' . $row['nama'] . ')';
    }
    echo json_encode([
        'available' => false,
        'booking_info' => implode(', ', $booking_info)
    ]);
} else {
    echo json_encode(['available' => true]);
}
?>