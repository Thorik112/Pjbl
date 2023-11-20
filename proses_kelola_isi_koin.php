<?php
include "koneksi.php";
session_start(); // Mulai atau lanjutkan sesi PHP
function addNotification($nama, $message) {
  if (!isset($_SESSION['notif4'][$nama])) {
      $_SESSION['notif4'][$nama] = array();
  }
  $_SESSION['notif4'][$nama][] = $message;
}
// Fungsi untuk menyetujui transaksi dan mengirim notifikasi
function approveTransaction($nama, $koin) {
    // Logika untuk menyetujui transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Transaksi Berhasil koin sejumlah $koin";
    addNotification($nama, $adminMessage);
}

// Fungsi untuk menolak transaksi dan mengirim notifikasi
function tolakTransaksi($nama, $koin) {
    // Logika untuk menolak transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Karena Kelalaian admin koin anda dikembalikan sejumlah $koin";
    addNotification($nama, $adminMessage);
}

// Cek apakah ada data yang dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah elemen 'id' dan 'action' ada dalam data POST
    if (isset($_POST['koin']) && isset($_POST['action']) && isset($_POST['id'])) {
        $koin = $_POST['koin'];
        $action = $_POST['action'];
        $id_koin = $_POST['id'];

        // Selanjutnya, Anda dapat mengambil data 'nama_pemesan' jika perlu
        if (isset($_POST['nama'])) {
            $nama = $_POST['nama'];
                    // Sekarang Anda memiliki $id_joki, $action, dan $nama_pemesan (jika diperlukan)
        // yang dapat Anda gunakan sesuai dengan logika Anda.

        // Contoh logika:
        if ($action === 'ditolak') {
          tolakTransaksi($nama, $koin);
          $query = mysqli_query($koneksi, "UPDATE tb_koin SET status = '$action' WHERE id_koin = '$id_koin'");
          if ($query) {
            header('location: kelola_isi_koin.php');
          } else {
              echo "<script>alert('Gagal2');window.location='kelola_isi_koin.php'</script>";
          }
      } elseif ($action === 'terima') {
          // Lakukan tindakan persetujuan
          approveTransaction($nama, $koin);
          $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin + $koin WHERE nama = '$nama'");
          if ($query) {
            $query = mysqli_query($koneksi, "UPDATE tb_koin SET status = '$action' WHERE id_koin = '$id_koin'");
            if ($query) {
                header('location: kelola_isi_koin.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_isi_koin.php'</script>";
            }
          } else {
              echo "<script>alert('Gagal');window.location='kelola_isi_koin.php'</script>";
          }
      }
      } else {
          echo "<script>alert('Aksi tidak valid');window.location='kelola_isi_koin.php'</script>";
      }
    } else {
        echo "<script>alert('Data yang dibutuhkan tidak ada dalam permintaan POST');window.location='kelola_isi_koin.php'</script>";
    }
} else {
    echo "<script>alert('Permintaan harus menggunakan metode POST');window.location='kelola_isi_koin.php'</script>";
}
?>
