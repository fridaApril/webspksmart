<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk_susu = $_POST['merk_susu'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $usia = $_POST['usia'];
    $kandungan_nutrisi = $_POST['kandungan_nutrisi'];
    $kandungan_kalsium = $_POST['kandungan_kalsium'];
    $kandungan_gula = $_POST['kandungan_gula'];
    $kandungan_protein = $_POST['kandungan_protein'];
    $kandungan_lemak = $_POST['kandungan_lemak'];
    $harga = $_POST['harga'];
    $rasa = $_POST['rasa'];
    $ketersediaan_produk = $_POST['ketersediaan_produk'];

    $sql = "INSERT INTO alternatif
        (merk_susu, nama_alternatif, usia, kandungan_nutrisi, kandungan_kalsium, kandungan_gula, kandungan_protein, kandungan_lemak, harga, rasa, ketersediaan_produk) 
        VALUES 
        ('$merk_susu', '$nama_alternatif', '$usia', '$kandungan_nutrisi', '$kandungan_kalsium', '$kandungan_gula', '$kandungan_protein', '$kandungan_lemak', '$harga', '$rasa', '$ketersediaan_produk')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='tambahalternatifsusu.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Alternatif Susu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="logo.png" />
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
            <h3 class="mb-4">Form Tambah Data Alternatif Susu</h3>
            <form method="post" action="">

                <div class="mb-3">
                    <label class="form-label">Merk Susu</label>
                    <input type="text" class="form-control" name="merk_susu" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Alternatif</label>
                    <input type="text" class="form-control" name="nama_altenatif" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <input type="text" class="form-control" name="usia" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kandungan Nutrisi</label>
                    <input type="text" class="form-control" name="kandungan_nutrisi" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kandungan Kalsium (mg)</label>
                    <input type="text" class="form-control" name="kandungan_kalsium" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kandungan Gula</label>
                    <input type="text" class="form-control" name="kandungan_gula" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kandungan Protein (g)</label>
                    <input type="text" class="form-control" name="kandungan_protein" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kandungan Lemak (g)</label>
                    <input type="text" class="form-control" name="kandungan_lemak" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" class="form-control" name="harga" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rasa</label>
                    <input type="text" class="form-control" name="rasa" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ketersediaan Produk</label>
                    <input type="text" class="form-control" name="ketersediaan_produk" required>
                </div>
                <div class="d-flex justify-content-between">
                <a href="dataalternatif.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</body>

</html>