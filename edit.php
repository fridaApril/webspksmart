<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM alternatif WHERE id_alternatif = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Data tidak ditemukan!";
    exit();
}

$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_alternatif = $_POST['nama_alternatif'];
    $merk_susu = $_POST['merk_susu'];
    $kandungan_nutrisi = $_POST['kandungan_nutrisi'];
    $kandungan_kalsium = $_POST['kandungan_kalsium'];
    $kandungan_gula = $_POST['kandungan_gula'];
    $kandungan_protein = $_POST['kandungan_protein'];
    $kandungan_lemak = $_POST['kandungan_lemak'];
    $harga = $_POST['harga'];
    $rasa = $_POST['rasa'];
    $ketersediaan_produk = $_POST['ketersediaan_produk'];

    $update = "UPDATE alternatif SET 
                nama_alternatif='$nama_alternatif', 
                merk_susu='$merk_susu', 
                kandungan_nutrisi='$kandungan_nutrisi', 
                kandungan_kalsium='$kandungan_kalsium', 
                kandungan_gula='$kandungan_gula', 
                kandungan_protein='$kandungan_protein', 
                kandungan_lemak='$kandungan_lemak', 
                harga='$harga', 
                rasa='$rasa', 
                ketersediaan_produk='$ketersediaan_produk'
               WHERE id_alternatif=$id";

    if ($conn->query($update) === TRUE) {
        header("Location: dataalternatif.php");
        exit();
    } else {
        echo "Error: " . $update . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Alternatif Susu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="index.php">
            <img src="logo.png" alt="Logo" width="120" class="d-inline-block align-text-top">
        </a>
    </div>
</nav>

<div class="container" style="margin-top: 100px; max-width: 700px;">
    <h2 class="text-center mb-4">Edit Data Alternatif Susu</h2>

    <form method="POST" action="">
        <?php
        $fields = [
            'nama_alternatif' => 'Nama Alternatif',
            'merk_susu' => 'Merk Susu',
            'kandungan_nutrisi' => 'Kandungan Nutrisi',
            'kandungan_kalsium' => 'Kandungan Kalsium (mg)',
            'kandungan_gula' => 'Kandungan Gula',
            'kandungan_protein' => 'Kandungan Protein (g)',
            'kandungan_lemak' => 'Kandungan Lemak (g)',
            'harga' => 'Harga',
            'rasa' => 'Rasa',
            'ketersediaan_produk' => 'Ketersediaan Produk'
        ];
        foreach ($fields as $field => $label) {
            echo '
            <div class="mb-3">
                <label class="form-label">'.$label.'</label>
                <input type="text" name="'.$field.'" class="form-control" value="'.htmlspecialchars($data[$field]).'" required>
            </div>';
        }
        ?>
        <div class="d-flex justify-content-between">
            <a href="dataalternatif.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
