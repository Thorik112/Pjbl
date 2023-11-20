<?php
include "koneksi.php";
$id=$_POST['id'];
$game=$_POST['game'];
$acara=$_POST['acara'];
$waktu=$_POST['waktu'];
$deskripsi=$_POST['deskripsi'];

if (isset($_POST['ubah_gambar'])){
  $sumber = $_FILES['gambar']['name'];
  $nama_gambar = $_FILES['gambar']['tmp_name'];

  $gambarbaru = date('dmYHis').$sumber;

  $path = "file/".$gambarbaru;

  if(move_uploaded_file($nama_gambar, $path)){
    $query = "SELECT id_acara FROM tb_acara WHERE id_acara='$id'";
    $hasil= mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($hasil);

    if(is_file("file/".$data['gambar']))
    unlink("file/".$data['gambar']);

    $query = "UPDATE tb_acara SET nama_game='$game', acara='$acara', waktu='$waktu', gambar='$gambarbaru', waktu='$waktu', deskripsi='$deskripsi' WHERE id_acara='$id'";
    $hasil=mysqli_query($koneksi, $query);

    if($hasil){
      header("location: kelola_acara.php");
    }else{
      echo "Maaf Gagal";
      echo "<br><a href='kelola_acara.php'>Kembali Ke Form</a>";
    }
  }
  else{
    echo "<script>alert(Maaf, Gambar gagal di upload)window.location='kelola_acara.php'</script>";
  }
}else{
  $query = "UPDATE tb_acara SET nama_game='$game', acara='$acara', waktu='$waktu', deskripsi='$deskripsi' WHERE id_acara='$id'";
  $hasil=mysqli_query($koneksi, $query);

  if($hasil){
    header("location: kelola_acara.php");
  }
  else{
    echo "Maaf Gagal";
    echo "<br><a href='kelola_acara.php'>Kembali Ke Form</a>";
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