<?php
include "koneksi.php";

$amount = $_POST['gender'];
$date = date("Y-m-d H:i:s");
$image = $_FILES['gambar']['name'];
$file_tmp = $_FILES['gambar']['tmp_name'];
move_uploaded_file($file_tmp, 'file/'.$image);
$submit = $_POST['submit'];
$user_id = $_POST['name'];

$promoCode = $_POST['promo_code'];

// Periksa apakah pengguna ada di dalam tabel
$userCheckQuery = "SELECT nama FROM tb_akun WHERE nama = '$user_id'";
$userResult = $koneksi->query($userCheckQuery);

if ($submit) {
    if ($userResult->num_rows == 0) {
        echo "<script>alert('Nama yang Anda isi tidak ada');
        window.location='isi_koin.php'</script>";
    } else {
        // Periksa apakah kode promo valid dan belum digunakan oleh pengguna tertentu
        $promoCheckQuery = "SELECT * FROM tb_promo_usage WHERE coupon_code = '$promoCode' AND user_id = '$user_id'";
        $promoResult = $koneksi->query($promoCheckQuery);

        if ($promoResult->num_rows == 0) {
            // tandai kode promo sebagai digunakan oleh pengguna saat ini
            $insertPromoQuery = "INSERT INTO tb_promo_usage (coupon_code, user_id) VALUES ('$promoCode', '$user_id')";
            $koneksi->query($insertPromoQuery);

            $insertQuery = "INSERT INTO tb_koin (id_koin, nama, koin, bukti, waktu_isi_koin, status) 
                            VALUES ('', '$user_id', '$amount', '$image', '$date', 'menunggu')";

            if ($koneksi->query($insertQuery) === TRUE) {
                echo "<script>alert('Isi koin sejumlah $amount berhasil terkirim. Tunggu tanggapan dari admin.');
                window.location='isi_koin.php'</script>";
            } else {
                echo "Error: " . $koneksi->error;
            }
        } else {
            echo "<script>alert('Kode promo sudah digunakan oleh Anda sebelumnya.');
            window.location='isi_koin.php'</script>";
        }
    }
} else {
    echo "<script>alert('Nama yang Anda isi tidak ada');
        window.location='isi_koin.php'</script>";
}
?>
