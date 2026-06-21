<h2>Data Pelanggan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';
        $no = 1;
        $ambil = $koneksi->query("SELECT * FROM pelanggan");
        while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                <td><?php echo $pecah['email_pelanggan']; ?></td>
                <td><?php echo $pecah['telepon_pelanggan']; ?></td>
                <td><?php echo $pecah['alamat_pelanggan']; ?></td>
                <td>
                    <a href="hapus_pelanggan.php?id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
