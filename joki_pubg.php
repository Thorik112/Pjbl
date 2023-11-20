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
          <input name="username" id="username" type="text" placeholder="Username" value="<?php echo $data['nama']; ?>" readonly>
        </div>

        <div class="input-box2">
          <input name="op" id="pass1" text-align="center" type="password" placeholder="Password Lama" required>
        </div>

        <div class="input-box2">
          <input name="np" id="pass2" type="password" placeholder="Password Baru" required>
        </div>

				<div class="input-box2">
          <input name="c_np" id="pass1" text-align="center" type="password" placeholder="Konfirmasi Password Baru" required>
        </div>

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
	<section class="page-section spad contact-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 mb-5 mb-lg-0">
					<h4 class="comment-title">Joki PUBG</h4>
					<p>Lengkapi data ini maka kami akan segera memproses pesanan anda. Apa bila pesanan tidak ditanggapi dalam waktu 1 menit maka koin akan segera dikembalikan. Kami akan menjaga keamanan akun seluruh pelanggan kami.</p>
					<div class="row">
						<div class="col-md-9">
							<ul class="contact-info-list">
								<li><div class="cf-left">Alamat</div><div class="cf-right">Jl. Tirto Rahayu No.72 Landungsari Kec.Dau Kab.Malang</div></li>
								<li><div class="cf-left">Phone</div><div class="cf-right">+62 857 3828 8914</div></li>
								<li><div class="cf-left">E-mail</div><div class="cf-right">mochthoriqul12@gmail.com</div></li>
							</ul>
						</div>
					</div>
					<div class="social-links">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-whatsapp"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-youtube"></i></a>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="contact-form-warp">
						<h4 class="comment-title">Lengkapi Data Dibawah Ini</h4>
						<form class="comment-form" action="" method="post">
						<h6>Harga/100 point</h6>
						<p>Platinum 25000 | Diamond 35000 | Crown 40000 | Ace 60000 | Ace Master 75000 | Ace Dominator 90000 <p>
							<div class="row">
								<div class="col-md-12">
									<input type="text" placeholder="Username Game" required name="username_game">
								</div>
								<div class="col-md-6">
									<input type="text" placeholder="Akun Play Game" required name="akun">
								</div>
								<div class="col-md-6">
									<input type="password" placeholder="Password Game" required name="pass">
								</div>
								<div class="input_group">
											<div class="input_box">
												<h6>Rank</h6>
												<input type="radio" id="b1" name="rank" class="radio" value="platinum" required>
												<label for="b1">Platinum</label> 
												<input type="radio" id="b8" name="rank" class="radio" value="diamond">
												<label for="b8">Diamond</label>
												<input type="radio" id="b9" name="rank" class="radio" value="crown">
												<label for="b9">Crown</label>
												<input type="radio" id="b10" name="rank" class="radio" value="ace">
												<label for="b10">Ace</label>
												<input type="radio" id="b11" name="rank" class="radio" value="ace_master">
												<label for="b11">Ace Master</label>
												<input type="radio" id="b6" name="rank" class="radio" value="ace_dominator">
												<label for="b6">Ace Dominator</label>
											</div>
								</div>
									<div class="col-lg-12">
										<input type="number" placeholder="Berapa" id="bintang" required name="bintang">
								</div>
								<div class="col-lg-12">
									<textarea placeholder="Pesan" name="pesan"></textarea>
									<div class="input_group">
			<div class="input_box">
				<h6>Total Bayar : </h6>
				<input type="number" id="total2" readonly name="total2" placeholder="Total Bayar">
				<script>
										var game1 = document.getElementById("b1");
										var game2 = document.getElementById("b8");
										var game3 = document.getElementById("b9");
										var game4 = document.getElementById("b10");
										var game5 = document.getElementById("b11");
										var game6 = document.getElementById("b6");

										var totalBayarElem = document.getElementById("total");
										var bintang = document.getElementById("bintang");
										var harga = document.getElementById("total2");

										game1.addEventListener("change", updateTotal);
										game2.addEventListener("change", updateTotal);
										game3.addEventListener("change", updateTotal);
										game4.addEventListener("change", updateTotal);
										game5.addEventListener("change", updateTotal);
										game6.addEventListener("change", updateTotal);

										bintang.addEventListener("input", function() {
											var nilai = parseFloat(bintang.value);

											// Menampilkan nilai di elemen output
											totalBayarElem.textContent = "Rp " + updateTotal();
										});

										function updateTotal() {
											var totalBayar = 0;
											if (game1.checked) {
												totalBayar += 25000 * parseFloat(bintang.value);
											}
											if (game2.checked) {
												totalBayar += 35000 * parseFloat(bintang.value);
											}
											if (game3.checked) {
												totalBayar += 40000 * parseFloat(bintang.value);
											}
											if (game4.checked) {
												totalBayar += 60000 * parseFloat(bintang.value);
											}
											if (game5.checked) {
												totalBayar += 75000 * parseFloat(bintang.value);
											}
											if (game6.checked) {
												totalBayar += 90000 * parseFloat(bintang.value);
											}

											harga.value = totalBayar;
											return totalBayar;
										}
										var totalBayarText = totalBayarElem.textContent; // Mengambil teks dari totalBayarElem
										var totalBayar = parseFloat(totalBayarText.replace("Rp ", "")); // Mengambil nilai numerik dari teks

										// Mengirim data ke PHP menggunakan AJAX
										$.ajax({
											type: "POST",
											// Gantilah "proses.php" dengan URL PHP Anda
											url: "joki_ff.php",
											data: { totalBayar: totalBayar },
											success: function(response) {
												console.log('Data yang diterima dari PHP: ' + response);
											}
										});
																	</script>
													</div>
												</div>
									<input type="submit" name="submit" value="Pesan Sekarang" class="site-btn btn-sm">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
include "koneksi.php";
@session_start();
@$username = $_SESSION['nama'];
@$game = "mlbb";
@$penjoki = $_GET['penjoki'];
@$hasil = "menunggu";
@$tanggal = date("Y-m-d H:i:s");
@$akun = $_POST['akun'];
@$username_game = $_POST['username_game'];
@$pass = $_POST['pass'];
@$pengacak = "p3ng4c4k";
@$passmd = md5($pengacak . md5($pass));
@$rank = $_POST['rank'];
@$jumlah = $_POST['bintang'];
@$totalBayar = $_POST['total2'];
@$pesan = $_POST['pesan'];
@$kirim = $_POST['submit'];

function addNotification2($penjoki, $message) {
    if (!isset($_SESSION['notif2'][$penjoki])) {
        $_SESSION['notif2'][$penjoki] = array();
    }
    $_SESSION['notif2'][$penjoki][] = $message;
}

// Fungsi untuk menyetujui transaksi dan mengirim notifikasi
function transaksiBaru($penjoki) {
    // Logika untuk menyetujui transaksi
    // Anda juga bisa menambahkan notifikasi ke pengguna
    $adminMessage = "Ada Pesanan joki baru yang dipesan oleh.";
    addNotification2($penjoki, $adminMessage);
}

if ($kirim) {
    // Periksa jumlah koin pengguna
    $queryKoin = mysqli_query($koneksi, "SELECT koin FROM tb_akun WHERE nama = '$username'");
    $dataKoin = mysqli_fetch_assoc($queryKoin);
    $koinPengguna = $dataKoin['koin'];

    if ($koinPengguna >= $totalBayar) {
        // Jika jumlah koin mencukupi, proses transaksi
        $query = "INSERT INTO transaksi_joki (nama_game, nama_pemesan, nama_penjoki, rank, jumlah_pemesanan, harga, pesan, username_game, password_game, hasil, akun, waktu_pemesanan) VALUES ('$game','$username','$penjoki','$rank','$jumlah','$totalBayar','$pesan','$username_game','$passmd','$hasil','$akun','$tanggal')";

        if ($koneksi->query($query) === TRUE) {
            // Kurangi koin pengguna
            $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin - $totalBayar WHERE nama = '$username'");
            transaksiBaru($penjoki);
            echo "<script>window.alert('Pesanan joki telah terkirim tunggu tanggapan penjoki di riwayat transaksi joki')
            window.location='pesan.php'</script>";
        } else {
            echo "<script>window.alert('Pesanana joki gagal terkirim')
            window.location='pesan.php'</script>";
        }
    } else {
        // Jika jumlah koin tidak mencukupi
        echo "<script>window.alert('Koin Anda tidak mencukupi untuk transaksi ini.')
        window.location='pesan.php'</script>";
    }
}
?>

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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
    </body>
</html>