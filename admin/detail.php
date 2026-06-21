<h2>Detail Pembelian</h2>

<?php
$ambil = $koneksi->query("select * from pembelian join pelanggan 
on pembelian.id_pelanggan=pelanggan.id_pelanggan
where pembelian.id_pembelian = '$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<strong><?php echo $detail['nama_pelanggan']?></strong><br>
<p>
    <?php echo $detail['telepon_pelanggan'];?> <br>
    <?php echo $detail['email_pelanggan'];?> <br>
</p>

<p>
    tanggal : <?php echo $detail['tanggal_pembelian'];?> <br>
    total : <?php echo $detail['total_pembelian'];?> <br>
</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $ambil = $koneksi->query("SELECT * FROM pembelian_produk join produk on 
        pembelian_produk.id_produk=produk.id_produk where 
        pembelian_produk.id_pembelian = '$_GET[id]'");
        while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td><?php echo $pecah['harga_produk']; ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td>
                    <?php echo $pecah['harga_produk']*$pecah['jumlah'];?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>