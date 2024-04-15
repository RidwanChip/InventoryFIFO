<?php
include 'Models/Supplier.php';

use Models\Supplier;

$db = new Supplier();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $db->tambah_data(
        $_POST['nama_supplier'],
        $_POST['alamat'],
        $_POST['kontak']
    );
    $_SESSION['success'] = "Sukses Data Ditambahkan";
    header("location: ../kkp/page.php?q=supplierView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['supplier_id'],
        $_POST['nama_supplier'],
        $_POST['alamat'],
        $_POST['kontak']
    );
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../kkp/page.php?q=supplierView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['supplier_id']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../kkp/page.php?q=supplierView");
}
