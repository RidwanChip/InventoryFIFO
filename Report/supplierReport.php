<?php
require('../library/fpdf.php');
class PDF extends FPDF
{
    // Fungsi untuk membuat header halaman
    function Header()
    {
        // Logo
        $this->Image('logo.png', 10, 6, 30);
        // Judul
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Laporan Data Supplier', 0, 1, 'C');
        // Garis bawah
        $this->Ln(10);
    }

    // Fungsi untuk membuat tabel
    function CreateTable($header, $data)
    {
        // Header
        foreach ($header as $col)
            $this->Cell(45, 7, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(45, 6, $col, 1);
            $this->Ln();
        }
    }
}

// Membuat objek PDF baru
$pdf = new PDF();
$pdf->AddPage();

// Header
$header = array('ID', 'Nama Supplier', 'Alamat', 'Kontak');

// Data
$data = array();
include '../Database.php';
$db = new \Models\Database();
$conn = $db->getConnection();
$sql = "SELECT * FROM supplier";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array($row["supplier_id"], $row["nama_supplier"], $row["alamat"], $row["kontak"]);
    }
} else {
    $data[] = array('Tidak ada data', '', '', '');
}

// Membuat tabel dari data
$pdf->CreateTable($header, $data);

// Menampilkan PDF
$pdf->Output();

// Menutup koneksi database
mysqli_close($conn);
