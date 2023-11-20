<?php
// admin.php

if(isset($_POST['kirim_notifikasi'])) {
    $transaksiDiterima = ($_POST['status_transaksi'] == 'diterima');
    
    // Panggil fungsi kirimNotifikasiFCM dengan tiga argumen
    require 'fcm_notification.php';
    kirimNotifikasiFCM($_POST['device_token'], $transaksiDiterima);

    echo "<p>Notifikasi berhasil dikirim ke perangkat dengan token: {$_POST['device_token']}.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Page</h1>

    <h2>Kirim Notifikasi ke Pengguna</h2>
    <form method="post" action="">
        <label for="device_token">Device Token Pengguna:</label>
        <?php
        // Tambahkan input untuk menampilkan device token yang diambil secara otomatis
        echo '<input type="text" name="device_token" id="device_token" required readonly>';
        ?>

        <!-- Tambahkan input hidden untuk menyimpan device token yang diambil secara otomatis -->
        <input type="hidden" id="device_token_hidden" name="device_token" required>

        <br>
        <label for="status_transaksi">Status Transaksi:</label>
        <select name="status_transaksi" required>
            <option value="diterima">Diterima</option>
            <option value="ditolak">Ditolak</option>
        </select>
        <br>
        <input type="submit" name="kirim_notifikasi" value="Kirim Notifikasi">
    </form>

    <!-- Script JavaScript untuk mendapatkan dan menampilkan device token secara otomatis -->
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-messaging.js"></script>
    <script src="firebase-config.js"></script>

    <script>
        const messaging = firebase.messaging();
        messaging.getToken().then((token) => {
            // Tampilkan token di input dan input hidden
            document.getElementById("device_token").value = token;
            document.getElementById("device_token_hidden").value = token;

            // Tampilkan token di konsol (untuk tujuan debug)
            console.log("Device Token:", token);
        });
    </script>
</body>
</html>
