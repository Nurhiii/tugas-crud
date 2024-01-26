<?php


session_start();

//membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Mohon Login Terlebih dahulu');
            document.location.href= 'login.php';
          </script>";
    exit;
}

$title = 'Daftar mahasiswa';

include 'layout/header.php';
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC ");

$lebarKolomAksi = ($_SESSION['level'] == 3) ? '10%' : '25%';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-users"></i> <b> Mahasiswa</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item active">Sosial Media</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h1></h1>

                            <p>Instagram</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <a href="https://www.instagram.com/universitasprimagraha?igsh=MTg3dGQ5YnU3bWJibw==" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><sup style="font-size: 20px"></sup></h3>

                            <p>Website</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <a href="https://upg.ac.id/v1/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3></h3>

                            <p>YouTube</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <a href="https://youtube.com/@universitasprimagraha6968?si=60Z-b-ObgHTpws7L" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3></h3>

                            <p>Facebook</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <a href="https://www.facebook.com/profile.php?id=100080510882329&mibextid=zLoPMf" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Tabel Data Mahasiswa</b></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="tambah-mahasiswa.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah </a>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No </th>
                                            <th>NIM </th>
                                            <th>Nama </th>
                                            <th>Prodi </th>
                                            <th>Jenis Kelamin </th>
                                            <th>Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $mahasiswa['nim']; ?></td>
                                                <td><?= $mahasiswa['nama']; ?></td>
                                                <td><?= $mahasiswa['prodi']; ?></td>
                                                <td><?= $mahasiswa['jk']; ?></td>
                                                <td class="text-center" style="width: <?= $lebarKolomAksi; ?>">
                                                    <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-id-card"></i> Detail</a>

                                                    <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 4) : ?>
                                                        <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                                        <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini.?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </body>
                                </table>

                            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
</div>

<?php include 'layout/footer.php' ?>