<?php
require_once 'koneksi.php';

$response = array();

if (isset($_POST['coupon']) && isset($_POST['price'])) {
    $coupon_code = $_POST['coupon'];
    $price = $_POST['price'];

    $stmt = mysqli_prepare($koneksi, "SELECT * FROM `tb_promo` WHERE `coupon_code` = ?");
    mysqli_stmt_bind_param($stmt, "s", $coupon_code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $fetch = mysqli_fetch_array($result);

        if ($fetch) {
            $discount = $fetch['discount'] / 100;
            $total = $discount * $price;

            $response['discount'] = $fetch['discount'];
            $response['price'] = $price - $total;

            echo json_encode($response);
        } else {
            $response['error'] = "Invalid Coupon Code";
            echo json_encode($response);
        }
    } else {
        $response['error'] = "Query Failed";
        echo json_encode($response);
    }

    mysqli_stmt_close($stmt);
} else {
    $response['error'] = "Incomplete Data";
    echo json_encode($response);
}
?>
