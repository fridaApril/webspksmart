<?php
include 'config.php'; // Pastikan file ini mengatur koneksi $conn

if (!isset($_GET['alternatif'])) {
    header("Location: index.php?error=invalid_request");
    exit;
}

$alternatif = $_GET['alternatif'];

// Lindungi dari SQL Injection
$alternatif_safe = mysqli_real_escape_string($conn, $alternatif);

// Jalankan query DELETE
$sql = "DELETE FROM nilai_batas WHERE alternatif = '$alternatif_safe'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: datanilai.php?status=deleted");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}

?>
