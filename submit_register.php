<?php
$username = $_POST['nama'];
$password1 = $_POST['pass1'];
$password2 = $_POST['pass2'];
$email = $_POST['email'];
$level = "user";
$gambar = "8.jpg";
$koin = 0;

include "koneksi.php";

// Cek apakah nama sudah ada dalam database
$checkQuery = "SELECT nama FROM tb_akun WHERE nama = '$username'";
$checkResult = mysqli_query($koneksi, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // Jika nama sudah ada, tampilkan pesan kesalahan
    $errorMessage = "Username sudah ada yang memiliki.";
} elseif ($password1 == $password2) {
    // Validasi Nama
    if (!preg_match('/^[a-zA-Z0-9]{6,20}$/', $username)) {
        $errorMessage = "Nama tidak valid. Nama harus lebih dari 6 huruf, kurang dari 20 huruf, dan hanya mengizinkan huruf dan angka.";
    } else {
        $pengacak = "p3ng4c4k";

        $passmd = md5($pengacak . md5($password1));

        $query = "INSERT INTO tb_akun(id_akun, nama, password, email, level, koin, gambar) VALUES('', '$username', '$passmd', '$email', '$level', '$koin', '$gambar')";
        $hasil = mysqli_query($koneksi, $query);

        if ($hasil) {
            $successMessage = "Registrasi berhasil.";
        } else {
            $errorMessage = "Registrasi gagal.";
        }
    }
} else {
    $errorMessage = "Password yang dimasukkan tidak sama.";
}

// Redirect back to the register page with messages
if (isset($errorMessage)) {
    echo '<script>alert("' . $errorMessage . '");</script>';
    echo '<script>window.location.href="register.php";</script>';
} elseif (isset($successMessage)) {
    echo '<script>alert("' . $successMessage . '");</script>';
    echo '<script>window.location.href="login.php";</script>';
}
?>
