<?php
include 'Models/Pelanggan.php';

use Models\Pelanggan;

$db = new Pelanggan();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $db->tambah_data(
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['kontak']
    );
    $_SESSION['success'] = "Sukses Data Ditambahkan";
    header("location: ../kkp/page.php?q=pelangganView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['pelanggan_id'],
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['kontak']
    );
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../kkp/page.php?q=pelangganView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['pelanggan_id']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../kkp/page.php?q=pelangganView");
}
