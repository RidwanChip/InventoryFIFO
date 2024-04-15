<?php

namespace Models;

require_once 'Database.php';

class Keluar
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
            "SELECT tk.transaksi_keluar_id, b.nama_barang, p.nama , tk.jumlah_keluar, b.harga_satuan, tk.tanggal_keluar , tk.ket
            FROM transaksi_keluar tk
            JOIN barang b ON tk.barang_id = b.barang_id
            JOIN pelanggan p ON tk.pelanggan_id = p.pelanggan_id"
        );
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function tambah_data($barang_ids, $pelanggan_ids, $jumlah_keluars, $tanggal_keluar, $ket)
    {
        // Memeriksa apakah jumlah barang, jumlah keluar, dan tanggal keluar memiliki jumlah yang sama
        if (count($barang_ids) != count($jumlah_keluars)) {
            echo "Error: Jumlah barang, jumlah keluar, dan tanggal keluar harus sama.";
            return;
        }

        // Memproses setiap barang yang akan dikeluarkan
        for ($i = 0; $i < count($barang_ids); $i++) {
            $barang_id = $barang_ids[$i];
            $jumlah_keluar = $jumlah_keluars[$i];


            // Memeriksa apakah jumlah keluar valid
            if ($jumlah_keluar <= 0) {
                $_SESSION['failed'] = "Jumlah keluar tidak valid";
                return;
            }

            // Menghitung jumlah total masuk untuk barang tersebut
            $sql_total_masuk = "SELECT SUM(jumlah_masuk) AS total_masuk FROM transaksi_masuk WHERE barang_id = '$barang_id'";
            $result_total_masuk = mysqli_query($this->db, $sql_total_masuk);
            $row_total_masuk = mysqli_fetch_assoc($result_total_masuk);
            $total_masuk = $row_total_masuk['total_masuk'];

            // Memeriksa apakah stok cukup
            if ($total_masuk < $jumlah_keluar) {
                $_SESSION['failed'] = "Jumlah stok keseluruhan masuk tidak mencukupi.";
                return;
            }

            // Memperbarui jumlah keluar di tabel transaksi keluar
            mysqli_query($this->db, "INSERT INTO transaksi_keluar (barang_id, pelanggan_id ,jumlah_keluar, tanggal_keluar, ket) VALUES ('$barang_id', '$pelanggan_ids', '$jumlah_keluar', '$tanggal_keluar' , '$ket')");

            // Mengurangi stok barang di tabel barang
            $sql_update_stok_barang = "UPDATE barang SET stok = stok - '$jumlah_keluar' WHERE barang_id = '$barang_id'";
            if (mysqli_query($this->db, $sql_update_stok_barang)) {
                // Memperbarui jumlah masuk di tabel transaksi masuk berdasarkan metode FIFO
                $jumlah_yang_dikeluarkan = $jumlah_keluar;
                while ($jumlah_yang_dikeluarkan > 0) {
                    // Ambil transaksi masuk yang paling lama (FIFO)
                    $sql_select_transaksi_masuk = "SELECT transaksi_masuk_id, jumlah_masuk FROM transaksi_masuk WHERE barang_id = '$barang_id' AND jumlah_masuk > 0 ORDER BY tanggal_masuk ASC LIMIT 1";
                    $result_transaksi_masuk = mysqli_query($this->db, $sql_select_transaksi_masuk);
                    if ($result_transaksi_masuk && mysqli_num_rows($result_transaksi_masuk) > 0) {
                        $row = mysqli_fetch_assoc($result_transaksi_masuk);
                        $transaksi_masuk_id = $row['transaksi_masuk_id'];
                        $jumlah_masuk = $row['jumlah_masuk'];

                        // Jika jumlah yang akan dikeluarkan lebih kecil dari atau sama dengan jumlah masuk pada transaksi ini
                        if ($jumlah_yang_dikeluarkan <= $jumlah_masuk) {
                            mysqli_query($this->db, "UPDATE transaksi_masuk SET jumlah_masuk = jumlah_masuk - '$jumlah_yang_dikeluarkan' WHERE transaksi_masuk_id = '$transaksi_masuk_id'");
                            $jumlah_yang_dikeluarkan = 0; // Jumlah yang dikeluarkan sudah terpenuhi
                        } else {
                            // Jika jumlah yang akan dikeluarkan lebih besar dari jumlah masuk pada transaksi ini
                            mysqli_query($this->db, "UPDATE transaksi_masuk SET jumlah_masuk = 0 WHERE transaksi_masuk_id = '$transaksi_masuk_id'");
                            $jumlah_yang_dikeluarkan -= $jumlah_masuk;
                        }
                    } else {
                        // Jika tidak ada transaksi masuk lagi untuk barang ini
                        echo "Error: Tidak ada transaksi masuk lagi untuk barang ini.";
                        return;
                    }
                }
                $_SESSION['success'] = "Transaksi barang keluar berhasil ditambahkan.";
                echo "Transaksi barang keluar berhasil ditambahkan.";
            } else {
                echo "Error: " . $sql_update_stok_barang . "<br>" . mysqli_error($this->db);
            }
        }
    }

    function edit_data($transaksi_keluar_id)
    {
        $data = mysqli_query($this->db, "SELECT * FROM transaksi_keluar WHERE transaksi_keluar_id='$transaksi_keluar_id'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function update_data($transaksi_keluar_id, $barang_id, $jumlah_keluar, $tanggal_keluar, $ket)
    {
        mysqli_query($this->db, "UPDATE transaksi_keluar SET barang_id = '$barang_id', jumlah_keluar = '$jumlah_keluar', tanggal_keluar = '$tanggal_keluar' , ket = '$ket' WHERE transaksi_keluar_id ='$transaksi_keluar_id' ");
    }

    function hapus_data($transaksi_keluar_id)
    {
        mysqli_query($this->db, "DELETE FROM transaksi_keluar WHERE transaksi_keluar_id = '$transaksi_keluar_id' ");
    }
}
