<?php
include 'Models/Pelanggan.php';

use Models\Pelanggan;

$db = new Pelanggan();
$row = $db->edit_data($_GET['pelanggan_id']);
?>
<h2 class="mt-3">Edit pelanggan</h2>
<form action="../kkp/page.php?q=pelangganAct&aksi=update" method="post">
    <?php
    foreach ($row as $pelanggan) {
    ?>
        <input type="hidden" name="pelanggan_id" value="<?php echo $pelanggan['pelanggan_id'] ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama pelanggan:</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $pelanggan['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">alamat:</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $pelanggan['alamat']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">kontak</label>
            <input type="text" class="form-control" name="kontak" value="<?php echo $pelanggan['kontak']; ?>" required>
        </div>
    <?php
    }
    ?>
    <button type="submit" name="edit" class="btn btn-primary">Update pelanggan</button>
</form>