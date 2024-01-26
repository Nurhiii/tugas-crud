<?php

session_start();

//membatasi halaman sebelum login
// if (!isset($_SESSION["login"])) {
//     echo "<script>
//             alert('Mohon Login Terlebih dahulu');
//             document.location.href= 'login.php';
//           </script>";
//     exit;
// }

$title = 'Detail Mahasiswa';

include 'layout/header.php';



//mengambil id mahasiswa daru url
$data_mahasiswa = (int)$_GET['id_mahasiswa'];

//MENAMPILKAN DATA MAHASISWA
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $data_mahasiswa")[0];


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-4">

                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container mt-5">
            <h1> Data <?= $mahasiswa['nama']; ?></h1>
            <hr>

            <table class="table table-bordered table-striped mt-3">
                <tr>
                    <td>NIM</td>
                    <td>: <?= $mahasiswa['nim']; ?></td>
                </tr>

                <tr>
                    <td>Nama</td>
                    <td>: <?= $mahasiswa['nama']; ?></td>
                </tr>

                <tr>
                    <td>Program studi</td>
                    <td>: <?= $mahasiswa['prodi']; ?></td>
                </tr>

                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?= $mahasiswa['jk']; ?></td>
                </tr>

                <tr>
                    <td>Agama</td>
                    <td>: <?= $mahasiswa['agama']; ?></td>
                </tr>

                <tr>
                    <td>Telepon</td>
                    <td>: <?= $mahasiswa['telepon']; ?></td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>: <?= $mahasiswa['alamat']; ?></td>
                </tr>

                <tr>
                    <td>E-mail</td>
                    <td>: <?= $mahasiswa['email']; ?></td>
                </tr>

                <tr>
                    <td width="50%">Foto</td>
                    <td>
                        <a href="assets/img/<?= $mahasiswa['foto']; ?>">
                            <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="foto" width="50%">
                        </a>
                    </td>
                </tr>
            </table>
            <a href="mahasiswa.php" class="btn btn-secondary btn-sm" style="float: right;">Kembali</a>
        </div>
        <?php include 'layout/footer.php'; ?>