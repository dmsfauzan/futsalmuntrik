<h2>Data Lapangan</h2>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Lapangan</a><br>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $ambil = $koneksi->query("SELECT * FROM produk");
        while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td><?php echo $pecah['harga_produk']; ?></td>
                <td>
                    <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
                </td>
                <td>
                    <a href="index.php?halaman=editproduk&id=<?php echo $pecah['id_produk']?>" class="btn btn-warning">Edit</a>
                    <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

