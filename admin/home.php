<?php
//koneksi database
include 'koneksi.php';

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('You must login first');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$admin = $_SESSION['admin'];

// Ambil data statistik - Gunakan backticks karena ORDER adalah reserved keyword
$query_produk = $koneksi->query("SELECT COUNT(*) as total FROM produk");
$total_produk = $query_produk->fetch_assoc()['total'];

// Gunakan backticks untuk tabel `order` (bukan orders)
$query_order = $koneksi->query("SELECT COUNT(*) as total FROM `order`");
$total_order = $query_order->fetch_assoc()['total'];

$query_order_pending = $koneksi->query("SELECT COUNT(*) as total FROM `order` WHERE status = 'pending'");
$total_pending = $query_order_pending->fetch_assoc()['total'];

$query_order_selesai = $koneksi->query("SELECT COUNT(*) as total FROM `order` WHERE status = 'selesai'");
$total_selesai = $query_order_selesai->fetch_assoc()['total'];

// Query untuk recent orders
$query_recent = $koneksi->query("SELECT o.*, p.nama_produk FROM `order` o LEFT JOIN produk p ON o.id_produk = p.id_produk ORDER BY o.tanggal_order DESC LIMIT 5");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin | Futsal Muntrik</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --hijau: #1DB954;
            --hijau-gelap: #148a3d;
            --hijau-tua: #0d5c29;
            --hitam: #0a0a0a;
            --hitam-lunak: #141414;
            --abu-gelap: #1e1e1e;
            --abu-sedang: #2a2a2a;
            --putih: #f5f5f5;
            --putih-lunak: #cccccc;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Rajdhani', sans-serif !important;
        }

        body {
            background: linear-gradient(135deg, var(--hitam) 0%, var(--hitam-lunak) 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            padding: 30px;
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--abu-gelap) 0%, var(--abu-sedang) 100%);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 35px;
            border: 1px solid rgba(29,185,84,0.2);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--hijau), var(--hijau-gelap));
        }

        .welcome-card::after {
            content: '⚽';
            position: absolute;
            right: 30px;
            bottom: 20px;
            font-size: 100px;
            opacity: 0.05;
            font-family: inherit;
        }

        .welcome-card h2 {
            color: var(--putih);
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .welcome-card h2 span {
            color: var(--hijau);
        }

        .welcome-card p {
            color: var(--putih-lunak);
            font-size: 1rem;
            margin-bottom: 0;
        }

        /* Stat Cards */
        .stat-card {
            background: var(--abu-gelap);
            border-radius: 16px;
            padding: 25px 20px;
            margin-bottom: 25px;
            border: 1px solid rgba(29,185,84,0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--hijau);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--hijau), transparent);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            background: rgba(29,185,84,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .stat-icon i {
            font-size: 26px;
            color: var(--hijau);
        }

        .stat-number {
            font-family: 'Rajdhani', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--hijau);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--putih-lunak);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: 500;
        }

        /* Quick Actions */
        .quick-actions {
            background: var(--abu-gelap);
            border-radius: 16px;
            padding: 25px;
            border: 1px solid rgba(29,185,84,0.15);
            height: 100%;
        }

        .quick-actions h4 {
            color: var(--putih);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(29,185,84,0.3);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .quick-actions h4 i {
            color: var(--hijau);
            margin-right: 10px;
        }

        .action-btn {
            background: var(--abu-sedang);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 15px 18px;
            margin-bottom: 12px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .action-btn:hover {
            background: rgba(29,185,84,0.1);
            border-color: var(--hijau);
            transform: translateX(8px);
            text-decoration: none;
        }

        .action-btn i {
            font-size: 22px;
            color: var(--hijau);
            margin-right: 15px;
            width: 30px;
            text-align: center;
        }

        .action-btn span {
            color: var(--putih-lunak);
            font-weight: 500;
            font-size: 0.95rem;
        }

        /* Recent Orders Table */
        .recent-orders {
            background: var(--abu-gelap);
            border-radius: 16px;
            padding: 25px;
            border: 1px solid rgba(29,185,84,0.15);
            height: 100%;
        }

        .recent-orders h4 {
            color: var(--putih);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(29,185,84,0.3);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .recent-orders h4 i {
            color: var(--hijau);
            margin-right: 10px;
        }

        .table-custom {
            width: 100%;
            color: var(--putih-lunak);
            border-collapse: collapse;
        }

        .table-custom th {
            color: var(--hijau);
            font-weight: 600;
            padding: 12px 10px;
            border-bottom: 2px solid rgba(29,185,84,0.3);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            padding: 12px 10px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .table-custom tr:hover {
            background: rgba(29,185,84,0.05);
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background: rgba(241, 196, 15, 0.15);
            color: #f1c40f;
            border: 1px solid rgba(241, 196, 15, 0.3);
        }

        .badge-selesai {
            background: rgba(46, 204, 113, 0.15);
            color: #2ecc71;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        .badge-proses {
            background: rgba(52, 152, 219, 0.15);
            color: #3498db;
            border: 1px solid rgba(52, 152, 219, 0.3);
        }

        .btn-detail-custom {
            background: transparent;
            border: 1px solid var(--hijau);
            color: var(--hijau);
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.7rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail-custom:hover {
            background: var(--hijau);
            color: var(--hitam);
            text-decoration: none;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, rgba(29,185,84,0.05), rgba(29,185,84,0.02));
            border-left: 4px solid var(--hijau);
            border-radius: 12px;
            padding: 18px 25px;
            margin-top: 25px;
        }

        .info-box p {
            color: var(--putih-lunak);
            font-size: 0.85rem;
            margin: 0;
        }

        .info-box i {
            color: var(--hijau);
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 15px;
            }
            .welcome-card {
                padding: 20px;
            }
            .welcome-card h2 {
                font-size: 1.5rem;
            }
            .stat-number {
                font-size: 1.8rem;
            }
            .table-custom th,
            .table-custom td {
                padding: 8px 5px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="container-fluid">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h2>Selamat Datang, <span><?php echo htmlspecialchars($admin['username']); ?></span>!</h2>
                <p>Kelola lapangan futsal dan booking dengan mudah di dashboard ini.</p>
            </div>

            <!-- Stat Cards Row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-futbol"></i>
                        </div>
                        <div class="stat-number"><?php echo $total_produk; ?></div>
                        <div class="stat-label">Total Lapangan</div>
                        <small style="color: #555;">Lapangan aktif</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-calendar-check"></i>
                        </div>
                        <div class="stat-number"><?php echo $total_order; ?></div>
                        <div class="stat-label">Total Booking</div>
                        <small style="color: #555;">Keseluruhan</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-clock"></i>
                        </div>
                        <div class="stat-number"><?php echo $total_pending; ?></div>
                        <div class="stat-label">Menunggu Konfirmasi</div>
                        <small style="color: #f1c40f;">Perlu tindakan</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="stat-number"><?php echo $total_selesai; ?></div>
                        <div class="stat-label">Booking Selesai</div>
                        <small style="color: #2ecc71;">Terkonfirmasi</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Orders -->
            <div class="row">
                <div class="col-md-4">
                    <div class="quick-actions">
                        <h4><i class="fa fa-bolt"></i> Aksi Cepat</h4>
                        <a href="index.php?halaman=produk" class="action-btn">
                            <i class="fa fa-futbol"></i>
                            <span>Kelola Lapangan</span>
                        </a>
                        <a href="index.php?halaman=orderproduk" class="action-btn">
                            <i class="fa fa-calendar-check"></i>
                            <span>Lihat Booking</span>
                        </a>
                        <a href="index.php?halaman=tambahproduk" class="action-btn">
                            <i class="fa fa-plus-circle"></i>
                            <span>Tambah Lapangan Baru</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="recent-orders">
                        <h4><i class="fa fa-history"></i> Booking Terbaru</h4>
                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Lapangan</th>
                                        <th>Tanggal Main</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query_recent && $query_recent->num_rows > 0) {
                                        while ($row = $query_recent->fetch_assoc()) {
                                            $status_class = '';
                                            $status_text = '';
                                            if ($row['status'] == 'pending') {
                                                $status_class = 'badge-pending';
                                                $status_text = 'Menunggu';
                                            } elseif ($row['status'] == 'proses') {
                                                $status_class = 'badge-proses';
                                                $status_text = 'Diproses';
                                            } else {
                                                $status_class = 'badge-selesai';
                                                $status_text = 'Selesai';
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars(substr($row['nama'], 0, 25)); ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['tanggal_main'])); ?></td>
                                            <td><span class="badge-status <?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
                                            <td>
                                                <a href="index.php?halaman=orderproduk" class="btn-detail-custom">
                                                    <i class="fa fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="5" class="empty-state">
                                                <i class="fa fa-inbox"></i><br>
                                                Belum ada booking
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p>
                    <i class="fa fa-info-circle"></i>
                    <strong>Tips Dashboard:</strong> Pantau booking baru yang masuk dan segera lakukan konfirmasi. 
                    Booking yang cepat dikonfirmasi akan meningkatkan kepuasan pelanggan.
                </p>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>