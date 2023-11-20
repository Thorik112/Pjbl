<?php
include "koneksi.php";
$id=$_GET['id_akun'];
$game = isset($_POST['game']) ? implode(', ', $_POST['game']) : '';
$jenis = ['Mabar'];
$harga = $_POST['harga'];
$deskripsi=$_POST['deskripsi'];

    $query = "SELECT id_akun FROM tb_akun WHERE id_akun='$id'";
    $hasil= mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($hasil);

    if ($data){
      $query = "UPDATE tb_akun SET game='$game', deskripsi_diri='$deskripsi', harga='$harga' WHERE id_akun='$id'";
    $hasil=mysqli_query($koneksi, $query);

    if($hasil){
      echo "<script>window.alert('Selamat data berhasil di ubah')
      window.location='admin.php#data_diri'</script>";
    }else{
      echo "<script>window.alert('Maaf Gagal')
      window.location='admin.php'</script>";
      //echo "<br><a href='kelola_acara.php'>Kembali Ke Form</a>";
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