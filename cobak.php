<!-- user.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
    <h1>User Page</h1>

    <?php
    // Simulasi transaksi yang berhasil atau ditolak
    $transaksiDiterima = true; // Ganti sesuai kebutuhan

    // Tampilkan notifikasi untuk pengguna
    $notifPengguna = ($transaksiDiterima) ? "Transaksi Anda telah diterima." : "Maaf, transaksi Anda ditolak.";
    echo "<p>$notifPengguna</p>";
    ?>
</body>
</html>
