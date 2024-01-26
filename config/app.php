<?php
include 'controller.php';
include 'database.php';

// Buat koneksi ke database
$db = mysqli_connect('localhost', 'root', '', 'crud');

// Periksa koneksi
if ($db->connect_error) {
    // Tampilkan informasi kesalahan yang lebih rinci
    echo "Connection failed: " . $db->connect_error;

    // Gantilah die() dengan tindakan yang sesuai untuk penanganan kesalahan yang lebih baik
    // Contoh: header("Location: error.php");
    exit;
}
