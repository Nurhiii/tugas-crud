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

// Menerima id barang yang dipilih pengguna
$id_barang = (int)$_GET['id_barang'];

// Periksa apakah id_barang sudah ada
if (!isset($id_barang)) {
    echo "<script>
            alert('ID barang tidak valid');
            document.location.href ='index.php';
        </script>";
    exit; // Hentikan eksekusi skrip jika ID tidak valid
}

// Periksa apakah fungsi deelte_barang() ada
if (function_exists('delete_barang')) {
    // Panggil fungsi delete_barang()
    if (delete_barang($id_barang) > 0) {
        echo "<script>
                alert('Data barang berhasil dihapus');
                document.location.href ='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data barang gagal dihapus');
                document.location.href ='index.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Fungsi delete_barang() tidak ditemukan');
            document.location.href ='index.php';
        </script>";
}
