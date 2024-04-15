<?php
session_start();
include '../kkp/Alert/notif.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../kkp/main.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar fixed-top navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-primary d-lg-none overflow-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                        <i class="bi bi-menu-button-wide"> </i>Menu
                    </button>
                    <a class="navbar-brand mx-lg-2" href="../kkp/page.php?q=home" style="color: orange;">SUP Frezz</a>
                </div>
            </nav>
            <aside class="bd-sidebar col col-12 col-sm-12 col-lg-2 h-100vh pt-3">
                <div class="">
                    <div class="offcanvas-lg offcanvas-start pt-lg-5 mt-lg-3 m-lg-2" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">
                                <i class="bi bi-menu-button-wide"> </i>Menu
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <nav class="bd-links w-100">
                                <p class="d-inline-flex gap-1">
                                    <a href="../kkp/page.php?q=barangView"><button class="btn btn-success" style="min-width: 150px;"><i class="bi bi-boxes"> </i>Barang</button></a>
                                </p>
                                <br />

                                <p class="d-inline-flex gap-1">
                                    <a href="../kkp/page.php?q=supplierView"><button class="btn btn-success" style="min-width: 150px;"><i class="bi bi-person-vcard"> </i>Supplier</button></a>
                                </p>
                                <br />

                                <p class="d-inline-flex gap-1">
                                    <a href="../kkp/page.php?q=pelangganView"><button class="btn btn-success" style="min-width: 150px;"><i class="bi bi-person-lines-fill"> </i>Pelanggan</button></a>
                                </p>
                                <br />

                                <p class="d-inline-flex gap-1">
                                    <a href="../kkp/page.php?q=masukView"><button class="btn btn-success" style="min-width: 150px;"><i class="bi bi-inboxes"> </i>Barang Masuk</button></a>
                                </p>
                                <br />

                                <p class="d-inline-flex gap-1">
                                    <a href="../kkp/page.php?q=keluarView"><button class="btn btn-success" style="min-width: 150px;"><i class="bi bi-inboxes-fill"> </i>Barang Keluar</button></a>
                                </p>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>
            <main class="main col col-sm-11 col-lg-9 p-lg-0 m-2">
                <div class="pt-5">