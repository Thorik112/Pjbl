<?php
include "koneksi.php";
$id=$_POST['id'];
$game=$_POST['game'];
$deskripsi=$_POST['deskripsi'];

if (isset($_POST['ubah_gambar'])){
  $sumber = $_FILES['gambar']['name'];
  $nama_gambar = $_FILES['gambar']['tmp_name'];

  $gambarbaru = date('dmYHis').$sumber;

  $path = "file/".$gambarbaru;

  if(move_uploaded_file($nama_gambar, $path)){
    $query = "SELECT id_game FROM tb_game WHERE id_game='$id'";
    $hasil= mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($hasil);

    if(is_file("file/".$data['gambar']))
    unlink("file/".$data['gambar']);

    $query = "UPDATE tb_game SET game='$game', deskripsi='$deskripsi', gambar='$gambarbaru' WHERE id_game=$id";
    $hasil=mysqli_query($koneksi, $query);

    if($hasil){
      header("location: kelola_game.php");
    }else{
      echo "Maaf Gagal";
      echo "<br><a href='kelola_game.php'>Kembali Ke Form</a>";
    }
  }
  else{
    echo "<script>alert(Maaf, Gambar gagal di upload)window.location='kelola_promo.php'</script>";
  }
}else{
  $query = "UPDATE tb_game SET game='$game', deskripsi='$deskripsi' WHERE id_game='$id'";
  $hasil=mysqli_query($koneksi, $query);

  if($hasil){
    header("location: kelola_game.php");
  }
  else{
    echo "Maaf Gagal";
    echo "<br><a href='kelola_game.php'>Kembali Ke Form</a>";
  }
}
//$query="UPDATE tb_siswa SET nama='$nama', kelas='$kelas', ttl='$ttl', alamat='$alamat', kota='$kota', jk='$jk', hobi='$hobi', eskul='$eskul' WHERE nis='$nis';";
//$hasil=mysqli_query($koneksi, $query);
//if ($hasil) {
  //  header('location:tampil.php');
//}else{

  //  echo "Gagal update data";
   // echo mysqli_error();
//}
?>