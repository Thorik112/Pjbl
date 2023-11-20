<?php
include "koneksi.php";
$id_acara=$_GET['id_acara'];
$query="DELETE FROM tb_acara where id_acara='$id_acara'";
$hasil=mysqli_query($koneksi, $query);
if ($hasil) {
?>
<script language="javascript">document.location.href="kelola_acara.php";</script>
<?php
}else{
echo "gagal hapus data";
}
?>