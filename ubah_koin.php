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
          <ul class="dropdown-menu" style="height: 108px; width: 200px;">
            <li><a class="dropdown-item text-dark" href="riwayat_isi_koin.php" style="width: 70%;">Riwayat Isi Koin</a></li>
            <li><a class="dropdown-item text-dark" href="riwayat_transaksi.php" style="width: 70%;">Riwayat Transaksi</a></li>
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
										<label for="jenis" style="color: #fff;">Role :</label><br>
										<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="jenis[]" value="Joki">
												<label class="form-check-label" style="color: #fff;">Joki</label>
										</div>
										<div class="form-check form-check-inline">
												<input type="checkbox" class="form-check-input" name="jenis[]" value="Mabar">
												<label class="form-check-label" style="color: #fff;">Mabar</label>
										</div>
								</div>

					<div class="form-group">
										<label for="deskripsi" style="color: #fff;">Deskripsi Diri</label>
										<textarea class="form-control" name="deskripsi" cols="50" rows="5" style="width: 200%;"></textarea>
								</div>

								<div class="input-box2">
							<input name="number" id="harga" type="text" placeholder="Harga" required>
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
						<input type="text" placeholder="username akun" required class="name" name="nama">
						<i class="fa fa-user icon"></i>
					</div>
				</div>
		<div class="input_group">
				<div class="input_box">
					<h4>Nominal Koin</h4>
					<input type="radio" required id="b1" name="gender" class="radio" value="5000">
					<label for="b1">5.000</label>
					<input type="radio" id="b2" name="gender" class="radio" value="10000">
					<label for="b2">10.000</label>
					<input type="radio" id="b3" name="gender" class="radio" value="20000">
					<label for="b3">20.000</label>
					<input type="radio" id="b4" name="gender" class="radio" value="50000">
					<label for="b4">50.000</label>
					<input type="radio" id="b5" name="gender" class="radio" value="100000">
					<label for="b5">100.000</label>
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
                                <label for="gambar">Bukti Transfer:</label>
                                <input type="file" name="gambar" id="gambar" required>
                            </div>
		<div class="input_group">
			<div class="input_box">
				<p>Total Bayar: <span id="total"></span></p>
				<script>
							var koin1 = document.getElementById("b1");
							var koin2 = document.getElementById("b2");
							var koin3 = document.getElementById("b3");
							var koin4 = document.getElementById("b4");
							var koin5 = document.getElementById("b5");

							var totalBayarElem = document.getElementById("total");

							koin1.addEventListener("change", updateTotal);
							koin2.addEventListener("change", updateTotal);
							koin3.addEventListener("change", updateTotal);
							koin4.addEventListener("change", updateTotal);
							koin5.addEventListener("change", updateTotal);

							function updateTotal() {
								var totalBayar = 0;
								if (koin1.checked) {
									totalBayar += parseFloat(koin1.value) + 1000
								}
								if (koin2.checked) {
									totalBayar += parseFloat(koin2.value) + 900
								}
								if (koin3.checked) {
									totalBayar += parseFloat(koin3.value) + 800
								}
								if (koin4.checked) {
									totalBayar += parseFloat(koin4.value) + 700
								}
								if (koin5.checked) {
									totalBayar += parseFloat(koin5.value) + 600
								}

								totalBayarElem.textContent = "Rp " + totalBayar;
							}

							document.getElementById("total").textContent = "Rp " + totalBayar1;
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
				<h2>Pemain Kami</h2>
			</div>
			<div class="row text-white">
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/1.jpg">
							<div class="score yellow">9.3</div>
						</div>
						<div class="review-text">
							<h5>Assasin’’s Creed</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/2.jpg">
							<div class="score purple">9.5</div>
						</div>
						<div class="review-text">
							<h5>Doom</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/3.jpg">
							<div class="score green">9.1</div>
						</div>
						<div class="review-text">
							<h5>Overwatch</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="review-item">
						<div class="review-cover set-bg" data-setbg="img/review/4.jpg">
							<div class="score pink">9.7</div>
						</div>
						<div class="review-text">
							<h5>GTA</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
						</div>
					</div>
				</div>
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
							<a class="sidebar-brand-text mx-3" href="index.html">
								<strong>JOCKEY</strong>
							</a>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="footer-widget mb-5 mb-md-0">
						<h4 class="fw-title">Rekomendasi Game</h4>
						<div class="latest-blog">
							<div class="lb-item">
								<div class="lb-thumb set-bg" data-setbg="img/latest-blog/1.jpg"></div>
								<div class="lb-content">
									<div class="lb-date">June 21, 2018</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum </p>
									<a href="#" class="lb-author">By Admin</a>
								</div>
							</div>
							<div class="lb-item">
								<div class="lb-thumb set-bg" data-setbg="img/latest-blog/2.jpg"></div>
								<div class="lb-content">
									<div class="lb-date">June 21, 2018</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum </p>
									<a href="#" class="lb-author">By Admin</a>
								</div>
							</div>
							<div class="lb-item">
								<div class="lb-thumb set-bg" data-setbg="img/latest-blog/3.jpg"></div>
								<div class="lb-content">
									<div class="lb-date">June 21, 2018</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum </p>
									<a href="#" class="lb-author">By Admin</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="footer-widget">
						<h4 class="fw-title">Player Populer</h4>
						<div class="top-comment">
							<div class="tc-item">
								<div class="tc-thumb set-bg" data-setbg="img/authors/1.jpg"></div>
								<div class="tc-content">
									<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
									<div class="tc-date">June 21, 2018</div>
								</div>
							</div>
							<div class="tc-item">
								<div class="tc-thumb set-bg" data-setbg="img/authors/2.jpg"></div>
								<div class="tc-content">
									<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
									<div class="tc-date">June 21, 2018</div>
								</div>
							</div>
							<div class="tc-item">
								<div class="tc-thumb set-bg" data-setbg="img/authors/3.jpg"></div>
								<div class="tc-content">
									<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
									<div class="tc-date">June 21, 2018</div>
								</div>
							</div>
							<div class="tc-item">
								<div class="tc-thumb set-bg" data-setbg="img/authors/4.jpg"></div>
								<div class="tc-content">
									<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
									<div class="tc-date">June 21, 2018</div>
								</div>
							</div>
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
				<li><a href="user.html">Home</a></li>
				<li><a href="review.html">Isi Koin</a></li>
				<li><a href="categories.html">Pesan</a></li>
				<li><a href="community.html">Riwayat</a></li>
				<li><a href="contact.html">Contact</a></li>
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
    </body>
</html>