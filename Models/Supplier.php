<?php

namespace Models;

require_once 'Database.php';

class Supplier
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function tampil_data()
    {
        $data = mysqli_query($this->db, "SELECT * FROM supplier");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function tambah_data($nama_supplier, $alamat, $kontak)
    {
        mysqli_query($this->db, "INSERT INTO supplier VALUES (NULL ,'$nama_supplier','$alamat','$kontak')");
    }

    function edit_data($supplier_id)
    {
        $data = mysqli_query($this->db, "SELECT * FROM supplier WHERE supplier_id='$supplier_id'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function update_data($supplier_id, $nama_supplier, $alamat, $kontak)
    {
        mysqli_query($this->db, "UPDATE supplier SET nama_supplier = '$nama_supplier', alamat = '$alamat', kontak = '$kontak' WHERE supplier_id ='$supplier_id' ");
    }

    function hapus_data($supplier_id)
    {
        mysqli_query($this->db, "DELETE FROM supplier WHERE supplier_id = '$supplier_id' ");
    }
}
