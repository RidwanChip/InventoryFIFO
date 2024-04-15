<?php
include 'Models/Masuk.php';

use Models\Masuk;

$db = new Masuk();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $db->tambah_data(
        $_POST['barang_id'],
        $_POST['supplier_id'],
        $_POST['jumlah_masuk'],
        $_POST['tanggal_masuk'],
        $_POST['ket']
    );

    header("location: ../kkp/page.php?q=masukView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['Masuk_id'],
        $_POST['nama_Masuk'],
        $_POST['harga_satuan'],
        $_POST['stok'],
        $_POST['ket']
    );
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../kkp/page.php?q=MasukView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['transaksi_masuk_id']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../kkp/page.php?q=masukView");
}
