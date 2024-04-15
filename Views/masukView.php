<?php
include 'Models/masuk.php';

use Models\masuk;

$db = new masuk();
?>
<h2 class="pt-3">Data Barang Masuk</h2>
<?php
msg_query()
?>
<a href="../kkp/page.php?q=masukInput"><button class="btn btn-success text-light">Tambah Barang Masuk</button></a>
<a href="report/masukReport.php" target="_BLANK"><button class="btn btn-warning text-dark">Cetak Laporan</button></a>
<div class='table-responsive pt-3'>
    <table id="myTable" class='table table-striped table-bordered pt-0' border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Nama Supplier</th>
                <th>Jumlah Masuk</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $masuk) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $masuk['transaksi_masuk_id'] ?></td>
                    <td><?php echo $masuk['nama_barang'] ?></td>
                    <td><?php echo $masuk['nama_supplier'] ?></td>
                    <td><?php echo $masuk['jumlah_masuk'] ?></td>
                    <td><?php echo $masuk['tanggal_masuk'] ?></td>
                    <td><?php echo $masuk['ket'] ?></td>
                    <td>
                        <a class='badge bg-info text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=masukEdit&transaksi_masuk_id=<?php echo $masuk['transaksi_masuk_id']; ?>">Edit</a>
                        <a class='badge bg-danger text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=masukAct&transaksi_masuk_id=<?php echo $masuk['transaksi_masuk_id']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>