<?php
include "koneksi.php";
session_start(); // Mulai atau lanjutkan sesi PHP
function addNotification($nama_pemesan, $message) {
  if (!isset($_SESSION['notif4'][$nama_pemesan])) {
      $_SESSION['notif4'][$nama_pemesan] = array();
  }
  $_SESSION['notif4'][$nama_pemesan][] = $message;
}
// Fungsi untuk menyetujui transaksi dan mengirim notifikasi
function approveTransaction($nama_pemain, $koin) {
    // Logika untuk menyetujui transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Transaksi Berhasil koin sejumlah $koin";
    addNotification($nama_pemain, $adminMessage);
}

// Fungsi untuk menolak transaksi dan mengirim notifikasi
function tolakTransaksi($nama_pemesan, $koin) {
    // Logika untuk menolak transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Karena Kelalaian admin koin anda dikembalikan sejumlah $koin";
    addNotification($nama_pemesan, $adminMessage);
}

// Cek apakah ada data yang dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah elemen 'id' dan 'action' ada dalam data POST
    if (isset($_POST['harga']) && isset($_POST['action']) && isset($_POST['id'])) {
        $koin = $_POST['harga'];
        $action = $_POST['action'];
        $id_mabar = $_POST['id'];

        // Selanjutnya, Anda dapat mengambil data 'nama_pemesan' jika perlu
        if (isset($_POST['nama_pemesan']) && isset($_POST['nama_pemain'])) {
            $nama_pemesan = $_POST['nama_pemesan'];
            $nama_pemain = $_POST['nama_pemain'];
                    // Sekarang Anda memiliki $id_joki, $action, dan $nama_pemesan (jika diperlukan)
        // yang dapat Anda gunakan sesuai dengan logika Anda.

        // Contoh logika:
        if ($action === 'ditolak') {
          tolakTransaksi($nama_pemesan, $koin);
          $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin + $koin WHERE nama = '$nama_pemesan'");
          if ($query) {
            $query = mysqli_query($koneksi, "UPDATE transaksi_mabar SET hasil = 'gagal' WHERE id_mabar = '$id_mabar'");
            if ($query) {
                header('location: kelola_mabar.php');
            } else {
                echo "<script>alert('Gagal1');window.location='kelola_mabar.php'</script>";
            } 
          } else {
              echo "<script>alert('Gagal2');window.location='kelola_mabar.php'</script>";
          }
      } elseif ($action === 'setuju') {
          // Lakukan tindakan persetujuan
          approveTransaction($nama_pemain, $koin);
          $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin + $koin WHERE nama = '$nama_pemain'");
          if ($query) {
            $query = mysqli_query($koneksi, "UPDATE transaksi_mabar SET hasil = 'berhasil' WHERE id_mabar = '$id_mabar'");
            if ($query) {
                header('location: kelola_mabar.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_mabar.php'</script>";
            }
          } else {
              echo "<script>alert('Gagal');window.location='kelola_mabar.php'</script>";
          }
      } else {
          echo "<script>alert('Aksi tidak valid');window.location='kelola_mabar.php'</script>";
      }
        }
    } else {
        echo "<script>alert('Data yang dibutuhkan tidak ada dalam permintaan POST');window.location='kelola_mabar.php'</script>";
    }
} else {
    echo "<script>alert('Permintaan harus menggunakan metode POST');window.location='kelola_mabar.php'</script>";
}
?>
