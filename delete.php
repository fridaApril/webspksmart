<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM alternatif WHERE id_alternatif = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: dataalternatif.php");
    exit();
} else {
    echo "Error saat menghapus data: " . $conn->error;
}
?>
