<?php
include 'Models/barang.php';

use Models\Barang;

$db = new Barang();
?>
<h2 class="pt-3">Data Barang</h2>
<?php
msg_query()
?>
<a href="../kkp/page.php?q=barangInput"><button class="btn btn-success text-light">Tambah Barang</button></a>
<a href="report/barangReport.php" target="_BLANK"><button class="btn btn-warning text-dark">Cetak Laporan</button></a>
<div class='table-responsive pt-3'>
    <table id="myTable" class='table table-striped table-bordered pt-0' border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama barang</th>
                <th>Gambar</th>
                <th>Harga / Item</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $barang) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $barang['barang_id'] ?></td>
                    <td><?php echo $barang['nama_barang'] ?></td>
                    <td><?php echo '<img class="rounded" src="data:image/jpeg;base64,' . base64_encode($barang["gambar"]) . '" height="50" />' ?></td>
                    <td><?php echo $barang['harga_satuan'] ?></td>
                    <td><?php echo $barang['stok'] ?></td>
                    <td>
                        <a class='badge bg-info text-wrap fs-6 link-light link-offset-2' href="../kkp/page.php?q=barangEdit&barang_id=<?php echo $barang['barang_id']; ?>">Edit</a>
                        <a class='badge bg-danger text-wrap fs-6 link-light link-offset-2' href="../kkp/page.php?q=barangAct&barang_id=<?php echo $barang['barang_id']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>