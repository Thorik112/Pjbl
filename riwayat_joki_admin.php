<?php
session_start();
if (isset($_SESSION['level']) && isset($_SESSION['nama']))
{
   
    if ($_SESSION['level']=="admin")
    {
    }
		else if ($_SESSION['level']=='admin')
    {
      header('location:admin.php');
    }
		else if ($_SESSION['level']=='user')
		{
			header('location:user.php');
		}
}
 if (!isset($_SESSION['level']))
{
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Jockey</title>
	<meta charset="UTF-8">
	<meta name="description" content="Game Warrior Template">
	<meta name="keywords" content="warrior, game, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/stylecoba.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="container" style="margin-top= 0%;">
			<!-- logo -->
			<div>
			<a class="sidebar-brand-text mx-3" href="admin.php">
					<strong>JOCKEY</strong>
				</a>
			</div>
			<div class="profile-dropdown">
			<?php 
         include "koneksi.php";
				 $username = $_SESSION['nama'];
         $query = "SELECT * FROM tb_akun WHERE nama = '$username'";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
						?>
        <div onclick="toggle()" class="profile-dropdown-btn">
          <div class="profile-img">
					<img src="file/<?php echo $data['gambar'] ; ?>">
          </div>

          <span>	
					<?php echo $username; ?><br>			
			   <a><?php echo $data['koin']; ?><a>
						<?php
					}
				}
		?>
          </span>
        </div>

        <ul class="profile-dropdown-list">
          <li class="profile-dropdown-list-item">
            <a href="#edit">
              <i class="fas fa-fw fa-user"></i>
              Edit Profile
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="#data_diri">
              <i class="fas fa-fw fa-table"></i>
              Edit Data Admin
            </a>
          </li>
					<li class="profile-dropdown-list-item">
            <a href="#ubah_koin">
              <i class="fas fa-fw fa-coins"></i>
              Ubah Koin
            </a>
          </li>

					<hr>

          <li class="profile-dropdown-list-item">
            <a href="logout.php">
              <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
              Log out
            </a>
          </li>
        </ul>
      </div>
			<script src="js/script.js"></script>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- site menu -->
			<nav class="main-menu">
			<ul>
				<li><a href="admin.php">Home</a></li>
				<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kelola Pesanan
          </a>
          <ul class="dropdown-menu" style="height: 5; width: 200px;">
            <li><a class="dropdown-item text-dark" href="kelola_pesanan_joki.php" style="width: 70%;">Joki</a></li>
            <li><a class="dropdown-item text-dark" href="kelola_pesanan_mabar.php" style="width: 70%;">Mabar</a></li>
          </ul>
        </li>
				<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Riwayat
          </a>
          <ul class="dropdown-menu" style="height: 150px; width: 200px;">
            <li><a class="dropdown-item text-dark" href="riwayat_ubah_koin.php" style="width: 70%;">Riwayat Isi Koin</a></li>
            <li><a class="dropdown-item text-dark" href="riwayat_joki_admin.php" style="width: 70%;">Riwayat Joki</a></li>
						<li><a class="dropdown-item text-dark" href="riwayat_mabar_admin.php" style="width: 70%;">Riwayat Mabar</a></li>
          </ul>
        </li>
				<li><a href="contact_admin.php">Contact</a></li>
			</ul>
			</nav>
		</div>
	</header>
	<div class="uk">
      <div class="overlay" id="ubah_koin">
        <div class="popup" style="margin-top: 12%;">
          <h2 style="text-align: center;">Ubah Koin</h2>
          <a class="close" href="#">&times;</a>
          <br>
          <div class="content">
          <div class="wrapper2">
					<?php 
         include "koneksi.php";
				 $username = $_SESSION['nama'];
         $query = "SELECT * FROM tb_akun WHERE nama = '$username'";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
						?>
      <form id="form-ubah" method="post" action="proses_ubah_koin.php?id_akun=<?php echo $data['id_akun']; ?>">   

			<div class="input-box2">
			<label for="no" style="color: #fff;">Nomor Handphone :</label>
          <input name="no" id="no" type="number" placeholder="No.Hp / Dana" required>
        </div><br>
								<div class="input_group">
				<div class="input_box">
					<p style="color: #fff;">Jumlah :<p>
					<input type="radio" id="b2" name="harga" class="radio" value="10000" <?php if($data['harga']==10000) echo 'checked'; ?> required>
					<label for="b2">10.000</label>
					<input type="radio" id="b3" name="harga" class="radio" value="25000" <?php if($data['harga']==25000) echo 'checked'; ?>>
					<label for="b3">25.000</label>
					<input type="radio" id="b4" name="harga" class="radio" value="50000" <?php if($data['harga']==50000) echo 'checked'; ?>>
					<label for="b4" style="position: absolute;">50.000</label>
					<input type="radio" id="b5" name="harga" class="radio" value="100000" <?php if($data['harga']==100000) echo 'checked'; ?>>
					<label for="b5" style="position: absolute; margin-left: 50%;">100.000</label>
				</div>
		</div>

		<input type="hidden" name="id" value="<?php echo $data['nama']; ?>">
		<button type="submit" class="btn" onclick="tampilkanKonfirmasi()">Ubah</button>
      </form>
			<script>
function tampilkanKonfirmasi() {
    if (confirm("Apakah Anda yakin akan mengubah koin?")) {
        // Jika pengguna menekan "OK" dalam konfirmasi, submit form
        document.getElementById("form-ubah").submit();
    }
}
</script>
			<?php
					}
				}
				?>
    </div>
          </div>
        </div>
      </div>
    </div>
	<div class="dd">
      <div class="overlay" id="data_diri">
        <div class="popup">
          <h2 style="text-align: center;">Edit Data Admin</h2>
          <a class="close" href="#">&times;</a>
          <br>
          <div class="content">
          <div class="wrapper2">
					<?php 
         include "koneksi.php";
				 $username = $_SESSION['nama'];
         $query = "SELECT * FROM tb_akun WHERE nama = '$username'";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
						$game = $data['game'];
						$game_string = explode(', ', $game);
						?>
      <form method="post" action="proses_edit_admin.php?id_akun=<?php echo $data['id_akun']; ?>">   
								<div class="form-group">
										<label for="Game" style="color: #fff;">Role Game:</label><br>
										<table>
										<tr>
											<td><div class="form-check">
												<input type="checkbox" class="form-check-input" name="game[]" value="MK" <?php if(in_array('MK', $game_string)) echo 'checked'; ?>>
												<label class="form-check-label" style="color: #fff;">MK</label><br>
												<input type="checkbox" class="form-check-input" name="game[]" value="BVBNJ" <?php if(in_array('BVBNJ', $game_string)) echo 'checked'; ?>>
												<label class="form-check-label" style="color: #fff;">BVBNJ</label>
										</div></td>
									</tr>
										</table>
								</div>

					<div class="form-group">
										<label for="deskripsi" style="color: #fff;">Deskripsi Diri</label>
										<textarea class="form-control" name="deskripsi" cols="50" rows="5" style="width: 200%;"><?php echo $data['deskripsi_diri']; ?></textarea>
								</div>

								<div class="input_group">
				<div class="input_box">
					<p style="color: #fff;">Harga<p>
					<input type="radio" id="b2" name="harga" class="radio" value="10000" <?php if($data['harga']==10000) echo 'checked'; ?> required>
					<label for="b2">10.000</label>
					<input type="radio" id="b3" name="harga" class="radio" value="25000" <?php if($data['harga']==25000) echo 'checked'; ?>>
					<label for="b3">25.000</label>
					<input type="radio" id="b4" name="harga" class="radio" value="50000" <?php if($data['harga']==50000) echo 'checked'; ?>>
					<label for="b4" style="position: absolute;">50.000</label>
					<input type="radio" id="b5" name="harga" class="radio" value="100000" <?php if($data['harga']==100000) echo 'checked'; ?>>
					<label for="b5" style="position: absolute; margin-left: 50%;">100.000</label>
				</div>
		</div>

						<button type="submit" class="btn">Ubah</button>
      </form>
			<?php
					}
				}
				?>
    </div>
          </div>
        </div>
      </div>
    </div>
	<div class="e">
	<?php
include 'koneksi.php';
$nama = $_SESSION['nama']; // User's session
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_akun WHERE nama = '$nama'"));
?>
      <div class="overlay" id="edit">
        <div class="popup">
          <span><h2 style="text-align: center;">Edit Profil</h2></span>
          <a class="close" href="#">&times;</a>
          <br>
          <div class="content">
          <div class="wrapper2">
					<form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <?php
        $id = $user["id_akun"];
        $name = $user["nama"];
        $image = $user["gambar"];
        ?>
        <img src="file/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
        <div class="round">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
          <i class = "fa fa-camera" style = "color: #fff;"></i>
        </div>
      </div>
    </form>
    <script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
    <?php
    if(isset($_FILES["image"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["name"];

      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo
        "
        <script>
          alert('Invalid Image Extension');
          document.location.href = 'pesan.php#edit';
        </script>
        ";
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = 'startbootstrap-sb-admin-2-gh-pages/pesan.php#edit';
        </script>
        ";
      }
      else{
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query = "UPDATE tb_akun SET gambar = '$newImageName' WHERE id_akun = $id";
        mysqli_query($koneksi, $query);
        move_uploaded_file($tmpName, 'file/' . $newImageName);
        echo
        "
        <script>
        document.location.href = 'pesan.php#edit';
        </script>
        ";
      }
    }
    ?>
		<?php 
         include "koneksi.php";
				 $username = $_SESSION['nama'];
         $query = "SELECT * FROM tb_akun WHERE nama = '$username'";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
						?>
      <form method="post" action="proses_edit_profil.php?nama=<?php echo $_SESSION['nama'] ?>">
        <div class="input-box2">
          <input name="username" id="username" type="text" placeholder="Username" value="<?php echo $data['nama']; ?>" required>
        </div>

        <div class="input-box2">
          <input name="op" id="pass1" text-align="center" type="password" placeholder="Password Lama">
        </div>

        <div class="input-box2">
          <input name="np" id="pass2" type="password" placeholder="Password Baru">
        </div>

				<div class="input-box2">
          <input name="c_np" id="pass1" text-align="center" type="password" placeholder="Konfirmasi Password Baru">
        </div>

				<input type="checkbox" name="ubah_Password" value="true"><a style="color: white; position: absolute;">Ceklis jika ingin mengubah password</a><br>

        <button type="submit" class="btn">Update</button>
				
      </form>
			<?php
					}
				}
			?>
    </div>
          </div>
        </div>
      </div>
    </div>

	<!-- Header section end -->



	<!-- Latest news section -->
	<div class="latest-news-section">
		<div class="ln-title">Berita Terbaru</div>
		<div class="news-ticker">
			<div class="news-ticker-contant">
				<div class="nt-item"><span class="new">cepat</span>Temukan tempat bermain game impianmu. </div>
				<div class="nt-item"><span class="strategy">aman</span>Bermainlah ditempat yang membuatmu nyaman. </div>
				<div class="nt-item"><span class="racing">terpecaya</span>Karena kebahagiaan dimulai dari kenyamanan. </div>
			</div>
		</div>
	</div>
	<!-- Latest news section end -->


	<!-- Page info section -->
	<!-- <section class="page-info-section set-bg" data-setbg="img/page-top-bg/4.jpg">
		<div class="pi-content">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-lg-6 text-white">
						<h2>Our Community</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Page info section -->


	<!-- Page section -->
	<div class="transaction-history">
	<?php 
         include "koneksi.php";
				 $nama = $_SESSION['nama'];
         $query = "SELECT * FROM transaksi_joki WHERE nama_penjoki = '$nama'";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
			?>
        <div class="transaction-item">
            <div class="transaction-header">
                <h3 class="text-white">No. Pesanan: <?php echo $data['id_joki']; ?></h3>
                <?= $data['hasil'] === 'menunggu' ? '<h5><span class="badge badge-warning">Menunggu</span></h5>' 
										: ($data['hasil'] === 'ditolak' ? '<h5><span class="badge badge-danger">DiTolak</span></h5>' 
										:'<h5><span class="badge badge-success">DiTerima</span></h5>') ?>
            </div>
            <div class="transaction-details text-white">
                <p>Nama Game: <?php echo $data['nama_game']; ?></p>
                <p>Nama Pemesan: <?php echo $data['nama_pemesan']; ?></p>
								<p>Bayar : <?php echo $data['harga']; ?></p>
                <p>Tanggal Pemesanan: <?php echo $data['waktu_pemesanan']; ?></p>
            </div>
        </div>
				<?php
					}
				}
				else{ 
				?>
				<h3 style="text-align: center; margin-top: 40px; margin-bottom: 40px;">Belum Ada Pesanan Mabar Apapun</h3>
				<?php
				}
				?>
        <!-- Tambahkan item transaksi lain di sini -->
    </div>
	<!-- Page section end -->


<!-- Footer top section -->
<section class="footer-top-section">
		<div class="container">
			<div class="footer-top-bg">
				<img src="img/footer-top-bg.png" alt="">
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="footer-logo text-white">
						<div>
							<a class="sidebar-brand-text mx-3" href="user.php">
								<strong>JOCKEY</strong>
							</a>
						</div>
						<p>adalah website yang menyediakan layanan digital
                  seperti layanan Joki ataupun layanan untuk mencari
        tempat untuk bermain bersama. Layanan ini didirikan
        pada tahun 2023 dan siap untuk melayani semua konsumen
        yang datang. Selain Website saya juga telah membuat
        aplikasi mobilenya dengan nama jockey. </p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="footer-widget mb-5 mb-md-0">
						<h4 class="fw-title">Rekomendasi Game</h4>
						<?php 
         include "koneksi.php";
         $query = "SELECT * FROM tb_game ORDER BY RAND() LIMIT 3";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
			?>
						<div class="latest-blog">
							<div class="lb-item">
								<div class="lb-thumb set-bg" data-setbg="file/<?php echo $data['gambar'] ; ?>"></div>
								<div class="lb-content">
									<div class="lb-date"><?php echo $data['game']; ?></div>
									<p><?php echo $data['deskripsi']; ?></p>
									<a href="login.php" class="lb-author">Pesan</a>
								</div>
							</div>
						</div>
						<?php
					}
				}
		?>	
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="footer-widget">
						<h4 class="fw-title">Player Populer</h4>
						<div class="top-comment">
						<?php
include "koneksi.php";

$query = "SELECT tj.nama_penjoki, COUNT(tj.nama_penjoki) AS jumlah_nama, ta.deskripsi_diri, ta.jenis, ta.game, ta.gambar
          FROM transaksi_joki tj
          LEFT JOIN tb_akun ta ON tj.nama_penjoki = ta.nama
          GROUP BY tj.nama_penjoki 
          ORDER BY jumlah_nama DESC 
          LIMIT 2";

$hasil = mysqli_query($koneksi, $query);

if (mysqli_num_rows($hasil) > 0) {
    while ($data = mysqli_fetch_assoc($hasil)) {
        $image = $data["gambar"];
        ?>
        <div class="tc-item">
            <div class="tc-thumb set-bg" data-setbg="file/<?php echo $image; ?>">
                <img src="file/<?php echo $image; ?>" title="<?php echo $image; ?>">
            </div>
            <div class="tc-content">
                <p><a href="login.php"><?php echo $data['nama_penjoki']; ?></a> <span><?php echo $data['jenis']; ?></span>  <?php echo $data['deskripsi_diri']; ?></p>
                <div class="tc-date"><?php echo $data['game']; ?></div>
            </div>
        </div>
        <?php
    }
}
?>
						<?php
include "koneksi.php";

$query = "SELECT tm.nama_pemain, COUNT(tm.nama_pemain) AS jumlah_nama, ta.deskripsi_diri, ta.jenis, ta.game, ta.gambar
          FROM transaksi_mabar tm
          LEFT JOIN tb_akun ta ON tm.nama_pemain = ta.nama
          GROUP BY tm.nama_pemain 
          ORDER BY jumlah_nama DESC 
          LIMIT 2";

$hasil = mysqli_query($koneksi, $query);

if (mysqli_num_rows($hasil) > 0) {
    while ($data = mysqli_fetch_assoc($hasil)) {
        $image = $data["gambar"];
        ?>
        <div class="tc-item">
            <div class="tc-thumb set-bg" data-setbg="file/<?php echo $image; ?>">
                <img src="file/<?php echo $image; ?>" title="<?php echo $image; ?>">
            </div>
            <div class="tc-content">
                <p><a href="login.php"><?php echo $data['nama_pemain']; ?></a> <span><?php echo $data['jenis']; ?></span>  <?php echo $data['deskripsi_diri']; ?></p>
                <div class="tc-date"><?php echo $data['game']; ?></div>
            </div>
        </div>
        <?php
    }
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Footer top section end -->

	
	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<ul class="footer-menu">
				<li><a href="admin.php">Home</a></li>
				<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kelola Pesanan
          </a>
          <ul class="dropdown-menu" style="height: 5; width: 200px;">
            <li><a class="dropdown-item text-dark" href="kelola_pesanan_joki.php" style="width: 70%;">Joki</a></li>
            <li><a class="dropdown-item text-dark" href="kelola_pesanan_mabar.php" style="width: 70%;">Mabar</a></li>
          </ul>
        </li>
				<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Riwayat
          </a>
          <ul class="dropdown-menu" style="height: 100px; width: 200px;">
            <li><a class="dropdown-item text-dark" href="riwayat_ubah_koin.php" style="width: 70%;">Riwayat Isi Koin</a></li>
            <li><a class="dropdown-item text-dark" href="riwayat_joki_admin.php" style="width: 70%;">Riwayat Joki</a></li>
						<li><a class="dropdown-item text-dark" href="riwayat_mabar_admin.php" style="width: 70%;">Riwayat Mabar</a></li>
          </ul>
        </li>
				<li><a href="contact_admin.php">Contact</a></li>
			</ul>
			<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script>JOCKEY
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
		</div>
	</footer>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.marquee.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
    </body>
</html>