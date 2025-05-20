<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alternatif_susu WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk_susu'];
    $nutrisi = $_POST['kandungan_nutrisi'];
    $kalsium = $_POST['kandungan_kalsium'];
    $gula = $_POST['kandungan_gula'];
    $protein = $_POST['kandungan_protein'];
    $lemak = $_POST['kandungan_lemak'];
    $harga = $_POST['harga'];
    $rasa = $_POST['rasa'];
    $ketersediaan = $_POST['ketersediaan_produk'];

    $update = "UPDATE alternatif_susu SET 
        merk_susu='$merk', 
        kandungan_nutrisi='$nutrisi', 
        kandungan_kalsium='$kalsium', 
        kandungan_gula='$gula', 
        kandungan_protein='$protein', 
        kandungan_lemak='$lemak', 
        harga='$harga', 
        rasa='$rasa', 
        ketersediaan_produk='$ketersediaan' 
        WHERE id=$id";

    if ($conn->query($update) === TRUE) {
        header("Location: dataalternatif.php");
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
    <title>Edit Alternatif Susu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Alternatif Susu</h2>
    <form method="post">
        <?php
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                echo '<div class="mb-3">
                        <label class="form-label">' . ucwords(str_replace("_", " ", $key)) . '</label>
                        <input type="text" name="' . $key . '" class="form-control" value="' . htmlspecialchars($value) . '" required>
                      </div>';
            }
        }
        ?>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="dataalternatif.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
