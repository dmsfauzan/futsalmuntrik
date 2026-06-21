<?php
// order.php - Halaman Booking
$ambil = $koneksi->query("
    SELECT o.*, p.nama_produk, 
           bj.jam_mulai, bj.jam_selesai,
           TIMESTAMPDIFF(HOUR, bj.jam_mulai, bj.jam_selesai) as durasi_jam
    FROM `order` o 
    JOIN produk p ON o.id_produk = p.id_produk
    LEFT JOIN booking_jadwal bj ON o.id_order = bj.id_order
    ORDER BY o.tanggal_order DESC
");

// Hitung statistik
$total_order = $koneksi->query("SELECT COUNT(*) as total FROM `order`")->fetch_assoc()['total'];
$pending = $koneksi->query("SELECT COUNT(*) as total FROM `order` WHERE status='pending'")->fetch_assoc()['total'];
$success = $koneksi->query("SELECT COUNT(*) as total FROM `order` WHERE status='success'")->fetch_assoc()['total'];
$gagal = $koneksi->query("SELECT COUNT(*) as total FROM `order` WHERE status='gagal'")->fetch_assoc()['total'];
?>

<style>
    /* Tambahan style untuk menjaga konsistensi dengan tema admin */
    .stat-box {
        background: var(--abu-gelap);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        border: 1px solid rgba(29,185,84,0.2);
        transition: all 0.3s;
    }

    .stat-box:hover {
        transform: translateY(-5px);
        border-color: var(--hijau);
    }

    .stat-icon {
        font-size: 40px;
        color: var(--hijau);
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--putih);
        margin-bottom: 5px;
    }

    .stat-label {
        color: var(--putih-lunak);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .badge-durasi {
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        background: rgba(52, 152, 219, 0.15);
        color: #3498db;
        border: 1px solid rgba(52, 152, 219, 0.3);
    }

    .jam-info {
        font-size: 0.85rem;
        color: var(--putih-lunak);
    }

    .jam-info i {
        color: var(--hijau);
        margin-right: 4px;
    }

    /* Dark theme untuk admin */
    .panel-default {
        background: var(--abu-gelap);
        border: 1px solid rgba(29,185,84,0.2);
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .panel-default > .panel-heading {
        background: var(--abu-sedang);
        color: var(--putih);
        font-family: 'Rajdhani', sans-serif;
        font-weight: 700;
        border-bottom: 1px solid var(--hijau);
        border-radius: 10px 10px 0 0;
        padding: 15px 20px;
    }

    .panel-body {
        color: var(--putih-lunak);
        padding: 20px;
    }

    .table {
        color: var(--putih-lunak);
        margin-bottom: 0;
    }

    .table > thead > tr > th {
        border-bottom: 2px solid var(--hijau);
        color: var(--hijau);
        font-weight: 600;
        padding: 12px;
    }

    .table > tbody > tr > td {
        border-top: 1px solid rgba(255,255,255,0.1);
        vertical-align: middle;
        padding: 12px;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: rgba(255,255,255,0.03);
    }

    .table-hover > tbody > tr:hover {
        background-color: rgba(29,185,84,0.05);
    }

    .form-control {
        background: var(--abu-sedang);
        border: 1px solid #333;
        color: var(--putih);
        border-radius: 6px;
    }

    .form-control:focus {
        border-color: var(--hijau);
        box-shadow: 0 0 0 2px rgba(29,185,84,0.2);
        color: var(--putih);
    }

    .form-control option {
        background: var(--abu-gelap);
        color: var(--putih);
    }

    .input-group-addon {
        background: var(--abu-sedang) !important;
        border-color: #333 !important;
        color: var(--putih-lunak) !important;
    }

    .btn-info {
        background: #3498db;
        border: none;
        transition: all 0.2s;
    }

    .btn-info:hover {
        background: #2980b9;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-box {
            margin-bottom: 15px;
        }
        .table thead th {
            font-size: 0.7rem;
            padding: 8px;
        }
        .table tbody td {
            font-size: 0.75rem;
            padding: 8px;
        }
        .jam-info {
            font-size: 0.7rem;
        }
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-calendar-check"></i> Data Pemesanan Lapangan
                <span style="float: right;">
                    <small>Total: <?= $total_order ?> pemesanan</small>
                </span>
            </div>
            <div class="panel-body">
                <!-- Statistik Cards -->
                <div class="row" style="margin-bottom: 25px;">
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-box">
                            <div class="stat-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="stat-number"><?= $total_order ?></div>
                            <div class="stat-label">Total Pemesanan</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-box">
                            <div class="stat-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="stat-number"><?= $pending ?></div>
                            <div class="stat-label">Menunggu Konfirmasi</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-box">
                            <div class="stat-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="stat-number"><?= $success ?></div>
                            <div class="stat-label">Berhasil / Selesai</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-box">
                            <div class="stat-icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <div class="stat-number"><?= $gagal ?></div>
                            <div class="stat-label">Dibatalkan / Gagal</div>
                        </div>
                    </div>
                </div>

                <!-- Search Box -->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-4 col-md-offset-8">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari pemesanan...">
                            <span class="input-group-addon" style="background: var(--abu-sedang); border-color: #333;">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Tanggal Main</th>
                                <th>Jam Main</th>
                                <th>Durasi</th>
                                <th>Waktu Order</th>
                                <th>Bukti Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php while ($row = $ambil->fetch_assoc()): ?>
                            <?php
                                // Format jam main
                                $jam_info = '-';
                                if (!empty($row['jam_mulai']) && !empty($row['jam_selesai'])) {
                                    $jam_info = date('H:i', strtotime($row['jam_mulai'])) . ' - ' . date('H:i', strtotime($row['jam_selesai']));
                                }
                                
                                // Format durasi
                                $durasi_info = '-';
                                if (!empty($row['durasi_jam']) && $row['durasi_jam'] > 0) {
                                    $durasi_info = '<span class="badge-durasi">' . $row['durasi_jam'] . ' Jam</span>';
                                }
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><strong><?= htmlspecialchars($row['nama_produk']); ?></strong></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['telepon_pelanggan']); ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_main'])); ?></td>
                                <td class="jam-info">
                                    <?php if ($jam_info != '-'): ?>
                                        <i class="fa fa-clock-o"></i> <?= $jam_info; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $durasi_info; ?></td>
                                <td><?= date('d-m-Y H:i', strtotime($row['tanggal_order'])); ?></td>
                                <td>
                                    <?php
                                    $filePath = '../uploads/bukti/' . basename($row['bukti_pembayaran']);
                                    if (!empty($row['bukti_pembayaran']) && file_exists($filePath)):
                                    ?>
                                        <a href="../uploads/bukti/<?= $row['bukti_pembayaran']; ?>" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i> Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">
                                            <i class="fa fa-ban"></i> Tidak ada
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="post" action="ubah_status.php" style="display: inline-block;">
                                        <input type="hidden" name="id_order" value="<?= $row['id_order']; ?>">
                                        <select name="status" class="form-control" style="width: 140px; background: var(--abu-sedang); color: var(--putih); border-color: #333;" onchange="this.form.submit()">
                                            <option value="pending" <?= ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending - Menunggu</option>
                                            <option value="success" <?= ($row['status'] == 'success') ? 'selected' : ''; ?>>Success - Berhasil</option>
                                            <option value="gagal" <?= ($row['status'] == 'gagal') ? 'selected' : ''; ?>>Gagal - Batal</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if ($ambil->num_rows == 0): ?>
                            <tr>
                                <td colspan="11" class="text-center" style="padding: 50px;">
                                    <i class="fa fa-futbol fa-3x text-muted"></i>
                                    <p class="text-muted" style="margin-top: 15px;">Belum ada data pemesanan lapangan futsal</p>
                                    <small class="text-muted">Silahkan tunggu pemesanan dari pelanggan</small>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchText = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#dataTable tbody tr');
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            if (text.includes(searchText)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show/hide no result message
        let noResultMsg = document.querySelector('#noResultMessage');
        if (visibleCount === 0 && tableRows.length > 0) {
            if (!noResultMsg) {
                let tbody = document.querySelector('#dataTable tbody');
                let tr = document.createElement('tr');
                tr.id = 'noResultMessage';
                tr.innerHTML = '<td colspan="11" class="text-center" style="padding: 50px;"><i class="fa fa-search fa-3x text-muted"></i><p class="text-muted" style="margin-top: 15px;">Tidak ada data yang ditemukan</p><small class="text-muted">Coba kata kunci lain</small></td>';
                tbody.appendChild(tr);
            }
        } else if (noResultMsg) {
            noResultMsg.remove();
        }
    });

    // Auto-refresh status (optional, refresh every 60 seconds)
    // setTimeout(() => location.reload(), 60000);
</script>