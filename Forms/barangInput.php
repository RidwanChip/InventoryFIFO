<h2 class="mt-3">Tambah barang</h2>
<form action="../kkp/page.php?q=barangAct&aksi=tambah" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" name="nama_barang" required>
    </div>
    <div class="mb-3">
        <label for="harga_satuan" class="form-label">Harga</label>
        <input type="text" class="form-control" name="harga_satuan" required>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" value="0" required>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar" required>
    </div>
    <button type="submit" name="tambah" class="btn btn-primary">Tambah barang</button>
</form>