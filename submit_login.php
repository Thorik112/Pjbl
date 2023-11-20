<?php
session_start();
include "koneksi.php";
$username = $_POST['nama'];
$password = $_POST['password'];

$query = "SELECT * FROM tb_akun WHERE nama = '$username'";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);

$pengacak = "p3ng4c4k";

$passmd = md5($pengacak . md5($password));
if ($passmd == $data['password'])
{

  $_SESSION['level'] = $data['level'];
  $_SESSION['nama'] = $data['nama'];

  $query="UPDATE tb_akun SET status='online' WHERE nama='$username';";
  $hasil = mysqli_query($koneksi,$query);

  if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
    // Atur cookie untuk mengingat pengguna
    $cookie_name = "remember_me_cookie";
    $cookie_value = base64_encode($username . '|' . $password);
    $cookie_expire = time() + (30 * 24 * 60 * 60); // Cookie berlaku selama 30 hari
    setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
}

  header('location: user.php');
}
else echo "<h2>Login Gagal<h2>";
?>