<?php

namespace Models;

require_once 'Database.php';

class Masuk
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function tampil_data()
    {
        $data = mysqli_query(
            $this->db,
            "SELECT transaksi_masuk.transaksi_masuk_id, 
            barang.nama_barang, 
            supplier.nama_supplier, 
            transaksi_masuk.jumlah_masuk, 
            transaksi_masuk.tanggal_masuk,
            transaksi_masuk.ket
     FROM transaksi_masuk
     JOIN barang ON transaksi_masuk.barang_id = barang.barang_id
     JOIN supplier ON transaksi_masuk.supplier_id = supplier.supplier_id"
        );
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function tambah_data($barang_id, $supplier_id, $jumlah_masuk, $tanggal_masuk, $ket)
    {
        // Masukkan data transaksi masuk ke dalam tabel Transaksi_Masuk
        $sql = "INSERT INTO transaksi_masuk VALUES (NULL, '$barang_id', '$supplier_id', '$jumlah_masuk', '$tanggal_masuk' , '$ket')";
        if (mysqli_query($this->db, $sql)) {
            // Memperbarui stok barang
            $sql_update_stok = "UPDATE barang SET stok = stok + '$jumlah_masuk' WHERE barang_id = '$barang_id'";
            if (mysqli_query($this->db, $sql_update_stok)) {
                $_SESSION['success'] = "Sukses Data Ditambahkan";
            } else {
                echo "Error: " . $sql_update_stok . "<br>" . mysqli_error($this->db);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->db);
        }
    }

    function edit_data($barang_id)
    {
        $data = mysqli_query($this->db, "SELECT * FROM barang WHERE barang_id='$barang_id'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function update_data($barang_id, $nama_barang, $harga_satuan, $stok, $ket)
    {
        mysqli_query($this->db, "UPDATE barang SET nama_barang = '$nama_barang', harga_satuan = '$harga_satuan', stok = '$stok' , ket = '$ket' WHERE barang_id ='$barang_id' ");
    }

    function hapus_data($transaksi_masuk_id)
    {
        mysqli_query($this->db, "DELETE FROM transaksi_masuk WHERE transaksi_masuk_id = '$transaksi_masuk_id' ");
    }
}
