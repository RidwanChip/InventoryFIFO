<?php
include 'Models/Barang.php';

use Models\Barang;

$db = new Barang();
$row = $db->edit_data($_GET['barang_id']);
?>
<h2 class="mt-3">Edit barang</h2>
<form action="../kkp/page.php?q=barangAct&aksi=update" method="post" enctype="multipart/form-data">
    <?php
    foreach ($row as $barang) {
    ?>
        <input type="hidden" name="barang_id" value="<?php echo $barang['barang_id'] ?>">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga / Kilo</label>
            <input type="text" class="form-control" name="harga_satuan" value="<?php echo $barang['harga_satuan']; ?>" required>
        </div>
        <div class="mb-2">
            <label for="stok" class="form-label">Stok : <?php echo $barang['stok']; ?></label>
            <input type="text" class="form-control" name="stok" value="<?php echo $barang['stok']; ?>" required hidden>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar:</label><br>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($barang['gambar']); ?>" height="100"><br><br>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
    <?php
    }
    ?>
    <button type="submit" name="edit" class="btn btn-primary">Update barang</button>
</form>