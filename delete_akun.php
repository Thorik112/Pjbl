<?php
include "koneksi.php";
$id_akun=$_GET['id_akun'];
$query="DELETE FROM tb_akun where id_akun='$id_akun'";
$hasil=mysqli_query($koneksi, $query);
if ($hasil) {
?>
<script language="javascript">document.location.href="super_admin.php";</script>
<?php
}else{
echo "gagal hapus data";
}
?>