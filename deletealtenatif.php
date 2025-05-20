<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM alternatif_susu WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: dataalternatif.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
