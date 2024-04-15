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
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Laporan Barang Keluar', 0, 1, 'C');
        // Garis bawah
        $this->Ln(10);
    }

    // Fungsi untuk membuat tabel
    function CreateTable($header, $data)
    {
        // Header
        foreach ($header as $col)
            $this->Cell(28, 6, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(28, 4, $col, 1);
            $this->Ln();
        }
    }
}

// Membuat objek PDF baru
$pdf = new PDF();
$pdf->AddPage();

// Header
$header = array('ID', 'Nama Barang', 'Jumlah keluar', 'Harga/Kg', 'Total Harga', 'Pembeli', 'Tanggal Keluar');

// Data
$data = array();
include '../Database.php';
$db = new \Models\Database();
$conn = $db->getConnection();
$sql = "SELECT tk.transaksi_keluar_id, b.nama_barang, p.nama , tk.jumlah_keluar, b.harga_satuan, tk.tanggal_keluar
        FROM transaksi_keluar tk
        JOIN barang b ON tk.barang_id = b.barang_id
        JOIN pelanggan p ON tk.pelanggan_id = p.pelanggan_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $total = $row["jumlah_keluar"] * $row["harga_satuan"];
        $data[] = array($row["transaksi_keluar_id"], $row["nama_barang"], $row["jumlah_keluar"], $row["harga_satuan"], $total, $row["nama"], $row["tanggal_keluar"]);
    }
} else {
    $data[] = array('Tidak ada data', '', '', '', '', '', '');
}

// Membuat tabel dari data
$pdf->CreateTable($header, $data);

// Menampilkan PDF
$pdf->Output();

// Menutup koneksi database
mysqli_close($conn);
