<?php
include "koneksi.php";
$username = $_POST['username'];
$op = $_POST['op'];
$password1 = $_POST['np'];
$password2 = $_POST['c_np'];

$nama = $_GET['nama'];

$query = "SELECT * FROM tb_akun WHERE nama = '$nama'";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);

$pengacak = "p3ng4c4k";

$passmd = md5($pengacak . md5($op));
if ($passmd == $data['password'])
{

  if ($password1 == $password2)
  {
    include "koneksi.php";
  
    $pengacak = "p3ng4c4k";
  
    $passmd = md5($pengacak . md5($password1));
  
    $query = "UPDATE tb_akun SET nama = '$username', password = '$passmd' WHERE nama = '$nama'";

          if ($koneksi->query($query) === TRUE) {
              echo "Data Berhasil Diubah";
              header("location: login.php");
          } else {
              echo "Error: " . $koneksi->error;
          }
  }
  else echo "Password yang dimasukkan tidak sama";
}
else echo "<h2>Password Lama Salah<h2>";