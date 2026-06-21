<h2>Edit Produk</h2>

<?php
// Validasi ID produk
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan!'); location='index.php?halaman=produk';</script>";
    exit;
}

$id_produk = mysqli_real_escape_string($koneksi, $_GET['id']);
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");

if ($ambil->num_rows == 0) {
    echo "<script>alert('Produk tidak ditemukan!'); location='index.php?halaman=produk';</script>";
    exit;
}

$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($pecah['nama_produk']); ?>" required>
    </div>
    <div class="form-group">
        <label>Harga (Rp.) / Jam</label>
        <input type="number" class="form-control" name="harga" value="<?php echo htmlspecialchars($pecah['harga_produk']); ?>" required>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10" required><?php echo htmlspecialchars($pecah['deskripsi_produk']); ?></textarea>
    </div>
    <div class="form-group">
        <label>Foto Saat Ini</label><br>
        <img src="../foto_produk/<?php echo htmlspecialchars($pecah['foto_produk']); ?>" width="200" class="img-thumbnail">
    </div>
    <div class="form-group">
        <label>Ganti Foto (Opsional)</label>
        <input type="file" class="form-control" name="foto" accept="image/jpeg,image/png,image/jpg">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
    <a href="index.php?halaman=produk" class="btn btn-secondary">Batal</a>
</form>

<?php
if (isset($_POST['ubah'])) {
    // Ambil data dengan sanitasi
    $nama_produk = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $harga_produk = mysqli_real_escape_string($koneksi, trim($_POST['harga']));
    $deskripsi_produk = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    
    // Validasi input tidak boleh kosong
    if (empty($nama_produk) || empty($harga_produk) || empty($deskripsi_produk)) {
        echo "<script>alert('Semua field wajib diisi!');</script>";
        echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
        exit;
    }
    
    // Validasi harga harus angka positif
    if (!is_numeric($harga_produk) || $harga_produk <= 0) {
        echo "<script>alert('Harga harus berupa angka positif!');</script>";
        echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
        exit;
    }
    
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];
    
    // Cek apakah ada file yang diupload
    if (!empty($namafoto) && $error == UPLOAD_ERR_OK) {
        // Validasi ekstensi file
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($namafoto, PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<script>alert('Format file tidak didukung! Gunakan JPG, JPEG, PNG, atau GIF.');</script>";
            echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
            exit;
        }
        
        // Validasi ukuran file (max 2MB)
        $file_size = $_FILES['foto']['size'];
        if ($file_size > 2 * 1024 * 1024) {
            echo "<script>alert('Ukuran file maksimal 2MB!');</script>";
            echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
            exit;
        }
        
        // Hapus foto lama jika ada
        if (!empty($pecah['foto_produk']) && file_exists("../foto_produk/" . $pecah['foto_produk'])) {
            unlink("../foto_produk/" . $pecah['foto_produk']);
        }
        
        // Generate nama file unik
        $timestamp = time();
        $random = rand(1000, 9999);
        $new_namafoto = $timestamp . '_' . $random . '.' . $file_extension;
        
        // Upload file baru
        if (move_uploaded_file($lokasifoto, "../foto_produk/$new_namafoto")) {
            // Update semua data termasuk foto
            $query = "UPDATE produk SET 
                        nama_produk='$nama_produk', 
                        harga_produk='$harga_produk', 
                        deskripsi_produk='$deskripsi_produk',
                        foto_produk='$new_namafoto' 
                      WHERE id_produk='$id_produk'";
            
            if ($koneksi->query($query)) {
                echo "<script>alert('Data berhasil diubah!');</script>";
                echo "<script>location='index.php?halaman=produk';</script>";
            } else {
                echo "<script>alert('Gagal mengubah data: " . $koneksi->error . "');</script>";
                echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload foto!');</script>";
            echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
        }
    } else {
        // Update tanpa mengganti foto
        $query = "UPDATE produk SET 
                    nama_produk='$nama_produk', 
                    harga_produk='$harga_produk', 
                    deskripsi_produk='$deskripsi_produk'
                  WHERE id_produk='$id_produk'";
        
        if ($koneksi->query($query)) {
            echo "<script>alert('Data berhasil diubah!');</script>";
            echo "<script>location='index.php?halaman=produk';</script>";
        } else {
            echo "<script>alert('Gagal mengubah data: " . $koneksi->error . "');</script>";
            echo "<script>location='index.php?halaman=editproduk&id=$id_produk';</script>";
        }
    }
}
?>