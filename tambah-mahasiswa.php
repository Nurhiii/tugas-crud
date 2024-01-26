<?php

// untuk memulai debuat halaman dari user yng login
session_start();

//membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Mohon Login Terlebih dahulu');
            document.location.href= 'login.php';
          </script>";
    exit;
}


// NAMA DATA YG MUNCUL AKAN OTOMATIS BERUBAH SESUAI HALAMAN YG DI PILIH
$title = 'Tambah mahasiswa';
include 'layout/header.php';

//check apakah tombol tambah berhasil
if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa berhasil ditambahkan');
                document.location.href = 'mahasiswa.php';
             </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal ditambahkan');
                document.location.href = 'mahasiswa.php';
             </script>";
    }
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-plus"></i> Tambah Data Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="mahasiswa.php">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active">Ubah Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $mahasiswa['foto']; ?>">

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM Mahasiswa</label>
                    <input type="number" class="form-control" id="nim" name="nim" placeholder="NIM Mahasiswa...." required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa...." required>
                </div>

                <div class="row">
                    <div class="mb-3 col-6 ">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select name="prodi" id="prodi" class="form-control" required>
                            <option value="">-- pilih prodi -- </option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Nuklir">Teknik Nuklir</option>
                            <option value="Teknik Industri">Teknik Industri</option>
                            <option value="Teknik Kimia">Teknik Kimia</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Farmasi">Farmasi</option>
                            <option value="Bahasa dan Sastra Indonesia">Bahasa dan Sastra Indonesia</option>
                            <option value="Sastra Jepang ">Sastra Jepang </option>
                            <option value="Sastra Arab ">Sastra Arab </option>
                            <option value="Sastra Inggris ">Sastra Inggris </option>
                            <option value="Hukum ">Hukum </option>
                            <option value="Kedokteran ">Kedokteran </option>
                            <option value="Akuntansi ">Akuntansi </option>
                            <option value=" Ilmu Ekonomi  "> Ilmu Ekonomi </option>
                            <option value="Manajemen ">Manajemen </option>
                            <option value="Kimia ">Kimia </option>
                            <option value=" Ilmu Komputer  "> Ilmu Komputer </option>
                            <option value="Matematika ">Matematika </option>
                            <option value=" Ilmu Komunikasi "> Ilmu Komunikasi </option>
                            <option value="Sosiologi ">Sosiologi </option>
                            <option value="Politik dan Pemerintahan ">Politik dan Pemerintahan </option>
                            <option value="Teknik Pertanian ">Teknik Pertanian </option>
                            <option value="Sejarah ">Sejarah </option>
                            <option value="Teknologi Pangan dan Hasil Pertanian ">Teknologi Pangan dan Hasil Pertanian </option>
                            <option value=" Ilmu Hubungan Internasional "> Ilmu Hubungan Internasional </option>
                        </select>
                    </div>


                    <div class="mb-3 col-6">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="">-- pilih Jenis Kelamin -- </option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" id="agama" class="form-control" required>
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>

                <div class="mb-3 ">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="08xxx" required>
                </div>


                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat"></textarea>
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="xxx@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="customFile"> Foto </label>
                    <input type="file" class="form-control" id="foto" name="foto" onchange="previewImg()">
                    <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px">
                </div>

                <button type="submit" name="tambah" class="btn btn-primary" style="float: right;"><i class="fas fa-plus-circle"></i> Tambah</button>

                <head>
                    <style>
                        .mb-3 {
                            margin-bottom: 15px;
                            /* Atur nilai margin */
                        }

                        .img-preview {
                            margin-top: 10px;
                            /* Atur nilai margin atas  */
                        }
                    </style>
                </head>

                <!-- //previewImg  yg muncul di bawah-->
                <script>
                    function previewImg() {
                        const foto = document.querySelector('#foto');
                        const imgPreview = document.querySelector('.img-preview');

                        const fileFoto = new FileReader();
                        fileFoto.readAsDataURL(foto.files[0]);

                        fileFoto.onload = function(e) {
                            imgPreview.src = URL.createObjectURL(foto.files[0]);
                        }
                    }
                </script>



                <?php include 'layout/footer.php'; ?>