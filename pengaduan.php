<?php
session_start();

// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'crud';

$db = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$title = 'Form Pengaduan';

include 'layout/header.php';

// Memeriksa apakah formulir pengaduan telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_pengaduan'])) {
    // Mengambil data dari formulir
    $isi_pengaduan = mysqli_real_escape_string($db, $_POST['isi_pengaduan']); // Menghindari SQL injection

    // Simpan data pengaduan ke database (asumsi tabel pengaduan sudah ada)
    $query = "INSERT INTO pengaduan (isi_pengaduan) VALUES ('$isi_pengaduan')";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Tampilkan pesan sukses
        echo "<script>
            alert('Pengaduan Anda telah berhasil disampaikan');
        </script>";
    } else {
        echo "Error: " . mysqli_error($db); // Tampilkan pesan error jika query gagal
    }
}

include 'layout/footer.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="far fa-question-circle"></i> Layanan Pengaduan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Pengaduan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Form Pengaduan</b></h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="isi_pengaduan">Isi Pengaduan:</label>
                                    <textarea class="form-control" id="isi_pengaduan" name="isi_pengaduan" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit_pengaduan">Kirim Pengaduan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>