<?php
include "koneksi.php";
$id_promo=$_GET['id_promo'];
$query="DELETE FROM tb_promo where id_promo='$id_promo'";
$hasil=mysqli_query($koneksi, $query);
if ($hasil) {
?>
<script language="javascript">document.location.href="kelola_promo.php";</script>
<?php
}else{
echo "gagal hapus data";
}
?>