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

$title = 'Daftar Barang';
include 'layout/header.php';
$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC ");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-list"></i> <b>Data Barang LEBKOM</b></h1>
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

            <!-- Diagram Batang -->
            <div class="col-lg-12">
                <canvas id="myBarChart" width="800" height="400"></canvas>
            </div>
            <!-- /.col-lg-12 -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Tabel Data Barang </b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="tambah-barang.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah </a>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <table class="table table-bordered table-striped mt-3" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No </th>
                                                    <th>Nama </th>
                                                    <th>Jumlah </th>
                                                    <th>Harga </th>
                                                    <th>Tanggal </th>
                                                    <th>Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data_barang as $barang) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $barang['nama']; ?></td>
                                                        <td><?= $barang['jumlah']; ?></td>
                                                        <td>Rp. <?php echo number_format((float)$barang['harga'], 0, ',', '.'); ?></td>
                                                        <td><?= date('d/m/y | h:i:s', strtotime($barang['tanggal'])); ?></td>
                                                        <td width="20%" class="text-center">
                                                            <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                                                            <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin data barang akan dihapus.?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Skrip Diagram Batang -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var dataBarang = <?php echo json_encode($data_barang); ?>;
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataBarang.map(function(barang) {
                return barang.nama;
            }),
            datasets: [{
                label: 'Jumlah Barang',
                data: dataBarang.map(function(barang) {
                    return barang.jumlah;
                }),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include 'layout/footer.php' ?>