<?php

// untuk memulai debuat halaman dari user yng login
session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
}

// membatasi halaman sesuai user  login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
            alert('Perhatian anda tidak punya hak akses');
            document.location.href = 'crud-modal.php';
          </script>";
    exit;
}


// NAMA DATA YG MUNCUL AKAN OTOMATIS BERUBAH SESUAI HALAMAN YG DI PILIH
$title = 'Daftar Barang';
include 'layout/header.php';

$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");



?>
<div class="container mt-5">
    <h1><i class="fas fa-clipboard-list"></i> Data Barang</h1>
    <hr>
    <a href="tambah-barang.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($data_barang) : ?>
                <?php $no = 1; ?>
                <?php foreach ($data_barang as $barang) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $barang['nama']; ?></td>
                        <td><?= $barang['jumlah']; ?></td>
                        <td>Rp. <?= number_format((float) str_replace(['.', ','], '', $barang['harga']), 2, ',', '.'); ?></td>
                        <td><?= date('d/m/y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                        <td width="20%" class="text-center">
                            <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm ('Apakah anada yakin ingin menghapus data ini??')"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>