<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Harga (Rp.)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label>Qty</label> <!-- Input untuk Qty -->
        <input type="number" class="form-control" name="qty">
    </div>
    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>


<?php
if (isset($_POST['save'])) {
    $nama_produk = $_POST['nama'];
    $harga_produk = $_POST['harga'];
    $deskripsi_produk = $_POST['deskripsi'];
    $qty_produk = $_POST['qty']; 
    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    if (empty($qty_produk)) {
        echo "<div class='alert alert-danger'>Jumlah produk harus diisi.</div>";
    } elseif (empty($lokasi_foto)) {
        echo "<div class='alert alert-danger'>Foto produk harus diisi.</div>";
    } else {
        move_uploaded_file($lokasi_foto, "../foto_produk/" . $nama_foto);

        $query = "INSERT INTO produk (nama_produk, harga_produk, deskripsi_produk, qty, foto_produk)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sisis", $nama_produk, $harga_produk, $deskripsi_produk, $qty_produk, $nama_foto);

        try {
            $stmt->execute();
            echo "<div class='alert alert-info'>Data Tersimpan</div>";
            echo "<meta http-equiv='refresh' content='1; url=index.php?halaman=produk'>";
        } catch (mysqli_sql_exception $e) {
            echo "<div class='alert alert-danger'>Data Gagal Tersimpan: " . $e->getMessage() . "</div>";
        }
    }
}
?>
