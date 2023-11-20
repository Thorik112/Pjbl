<?php
session_start();
if (isset($_SESSION['level']) && isset($_SESSION['nama']))
{
   
    if ($_SESSION['level']=="user")
    {
    }else if ($_SESSION['level']=='admin')
		{
      header('location:admin.php');
    }
		else if ($_SESSION['level']=='super')
		{
      header('location:super_admin.php');
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
	<title>Game Warrior Template</title>
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
			<a class="sidebar-brand-text mx-3" href="user.php">
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
            <a href="#menjadi_admin">
              <i class="fas fa-fw fa-plus"></i>
              Menjadi Admin
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
					<li><a href="user.php">Home</a></li>
					<li><a href="isi_koin.php">Isi Koin</a></li>
					<li><a href="pesan.php">Pesan</a></li>
					<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Riwayat
          </a>
          <ul class="dropdown-menu" style="height: 150px; width: 200px;">
            <li><a class="dropdown-item text-dark" href="riwayat_isi_koin.php" style="width: 70%;">Riwayat Isi Koin</a></li>
            <li><a class="dropdown-item text-dark" href="riwayat_joki.php" style="width: 70%;">Riwayat Joki</a></li>
						<li><a class="dropdown-item text-dark" href="riwayat_mabar.php" style="width: 70%;">Riwayat Mabar</a></li>
          </ul>
        </li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="ma">
      <div class="overlay" id="menjadi_admin">
        <div class="popup">
          <h2 style="text-align: center;">Menjadi Admin</h2>
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
      <form method="post" action="proses_menjadi_admin.php?id_akun=<?php echo $data['id_akun']; ?>">   
			<?php 
         include "koneksi.php";
         $query = "SELECT * FROM tb_game";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
						?>			
								<div class="form-group">
										<label for="Game" style="color: #fff;">Role Game:</label><br>
										<table>
											<?php
											while ($data = mysqli_fetch_assoc($hasil)) {
											?>
										<tr>
											<td><div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="game[]" value="<?php echo $data['game']; ?>">
												<label class="form-check-label" style="color: #fff;"><?php echo $data['game']; ?></label>
										</div></td>
									</tr>
										</table>
										<?php
					}
				}
				?>
								</div>

					<div class="form-group">
										<label for="deskripsi" style="color: #fff;">Deskripsi Diri</label>
										<textarea class="form-control" name="deskripsi" cols="50" rows="5" style="width: 200%;" required></textarea>
								</div>

										<div class="input_group">
				<div class="input_box">
					<p style="color: #fff;">Harga<p>
					<input type="radio" id="b2" name="harga" class="radio" value="10000" required>
					<label for="b2">10.000</label>
					<input type="radio" id="b3" name="harga" class="radio" value="25000">
					<label for="b3">25.000</label>
					<input type="radio" id="b4" name="harga" class="radio" value="50000">
					<label for="b4" style="position: absolute;">50.000</label>
					<input type="radio" id="b5" name="harga" class="radio" value="100000">
					<label for="b5" style="position: absolute; margin-left: 50%;">100.000</label>
				</div>
		</div>

						<button type="submit" class="btn">Daftar</button>
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

				<input type="checkbox" name="ubah_Password" value="true"><a style="color: white; position: absolute;">Ceklis jika ingin mengubah password<a><br>

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

	<!-- Page section -->
	<section class="page-section review-page spad">
		<div class="wrapper">
			<form action="proses_isi_koin.php" method="POST" enctype="multipart/form-data">
				<h2>Isi Koin Form</h2>
				<h4>Account</h4>
				<div class="input_group">
					<div class="input_box">
						<input type="text" placeholder="username akun" required class="name" name="nama" value="<?php echo $_SESSION['nama']; ?>">
						<i class="fa fa-user icon"></i>
					</div>
				</div>
        <input type="hidden" id="name" value="<?php echo $_SESSION['nama']; ?>" name="name"/>
		<div class="input_group">
				<div class="input_box">
					<h4>Nominal Koin</h4>
					<input type="radio" required id="b1" name="gender" class="radio" value="5000">
					<label for="b1">5.000</label>
					<input type="radio" id="b6" name="gender" class="radio" value="10000">
					<label for="b6">10.000</label>
					<input type="radio" id="b7" name="gender" class="radio" value="20000">
					<label for="b7">20.000</label>
					<input type="radio" id="b8" name="gender" class="radio" value="50000">
					<label for="b8">50.000</label>
					<input type="radio" id="b9" name="gender" class="radio" value="100000">
					<label for="b9">100.000</label>
				</div>
		</div>
		<div class="input_group">
			<div class="input_box">
				<h4>Metode Pembayaran</h4>
				<input type="radio" name="pay" class="radio" id="bc1" value="dana" checked>
				<label for="bc1"><span>
					<i class="fa fa-cc-dana"></i>Dana
				</span></label>
				<input type="radio" name="pay" class="radio" id="bc2" value="pulsa" checked>
				<label for="bc2"><span>
					<i class="fa fa-cc-pulsa"></i>Pulsa
				</span></label>
			</div>
		</div>
		<div class="form-group">
				<h4 class="text-warning">*Optional</h4>
				<label>Coupon Code</label>
				<input class="form-control" type="text" id="coupon" style="width: 100%;" name="promo_code"/>
				<input type="hidden" id="price"/>
				<div id="result"></div>
				<br style="clear:both;"/>
				<button class="btn btn-primary" id="activate">Activate Code</button>
			</div>
		<div class="form-group">
                                <label for="gambar">Bukti Transfer:</label>
                                <input type="file" name="gambar" id="gambar" required>
                            </div>
		<div class="input_group">
			<div class="input_box">
				<p>Total Bayar: <span id="total"></span></p>
				<script>
var koin1 = document.getElementById("b1");
var koin2 = document.getElementById("b6");
var koin3 = document.getElementById("b7");
var koin4 = document.getElementById("b8");
var koin5 = document.getElementById("b9");

var totalBayarElem = document.getElementById("total");
var priceElem = document.getElementById("price");

koin1.addEventListener("change", updateTotal);
koin2.addEventListener("change", updateTotal);
koin3.addEventListener("change", updateTotal);
koin4.addEventListener("change", updateTotal);
koin5.addEventListener("change", updateTotal);

function updateTotal() {
    var totalBayar = 0;
    if (koin1.checked) {
        totalBayar += parseFloat(koin1.value)
    }
    if (koin2.checked) {
        totalBayar += parseFloat(koin2.value)
    }
    if (koin3.checked) {
        totalBayar += parseFloat(koin3.value)
    }
    if (koin4.checked) {
        totalBayar += parseFloat(koin4.value)
    }
    if (koin5.checked) {
        totalBayar += parseFloat(koin5.value)
    }

    totalBayarElem.textContent = "Rp. " + totalBayar; // Update tampilan totalBayar

    // Set nilai dari priceElem ke totalBayar
    priceElem.value = totalBayar;
}

							</script>
			</div>
		</div>
		<div class="input_group">
			<div class="input_box">
				<input type="submit" class="btn btn-primary" name="submit" value="Submit">
				<input type="reset" class="btn btn-secondary" name="reset" value="Hapus">
			</div>
		</div>
	</form>
		</div>
	</section>
	<!-- Page section end -->


	<!-- Review section -->
	<section class="review-section review-dark spad set-bg" data-setbg="img/review-bg-2.jpg">
		<div class="container">
			<div class="section-title text-white">
				<div class="cata new">pengumuman</div>
				<h2>Beberapa Pemain Kami</h2>
			</div>
			<div class="row text-white">
			<?php
include "koneksi.php";
$query = "SELECT * FROM tb_akun WHERE level = 'admin' ORDER BY RAND() LIMIT 4";
$hasil = mysqli_query($koneksi, $query);
$no = 1;
$jum = mysqli_num_rows($hasil);

if ($jum > 0) {
    while ($data = mysqli_fetch_assoc($hasil)) {
        $image = $data["gambar"];
?>
        <div class="col-lg-3 col-md-6">
            <div class="review-item">
                <div class="review-cover set-bg" data-setbg="file/<?php echo $image; ?>">
                    <img src="file/<?php echo $image; ?>" title="<?php echo $image; ?>">
                    <div class="score yellow"><?php echo $data['kategori']; ?></div>
                </div>
                <div class="review-text">
                    <h5><?php echo $data['nama']; ?></h5>
                    <p><?php echo $data['deskripsi_diri']; ?>.</p>
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
	<!-- Review section end -->


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
        // Batasi deskripsi hanya menampilkan sejumlah karakter tertentu
        $deskripsi = $data['deskripsi'];
        $max_length = 100; // Ganti dengan jumlah karakter maksimum yang ingin Anda tampilkan
        $deskripsi = (strlen($deskripsi) > $max_length) ? substr($deskripsi, 0, $max_length) . '...' : $deskripsi;
        ?>
        <div class="latest-blog">
            <div class="lb-item">
                <div class="lb-thumb set-bg" data-setbg="file/<?php echo $data['gambar']; ?>"></div>
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
  <script>
// Panggil fungsi saat dokumen dimuat
window.addEventListener('load', setEqualHeight);

// Mengatur deskripsi menjadi hanya sebagian
function setPartialDescription() {
  const elements = document.querySelectorAll('.lb-content p');
  elements.forEach(element => {
    const text = element.textContent;
    const maxLength = 100; // Jumlah maksimum karakter deskripsi yang ditampilkan
    if (text.length > maxLength) {
      const partialText = text.slice(0, maxLength) + '...';
      element.textContent = partialText;
    }
  });
}

setPartialDescription();
</script>
	<!-- Footer top section end -->

	
	<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<ul class="footer-menu">
				<li><a href="user.php">Home</a></li>
				<li><a href="isi_koin.php">Isi Koin</a></li>
				<li><a href="pesan.php">Pesan</a></li>
				<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Riwayat
          </a>
          <ul class="dropdown-menu" style="height: 100px; width: 200px;">
            <li><a class="dropdown-item text-dark" href="riwayat_isi_koin.php" style="width: 70%;">Riwayat Isi Koin</a></li>
            <li><a class="dropdown-item text-dark" href="riwayat_joki.php" style="width: 70%;">Riwayat Joki</a></li>
						<li><a class="dropdown-item text-dark" href="riwayat_mabar.php" style="width: 70%;">Riwayat Mabar</a></li>
          </ul>
        </li>
				<li><a href="contact.php">Contact</a></li>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    var totalBayarElem = document.getElementById("total");
    var priceElem = document.getElementById("price");
    var couponData; // Simpan data kupon di sini

    $('#activate').on('click', function(){
        var coupon = $('#coupon').val();
        var price = parseFloat($('#price').val()); // Ambil nilai harga sebagai float
        
        if(coupon === ""){
            alert("Please enter a coupon code!");
        } else {
            $.post('get_discount.php', {coupon: coupon, price: price}, function(data){
                try {
                    var jsonData = JSON.parse(data);
                    if (jsonData.hasOwnProperty('error')) {
                        alert(jsonData.error);
                        resetTotal(price);
                        $('#result').html('');
                    } else {
                        couponData = jsonData;
                        $('#result').html("<h4 class='pull-right text-danger'>"+couponData.discount+"% Off</h4>");
                        updateTotal(price);
                    }
                } catch (error) {
                    alert("Invalid response from server");
                    resetTotal(price);
                    $('#result').html('');
                }
            });
        }
    });

    $('input[name="gender"]').on('change', function(){
        updateTotal(parseFloat($('#price').val())); // Ambil nilai harga sebagai float
    });

    function updateTotal(currentPrice) {
        var totalBayar = 0;
        $('input[name="gender"]:checked').each(function(){
            totalBayar += parseFloat(this.value);
        });

        var discount = 0;
        if (couponData) {
            discount = (couponData.discount / 100) * totalBayar;
        }

        totalBayar -= discount;
        totalBayarElem.textContent = "Rp. " + totalBayar; // Menampilkan dua desimal
        priceElem.value = totalBayar; // Set nilai pada elemen #price
    }

    function resetTotal(price) {
        totalBayarElem.textContent = "Rp. " + price; // Menampilkan dua desimal
        priceElem.value = price; // Set nilai pada elemen #price
    }
});
</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
    </body>
</html>