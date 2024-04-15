<?php
include 'Models/Barang.php';

use Models\Barang;

$db = new Barang();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $gambar = $_FILES['gambar'];
    $db->tambah_data(
        $_POST['nama_barang'],
        $_POST['harga_satuan'],
        $_POST['stok'],
        $gambar
    );
    $_SESSION['success'] = "Sukses Data Ditambahkan";
    header("location: ../kkp/page.php?q=barangView");
} elseif ($aksi == "update") {
    $gambar = $_FILES['gambar'];

    // Check if a new image is uploaded
    if ($_FILES['gambar']['name']) {
        // If a new image is uploaded, use the new image data for updating
        $db->update_data(
            $_POST['barang_id'],
            $_POST['nama_barang'],
            $_POST['harga_satuan'],
            $_POST['stok'],
            $gambar
        );
    } else {
        // If no new image is uploaded, use the existing image data from the database
        $db->update_data(
            $_POST['barang_id'],
            $_POST['nama_barang'],
            $_POST['harga_satuan'],
            $_POST['stok'],
            array('tmp_name' => '') // Provide an empty temporary file name to prevent errors
        );
    }
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../kkp/page.php?q=barangView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['barang_id']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../kkp/page.php?q=barangView");
}
