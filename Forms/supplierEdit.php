<?php
include 'Models/supplier.php';

use Models\Supplier;

$db = new Supplier();
$row = $db->edit_data($_GET['supplier_id']);
?>
<h2 class="mt-3">Edit supplier</h2>
<form action="../kkp/page.php?q=supplierAct&aksi=update" method="post">
    <?php
    foreach ($row as $supplier) {
    ?>
        <input type="hidden" name="supplier_id" value="<?php echo $supplier['supplier_id'] ?>">
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama supplier:</label>
            <input type="text" class="form-control" name="nama_supplier" value="<?php echo $supplier['nama_supplier']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">alamat:</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $supplier['alamat']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">kontak</label>
            <input type="text" class="form-control" name="kontak" value="<?php echo $supplier['kontak']; ?>" required>
        </div>
    <?php
    }
    ?>
    <button type="submit" name="edit" class="btn btn-primary">Update supplier</button>
</form>