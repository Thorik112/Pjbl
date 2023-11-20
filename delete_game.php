<?php
include "koneksi.php";
$id_game=$_GET['id_game'];
$query="DELETE FROM tb_game where id_game='$id_game'";
$hasil=mysqli_query($koneksi, $query);
if ($hasil) {
?>
<script language="javascript">document.location.href="kelola_game.php";</script>
<?php
}else{
echo "gagal hapus data";
}
?>