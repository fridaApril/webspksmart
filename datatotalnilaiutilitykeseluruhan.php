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


$wj = [
    'C1' => 0.20,
    'C2' => 0.25,
    'C3' => 0.15,
    'C4' => 0.15,
    'C5' => 0.10,
    'C6' => 0.05,
    'C7' => 0.05,
    'C8' => 0.05
];

$query = mysqli_query($conn, "SELECT * FROM nilai ORDER BY id ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPK Metode SMART - Per Alternatif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="logo.png" />
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
<a href="datahasilutility.php"><i class="bi bi-bar-chart me-2"></i>Data Hasil Utility</a>
<a href="datatotalnilaiutilitykeseluruhan.php" class="active"><i class="bi bi-calculator me-2"></i>Total Nilai Utility Keseluruhan</a>
<a href="dataranking.php"><i class="bi bi-trophy-fill me-2"></i>Data Ranking</a>

</div>
<div class="main-content"><
<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Total Nilai Utility Keseluruhan </h2>

    <?php
    while ($data = mysqli_fetch_assoc($query)) {
        $alt = $data['alternatif'];

        echo "<h4 class='mt-5 mb-3'>Alternatif {$alt}</h4>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='table-primary'>";
        echo "<tr><th>No</th><th>Kriteria</th><th>Penilaian</th><th>Perhitungan ui(ai)</th><th>wj</th><th>uiai</th></tr>";
        echo "</thead><tbody>";

        $no = 1;
        $total_uiai = 0;
        foreach ($nilai_batas[$alt] as $kriteria => $batas) {
            $penilaian = $data[$kriteria];
            $nilai_max = $batas['max'];
            $nilai_min = $batas['min'];
            $ui = hitungUi($nilai_max, $nilai_min, $penilaian);
        
            $bobot = $wj[$kriteria];
            $uiai = $ui * $bobot;
        
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$kriteria}</td>";
            echo "<td>{$penilaian}</td>";
            echo "<td>= 100 × ({$penilaian} - {$nilai_min}) / ({$nilai_max} - {$nilai_min}) = <strong>" . round($ui, 2) . "%</strong></td>";
            echo "<td>" . number_format($bobot, 2) . "</td>";
            echo "<td><strong>" . round($uiai, 2) . "</strong></td>";
            echo "</tr>";
        
            $total_uiai += $uiai;
            $no++;
        }

        echo "<tr class='table-success'>";
        echo "<td colspan='5'><strong>Total Nilai Utility (Σ uiai)</strong></td>";
        echo "<td><strong>" . round($total_uiai, 2) . "</strong></td>";
        echo "</tr>";
        
        echo "</tbody></table>";
        
    }
    ?>
</div>
</div>

<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>
