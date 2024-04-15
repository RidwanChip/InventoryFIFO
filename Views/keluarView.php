<?php
include 'Models/keluar.php';

use Models\keluar;

$db = new keluar();
?>
<h2 class="pt-3">Data Barang Keluar</h2>
<?php
msg_query()
?>
<a href="../kkp/page.php?q=keluarInput"><button class="btn btn-success text-light">Tambah Barang Keluar</button></a>
<a href="report/keluarReport.php" target="_BLANK"><button class="btn btn-warning text-dark">Cetak Laporan</button></a>
<div class='table-responsive pt-3'>
    <table id="myTable" class='table table-striped table-bordered pt-0' border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah keluar</th>
                <th>Harga/Kg</th>
                <th>Total Harga</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Keluar</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $keluar) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $keluar['transaksi_keluar_id'] ?></td>
                    <td><?php echo $keluar['nama_barang'] ?></td>
                    <td><?php echo $keluar['jumlah_keluar'] ?></td>
                    <td><?php echo $keluar['harga_satuan'] ?></td>
                    <?php
                    $total = $keluar['harga_satuan'] * $keluar['jumlah_keluar']
                    ?>
                    <td><?php echo $total ?></td>
                    <td><?php echo $keluar['nama'] ?></td>
                    <td><?php echo $keluar['tanggal_keluar'] ?></td>
                    <td><?php echo $keluar['ket'] ?></td>
                    <td>
                        <!-- <a class='badge bg-info text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=keluarEdit&transaksi_keluar_id=<?php echo $keluar['transaksi_keluar_id']; ?>">Edit</a> -->
                        <a class='badge bg-danger text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=keluarAct&transaksi_keluar_id=<?php echo $keluar['transaksi_keluar_id']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>