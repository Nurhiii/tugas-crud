<?php
session_start();
include 'config/app.php';

// cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    // ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // check username
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    // jika ada user nya
    if (mysqli_num_rows($result) == 1) {
        // cek password
        $hasil = mysqli_fetch_assoc($result);
        if (password_verify($password, $hasil['password'])) {
            // set session
            $_SESSION['login']      = true;
            $_SESSION['id_akun']    = $hasil['id_akun'];
            $_SESSION['nama']       = $hasil['nama'];
            $_SESSION['username']   = $hasil['username'];
            $_SESSION['email']      = $hasil['email'];
            $_SESSION['level']      = $hasil['level'];

            // arahkan ke halaman sesuai level
            if ($hasil['level'] == 1 or $_SESSION['level'] == 2) {
                header("Location: index.php"); // Sesuaikan dengan halaman yang diinginkan untuk level 1
            } else {
                header("Location: mahasiswa.php"); // Sesuaikan dengan halaman yang diinginkan untuk level selain 1
            }
            exit;
        }
    }

    // jika tidak ada user/login salah
    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/upg.png">
    <meta name="theme-color" content="#7952b3">

    <style>
        body {
            background: url('assets/img/gambar.jpg') center bottom/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
            margin: 0;
            padding: 0;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .form-signin {
            background-color: rgba(255, 255, 255, 0.6);
            /* Ganti nilai alpha untuk ketransparanannya */
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: auto;
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .form-floating input {
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        .form-floating label {
            padding: 10px;
        }

        .btn-primary {
            background-color: #343a40;
            border: none;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 90px;
            height: 90px;
        }

        h1,
        .text-muted {
            text-align: center;
            color: #343a40;
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-2" src="assets/img/upg.png" alt="" width="90" height="90">
            <h1 class="h3 mb-3 fw-normal"><b>Welcome</b></h1>

            <?php if (isset($error)) : ?>
                <div class=" alert alert-danger text-center">
                    <b>Username/Password SALAH</b>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password..." required>
                <label for="floatingPassword">Password</label>
            </div>


            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>

            <p class="mt-5 mb-3 text-muted">Copyright&copy; Nurhidayatillah <?= date('Y') ?></p>
        </form>
    </main>

</body>

</html>