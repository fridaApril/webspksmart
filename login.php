<?php
include 'config.php';
session_start();

$message = '';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_input = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE username = '$username'") or die('Query gagal');

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        if ($password_input === $row['password']) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_username'] = $row['username'];
                $_SESSION['admin_id'] = $row['id'];
                header('Location: home.php');
                exit;
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                header('Location: user.php');
                exit;
            }
        } else {
            $message = 'Password salah!';
        }
    } else {
        $message = 'Username tidak ditemukan!';
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Metode SMART</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card w-100 shadow" style="max-width: 900px;">
        <div class="row g-0">
            
            <div class="col-md-6 p-5">
                <h3 class="mb-4 text-center">Login Account</h3>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" name="submit" class="btn btn-primary">Masuk</button>
                    </div>

                    <div class="text-center">
                        <small>Belum punya akun?</small><br>
                        <a href="register.php">Daftar</a>
                    </div>
                </form>
            </div>

            <!-- Bagian Penjelasan SPK -->
            <div class="col-md-6 bg-primary text-white p-5 d-flex flex-column justify-content-center">
                <h4 class="fw-bold">Sistem Pendukung Keputusan</h4>
                <p class="mt-3">
                    SPK adalah sistem informasi interaktif yang membantu pengambilan keputusan dalam situasi semi-terstruktur dan tidak terstruktur.
                </p>
                <h5 class="fw-bold">Metode SMART</h5>
                <p>
                    Metode SMART menggunakan model linear additive untuk memprediksi nilai alternatif dan menawarkan fleksibilitas serta kemudahan dalam analisis kebutuhan keputusan.
                </p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
