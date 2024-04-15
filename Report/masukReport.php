<?php
require('../library/fpdf.php'); // Memuat library FPDF

class PDF extends FPDF
{
    // Fungsi untuk membuat header halaman
    function Header()
    {
        // Logo
        $this->Image('logo.png', 10, 6, 30);
        // Judul
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Laporan Barang Masuk', 0, 1, 'C');
        // Garis bawah
        $this->Ln(10);
    }

    // Fungsi untuk membuat tabel
    function CreateTable($header, $data)
    {
        // Header
        foreach ($header as $col)
            $this->Cell(38, 7, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(38, 6, $col, 1);
            $this->Ln();
        }
    }
}

// Membuat objek PDF baru
$pdf = new PDF();
$pdf->AddPage();

// Header
$header = array('ID', 'Nama Barang', 'Nama Supplier', 'Jumlah Masuk', 'Tanggal');

// Data
$data = array();
include '../Database.php';
$db = new \Models\Database();
$conn = $db->getConnection();
$sql = "SELECT transaksi_masuk.transaksi_masuk_id, 
        barang.nama_barang, 
        supplier.nama_supplier, 
        transaksi_masuk.jumlah_masuk, 
        transaksi_masuk.tanggal_masuk
        FROM transaksi_masuk
        JOIN barang ON transaksi_masuk.barang_id = barang.barang_id
        JOIN supplier ON transaksi_masuk.supplier_id = supplier.supplier_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array($row["transaksi_masuk_id"], $row["nama_barang"], $row["nama_supplier"], $row["jumlah_masuk"], $row["tanggal_masuk"]);
    }
} else {
    $data[] = array('Tidak ada data', '', '', '', '');
}

// Membuat tabel dari data
$pdf->CreateTable($header, $data);

// Menampilkan PDF
$pdf->Output();

// Menutup koneksi database
mysqli_close($conn);
