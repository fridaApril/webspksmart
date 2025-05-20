<?php
include 'config.php';

$sqlAlternatif = "SELECT * FROM alternatif";
$resultAlternatif = $conn->query($sqlAlternatif);


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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Susu & Ranking - Tampilan Lansia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #e3f2fd;
            font-size: 22px;
        }

        header {
            background-color: rgb(0, 0, 0);
            font-size: 25px;
            padding: 20px 0;
        }

        .navbar-brand img {
            width: 140px;
        }

        nav.navbar {
            background: linear-gradient(to right, rgb(82, 177, 254), rgb(102, 255, 107));
            padding: 10px 0;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .nav-link {
            color: black !important;
            font-size: 18px;
        }


        .navbar-nav .nav-link:hover {
            color: rgb(0, 46, 83) !important;
        }

        .container {
            margin-top: 20px;
            margin-bottom: 60px;
        }



        h2 {
            font-size: 32px;
            color: #0d47a1;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .logout-btn {
            background-color: #f44336;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }



        .table th,
        .table td {
            white-space: normal;
            padding: 10px;
            text-overflow: ellipsis;
        }

        .table {
            font-size: 14px;
        }

        @media (max-width: 768px) {

            .table th,
            .table td {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {

            .table th,
            .table td {
                font-size: 10px;
                padding: 8px;
            }
        }


        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .navbar-brand span {
            font-size: 34px;
            font-weight: bold;
        }



        @media print {
            @page {
                size: A4 landscape;
                margin: 10mm 15mm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                background: white !important;
                color: black;
                font-size: 14px;
            }

            nav,
            .logout-btn,
            button,
            .btn,
            .mt-5,
            canvas {
                display: none !important;
            }

            .table-responsive {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            table th,
            table td {
                padding: 6px 8px !important;
                font-size: 12px;
                border: 1px solid #000 !important;
            }

            h2,
            h4 {
                page-break-after: avoid;
                margin: 10px 0;
            }

            .container {
                margin: 0 !important;
                padding: 0 !important;
            }

            canvas {
                display: none !important;
            }

            #chartPrintImage {
                display: block !important;
            }
        }
    </style>
</head>

<script>
    function printData() {
        const printContents = document.getElementById("printArea").innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>


<body>

    <header class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center">
                <img src="logo.png" alt="Logo" class="d-inline-block align-text-top me-2">
                <span>Klinik Dokter Suzie Bas</span>
            </a>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark" style="margin-top: 110px;">
        <div class="container-fluid px-4 d-flex align-items-center">
            <ul class="navbar-nav mx-auto d-flex justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#dataAlternatif">Data Alternatif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#dataRanking">Data Ranking</a>
                </li>

            </ul>
            <a href="logout.php" class="btn btn-danger d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>
    </nav>




    <div class="container" id="printArea">
        <button class="btn btn-primary d-print-none" onclick="window.print();">
            <i class="bi bi-printer me-2"></i> Cetak
        </button>


        <h2 class="text-center" id="dataAlternatif">Data Alternatif Susu</h2>

        <div class="table-responsive">
            <table class="table table-bordered text-center bg-white">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Merk Susu</th>
                        <th>Usia</th>
                        <th>Kandungan Nutrisi</th>
                        <th>Kalsium</th>
                        <th>Gula</th>
                        <th>Protein</th>
                        <th>Lemak</th>
                        <th>Harga</th>
                        <th>Rasa</th>
                        <th>Ketersediaan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultAlternatif->num_rows > 0) {
                        $no = 1;
                        while ($row = $resultAlternatif->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row["merk_susu"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["usia"]) . " Tahun keatas</td>";
                            echo "<td>" . htmlspecialchars($row["kandungan_nutrisi"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["kandungan_kalsium"]) . " mg</td>";
                            echo "<td>" . htmlspecialchars($row["kandungan_gula"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["kandungan_protein"]) . " g</td>";
                            echo "<td>" . htmlspecialchars($row["kandungan_lemak"]) . " g</td>";
                            echo "<td>Rp " . htmlspecialchars($row["harga"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["rasa"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["ketersediaan_produk"]) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>Data tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h2 class="text-center" id="dataRanking">Data Ranking Susu</h2>

        <div class="table-responsive">
            <table class="table table-bordered text-center bg-white">
                <thead class="table-success">
                    <tr>
                        <th>Peringkat</th>
                        <th>Merk Susu</th>
                        <th>Nilai</th>
                        <th>Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?php
                    $ranking = 1;
                    $labels = [];
                    $values = [];
                    foreach ($hasil_total_uiai as $hasil) {
                        $namaAlternatif = $conn->real_escape_string($hasil['alternatif']);
                        $sqlMerk = "SELECT merk_susu FROM alternatif WHERE nama_alternatif = '$namaAlternatif' LIMIT 1";
                        $resultMerk = $conn->query($sqlMerk);
                        $merkSusu = "-";

                        if ($resultMerk && $rowMerk = $resultMerk->fetch_assoc()) {
                            $merkSusu = $rowMerk['merk_susu'];
                        }

                        if ($ranking >= 1 && $ranking <= 3) {
                            $keputusan = "<span class='badge bg-success'>Terpilih</span>";
                        } else {
                            $keputusan = "<span class='badge bg-danger'>Tidak Terpilih</span>";
                        }

                        echo "<tr>";
                        echo "<td>{$ranking}</td>";
                        echo "<td>" . htmlspecialchars($merkSusu) . "</td>";
                        echo "<td><strong>" . round($hasil['total_uiai'], 2) . "</strong></td>";
                        echo "<td>{$keputusan}</td>";
                        echo "</tr>";

                        $labels[] = $hasil['alternatif'];
                        $values[] = round($hasil['total_uiai'], 2);
                        $ranking++;
                    }
                    ?>

                </tbody>

                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <h4 class="text-center mb-3">Diagram Ranking Susu</h4>
            <canvas id="chartUIAI" height="100"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.addEventListener("beforeprint", () => {
            const canvas = document.getElementById("chartUIAI");
            const img = document.createElement("img");
            img.id = "chartPrintImage";
            img.src = canvas.toDataURL("image/png");
            img.style.width = "100%";
            img.style.maxHeight = "500px";

            canvas.style.display = "none";
            canvas.parentNode.insertBefore(img, canvas.nextSibling);
        });

        window.addEventListener("afterprint", () => {
            const canvas = document.getElementById("chartUIAI");
            const img = document.getElementById("chartPrintImage");

            if (img) {
                img.remove();
            }
            canvas.style.display = "block";
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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