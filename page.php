<?php
ob_start();
include 'layouts/header.php';
?>
<main>
    <?php
    if (isset($_GET['q'])) {
        $q = $_GET['q'];
        switch ($q) {
                //Home
            case 'home':
                include "../kkp/home.php";
                break;
                //Barang
            case 'barangView':
                include "../kkp/Views/barangView.php";
                break;
            case 'barangInput':
                include "../kkp/Forms/barangInput.php";
                break;
            case 'barangAct':
                include "../kkp/Proses/barangProses.php";
                break;
            case 'barangEdit':
                include "../kkp/Forms/barangEdit.php";
                break;
                //Supplier
            case 'supplierView':
                include "../kkp/Views/supplierView.php";
                break;
            case 'supplierInput':
                include "../kkp/Forms/supplierInput.php";
                break;
            case 'supplierAct':
                include "../kkp/Proses/supplierProses.php";
                break;
            case 'supplierEdit':
                include "../kkp/Forms/supplierEdit.php";
                break;
                //Barang Masuk
            case 'masukView':
                include "../kkp/Views/masukView.php";
                break;
            case 'masukInput':
                include "../kkp/Forms/masukInput.php";
                break;
            case 'masukAct':
                include "../kkp/Proses/masukProses.php";
                break;
            case 'masukEdit':
                include "../kkp/Forms/masukEdit.php";
                break;
                //Barang Keluar
            case 'keluarView':
                include "../kkp/Views/keluarView.php";
                break;
            case 'keluarInput':
                include "../kkp/Forms/keluarInput.php";
                break;
            case 'keluarAct':
                include "../kkp/Proses/keluarProses.php";
                break;
            case 'keluarEdit':
                include "../kkp/Forms/keluarEdit.php";
                break;
                //Pelanggan
            case 'pelangganView':
                include "../kkp/Views/pelangganView.php";
                break;
            case 'pelangganInput':
                include "../kkp/Forms/pelangganInput.php";
                break;
            case 'pelangganAct':
                include "../kkp/Proses/pelangganProses.php";
                break;
            case 'pelangganEdit':
                include "../kkp/Forms/pelangganEdit.php";
                break;
                //Img
            case 'Img':
                include "../kkp/Img/";
                break;
        }
    } else {
        echo "<a href='../oop/index.php'>Kembali ke Beranda</a>";
    }
    ?>
    <?php
    include 'layouts/footer.php';
    ?>