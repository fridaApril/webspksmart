<?php
include 'config.php';

$alternatif_query = mysqli_query($conn, "SELECT * FROM alternatif");

if (isset($_POST['submit'])) {
    $alternatif = $_POST['alternatif'];
    $kriterias = $_POST['kriteria'];
    $nilai_mins = $_POST['nilai_min'];
    $nilai_maxs = $_POST['nilai_max'];

    $success = true;
    foreach ($kriterias as $index => $kriteria) {
        $nilai_min = $nilai_mins[$index];
        $nilai_max = $nilai_maxs[$index];
        
        $query = mysqli_query($conn, "INSERT INTO nilai_batas (alternatif, kriteria, nilai_min, nilai_max) VALUES ('$alternatif', '$kriteria', '$nilai_min', '$nilai_max')");
        
        if (!$query) {
            $success = false;
            break;
        }
    }

    if ($success) {
        echo "<script>alert('Data berhasil ditambahkan semua'); window.location.href='datanilai.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Nilai Batas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="p-4">
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

    <h2>Tambah Nilai Batas</h2>
    <form method="post">
        <div class="mb-3">
            <label>Alternatif</label>
            <select name="alternatif" class="form-select" required>
                <option value="">-- Pilih Alternatif --</option>
                <?php while ($row = mysqli_fetch_assoc($alternatif_query)): ?>
                    <option value="<?= htmlspecialchars($row['nama_alternatif']); ?>"><?= htmlspecialchars($row['nama_alternatif']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Kriteria</th>
                    <th>Nilai Min</th>
                    <th>Nilai Max</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $kriterias = ['C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8'];
                foreach ($kriterias as $kriteria): ?>
                <tr>
                    <td>
                        <input type="hidden" name="kriteria[]" value="<?= $kriteria; ?>">
                        <?= $kriteria; ?>
                    </td>
                    <td><input type="number" name="nilai_min[]" class="form-control" required></td>
                    <td><input type="number" name="nilai_max[]" class="form-control" required></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
</body>
</html>
