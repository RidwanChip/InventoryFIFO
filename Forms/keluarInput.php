<?php
include 'Database.php';

use Models\Database;

$database = new Database();
$conn = $database->getConnection();
?>
<h2>Form Transaksi Barang Keluar</h2>
<form action="../kkp/page.php?q=keluarAct&aksi=tambah" method="POST">
    <div class="row">
        <div class="mb-3 col col-lg-4 col-md-4 col-sm-4">
            <label for="pelanggan_id" class="form-label">Nama Pelanggan</label>
            <select name="pelanggan_id" class="form-control" required>
                <option value="">Pilih Pelanggan</option>
                <?php
                include 'koneksi.php';
                // Mengambil data barang dari database
                $sql_pelanggan = "SELECT pelanggan_id, nama FROM pelanggan";
                $result_pelanggan = $conn->query($sql_pelanggan);
                if ($result_pelanggan->num_rows > 0) {
                    while ($row_pelanggan = $result_pelanggan->fetch_assoc()) {
                        echo "<option value='" . $row_pelanggan['pelanggan_id'] . "'>" . $row_pelanggan['nama'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3 col col-lg-4 col-md-4 col-sm-4">
            <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label><br>
            <input type="date" class="form-control" name="tanggal_keluar" required>
        </div>
        <div class="mb-3 col col-lg-4 col-md-4 col-sm-4">
            <label for="ket" class="form-label">Keterangan (Opsional)</label><br>
            <input type="text" class="form-control" name="ket">
        </div>
    </div>
    <!-- Looping untuk setiap barang -->
    <div class="barang-container">
        <div class="barang-item">
            <div class="row">
                <div class="mb-3 col col-lg-4 col-md-6 col-sm-6 ">
                    <label for="barang_id" class="form-label">Nama Barang</label>
                    <select name="barang_id[]" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        <?php
                        include 'koneksi.php';
                        // Mengambil data barang dari database
                        $sql_barang = "SELECT barang_id, nama_barang , stok FROM Barang";
                        $result_barang = $conn->query($sql_barang);
                        if ($result_barang->num_rows > 0) {
                            while ($row_barang = $result_barang->fetch_assoc()) {
                                echo "<option value='" . $row_barang['barang_id'] . "'>" . $row_barang['nama_barang'] . " - Stok " . $row_barang['stok'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col col-lg-4 col-md-6 col-sm-6">
                    <label for="jumlah_keluar" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah_keluar[]" required>
                </div>
                <div class="mb-3 col col-lg-4 col-md-6 col-sm-6">
                    <label for="" class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-danger hapus-barang form-control">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" id="tambah-barang">Tambah Barang</button>
    <br><br>
    <input type="submit" class="btn btn-primary" value="Submit">
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Menambahkan event listener untuk tombol tambah barang
        document.getElementById("tambah-barang").addEventListener("click", function() {
            var barangContainer = document.querySelector(".barang-container");
            var barangItem = document.querySelector(".barang-item").cloneNode(true);
            barangContainer.appendChild(barangItem);

            // Menambahkan event listener untuk tombol hapus di barang baru
            var hapusButton = barangItem.querySelector(".hapus-barang");
            hapusButton.addEventListener("click", function() {
                if (document.querySelectorAll(".barang-item").length > 1) {
                    barangItem.remove(); // Menghapus elemen barang dari DOM
                } else {
                    alert("Minimal satu barang harus ada.");
                }
            });
        });

        // Menambahkan event listener untuk tombol hapus di barang yang sudah ada
        var hapusButtons = document.querySelectorAll(".hapus-barang");
        hapusButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var barangItem = button.closest(".barang-item"); // Mendapatkan elemen barang terdekat
                if (document.querySelectorAll(".barang-item").length > 1) {
                    barangItem.remove(); // Menghapus elemen barang dari DOM
                } else {
                    alert("Minimal satu barang harus ada.");
                }
            });
        });
    });
</script>