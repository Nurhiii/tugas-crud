<?php

// Fungsi menampilkan 
function select($query)
{
    global $db;

    try {
        $result = mysqli_query($db, $query);
        if ($result === false) {
            throw new Exception(mysqli_error($db));
        }

        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    } catch (Exception $e) {
        // Menampilkan pesan kesalahan dengan detail
        echo "Error executing query: " . $e->getMessage();
        die(); // Stop eksekusi skrip
    }
}

// fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);


    // query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



//fungsi mengubah data barang
function update_barang($post)
{
    global $db;
    $id_barang = $post['id_barang'];
    $nama   = htmlspecialchars($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga  = strip_tags($post['harga']);

    //query ubah data 
    $query = "UPDATE barang SET nama ='$nama', jumlah = '$jumlah', harga ='$harga' WHERE id_barang =$id_barang  ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $db;

    //query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang =$id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menambah data mahasiswa
function create_mahasiswa($post)
{
    global $db;

    $nim        = strip_tags($post['nim']);
    $nama       = strip_tags($post['nama']);
    $prodi      = strip_tags($post['prodi']);
    $jk         = strip_tags($post['jk']);
    $agama      = strip_tags($post['agama']);
    $telepon    = strip_tags($post['telepon']);
    $alamat     = $post['alamat'];
    $email      = strip_tags($post['email']);
    $agama      = strip_tags($post['agama']);  // Tambahkan baris ini
    $foto       = upload_file();

    // Cek upload foto
    if (!$foto) {
        return false;
    }

    // Query tambah data 
    $query = "INSERT INTO mahasiswa VALUES(null, '$nim', '$nama', '$prodi', '$jk', '$agama', '$telepon', '$alamat', '$email', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


//fungsi mengubah data mahasiswa
function update_mahasiswa($post)
{
    global $db;
    $id_mahasiswa   = strip_tags($post['id_mahasiswa']);
    $nim            = strip_tags($post['nim']);
    $nama           = htmlspecialchars($post['nama']);
    $prodi          = strip_tags($post['prodi']);
    $jk             = strip_tags($post['jk']);
    $agama          = strip_tags($post['agama']);
    $telepon        = strip_tags($post['telepon']);
    $alamat         = $post['alamat'];
    $email          = strip_tags($post['email']);
    $fotoLama       = strip_tags($post['fotoLama']);

    // Cek upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    // Query ubah data 
    $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', prodi = '$prodi', jk= '$jk', agama= '$agama', telepon = '$telepon', alamat = '$alamat', email ='$email', foto='$foto' WHERE id_mahasiswa ='$id_mahasiswa'  ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


//fungsi mengupload file
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // Periksa apakah unggah file berhasil
    if ($error !== 0) {
        // Tangani kesalahan dan kembalikan false
        return false;
    }

    // Generate ekstensi file
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = pathinfo($namaFile, PATHINFO_EXTENSION);

    //cek format 
    if (!in_array($extensifile, $extensifileValid)) {
        //pesan gagal
        echo "<script>
        alert('Format file tidak valid');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    //cek ukuran file 2mb 
    if ($ukuranFile > 2048000) {
        //pesan gagal
        echo "<script>
        alert('Ukuran file max 2 MB');

        document.location.href = 'tambah-mahasiswa.php'; 
        </script>";
        die();
    }

    // Generate nama file baru DAN UNTUK KEAMANAN (AGAR TIDAK ADA YG UPLOAD FILE VIRUS [malware.exe]dan berubah menjadi karakter acak)
    $namaFileBaru = uniqid() . '_' . $extensifile;

    // Pindahkan file ke folder lokal DAN UBAH MENJADI KARAKTER ACAK 
    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);

    return $namaFileBaru;
}


//fungsi menghapus data mahasiswa
function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    // ambil nama file foto sesuai data yang dipilih
    $result = mysqli_query($db, "SELECT foto FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa");
    $fotoData = mysqli_fetch_assoc($result);
    $fotoToDelete = $fotoData['foto'];

    // hapus file foto dari direktori jika foto ada
    if ($fotoToDelete) {
        $pathToFile = 'assets/img/' . $fotoToDelete;
        if (file_exists($pathToFile)) {
            unlink($pathToFile);
        }
    }

    // query hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi tambah akun
function create_akun($post)
{
    global $db;

    $nama    = htmlspecialchars($post['nama']);
    $username = strip_tags($post['username']);
    $email   = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level   = strip_tags($post['level']);

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah data 
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi ubah akun
function update_akun($post)
{
    global $db;
    $id_akun     = htmlspecialchars($post['id_akun']);
    $nama        = strip_tags($post['nama']);
    $username    = strip_tags($post['username']);
    $email       = strip_tags($post['email']);
    $password    = strip_tags($post['password']);
    $level       = strip_tags($post['level']);

    //enkripsi password [PASSWORD TIDAK DI MUNCULKAN]
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query ubah data 
    $query = "UPDATE akun SET nama= '$nama', username= '$username', email='$email', password='$password', level='$level'  WHERE id_akun=$id_akun ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// Fungsi mengambil data akun berdasarkan ID
function get_akun_by_id($id_akun)
{
    global $db;

    // Query untuk mengambil data akun berdasarkan ID
    $query = "SELECT * FROM akun WHERE id_akun = $id_akun";
    $result = mysqli_query($db, $query);

    // Mengambil data akun sebagai array asosiatif
    $akun = mysqli_fetch_assoc($result);

    return $akun;
}



// fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $db;

    // query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
// File: config/controller.php

// Fungsi membuat pengaduan
function create_pengaduan($post)
{
    global $db;

    $nim_pengadu = strip_tags($post['nim_pengadu']);
    $isi_pengaduan = strip_tags($post['isi_pengaduan']);

    // Query tambah data pengaduan
    $query = "INSERT INTO pengaduan (nim_pengadu, isi_pengaduan) VALUES ('$nim_pengadu', '$isi_pengaduan')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi menampilkan data pengaduan
function select_pengaduan()
{
    global $db;

    // Query untuk mengambil semua data pengaduan
    $query = "SELECT * FROM pengaduan";
    $result = mysqli_query($db, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
