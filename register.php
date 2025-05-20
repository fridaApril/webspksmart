<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = 'user';

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE username = '$username'") or die('Query gagal');

    if (mysqli_num_rows($select) > 0) {
        $message[] = ['type' => 'danger', 'text' => 'Username sudah digunakan!'];
    } else {
        if ($password !== $cpassword) {
            $message[] = ['type' => 'danger', 'text' => 'Konfirmasi password tidak sesuai!'];
        } else {
            mysqli_query($conn, "INSERT INTO `users` (name, username, password, user_type) VALUES('$name', '$username', '$password', '$user_type')") or die('Query gagal');
            $message[] = ['type' => 'success', 'text' => 'Pendaftaran berhasil! Silakan login.'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .centered-container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body class="bg-light">

<div class="container centered-container">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Register Akun</h3>
                <?php
                if (isset($message)) {
                    foreach ($message as $msg) {
                        echo '<div class="alert alert-' . $msg['type'] . '">' . $msg['text'] . '</div>';
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Daftar</button>
                </form>
                <div class="text-center mt-3">
                    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
