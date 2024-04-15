<?php
include 'Models/Keluar.php';

use Models\Keluar;

$db = new Keluar();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $db->tambah_data(
        $_POST['barang_id'],
        $_POST['pelanggan_id'],
        $_POST['jumlah_keluar'],
        $_POST['tanggal_keluar'],
        $_POST['ket']
    );
    //$_SESSION['success'] = "Sukses Data Ditambahkan";
    header("location: ../kkp/page.php?q=keluarView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['keluar_id'],
        $_POST['nama_keluar'],
        $_POST['harga_satuan'],
        $_POST['stok'],
        $_POST['ket']
    );
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../kkp/page.php?q=keluarView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['transaksi_keluar_id']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../kkp/page.php?q=keluarView");
}
