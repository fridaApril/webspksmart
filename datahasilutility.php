<?php
include 'config.php';

function hitungUi($nilai_max, $nilai_min, $nilai_aktual) {
    if (($nilai_max - $nilai_min) != 0) {
        return 100 * (($nilai_aktual - $nilai_min) / ($nilai_max - $nilai_min));
    } else {
        return 0;
    }
}

$nilai_batas = [];
$result_batas = mysqli_query($conn, "SELECT * FROM nilai_batas");

while ($row = mysqli_fetch_assoc($result_batas)) {
    $alt = $row['alternatif'];
    $krit = $row['kriteria'];
    $nilai_batas[$alt][$krit] = [
        'max' => $row['nilai_max'],
        'min' => $row['nilai_min']
    ];
}

$query = mysqli_query($conn, "SELECT * FROM nilai ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Utility UI(ai)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        table {
            font-size: 14px;
            margin-bottom: 50px;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
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
<a href="datakriteria.php"><i class="bi bi-sliders2-vertical me-2"></i>Data Kriteria</a>
<a href="dataalternatif.php"><i class="bi bi-boxes me-2"></i>Data Alternatif</a>
<a href="datanilai.php"><i class="bi bi-pencil-square me-2"></i>Data Nilai</a>
<a href="datanilaiutility.php"><i class="bi bi-graph-up me-2"></i>Data Nilai Utility</a>
<a href="datahasilutility.php" class="active"><i class="bi bi-bar-chart me-2"></i>Data Hasil Utility</a>
<a href="datatotalnilaiutilitykeseluruhan.php"><i class="bi bi-calculator me-2"></i>Total Nilai Utility Keseluruhan</a>
<a href="dataranking.php"><i class="bi bi-trophy-fill me-2"></i>Data Ranking</a>

</div>
<div class="main-content">
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Hasil Perhitungan Nilai Utility Setiap Kriteria</h2>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Alternatif</th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>C5</th>
                <th>C6</th>
                <th>C7</th>
                <th>C8</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>{$data['alternatif']}</td>";

                foreach (['C1','C2','C3','C4','C5','C6','C7','C8'] as $kriteria) {
                    $penilaian = $data[$kriteria];
                    $nilai_max = $nilai_batas[$data['alternatif']][$kriteria]['max'];
                    $nilai_min = $nilai_batas[$data['alternatif']][$kriteria]['min'];
                    $ui = hitungUi($nilai_max, $nilai_min, $penilaian);
                    echo "<td>" . round($ui, 2) . "</td>";
                }
                

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>
