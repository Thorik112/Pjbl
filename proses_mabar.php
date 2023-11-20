<?php
include "koneksi.php";
session_start(); // Mulai atau lanjutkan sesi PHP
function addNotification($nama_pemesan, $message) {
  if (!isset($_SESSION['notif'][$nama_pemesan])) {
      $_SESSION['notif'][$nama_pemesan] = array();
  }
  $_SESSION['notif'][$nama_pemesan][] = $message;
}
// Fungsi untuk menyetujui transaksi dan mengirim notifikasi
function approveTransaction($nama_pemesan, $id_mabar) {
    // Logika untuk menyetujui transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Mabar dengan id = $id_mabar telah diterima dan sedang diproses oleh penjoki untuk info lebih lanjut pergi ke halaman riwayat joki.";
    addNotification($nama_pemesan, $adminMessage);
}

// Fungsi untuk menolak transaksi dan mengirim notifikasi
function tolakTransaksi($nama_pemesan, $id_mabar) {
    // Logika untuk menolak transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Mabar dengan id = $id_mabar telah ditolak oleh admin untuk info lebih lanjut pergi ke halaman riwayat joki.";
    addNotification($nama_pemesan, $adminMessage);
}

function selesaiTransaksi($nama_pemesan, $id_mabar) {
  // Logika untuk menolak transaksi
  // Anda juga bisa menambahkan notifikasi ke pengguna
  $adminMessage = "Mabar dengan id = $id_mabar telah selesai untuk bukti buktinya pergi ke halaman riwayat joki.";
  addNotification($nama_pemesan, $adminMessage);
}

// Cek apakah ada data yang dikirimkan melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah elemen 'id' dan 'action' ada dalam data POST
    if (isset($_POST['id']) && isset($_POST['action'])) {
        $id_mabar = $_POST['id'];
        $action = $_POST['action'];
        $gambar = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($file_tmp, 'file/' . $gambar);

        // Selanjutnya, Anda dapat mengambil data 'nama_pemesan' jika perlu
        if (isset($_POST['nama_pemesan'])) {
            $nama_pemesan = $_POST['nama_pemesan'];
                    // Sekarang Anda memiliki $id_joki, $action, dan $nama_pemesan (jika diperlukan)
        // yang dapat Anda gunakan sesuai dengan logika Anda.

        // Contoh logika:
        if ($action === 'ditolak') {
          tolakTransaksi($nama_pemesan, $id_mabar);
          $query = mysqli_query($koneksi, "UPDATE transaksi_mabar SET hasil = '$action' WHERE id_mabar = '$id_mabar'");
          if ($query) {
              header('location: kelola_pesanan_mabar.php');
          } else {
              echo "<script>alert('Gagal');window.location='kelola_pesanan_mabar.php'</script>";
          }
      } elseif ($action === 'diproses') {
          // Lakukan tindakan persetujuan
          approveTransaction($nama_pemesan, $id_mabar);
          $query = mysqli_query($koneksi, "UPDATE transaksi_mabar SET hasil = '$action' WHERE id_mabar = '$id_mabar'");
          if ($query) {
              header('location: kelola_pesanan_mabar.php');
          } else {
              echo "<script>alert('Gagal');window.location='kelola_pesanan_mabar.php'</script>";
          }
      } elseif ($action === 'selesai') {
          $query = mysqli_query($koneksi, "UPDATE transaksi_mabar SET hasil = '$action', bukti = '$gambar' WHERE id_msbsr = '$id_mabar'");
          if ($query) {
              header('location: kelola_pesanan_mabar.php');
          } else {
              echo "<script>alert('Gagal');window.location='kelola_pesanan_mabar.php'</script>";
          }
      } else {
          echo "<script>alert('Aksi tidak valid');window.location='kelola_pesanan_mabar.php'</script>";
      }
        }
    } else {
        echo "<script>alert('Data yang dibutuhkan tidak ada dalam permintaan POST');window.location='kelola_pesanan_mabar.php'</script>";
    }
} else {
    echo "<script>alert('Permintaan harus menggunakan metode POST');window.location='kelola_pesanan_mabar.php'</script>";
}
?>
