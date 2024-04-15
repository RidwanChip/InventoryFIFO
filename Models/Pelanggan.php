<?php

namespace Models;

require_once 'Database.php';

class Pelanggan
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function tampil_data()
    {
        $data = mysqli_query($this->db, "SELECT * FROM pelanggan");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function tambah_data($nama, $alamat, $kontak)
    {
        mysqli_query($this->db, "INSERT INTO pelanggan VALUES (NULL ,'$nama','$alamat','$kontak')");
    }

    function edit_data($pelanggan_id)
    {
        $data = mysqli_query($this->db, "SELECT * FROM pelanggan WHERE pelanggan_id='$pelanggan_id'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function update_data($pelanggan_id, $nama, $alamat, $kontak)
    {
        mysqli_query($this->db, "UPDATE pelanggan SET nama = '$nama', alamat = '$alamat', kontak = '$kontak' WHERE pelanggan_id ='$pelanggan_id' ");
    }

    function hapus_data($pelanggan_id)
    {
        mysqli_query($this->db, "DELETE FROM pelanggan WHERE pelanggan_id = '$pelanggan_id' ");
    }
}
