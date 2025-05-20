<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM kriteria WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: datakriteria.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
