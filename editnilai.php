<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM nilai WHERE id = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $C1 = $_POST['C1'];
    $C2 = $_POST['C2'];
    $C3 = $_POST['C3'];
    $C4 = $_POST['C4'];
    $C5 = $_POST['C5'];
    $C6 = $_POST['C6'];
    $C7 = $_POST['C7'];
    $C8 = $_POST['C8'];

    $update = "UPDATE nilai SET 
        alternatif='$alternatif', C1='$C1', C2='$C2', C3='$C3', 
        C4='$C4', C5='$C5', C6='$C6', C7='$C7', C8='$C8' 
        WHERE id=$id";

    if ($conn->query($update) === TRUE) {
        header("Location: datanilai.php");
        exit();
    } else {
        echo "Gagal update: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Nilai Alternatif</h2>
    <form method="post">
        <?php for ($i = 1; $i <= 8; $i++): ?>
            <div class="mb-3">
                <label>C<?= $i ?></label>
                <input type="number" name="C<?= $i ?>" class="form-control" value="<?= $data["C$i"] ?>" required>
            </div>
        <?php endfor; ?>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="datanilai.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
