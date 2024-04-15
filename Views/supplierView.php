<?php
include 'Models/supplier.php';

use Models\Supplier;

$db = new Supplier();
?>
<h2 class="pt-3">Data Supplier</h2>
<?php
msg_query()
?>
<a href="../kkp/page.php?q=supplierInput"><button class="btn btn-success text-light">Tambah Supplier</button></a>
<a href="report/supplierReport.php" target="_BLANK"><button class="btn btn-warning text-dark">Cetak Laporan</button></a>
<div class='table-responsive pt-3'>
    <table id="myTable" class='table table-striped table-bordered pt-0' border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama supplier</th>
                <th>alamat</th>
                <th>kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $supplier) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $supplier['supplier_id'] ?></td>
                    <td><?php echo $supplier['nama_supplier'] ?></td>
                    <td><?php echo $supplier['alamat'] ?></td>
                    <td><?php echo $supplier['kontak'] ?></td>
                    <td>
                        <a class='badge bg-info text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=supplierEdit&supplier_id=<?php echo $supplier['supplier_id']; ?>">Edit</a>
                        <a class='badge bg-danger text-wrap fs-6 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href="../kkp/page.php?q=supplierAct&supplier_id=<?php echo $supplier['supplier_id']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>