<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM kriteria WHERE id = $id";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak diberikan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot = $_POST['bobot'];
    $normalisasi = $_POST['normalisasi'];

    $update = "UPDATE kriteria SET nama_kriteria='$nama_kriteria', bobot=$bobot, normalisasi=$normalisasi WHERE id=$id";
    if ($conn->query($update)) {
        header("Location: datakriteria.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Kriteria</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" required value="<?= $data['nama_kriteria'] ?>">
        </div>
        <div class="mb-3">
            <label for="bobot" class="form-label">Bobot (%)</label>
            <input type="number" class="form-control" id="bobot" name="bobot" required step="0.01" value="<?= $data['bobot'] ?>">
        </div>
        <div class="mb-3">
            <label for="normalisasi" class="form-label">Normalisasi</label>
            <input type="number" class="form-control" id="normalisasi" name="normalisasi" required step="0.01" value="<?= $data['normalisasi'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="datakriteria.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
