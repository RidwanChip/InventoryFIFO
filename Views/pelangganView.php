<?php
include 'Models/Pelanggan.php';

use Models\Pelanggan;

$db = new Pelanggan();
?>
<h2 class="pt-3">Data Pelanggan</h2>
<?php
msg_query()
?>
<a href="../kkp/page.php?q=pelangganInput"><button class="btn btn-success text-light">Tambah Pelanggan</button></a>
<a href="report/pelangganReport.php" target="_BLANK"><button class="btn btn-warning text-dark">Cetak Laporan</button></a>
<div class='table-responsive pt-3'>
    <table id="myTable" class='table table-striped table-bordered pt-0' border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>alamat</th>
                <th>kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $pelanggan) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $pelanggan['pelanggan_id'] ?></td>
                    <td><?php echo $pelanggan['nama'] ?></td>
                    <td><?php echo $pelanggan['alamat'] ?></td>
                    <td><?php echo $pelanggan['kontak'] ?></td>
                    <td>
                        <a class='badge bg-info text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=pelangganEdit&pelanggan_id=<?php echo $pelanggan['pelanggan_id']; ?>">Edit</a>
                        <a class='badge bg-danger text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=pelangganAct&pelanggan_id=<?php echo $pelanggan['pelanggan_id']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>