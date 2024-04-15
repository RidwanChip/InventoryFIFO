<?php
include 'Database.php';

use Models\Database;

$database = new Database();
$conn = $database->getConnection();
?>
<h2>Form Transaksi Masuk Barang</h2>
<form action="../kkp/page.php?q=masukAct&aksi=tambah" method="POST">
    <div class="mb-3">
        <label for="barang_id" class="form-label">Nama Barang</label>
        <select name="barang_id" class="form-control" required>
            <option value="">Pilih Barang</option>
            <?php
            $sql_barang = "SELECT barang_id, nama_barang FROM Barang";
            $result_barang = $conn->query($sql_barang);
            if ($result_barang->num_rows > 0) {
                while ($row_barang = $result_barang->fetch_assoc()) {
                    echo "<option value='" . $row_barang['barang_id'] . "'>" . $row_barang['nama_barang'] . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="supplier_id" class="form-label">ID Supplier:</label>
        <select name="supplier_id" class="form-control" required>
            <option value="">Pilih Supplier</option>
            <?php
            // Mengambil data supplier dari database
            $sql_supplier = "SELECT supplier_id, nama_supplier FROM Supplier";
            $result_supplier = $conn->query($sql_supplier);
            if ($result_supplier->num_rows > 0) {
                while ($row_supplier = $result_supplier->fetch_assoc()) {
                    echo "<option value='" . $row_supplier['supplier_id'] . "'>" . $row_supplier['nama_supplier'] . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="jumlah_masuk" class="form-label">Jumlah Masuk:</label>
        <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk" required>
    </div>
    <div class="mb-1">
        <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required><br>
    </div>
    <div class="mb-3">
        <label for="ket" class="form-label">Keterangan (Opsional)</label>
        <input type="text" class="form-control" id="ket" name="ket"><br>
    </div>
    <input type="submit" class="btn btn-primary" value="Submit">
</form>