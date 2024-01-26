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

include 'config/app.php';

//menerima id mahasiswa yang dipilih pengguna
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

if (delete_mahasiswa($id_mahasiswa) > 0) {
    echo "<script>
        alert ('Data mahasiswa Berhasil Dihapus');
        document.location.href = 'mahasiswa.php';
    </script>";
} else {
    echo "<script>
        alert ('Data mahasiswa Gagal Dihapus');
        document.location.href = 'mahasiswa.php';
    </script>";
}
