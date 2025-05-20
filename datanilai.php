<?php
include 'config.php';

$sql = "SELECT * FROM nilai";
$result = $conn->query($sql);

$query = mysqli_query($conn, "SELECT * FROM nilai_batas ORDER BY alternatif ASC, kriteria ASC");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[$row['alternatif']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Nilai Alternatif</title>
    <link rel="icon" type="image/png" href="logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <a class="navbar-brand d-flex align-items-center" >
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
        <a href="datanilai.php" class="active"><i class="bi bi-pencil-square me-2"></i>Data Nilai</a>
        <a href="datanilaiutility.php"><i class="bi bi-graph-up me-2"></i>Data Nilai Utility</a>
        <a href="datahasilutility.php"><i class="bi bi-bar-chart me-2"></i>Data Hasil Utility</a>
        <a href="datatotalnilaiutilitykeseluruhan.php"><i class="bi bi-calculator me-2"></i>Total Nilai Utility Keseluruhan</a>
        <a href="dataranking.php"><i class="bi bi-trophy-fill me-2"></i>Data Ranking</a>

    </div>
    <div class="main-content">
        <div class="container mt-5 mb-5">
            <h2 class="text-center mb-4">Nilai Kriteria Untuk Setiap Alternatif</h2>

            <div class="text-end mb-3">
                <a href="tambahnilai.php" class="btn btn-primary">+ Tambah Data Nilai</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th rowspan="2">Alternatif</th>
                            <th colspan="8">Kriteria</th>
                        </tr>
                        <tr>
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                            <th>C6</th>
                            <th>C7</th>
                            <th>C8</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["alternatif"]) . "</td>";
                                echo "<td>" . $row["C1"] . "</td>";
                                echo "<td>" . $row["C2"] . "</td>";
                                echo "<td>" . $row["C3"] . "</td>";
                                echo "<td>" . $row["C4"] . "</td>";
                                echo "<td>" . $row["C5"] . "</td>";
                                echo "<td>" . $row["C6"] . "</td>";
                                echo "<td>" . $row["C7"] . "</td>";
                                echo "<td>" . $row["C8"] . "</td>";
                                echo "<td>
                                <a href='editnilai.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning mb-1'><i class='bi bi-pencil-square'></i></a>
                                <a href='deletenilai.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus nilai ini?\");'><i class='bi bi-trash'></i></a>
                              </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>Tidak ada data nilai</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <h2 class="text-center mb-4">Data Nilai Batas</h2>
            <div class="text-end mb-3">
            <a href="tambahnilaibatas.php" class="btn btn-primary mb-3">+ Tambah Data</a>
            </div>
            <?php
            uksort($data, function ($a, $b) {
                preg_match('/\d+/', $a, $matchesA);
                preg_match('/\d+/', $b, $matchesB);
                $numA = isset($matchesA[0]) ? (int)$matchesA[0] : 0;
                $numB = isset($matchesB[0]) ? (int)$matchesB[0] : 0;
                return $numA <=> $numB;
            });
            ?>

<?php foreach ($data as $alternatif => $nilai_list): ?>
    <h4>
        Alternatif: <?= htmlspecialchars($alternatif); ?>
        <a href="hapusalternatif.php?alternatif=<?= urlencode($alternatif); ?>" 
           class="btn btn-sm btn-danger ms-3" 
           onclick="return confirm('Yakin ingin menghapus semua data untuk alternatif ini?');">
            <i class="bi bi-trash"></i> Hapus Alternatif
        </a>
    </h4>
    
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kriteria</th>
                    <th>Nilai Min</th>
                    <th>Nilai Max</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($nilai_list)): ?>
                    <?php $no = 1;
                    foreach ($nilai_list as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['kriteria']); ?></td>
                            <td><?= htmlspecialchars($row['nilai_min']); ?></td>
                            <td><?= htmlspecialchars($row['nilai_max']); ?></td>
                            <td>
                                <a href="editnilaibatas.php?id=<?= urlencode($row['id']); ?>" class="btn btn-sm btn-warning mb-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>