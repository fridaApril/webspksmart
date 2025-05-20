<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot = $_POST['bobot'];
    $normalisasi = $_POST['normalisasi'];

    $sql = "INSERT INTO kriteria (nama_kriteria, bobot, normalisasi) VALUES ('$nama_kriteria', $bobot, $normalisasi)";

    if ($conn->query($sql) === TRUE) {
        header("Location: datakriteria.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
            max-width: 700px;
        }
        .card {
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="logo.png" alt="Logo" width="120" class="d-inline-block align-text-top me-2">
                <span>Klinik Dokter Suzie Bas</span>
            </a>

            <div class="d-flex ms-auto">
                <a href="logout.php" class="btn btn-outline-light fs-5">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card p-4">
            <h2 class="mb-4">Tambah Data Kriteria</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                    <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" required>
                </div>
                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot (%)</label>
                    <input type="number" class="form-control" id="bobot" name="bobot" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="normalisasi" class="form-label">Normalisasi</label>
                    <input type="number" class="form-control" id="normalisasi" name="normalisasi" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="datakriteria.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</body>

</html>