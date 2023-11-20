
<?php
session_start();

// Fungsi untuk menambahkan notifikasi ke sesi
function addNotification($user_id, $message) {
  if (!isset($_SESSION['notifications'][$user_id])) {
      $_SESSION['notifications'][$user_id] = array();
  }
  $_SESSION['notifications'][$user_id][] = $message;
}

// Fungsi untuk menampilkan notifikasi
function displayNotifications($user_id) {
  if (isset($_SESSION['notifications'][$user_id])) {
      foreach ($_SESSION['notifications'][$user_id] as $notification) {
          echo "<script>alert('$notification');</script>";
      }
      // Setelah menampilkan notifikasi, hapus dari sesi
      unset($_SESSION['notifications'][$user_id]);
  }
}

// Contoh penggunaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Simulasi menerima notifikasi dari formulir POST
  $user_id = $_POST['user_id']; // Sertakan informasi pengguna, seperti ID pengguna
  $notifMessage = 'Ayo Bang';
  addNotification($user_id, $notifMessage);
}

// Panggil fungsi untuk menampilkan notifikasi (ganti '1' dengan ID pengguna yang sesuai)
displayNotifications('totototo');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Game Warrior Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="Game Warrior Template">
	<meta name="keywords" content="warrior, game, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/animate.css"/>


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
		<div class="container">
			<!-- logo -->
			<div>
				<a class="sidebar-brand-text mx-3" href="index.html">
					<strong>JOCKEY</strong>
				</a>
			</div>
			<div class="user-panel">
				<a href="login.php">Login</a>  /  <a href="register.php">Register</a>
			</div>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- site menu -->
			<!--<nav class="main-menu">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="review.html">Games</a></li>
					<li><a href="categories.html">Blog</a></li>
					<li><a href="community.html">Forums</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>-->
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
		<?php 
         include "koneksi.php";
         $query = "SELECT * FROM tb_acara";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
			?>
			<div class="hs-item set-bg" data-setbg="file/<?php echo $data['gambar'] ; ?>">
				<div class="hs-text">
					<div class="container">
						<h2><span><?php echo $data['nama_game']; ?></span> Berakhir Pada <br><span> <?php echo $data['waktu']; ?></span></h2>
						<p><?php echo $data['acara']; ?> <br> <?php echo $data['deskripsi']; ?></p>
						<a href="#" class="site-btn">Read More</a>
					</div>
				</div>
			</div>
			<?php
					}
				}
		?>
		</div>
	</section>
	<!-- Hero section end -->


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


	<!-- Feature section -->
	<section class="feature-section spad">
		<div class="container">
			<div class="row">
				<?php 
         include "koneksi.php";
         $query = "SELECT * FROM tb_promo";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
			?>
				<div class="col-lg-3 col-md-6 p-0">
					<div class="feature-item set-bg" data-setbg="file/<?php echo $data['gambar'] ; ?>">
						<span class="cata new"><?php echo $data['discount']; ?></span>
						<div class="fi-content text-white">
							<h5><a href="#"><?php echo $data['promo']; ?></a></h5>
							<p>Berakhir Pada Tanggal :</p>
							<a href="#" class="fi-comment"><?php echo $data['tanggal']; ?></a>
						</div>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</section>
	<!-- Feature section end -->


	<!-- Recent game section  -->
	<section class="recent-game-section spad set-bg" data-setbg="img/recent-game-bg.png">
		<div class="container">
			<div class="section-title">
				<div class="cata new">new</div>
				<h2>Games</h2>
			</div>
			<div class="row">
			<?php
			include "koneksi.php";
			$query = "SELECT * FROM tb_game ORDER BY id_game DESC LIMIT 3";
			$result = mysqli_query($koneksi, $query);
			if (mysqli_num_rows($result) > 0) {
				while ($data = mysqli_fetch_assoc($result)) {
			?>
				<div class="col-lg-4 col-md-6">
					<div class="recent-game-item">
						<div class="rgi-thumb set-bg" data-setbg="file/<?php echo $data['gambar'] ; ?>">
						</div>
						<div class="rgi-content">
							<h5><?php echo $data['game']; ?></h5>
							<p><?php echo $data['deskripsi']; ?></p>
						</div>
					</div>	
				</div>
				<?php
				}
			}
			?>
			</div>
		</div>
	</section>
	<script>
// Menentukan tinggi terbesar untuk rgi-content
function setEqualHeight() {
  let maxHeight = 0;
  const elements = document.querySelectorAll('.rgi-content');
  elements.forEach(element => {
    const height = element.offsetHeight;
    if (height > maxHeight) {
      maxHeight = height;
    }
  });

  // Mengatur tinggi semua elemen rgi-content sesuai dengan tinggi terbesar
  elements.forEach(element => {
    element.style.height = maxHeight + 'px';
  });
}

// Panggil fungsi saat dokumen dimuat
window.addEventListener('load', setEqualHeight);

// Panggil fungsi saat ukuran layar berubah (jika diperlukan)
window.addEventListener('resize', setEqualHeight);
</script>
	<!-- Recent game section end -->


	<!-- Tournaments section -->
	<section class="tournaments-section spad">
		<div class="container">
			<div class="tournament-title">Pro Player</div>
			<div class="row">
			<?php
			include "koneksi.php";
			$query = "SELECT * FROM tb_akun WHERE kategori = 'pro' LIMIT 2";
			$result = mysqli_query($koneksi, $query);
			if (mysqli_num_rows($result) > 0) {
				while ($data = mysqli_fetch_assoc($result)) {
					$image = $data["gambar"];	
			?>
				<div class="col-md-6">
					<div class="tournament-item mb-4 mb-lg-0">
						<div class="ti-notic"><?php echo $data['jenis']; ?></div>
						<div class="ti-content">
							<div class="ti-thumb set-bg" data-setbg=""><img src="file/<?php echo $image; ?>" title="<?php echo $image; ?>" style="width: 168px; height: 178px; border-radius: 0%;"></div>
							<div class="ti-text">
								<h4><?php echo $data['nama']; ?></h4>
								<ul>
									<li><span>Game yang Dimainkan: </span><?php echo $data['game']; ?></li>
									<li><span>Deskripsi Diri: </span><?php echo $data['deskripsi_diri']; ?></li>
								</ul>
								<p><span>Harga Mabar: </span><?php echo $data['harga']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
			}
			?>
			</div>
		</div>
	</section>
	<!-- Tournaments section bg -->	


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
							<a class="sidebar-brand-text mx-3" href="index.html">
								<strong>JOCKEY</strong>
							</a>
							<p>adalah website yang menyediakan layanan digital
                  seperti layanan Joki ataupun layanan untuk mencari
        tempat untuk bermain bersama. Layanan ini didirikan
        pada tahun 2023 dan siap untuk melayani semua konsumen
        yang datang. Selain Website saya juga telah membuat
        aplikasi mobilenya dengan nama jockey. </p>
						</div>
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
						// Batasi deskripsi hanya menampilkan sejumlah karakter tertentu
						$deskripsi = $data['deskripsi'];
						$max_length = 100; // Ganti dengan jumlah karakter maksimum yang ingin Anda tampilkan
						$deskripsi = (strlen($deskripsi) > $max_length) ? substr($deskripsi, 0, $max_length) . '...' : $deskripsi;
			?>
						<div class="latest-blog">
							<div class="lb-item">
								<div class="lb-thumb set-bg" data-setbg="file/<?php echo $data['gambar'] ; ?>"></div>
								<div class="lb-content">
									<div class="lb-date"><?php echo $data['game']; ?></div>
									<p><?php echo $deskripsi; ?></p>
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
			<div class="user-panel" style="margin-top: -0.5%;">
				<a href="login.php">Login</a>  /  <a href="register.php">Register</a>
			</div>
			<!--<ul class="footer-menu">
				<li><a href="index.html">Home</a></li>
				<li><a href="review.html">Games</a></li>
				<li><a href="categories.html">Blog</a></li>
				<li><a href="community.html">Forums</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>-->
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
    </body>
</html>