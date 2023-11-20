<?php
include "koneksi.php";
session_start(); // Mulai atau lanjutkan sesi PHP
function addNotification($nama_pemesan, $message) {
  if (!isset($_SESSION['notif3'][$nama_pemesan])) {
      $_SESSION['notif'][$nama_pemesan] = array();
  }
  $_SESSION['notif3'][$nama_pemesan][] = $message;
}
// Fungsi untuk menyetujui transaksi dan mengirim notifikasi
function approveTransaction($nama_penjoki, $koin) {
    // Logika untuk menyetujui transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Transaksi Berhasil koin sejumlah $koin";
    addNotification($nama_penjoki, $adminMessage);
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
        $id_joki = $_POST['id'];

        // Selanjutnya, Anda dapat mengambil data 'nama_pemesan' jika perlu
        if (isset($_POST['nama_pemesan']) && isset($_POST['nama_penjoki'])) {
          $nama_pemesan = $_POST['nama_pemesan'];
            $nama_penjoki = $_POST['nama_penjoki'];
                    // Sekarang Anda memiliki $id_joki, $action, dan $nama_pemesan (jika diperlukan)
        // yang dapat Anda gunakan sesuai dengan logika Anda.

        // Contoh logika:
        if ($action === 'ditolak') {
          tolakTransaksi($nama_pemesan, $koin);
          $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin + $koin WHERE nama = '$nama_pemesan'");
          if ($hasil) {
            $query = mysqli_query($koneksi, "UPDATE transaksi_joki SET hasil = 'gagal' WHERE id_joki = '$id_joki'");
            if ($query) {
                header('location: kelola_joki.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_pesanan_joki.php'</script>";
            } 
          } else {
              echo "<script>alert('Gagal');window.location='kelola_joki.php'</script>";
          }
      } elseif ($action === 'setuju') {
          // Lakukan tindakan persetujuan
          approveTransaction($nama_pemesan, $koin);
          $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin + $koin WHERE nama = '$nama_penjoki'");
          if ($query) {
            $query = mysqli_query($koneksi, "UPDATE transaksi_joki SET hasil = 'berhasil' WHERE id_joki = '$id_joki'");
            if ($query) {
                header('location: kelola_joki.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_pesanan_joki.php'</script>";
            }
          } else {
              echo "<script>alert('Gagal');window.location='kelola_joki.php'</script>";
          }
      } else {
          echo "<script>alert('Aksi tidak valid');window.location='kelola_pjoki.php'</script>";
      }
        }
    } else {
        echo "<script>alert('Data yang dibutuhkan tidak ada dalam permintaan POST');window.location='kelola_joki.php'</script>";
    }
} else {
    echo "<script>alert('Permintaan harus menggunakan metode POST');window.location='kelola_joki.php'</script>";
}
?>
