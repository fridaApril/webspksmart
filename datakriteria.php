<?php
include 'config.php';
$sql = "SELECT * FROM kriteria";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <title>Data Kriteria</title>
    <link rel="icon" type="image/png" href="logo.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
<a href="home.php" style="margin-top: 20px;"><i class="bi bi-house-door me-2"></i>Beranda</a>
<a href="datasusulansia.php"><i class="bi bi-sliders2-vertical me-2"></i>Data Susu Lansia</a>
<a href="datakriteria.php" class="active"><i class="bi bi-sliders2-vertical me-2"></i>Data Kriteria</a>
<a href="dataalternatif.php" ><i class="bi bi-boxes me-2"></i>Data Alternatif</a>
<a href="datanilai.php"><i class="bi bi-pencil-square me-2"></i>Data Nilai</a>
<a href="datanilaiutility.php"><i class="bi bi-graph-up me-2"></i>Data Nilai Utility</a>
<a href="datahasilutility.php"><i class="bi bi-bar-chart me-2"></i>Data Hasil Utility</a>
<a href="datatotalnilaiutilitykeseluruhan.php"><i class="bi bi-calculator me-2"></i>Total Nilai Utility Keseluruhan</a>
<a href="dataranking.php"><i class="bi bi-trophy-fill me-2"></i>Data Ranking</a>

</div>

<div class="main-content">
<div class="container mt-5">
<h1 class="text-center mb-3">Data Kriteria</h1>
<div class="mb-3 text-end">
    <a href="tambahkriteria.php" class="btn btn-primary">+ Tambah Kriteria</a>
</div>


    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Bobot (%)</th>
                <th>Normalisasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
if ($result->num_rows > 0) {
    $no = 1;
    $totalBobot = 0;
    $totalNormalisasi = 0;

    while ($row = $result->fetch_assoc()) {
        $totalBobot += $row["bobot"];
        $totalNormalisasi += $row["normalisasi"];

        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row["kriteria"] . "</td>";
        echo "<td>" . $row["nama_kriteria"] . "</td>";
        echo "<td>" . $row["bobot"] . "%</td>";
        echo "<td>" . $row["normalisasi"] . "</td>";
        echo "<td>
                <a href='editkriteria.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning me-1'>
                    <i class='bi bi-pencil-square'></i> Edit
                </a>
                <a href='deletekriteria.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                    <i class='bi bi-trash'></i> Hapus
                </a>
              </td>";
        echo "</tr>";
    }
    echo "<tr class='table-secondary fw-bold'>
    <td></td>
            <td colspan='2'>Total</td>
            <td>" . number_format($totalBobot, 2) . "%</td>
            <td>" . number_format($totalNormalisasi, 2) . "</td>
          </tr>";

} else {
    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
}
?>


        </tbody>
    </table>
</div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
