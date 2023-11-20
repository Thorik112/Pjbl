<?php
session_start();
include "koneksi.php";

$username = $_SESSION['nama'];
$query="UPDATE tb_akun SET status='offline' WHERE nama='$username';";
$hasil = mysqli_query($koneksi,$query);

if ($hasil){
  unset($_SESSION['username']);
unset($_SESSION['level']);

session_destroy();
echo "<h1>Anda Sudah Log Out</h1>";
echo "<p><a href='login.php'>Login kembali</a></p>";
}
?>