<h2 class="mt-3">Tambah supplier</h2>
<form action="../kkp/page.php?q=supplierAct&aksi=tambah" method="post">
    <div class="mb-3">
        <label for="nama_supplier" class="form-label">Nama supplier:</label>
        <input type="text" class="form-control" name="nama_supplier" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">alamat:</label>
        <input type="text" class="form-control" name="alamat" required>
    </div>
    <div class="mb-3">
        <label for="kontak" class="form-label">kontak</label>
        <input type="text" class="form-control" name="kontak" required>
    </div>
    <button type="submit" name="tambah" class="btn btn-primary">Tambah supplier</button>
</form>
<?php
