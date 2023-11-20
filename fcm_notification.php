// fcm_notification.php

<?php
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

require __DIR__.'/vendor/autoload.php';

// Fungsi untuk mengirim notifikasi push ke FCM
function kirimNotifikasiFCM($deviceToken, $transaksiDiterima) {
    $judul = ($transaksiDiterima) ? "Transaksi Diterima" : "Transaksi Ditolak";
    $pesan = ($transaksiDiterima) ? "Transaksi Anda telah diterima." : "Maaf, transaksi Anda ditolak.";

    $factory = (new Factory)->withServiceAccount('path/to/firebase_credentials.json'); // Sesuaikan dengan path ke file credential Firebase Anda
    $messaging = $factory->createMessaging();

    $message = CloudMessage::new()
        ->withNotification(Notification::create($judul, $pesan))
        ->withData(['key' => 'value']); // Data tambahan jika diperlukan

    $messaging->send($message, $deviceToken);
}
?>
