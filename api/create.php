<?php

// render halaman menjadi json
header('Content-Type: application/json');

require '../config/app.php';

// mengambil input dan merubah ke type json
$post = (array)json_decode(file_get_contents('php://input'));

// menerima input
$nama       = $_POST['nama'];
$jumlah     = $_POST['jumlah'];
$harga      = $_POST['harga'];

// query tambah data
$query = "INSERT INTO barang VALUES (null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";
mysqli_query($db, $query);

// check status data
if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Ditambahkan']);
} else {
    echo json_encode(['pesan' => 'Data Barang Gagal Ditambahkan']);
}
