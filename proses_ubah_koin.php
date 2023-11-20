<?php
include "koneksi.php";
// Simulasi top up koin
$amount = $_POST['harga'];
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-m-d H:i:s");
$no = $_POST['no'];
// Di sini, Anda akan mengambil ID pengguna dari sesi atau sesuai dengan sistem autentikasi Anda.
$user_id = $_POST['id']; // Gantilah dengan ID pengguna yang sesuai

$checkQuery = "SELECT nama FROM tb_akun WHERE nama ='$user_id'";
$result = $koneksi->query($checkQuery);

    if ($result->num_rows == 0) {
        echo "<script>window.alert('NAMA yang isi tidak ada')
        window.location='isi_koin.php'</script>";
    } else {
      $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin - $amount WHERE nama = '$user_id'");
          if ($query) {
            $query2 = "INSERT INTO tb_ubah_koin (id_ubah_koin, nama, jumlah, status, waktu_permintaan, no_hp) VALUES ('','$user_id','$amount','menunggu','$tanggal','$no')";

            if ($koneksi->query($query2) === TRUE) {
                echo //"<script>alert(Top Up $amount Koin berhasil!!! )window.location='isi_koin.html'</script>";
                "Ubah koin sejumlah $amount berhasil terkirim tunggu tanggapan dari admin";
            } else {
                echo "Error: " . $koneksi->error;
            }
          }
          else {
            echo "<script>alert('Gagal');window.location='isi_koin.php'</script>";
        }
    }
?>
