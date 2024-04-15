<?php

namespace Models;

require_once 'Database.php';

class Barang
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function tampil_data()
    {
        $data = mysqli_query($this->db, "SELECT * FROM barang");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function tambah_data($nama_barang, $harga_satuan, $stok, $gambar)
    {
        $gambarData = addslashes(file_get_contents($gambar['tmp_name']));
        mysqli_query($this->db, "INSERT INTO barang (nama_barang, harga_satuan, stok, gambar) VALUES ('$nama_barang','$harga_satuan','$stok','$gambarData')");
    }

    function edit_data($barang_id)
    {
        $data = mysqli_query($this->db, "SELECT * FROM barang WHERE barang_id='$barang_id'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function update_data($barang_id, $nama_barang, $harga_satuan, $stok, $gambar)
    {
        if ($gambar['tmp_name'] != "") {
            // Jika gambar baru diunggah
            $gambarData = addslashes(file_get_contents($gambar['tmp_name']));
            mysqli_query($this->db, "UPDATE barang SET nama_barang = '$nama_barang', harga_satuan = '$harga_satuan', stok = '$stok', gambar = '$gambarData' WHERE barang_id ='$barang_id' ");
        } else {
            // Jika tidak ada gambar baru diunggah, gunakan data gambar yang ada di database
            $existingData = $this->get_existing_image($barang_id);
            $query = "UPDATE barang SET nama_barang = ?, harga_satuan = ?, stok = ?, gambar = ? WHERE barang_id = ?";
            $stmt = mysqli_prepare($this->db, $query);
            mysqli_stmt_bind_param($stmt, "ssiss", $nama_barang, $harga_satuan, $stok, $existingData, $barang_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    function get_existing_image($barang_id)
    {
        $result = mysqli_query($this->db, "SELECT gambar FROM barang WHERE barang_id = '$barang_id'");
        $row = mysqli_fetch_assoc($result);
        return $row['gambar'];
    }


    function hapus_data($barang_id)
    {
        mysqli_query($this->db, "DELETE FROM barang WHERE barang_id = '$barang_id' ");
    }
}
