<?php
include 'config.php';

$data_nilai = [];
$alternatif_list = [];
$query = mysqli_query($conn, "SELECT * FROM nilai");
while ($row = mysqli_fetch_assoc($query)) {
    $alt = $row['alternatif'];
    $alternatif_list[] = $alt;
    $data_nilai[$alt] = $row;
}

$kriteria_list = ['C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8'];
$nilai_batas = [];

foreach ($kriteria_list as $k) {
    $nilai_k = array_column($data_nilai, $k);
    $nilai_batas[$k]['min'] = min($nilai_k);
    $nilai_batas[$k]['max'] = max($nilai_k);
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

function hitungUi($nilai_max, $nilai_min, $nilai_aktual)
{
    if (($nilai_max - $nilai_min) != 0) {
        return 100 * (($nilai_aktual - $nilai_min) / ($nilai_max - $nilai_min));
    } else {
        return 0;
    }
}

$hasil_total_uiai = [];

foreach ($data_nilai as $alt => $nilai) {
    $total_uiai = 0;

    foreach ($kriteria_list as $k) {
        $penilaian = $nilai[$k];
        $nilai_max = $nilai_batas[$k]['max'];
        $nilai_min = $nilai_batas[$k]['min'];

        $ui = hitungUi($nilai_max, $nilai_min, $penilaian);
        $uiai = $ui * $wj[$k];

        $total_uiai += $uiai;
    }

    $hasil_total_uiai[] = [
        'alternatif' => $alt,
        'total_uiai' => $total_uiai
    ];
}
usort($hasil_total_uiai, function ($a, $b) {
    return $b['total_uiai'] <=> $a['total_uiai'];
});
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Total Nilai Utility</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="logo.png" />
    <style>
        table {
            font-size: 14px;
            margin-bottom: 50px;
        }

        th,
        td {
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

        .sidebar a:hover,
        .sidebar a.active {
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

<body class="bg-light">
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
        <a href="datatotalnilaiutilitykeseluruhan.php"><i class="bi bi-calculator me-2"></i>Total Nilai Utility Keseluruhan</a>
        <a href="dataranking.php" class="active"><i class="bi bi-trophy-fill me-2"></i>Data Ranking</a>

    </div>
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-center fw-bold mb-4">Hasil Total Nilai Utility (uiai) Per Alternatif</h2>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Peringkat</th>
                        <th>Alternatif</th>
                        <th>Total Nilai Utility</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ranking = 1;
                    $labels = [];
                    $values = [];
                    foreach ($hasil_total_uiai as $hasil) {
                        echo "<tr>";
                        echo "<td>{$ranking}</td>";
                        echo "<td>{$hasil['alternatif']}</td>";
                        echo "<td><strong>" . round($hasil['total_uiai'], 2) . "</strong></td>";
                        echo "</tr>";
                        $labels[] = $hasil['alternatif'];
                        $values[] = round($hasil['total_uiai'], 2);
                        $ranking++;
                    }
                    ?>
                </tbody>
            </table>
            <div class="mt-5">
                <h4 class="text-center mb-3">Diagram Total Nilai UIAI</h4>
                <canvas id="chartUIAI" height="100"></canvas>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartUIAI').getContext('2d');
        const chartUIAI = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total UIAI',
                    data: <?php echo json_encode($values); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nilai UIAI'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Alternatif'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>

</html>