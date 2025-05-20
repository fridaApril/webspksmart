<?php
include 'config.php';

$alternatif_query = mysqli_query($conn, "SELECT * FROM alternatif");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alternatif = $_POST['alternatif'];
    $C1 = $_POST['C1'];
    $C2 = $_POST['C2'];
    $C3 = $_POST['C3'];
    $C4 = $_POST['C4'];
    $C5 = $_POST['C5'];
    $C6 = $_POST['C6'];
    $C7 = $_POST['C7'];
    $C8 = $_POST['C8'];

    $sql = "INSERT INTO nilai (alternatif, C1, C2, C3, C4, C5, C6, C7, C8) 
            VALUES ('$alternatif', '$C1', '$C2', '$C3', '$C4', '$C5', '$C6', '$C7', '$C8')";

    if ($conn->query($sql) === TRUE) {
        header("Location: datanilai.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Nilai Alternatif</title>
    <link rel="icon" type="image/png" href="logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <h2 class="text-center mb-4">Tambah Nilai Alternatif</h2>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="alternatif" class="form-label">Nama Alternatif</label>
                <select name="alternatif" class="form-select" required>
                <option value="">-- Pilih Alternatif --</option>
                <?php while ($row = mysqli_fetch_assoc($alternatif_query)): ?>
                    <option value="<?= htmlspecialchars($row['nama_alternatif']); ?>"><?= htmlspecialchars($row['nama_alternatif']); ?></option>
                <?php endwhile; ?>
            </select>
            </div>

            <?php
            for ($i = 1; $i <= 8; $i++) {
                echo '
                <div class="mb-3">
                    <label for="C'.$i.'" class="form-label">C'.$i.'</label>
                    <input type="number" step="any" class="form-control" id="C'.$i.'" name="C'.$i.'" required>
                </div>';
            }
            ?>

            <div class="d-flex justify-content-between">
                <a href="datanilai.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
