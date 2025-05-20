<?php
include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM nilai WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: datanilai.php");
    exit();
} else {
    echo "Gagal menghapus data: " . $conn->error;
}
?>
