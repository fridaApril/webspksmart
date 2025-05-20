<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:login.php');
    exit;
}
$admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPK Metode SMART</title>
    <link rel="icon" type="image/png" href="logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 70px;
            left: 0;
            width: 240px;
            background-color: #0d6efd;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0b5ed7;
        }
        .main-content {
            margin-left: 260px;
            margin-top: 90px;
            padding: 30px 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                top: 0;
            }
            .main-content {
                margin-left: 0;
                margin-top: 110px;
            }
        }
        .table-responsive {
            overflow-x: auto;
        }
        .navbar {
            z-index: 1030;
        }

        .navbar-brand span {
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center">
            <img src="logo.png" alt="Logo" width="120" class="d-inline-block align-text-top me-2">
            <span>Klinik Dokter Suzie Bas</span>
        </a>

        <div class="d-flex ms-auto">
            <a href="logout.php" class="btn btn-danger btn-outline-light fs-5">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>


<div class="sidebar">
<a href="home.php" style="margin-top: 20px;" class="active"><i class="bi bi-house-door me-2"></i>Beranda</a>
<a href="datasusulansia.php"><i class="bi bi-sliders2-vertical me-2"></i>Data Susu Lansia</a>
<a href="datakriteria.php"><i class="bi bi-sliders2-vertical me-2"></i>Data Kriteria</a>
<a href="dataalternatif.php"><i class="bi bi-boxes me-2"></i>Data Alternatif</a>
<a href="datanilai.php"><i class="bi bi-pencil-square me-2"></i>Data Nilai</a>
<a href="datanilaiutility.php"><i class="bi bi-graph-up me-2"></i>Data Nilai Utility</a>
<a href="datahasilutility.php"><i class="bi bi-bar-chart me-2"></i>Data Hasil Utility</a>
<a href="datatotalnilaiutilitykeseluruhan.php"><i class="bi bi-calculator me-2"></i>Total Nilai Utility Keseluruhan</a>
<a href="dataranking.php"><i class="bi bi-trophy-fill me-2"></i>Data Ranking</a>
</div>

<div class="main-content">
    <div class="text-center my-5">
        <h1 class="fw-bold">SPK Pemilihan Susu Bagi Lansia</h1>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <div class="content-box">
                    <h2 class="mb-3">Mengapa Lansia Perlu Meminum Susu setelah Usia 51 Tahun?</h2>
                    <p>Seiring bertambahnya usia, kebutuhan tubuh akan kalsium dan vitamin D meningkat untuk menjaga kesehatan tulang dan mencegah osteoporosis.</p>
                    <p>Setelah usia 51 tahun, tubuh mengalami penurunan penyerapan kalsium, membuat tulang lebih rapuh dan rentan patah.</p>
                    <p>Mengonsumsi susu secara rutin penting untuk memastikan asupan kalsium dan vitamin D yang cukup, yang juga mendukung kesehatan otot dan tulang lansia.</p>
                </div>
            </div>

            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="img/lansia meminum susu.jpg" alt="Lansia Meminum Susu" class="img-fluid">
            </div>
        </div>
    </div>
    </div>
</body>
</html>
