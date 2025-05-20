<?php
include 'config.php';
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM nilai_batas WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if (isset($_POST['submit'])) {
    $nilai_min = intval($_POST['nilai_min']);
    $nilai_max = intval($_POST['nilai_max']);

    if ($nilai_min > $nilai_max) {
        echo "<script>alert('Nilai Min tidak boleh lebih besar dari Nilai Max!'); window.history.back();</script>";
        exit;
    }

    $update = mysqli_query($conn, "UPDATE nilai_batas SET nilai_min = $nilai_min, nilai_max = $nilai_max WHERE id = $id");

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='datanilai.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nilai Batas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="logo.png" />
</head>
<body class="p-5">
    <div class="container">
        <h2>Edit Nilai Batas</h2>

        <form method="post">
            <div class="mb-3">
                <label>Alternatif</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data['alternatif']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label>Kriteria</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data['kriteria']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label>Nilai Min</label>
                <input type="number" name="nilai_min" class="form-control" value="<?= htmlspecialchars($data['nilai_min']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Nilai Max</label>
                <input type="number" name="nilai_max" class="form-control" value="<?= htmlspecialchars($data['nilai_max']); ?>" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="datanilai.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
