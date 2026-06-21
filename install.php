<?php
/**
 * INSTALL SCRIPT - Futsal Muntrik
 * Jalankan file ini sekali untuk membuat database dan tabel yang diperlukan
 * HAPUS FILE INI SETELAH INSTALLASI SELESAI!
 */

// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'futsal_muntrik');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mulai output buffering
ob_start();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalasi Database - Futsal Muntrik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #141414 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: rgba(30, 30, 30, 0.95);
            border: 1px solid rgba(29, 185, 84, 0.2);
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: #1DB954;
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .logo p {
            color: #888;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .progress-bar {
            background: #1e1e1e;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin: 20px 0;
        }
        
        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #1DB954, #148a3d);
            border-radius: 10px;
            transition: width 0.5s ease;
        }
        
        .status {
            margin: 20px 0;
        }
        
        .status-item {
            background: rgba(255,255,255,0.03);
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 3px solid #333;
            transition: all 0.3s;
        }
        
        .status-item.success {
            border-left-color: #1DB954;
            background: rgba(29, 185, 84, 0.05);
        }
        
        .status-item.error {
            border-left-color: #e74c3c;
            background: rgba(231, 76, 60, 0.05);
        }
        
        .status-item .icon {
            font-size: 1.2rem;
            width: 30px;
            text-align: center;
        }
        
        .status-item .label {
            flex: 1;
            color: #ccc;
            font-size: 0.9rem;
        }
        
        .status-item .status-text {
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-item.success .status-text {
            color: #1DB954;
        }
        
        .status-item.error .status-text {
            color: #e74c3c;
        }
        
        .status-item .fa-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .btn-install {
            background: #1DB954;
            color: #0a0a0a;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-install:hover {
            background: #148a3d;
            transform: translateY(-2px);
        }
        
        .btn-install:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-install.success {
            background: #2ecc71;
        }
        
        .btn-install.error {
            background: #e74c3c;
        }
        
        .warning {
            background: rgba(241, 196, 15, 0.1);
            border: 1px solid #f1c40f;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            color: #f1c40f;
            font-size: 0.85rem;
        }
        
        .warning i {
            margin-right: 10px;
        }
        
        .summary {
            background: rgba(46, 204, 113, 0.05);
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            color: #2ecc71;
            font-size: 0.9rem;
            display: none;
        }
        
        .summary.show {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .config-box {
            background: rgba(255,255,255,0.03);
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #333;
        }
        
        .config-box label {
            color: #888;
            font-size: 0.8rem;
            display: block;
            margin-bottom: 4px;
        }
        
        .config-box input {
            width: 100%;
            padding: 10px 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid #333;
            border-radius: 6px;
            color: #fff;
            font-size: 0.9rem;
            transition: border-color 0.3s;
        }
        
        .config-box input:focus {
            outline: none;
            border-color: #1DB954;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <h1>⚽ FUTSAL MUNTRIK</h1>
        <p>Instalasi Database</p>
    </div>

    <?php
    // Proses instalasi
    if (isset($_POST['install'])) {
        $db_host = $_POST['db_host'] ?? 'localhost';
        $db_user = $_POST['db_user'] ?? 'root';
        $db_pass = $_POST['db_pass'] ?? '';
        $db_name = $_POST['db_name'] ?? 'futsal_muntrik';
        
        $success = true;
        $messages = [];
        
        try {
            // Koneksi ke MySQL tanpa database
            $conn = new mysqli($db_host, $db_user, $db_pass);
            
            if ($conn->connect_error) {
                throw new Exception("Koneksi gagal: " . $conn->connect_error);
            }
            
            // Buat database jika belum ada
            $conn->query("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $messages[] = ['success', 'Database berhasil dibuat atau sudah ada'];
            
            // Pilih database
            $conn->select_db($db_name);
            $messages[] = ['success', 'Database dipilih'];
            
            // Mulai transaksi
            $conn->begin_transaction();
            
            // ==================== TABEL USERS ====================
            $conn->query("
                CREATE TABLE IF NOT EXISTS users (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    username VARCHAR(50) UNIQUE NOT NULL,
                    email VARCHAR(100) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    nama VARCHAR(100) NOT NULL,
                    foto VARCHAR(255) DEFAULT 'avatar.png',
                    role ENUM('admin', 'user') DEFAULT 'user',
                    status ENUM('active', 'inactive', 'banned') DEFAULT 'active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    INDEX idx_email (email),
                    INDEX idx_username (username)
                )
            ");
            $messages[] = ['success', 'Tabel users dibuat'];
            
            // ==================== TABEL PRODUK (Lapangan) ====================
            $conn->query("
                CREATE TABLE IF NOT EXISTS produk (
                    id_produk INT PRIMARY KEY AUTO_INCREMENT,
                    nama_produk VARCHAR(100) NOT NULL,
                    deskripsi_produk TEXT,
                    harga_produk INT NOT NULL DEFAULT 50000,
                    foto_produk VARCHAR(255) DEFAULT 'default.jpg',
                    status ENUM('active', 'inactive') DEFAULT 'active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    INDEX idx_nama (nama_produk)
                )
            ");
            $messages[] = ['success', 'Tabel produk (lapangan) dibuat'];
            
            // ==================== TABEL ORDER ====================
            $conn->query("
                CREATE TABLE IF NOT EXISTS `order` (
                    id_order INT PRIMARY KEY AUTO_INCREMENT,
                    id_produk INT NOT NULL,
                    nama VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    telepon_pelanggan VARCHAR(20) NOT NULL,
                    tanggal_order DATETIME NOT NULL,
                    tanggal_main DATE NOT NULL,
                    jam_main TIME NULL,
                    bukti_pembayaran VARCHAR(255) NOT NULL,
                    status ENUM('pending', 'proses', 'success', 'gagal', 'selesai') DEFAULT 'pending',
                    catatan TEXT,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE,
                    INDEX idx_status (status),
                    INDEX idx_tanggal_order (tanggal_order),
                    INDEX idx_tanggal_main (tanggal_main),
                    INDEX idx_email (email)
                )
            ");
            $messages[] = ['success', 'Tabel order dibuat'];
            
            // ==================== TABEL BOOKING JADWAL ====================
            $conn->query("
                CREATE TABLE IF NOT EXISTS booking_jadwal (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    id_order INT NOT NULL,
                    id_produk INT NOT NULL,
                    tanggal_main DATE NOT NULL,
                    jam_mulai TIME NOT NULL,
                    jam_selesai TIME NOT NULL,
                    status ENUM('active', 'canceled', 'completed') DEFAULT 'active',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    FOREIGN KEY (id_order) REFERENCES `order`(id_order) ON DELETE CASCADE,
                    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE,
                    INDEX idx_tanggal_produk (tanggal_main, id_produk),
                    INDEX idx_status (status),
                    INDEX idx_jam (jam_mulai, jam_selesai)
                )
            ");
            $messages[] = ['success', 'Tabel booking_jadwal dibuat'];
            
            // ==================== SEEDER DATA AWAL ====================
            
            // Cek apakah admin sudah ada
            $checkAdmin = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'admin'");
            $adminExists = $checkAdmin->fetch_assoc()['total'] > 0;
            
            if (!$adminExists) {
                // Password default: admin123
                $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
                $conn->query("
                    INSERT INTO users (username, email, password, nama, role, status) VALUES
                    ('admin', 'admin@futsal.com', '$hashedPassword', 'Administrator', 'admin', 'active')
                ");
                $messages[] = ['success', 'Akun admin dibuat (username: admin, password: admin123)'];
            } else {
                $messages[] = ['info', 'Akun admin sudah ada, tidak dibuat ulang'];
            }
            
            // Cek apakah produk sudah ada
            $checkProduk = $conn->query("SELECT COUNT(*) as total FROM produk");
            $produkExists = $checkProduk->fetch_assoc()['total'] > 0;
            
            if (!$produkExists) {
                $conn->query("
                    INSERT INTO produk (nama_produk, deskripsi_produk, harga_produk, foto_produk) VALUES
                    ('Lapangan 1', 'Lapangan futsal standar dengan lantai vinyl berkualitas tinggi dan pencahayaan LED.', 80000, 'lapangan1.jpg'),
                    ('Lapangan 2', 'Lapangan futsal premium dengan lantai vinyl anti-slip dan pencahayaan profesional.', 80000, 'lapangan2.jpg'),
                    ('Lapangan 3', 'Lapangan futsal standar dengan fasilitas lengkap dan harga terjangkau.', 80000, 'lapangan3.jpg')
                ");
                $messages[] = ['success', 'Data lapangan awal (3 lapangan) ditambahkan'];
            } else {
                $messages[] = ['info', 'Data lapangan sudah ada, tidak ditambahkan ulang'];
            }
            
            // Commit transaksi
            $conn->commit();
            
            // Tampilkan pesan sukses
            ?>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 100%;"></div>
            </div>
            
            <div class="status">
                <?php foreach ($messages as $msg): ?>
                    <div class="status-item <?= $msg[0] ?>">
                        <span class="icon">
                            <?php if ($msg[0] == 'success'): ?>
                                ✅
                            <?php elseif ($msg[0] == 'info'): ?>
                                ℹ️
                            <?php else: ?>
                                ❌
                            <?php endif; ?>
                        </span>
                        <span class="label"><?= htmlspecialchars($msg[1]) ?></span>
                        <span class="status-text"><?= $msg[0] == 'success' ? 'Berhasil' : ($msg[0] == 'info' ? 'Info' : 'Gagal') ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="summary show">
                <p><strong>✅ Instalasi berhasil!</strong></p>
                <p>Database <strong><?= $db_name ?></strong> telah berhasil dibuat dengan semua tabel.</p>
                <p style="margin-top: 10px;">
                    <strong>🔑 Login Admin:</strong><br>
                    Username: <code>admin</code><br>
                    Password: <code>admin123</code>
                </p>
                <p style="margin-top: 10px; color: #f1c40f;">
                    <i class="fa fa-warning"></i> 
                    <strong>⚠️ PENTING:</strong> Hapus file <code>install.php</code> setelah instalasi selesai untuk keamanan!
                </p>
            </div>
            
            <a href="admin/login.php" class="btn-install success">🔑 Login ke Admin Panel</a>
            <a href="index.php" class="btn-install success" style="margin-top: 10px;">🏠 Buka Website</a>
            
            <?php
        } catch (Exception $e) {
            // Rollback jika ada error
            if (isset($conn)) {
                $conn->rollback();
            }
            ?>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 100%; background: #e74c3c;"></div>
            </div>
            <div class="status">
                <div class="status-item error">
                    <span class="icon">❌</span>
                    <span class="label">Error: <?= htmlspecialchars($e->getMessage()) ?></span>
                    <span class="status-text">Gagal</span>
                </div>
            </div>
            <button onclick="location.reload()" class="btn-install error">🔄 Coba Lagi</button>
            <?php
        }
    } else {
        // Tampilkan form instalasi
        ?>
        <div class="warning">
            <i class="fa fa-warning"></i>
            <strong>⚠️ Peringatan!</strong> File ini akan membuat database dan tabel. 
            Pastikan Anda sudah mengubah konfigurasi database di bagian atas file ini.
            <br><br>
            <strong>HAPUS FILE INI SETELAH INSTALASI!</strong>
        </div>
        
        <form method="POST">
            <div class="config-box">
                <label>Database Host</label>
                <input type="text" name="db_host" value="localhost" required>
            </div>
            <div class="config-box">
                <label>Database User</label>
                <input type="text" name="db_user" value="root" required>
            </div>
            <div class="config-box">
                <label>Database Password</label>
                <input type="password" name="db_pass" value="">
            </div>
            <div class="config-box">
                <label>Database Name</label>
                <input type="text" name="db_name" value="futsal_muntrik" required>
            </div>
            
            <button type="submit" name="install" class="btn-install">⚡ Mulai Instalasi</button>
        </form>
        <?php
    }
    ?>
</div>
</body>
</html>
<?php
ob_end_flush();
?>