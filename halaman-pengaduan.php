<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Mohon Login Terlebih dahulu');
            document.location.href= 'login.php';
          </script>";
    exit;
}

$title = 'Halaman Pengaduan';

include 'layout/header.php';

// Ambil data pengaduan dari database (sesuaikan dengan struktur database Anda)
$data_pengaduan = select("SELECT * FROM pengaduan ORDER BY id_pengaduan DESC");
?>

<div class="content-wrapper">
    <div class="content-header">
        <!-- ... (kode sebelumnya) -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Daftar Pengaduan</b></h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($data_pengaduan)) : ?>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM Pengadu</th>
                                            <th>Isi Pengaduan</th>
                                            <!-- Tambahan kolom-kolom lain sesuai kebutuhan -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_pengaduan as $pengaduan) : ?>
                                            <tr>
                                                <td><?= $pengaduan['id_pengaduan']; ?></td>
                                                <td><?= $pengaduan['nim_pengadu']; ?></td>
                                                <td><?= $pengaduan['isi_pengaduan']; ?></td>
                                                <!-- Tambahan baris-baris lain sesuai kebutuhan -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <p>Tidak ada pengaduan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>