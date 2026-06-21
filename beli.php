<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); location='login.php';</script>";
    exit;
}

$id_produk = $_GET['id'];

// Validasi data POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Method tidak diizinkan!'); location='index.php';</script>";
    exit;
}

// Ambil data dari form dengan sanitasi
$nama     = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
$email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
$telepon  = mysqli_real_escape_string($koneksi, trim($_POST['telepon']));
$tanggal  = mysqli_real_escape_string($koneksi, trim($_POST['tanggal']));
$durasi   = (int)($_POST['durasi'] ?? 0);
$total_harga = (int)($_POST['total_harga'] ?? 0);
$jam_main = $_POST['jam_main'] ?? '09:00'; // Default jam mulai

// Validasi data
if (empty($nama) || empty($email) || empty($telepon) || empty($tanggal)) {
    echo "<script>alert('Semua field wajib diisi!'); history.back();</script>";
    exit;
}

if ($durasi < 1 || $durasi > 3) {
    echo "<script>alert('Durasi tidak valid!'); history.back();</script>";
    exit;
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Format email tidak valid!'); history.back();</script>";
    exit;
}

// Validasi tanggal (tidak boleh hari ini atau kemarin)
$today = date('Y-m-d');
if ($tanggal <= $today) {
    echo "<script>alert('Tanggal main harus minimal H+1!'); history.back();</script>";
    exit;
}

// CEK KETERSEDIAAN LAPANGAN
$jam_mulai = date('H:i:s', strtotime($jam_main));
$jam_selesai = date('H:i:s', strtotime("+$durasi hours", strtotime($jam_main)));

// Cek apakah ada booking yang bentrok
$cek_stmt = $koneksi->prepare("
    SELECT COUNT(*) as total 
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

$cek_stmt->bind_param(
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

$cek_stmt->execute();
$cek_result = $cek_stmt->get_result();
$cek_data = $cek_result->fetch_assoc();

if ($cek_data['total'] > 0) {
    echo "<script>
        alert('Maaf, lapangan sudah dibooking pada jam tersebut!\\nSilakan pilih jam lain.');
        history.back();
    </script>";
    exit;
}

// Proses upload file
$targetDir = "uploads/bukti/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Validasi file upload
if ($_FILES["bukti_pembayaran"]["error"] != UPLOAD_ERR_OK) {
    $uploadErrors = [
        UPLOAD_ERR_INI_SIZE => "File terlalu besar (max " . ini_get('upload_max_filesize') . ")",
        UPLOAD_ERR_FORM_SIZE => "File terlalu besar",
        UPLOAD_ERR_PARTIAL => "File hanya terupload sebagian",
        UPLOAD_ERR_NO_FILE => "Tidak ada file yang diupload",
        UPLOAD_ERR_NO_TMP_DIR => "Folder temporary tidak ditemukan",
        UPLOAD_ERR_CANT_WRITE => "Gagal menulis file",
        UPLOAD_ERR_EXTENSION => "Upload file dihentikan oleh ekstensi"
    ];
    $errorMsg = $uploadErrors[$_FILES["bukti_pembayaran"]["error"]] ?? "Unknown error";
    echo "<script>alert('Upload gagal: $errorMsg'); history.back();</script>";
    exit;
}

$fileName = $_FILES["bukti_pembayaran"]["name"];
$fileTmp  = $_FILES["bukti_pembayaran"]["tmp_name"];
$fileSize = $_FILES["bukti_pembayaran"]["size"];
$fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

// Validasi ekstensi file
$allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
if (!in_array($fileType, $allowedTypes)) {
    echo "<script>alert('File harus berupa JPG, JPEG, PNG, atau PDF!'); history.back();</script>";
    exit;
}

// Validasi ukuran file (max 2MB)
if ($fileSize > 2 * 1024 * 1024) {
    echo "<script>alert('Ukuran file maksimal 2MB!'); history.back();</script>";
    exit;
}

// Generate nama file unik
$newFileName = time() . '_' . uniqid() . '.' . $fileType;
$filePath = $targetDir . $newFileName;

// Mulai transaksi database
$koneksi->begin_transaction();

try {
    // Upload file
    if (!move_uploaded_file($fileTmp, $filePath)) {
        throw new Exception("Gagal upload file");
    }
    
    $tanggal_order = date('Y-m-d H:i:s');
    $status = 'pending';
    
    // Insert ke tabel order
    $stmt = $koneksi->prepare("INSERT INTO `order` (
        id_produk, nama, email, telepon_pelanggan, tanggal_order, 
        tanggal_main, jam_main, bukti_pembayaran, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param(
        "issssssss",
        $id_produk,
        $nama,
        $email,
        $telepon,
        $tanggal_order,
        $tanggal,
        $jam_mulai,
        $newFileName,
        $status
    );
    
    if (!$stmt->execute()) {
        throw new Exception("Gagal menyimpan order: " . $stmt->error);
    }
    
    $id_order = $stmt->insert_id;
    $stmt->close();
    
    // Insert ke tabel booking_jadwal
    $jadwal_stmt = $koneksi->prepare("INSERT INTO booking_jadwal (
        id_order, id_produk, tanggal_main, jam_mulai, jam_selesai, status
    ) VALUES (?, ?, ?, ?, ?, 'active')");
    
    $jadwal_stmt->bind_param(
        "iisss",
        $id_order,
        $id_produk,
        $tanggal,
        $jam_mulai,
        $jam_selesai
    );
    
    if (!$jadwal_stmt->execute()) {
        throw new Exception("Gagal menyimpan jadwal: " . $jadwal_stmt->error);
    }
    
    $jadwal_stmt->close();
    
    // Commit transaksi
    $koneksi->commit();
    
    echo "<script>
        alert('Pesanan berhasil dikirim!');
        location='status_order.php?id=$id_order';
    </script>";
    
} catch (Exception $e) {
    // Rollback jika ada error
    $koneksi->rollback();
    
    // Hapus file jika sudah terupload
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    
    echo "<script>
        alert('Gagal memproses pesanan: " . addslashes($e->getMessage()) . "');
        history.back();
    </script>";
}

$koneksi->close();
?>