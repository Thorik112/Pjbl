<?php
include "koneksi.php";
session_start(); // Mulai atau lanjutkan sesi PHP

// Fungsi untuk menyetujui transaksi dan mengirim notifikasi
function approveTransaction($nama_pemesan) {
    // Logika untuk menyetujui transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Joki telah diterima dan sedang diproses oleh penjoki.";
    addNotification($nama_pemesan, $adminMessage);
}

// Fungsi untuk menolak transaksi dan mengirim notifikasi
function tolakTransaksi($nama_pemesan) {
    // Logika untuk menolak transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Joki telah ditolak oleh admin.";
    addNotification($nama_pemesan, $adminMessage);
}

// Cek apakah ada data yang dikirimkan melalui POST
function selesaiTransaksi($nama_pemesan, $id_joki) {
    // Logika untuk menolak transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Joki dengan id = $id_joki telah selesai untuk bukti buktinya pergi ke halaman riwayat joki.";
    addNotification($nama_pemesan, $adminMessage);
  }

  function addNotification($nama_pemesan, $message) {
    if (!isset($_SESSION['notif'][$nama_pemesan])) {
        $_SESSION['notif'][$nama_pemesan] = array();
    }
    $_SESSION['notif'][$nama_pemesan][] = $message;
  }
  
  // Cek apakah ada data yang dikirimkan melalui POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Periksa apakah elemen 'id' dan 'action' ada dalam data POST
      if (isset($_POST['id']) && isset($_POST['action'])) {
          $id_joki = $_POST['id'];
          $action = $_POST['action'];
          $gambar = $_FILES['gambar']['name'];
          $file_tmp = $_FILES['gambar']['tmp_name'];
          move_uploaded_file($file_tmp, 'file/' . $gambar);
          $gambar2 = $_FILES['gambar2']['name'];
          $file_tmp2 = $_FILES['gambar2']['tmp_name'];
          move_uploaded_file($file_tmp2, 'file/' . $gambar2);
  
          // Selanjutnya, Anda dapat mengambil data 'nama_pemesan' jika perlu
          if (isset($_POST['nama_pemesan'])) {
              $nama_pemesan = $_POST['nama_pemesan'];
                      // Sekarang Anda memiliki $id_joki, $action, dan $nama_pemesan (jika diperlukan)
          // yang dapat Anda gunakan sesuai dengan logika Anda.
  
          // Contoh logika:
          if ($action === 'ditolak') {
            tolakTransaksi($nama_pemesan, $id_joki);
            $query = mysqli_query($koneksi, "UPDATE transaksi_joki SET hasil = '$action' WHERE id_joki = '$id_joki'");
            if ($query) {
                header('location: kelola_pesanan_joki.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_pesanan_joki.php'</script>";
            }
        } elseif ($action === 'diproses') {
            // Lakukan tindakan persetujuan
            approveTransaction($nama_pemesan, $id_joki);
            $query = mysqli_query($koneksi, "UPDATE transaksi_joki SET hasil = '$action' WHERE id_joki = '$id_joki'");
            if ($query) {
                header('location: kelola_pesanan_joki.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_pesanan_joki.php'</script>";
            }
        } elseif ($action === 'selesai') {
          selesaiTransaksi($nama_pemesan, $id_joki);
            $query = mysqli_query($koneksi, "UPDATE transaksi_joki SET hasil = '$action', bukti = '$gambar', bukti2 = '$gambar2', password_game = null WHERE id_joki = '$id_joki'");
            if ($query) {
                header('location: kelola_pesanan_joki.php');
            } else {
                echo "<script>alert('Gagal');window.location='kelola_pesanan_joki.php'</script>";
            }
        } else {
            echo "<script>alert('Aksi tidak valid');window.location='kelola_pesanan_joki.php'</script>";
        }
          }
      } else {
          echo "<script>alert('Data yang dibutuhkan tidak ada dalam permintaan POST');window.location='kelola_pesanan_joki.php'</script>";
      }
  } else {
      echo "<script>alert('Permintaan harus menggunakan metode POST');window.location='kelola_pesanan_joki.php'</script>";
  }
  ?>
  