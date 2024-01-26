<?php
//FUNCTION FUNGSI MENAMPILKAN DATA
function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

//function fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    $nama   = htmlspecialchars($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga  = strip_tags($post['harga']);


//query tambah data
$query = "INSERT INTO barang VALUE(null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

mysqli_query($db, $query);

return mysqli_affected_rows($db);

}

//fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    $id_barang = strip_tags($post['id_barang']);
    $nama   = strip_tags($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga  = strip_tags($post['harga']);


//query ubah data
$query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

mysqli_query($db, $query);

return mysqli_affected_rows($db);


}

//FUNGSI MENGAPUS DATA BARANG
    function delete_barang($id_barang)
{
    global $db;

    //query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

// Fungsi menambah data mahasiswa
function create_mahasiswa($post)
{
    global $db;

    $nim     = htmlspecialchars($post['nim']);
    $nama    = htmlspecialchars($post['nama']);
    $prodi   = strip_tags($post['prodi']);
    $jk      = strip_tags( $post['jk']); // jenis kelamin
    $agama   = strip_tags($post['agama']);
    $telepon = strip_tags($post['telepon']);
    $email   = strip_tags($post['email']);
    $alamat  = strip_tags($post['alamat']);
    $foto   = upload_file();


       //cek  upload foto
if (!$foto) {
    return false;
 }

    // Query tambah data 
    $query = "INSERT INTO mahasiswa (nim, nama, prodi, jk, agama, telepon, email, alamat, foto) 
              VALUES ('$nim', '$nama', '$prodi', '$jk', '$agama', '$telepon', '$email', '$alamat', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// Fungsi mengubah data mahasiswa
function update_mahasiswa($post)
{
    global $db;
    $id_mahasiswa   = strip_tags($post['id_mahasiswa']);
    $nim            = htmlspecialchars($post['nim']);
    $nama           = htmlspecialchars($post['nama']);
    $prodi          = strip_tags($post['prodi']);
    $jk             = strip_tags($post['jk']); // jenis kelamin
    $agama          = strip_tags($post['agama']);
    $telepon        = strip_tags($post['telepon']);
    $email          = strip_tags($post['email']);
    $alamat         = strip_tags($post['alamat']);
    $fotoLama       = strip_tags($post['fotoLama']);

    // Cek upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    // Query ubah data
    $query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', prodi = '$prodi', jk = '$jk', agama = '$agama', telepon = '$telepon', email = '$email', alamat = '$alamat', foto = '$foto' WHERE id_mahasiswa = '$id_mahasiswa'";

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

    //cek file yg di upload
    $extensifileValid = ['jpg', 'jeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    //cek format 
  if(!in_array($extensifile, $extensifileValid)){
      //pesan gagal
      echo "<script>
      alert('Format file tidak valid');
      document.location.href = 'tambah-mahasiswa.php';
</script>";

        die();
  }

  //cek ukuran file 2mb
  if ($ukuranFile > 2048000){
    //pesan gagal
    echo "<script>
      alert('Ukuran file max 2 MB');
      document.location.href = 'tambah-mahasiswa.php';
</script>";
  }

    // Periksa apakah unggah file berhasil
    if ($error !== 0) {
        // Tangani kesalahan dan kembalikan false
        return false;
    }

    // ... Kode Anda yang sudah ada ...

    // Generate nama file baru
    $namaFileBaru = uniqid() . ',' . $extensifile;

    // Pindahkan file ke folder lokal
    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);

    return $namaFileBaru;
}



//fungsi menghapus data mahasiswa
function delete_mahasiswa ($id_mahasiswa)
{
    global $db;

    //query hapus data mahasiswa
    $query ="DELETE FROM mahasiswa WHERE id_mahasiswa =$id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


//fungsi tambah akun
function create_akun ($post)
{
    global $db;

        $nama = mysqli_real_escape_string($db, strip_tags($post['nama']));
        $username = mysqli_real_escape_string($db, strip_tags($post['username']));
        $email = mysqli_real_escape_string($db, strip_tags($post['email']));
        $password = mysqli_real_escape_string($db, strip_tags($post['password']));
        $level = mysqli_real_escape_string($db, strip_tags($post['level']));

   
    //enkripsi password
    $password= password_hash($password, PASSWORD_DEFAULT);

    //query tambah data 
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi ubah akun
function update_akun ($post)
{
    global $db;
        $id_akun = mysqli_real_escape_string($db, strip_tags($post['id_akun']));
        $nama = mysqli_real_escape_string($db, strip_tags($post['nama']));
        $username = mysqli_real_escape_string($db, strip_tags($post['username']));
        $email = mysqli_real_escape_string($db, strip_tags($post['email']));
        $password = mysqli_real_escape_string($db, strip_tags($post['password']));
        $level = mysqli_real_escape_string($db, strip_tags($post['level']));

   
    //enkripsi password
    $password= password_hash($password, PASSWORD_DEFAULT);

    //query ubah data 
    $query = "UPDATE akun SET nama= '$nama', username= '$username', email='$email', password='$password', level='$level'  WHERE id_akun=$id_akun ";


    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// hapus-akun.php
function hapus_akun($id_akun)
{
    global $db;

    $query = "DELETE FROM akun WHERE id_akun = ?";
    $stmt = mysqli_prepare($db, $query);
    
    mysqli_stmt_bind_param($stmt, "i", $id_akun);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    return $affected_rows;
}


