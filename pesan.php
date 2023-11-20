<?php
session_start();

if (isset($_SESSION['level']) && isset($_SESSION['nama'])) {
    if ($_SESSION['level'] == "user") {
        // Logika untuk pengguna
    } elseif ($_SESSION['level'] == 'admin') {
        header('location: admin.php');
    } elseif ($_SESSION['level'] == 'super') {
        header('location: super_admin.php');
    }
} else {
    header('location: index.php');
}

function getNotifications($nama_pemesan) {
    if (isset($_SESSION['notif'][$nama_pemesan])) {
        return $_SESSION['notif'][$nama_pemesan];
    }
    return array();
}

$nama_pemesan = $_SESSION['nama'];

// Tampilkan notifikasi kepada pengguna
$notifications = getNotifications($nama_pemesan);
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
										<textarea class="form-control" name="deskripsi" cols="50" rows="5" style="width: 200%;"></textarea>
								</div>

								<div class="input_group">
				<div class="input_box">
					<h5 style="color: #fff;">Harga</h5>
					<input type="radio" required id="b1" name="harga" class="radio" value="5000">
					<label for="b1">5.000</label>
					<input type="radio" id="b2" name="harga" class="radio" value="10000">
					<label for="b2">10.000</label>
					<input type="radio" id="b3" name="harga" class="radio" value="20000">
					<label for="b3" style="position: absolute;">20.000</label>
					<input type="radio" id="b4" name="harga" class="radio" value="50000">
					<label for="b4" style="position: absolute; right: -100%;">50.000</label>
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


	<!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="img/page-top-bg/1.jpg">
		<div class="pi-content">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-lg-6 text-white">
						<h2>Galeri Game</h2>
						<p>Pilihlah dan Nikmati Gamenya berjalan karena hidup juga perlu WS.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page info section -->


	<!-- Page section -->
	<section class="page-section recent-game-page spad">
		<div class="container">
			<div class="row">
											<?php 
include "koneksi.php";

// Inisialisasi variabel pencarian
$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Query untuk mencari game berdasarkan kata kunci pencarian
    $query = "SELECT * FROM tb_game WHERE game LIKE '%$search%' OR deskripsi LIKE '%$search%'";
} else {
    // Query untuk menampilkan semua game jika tidak ada kata kunci pencarian
    $query = "SELECT * FROM tb_game";
}

$hasil = mysqli_query($koneksi, $query);
$no = 1;
$jum = mysqli_num_rows($hasil);

// Batasi jumlah data yang akan ditampilkan per halaman
$items_per_page = 10;

// Hitung jumlah halaman yang dibutuhkan
$total_pages = ceil($jum / $items_per_page);

// Tentukan halaman saat ini
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Hitung offset untuk mengambil data dari halaman yang benar
$offset = ($current_page - 1) * $items_per_page;

// Sesuaikan kueri untuk mengambil data sesuai halaman saat ini
$query .= " LIMIT $offset, $items_per_page";

$hasil = mysqli_query($koneksi, $query);

?>

<div class="col-lg-8 col-md-5 recent-game mt-3">
    <div class="row">
        <?php
        if ($jum > 0) {
            while ($data = mysqli_fetch_assoc($hasil)) {
        ?>
						<div class="col-md-6">
							<div class="recent-game-item">
								<div class="baru">
									<div class="image">
										<div class="rgi-thumb set-bg" data-setbg="file/<?php echo $data['gambar'] ; ?>">
											<div class="baru2">
											<div class="cata new"><a href="joki.php?game=<?php echo $data['game']; ?>">JOKI</a></div>
											<div class="cata new mt-2"><a href="mabar.php?game=<?php echo $data['game']; ?>">MABAR</a></div>
											</div>
									</div>
									</div>
								</div>
								<div class="rgi-content">
									<h5><?php echo $data['game']; ?></h5>
									<p><?php echo $data['deskripsi']; ?></p>
								</div>
							</div>	
						</div>
						<?php
            }
        } else {
            // Tampilkan pesan jika tidak ada hasil pencarian
            echo "<p>Tidak ada hasil pencarian.</p>";
        }
        ?>
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

					</div>
					<div class="site-pagination">
        <?php
        // Tampilkan navigasi halaman jika diperlukan
        for ($page = 1; $page <= $total_pages; $page++) {
            if ($page == $current_page) {
                echo "<span class='active'>$page.</span>";
            } else {
                // Tambahkan link ke halaman lain di sini
                echo "<a href='pesan.php?page=$page'>$page.</a>";
            }
        }
        ?>
    </div>
					</div>
				<!-- sidebar -->
				<div class="col-lg-4 col-md-7 sidebar pt-5 pt-lg-0">
					<!-- widget -->
					<div class="widget-item">
        <form class="search-widget" action="pesan.php" method="get">
            <input type="text" name="search" placeholder="Search" value="<?php echo $search; ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
					<!-- widget -->
					<div class="widget-item">
						<h4 class="widget-title">Game Rekomendasi</h4>
						<?php
include "koneksi.php"; // Sesuaikan dengan file koneksi Anda

// Query untuk mengambil 3 game dengan jumlah data terbanyak
$query1 = "SELECT nama_game, COUNT(*) as jumlah
          FROM (
              SELECT nama_game FROM transaksi_mabar
              UNION ALL
              SELECT nama_game FROM transaksi_joki
          ) combined_data
          GROUP BY nama_game
          ORDER BY jumlah DESC
          LIMIT 3";

$result1 = mysqli_query($koneksi, $query1);

// Loop untuk mengambil game-game tersebut
while ($row1 = mysqli_fetch_assoc($result1)) {
    $game = $row1['nama_game'];
    // Query untuk mengambil data game
    $query2 = "SELECT * FROM tb_game WHERE game = '$game'";
    $result2 = mysqli_query($koneksi, $query2);

    // Menghitung jumlah data game
    $query3 = "SELECT COUNT(*) as jumlah FROM transaksi_mabar WHERE nama_game = '$game' UNION ALL SELECT COUNT(*) as jumlah FROM transaksi_joki WHERE nama_game = '$game'";
    $result3 = mysqli_query($koneksi, $query3);
    $total_data = 0;
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $total_data += $row3['jumlah'];
    }

    if (mysqli_num_rows($result2) > 0) {
        $data2 = mysqli_fetch_assoc($result2);
        ?>
        <div class="latest-blog">
            <div class="lb-item">
                <div class="lb-thumb set-bg" data-setbg="file/<?php echo $data2['gambar'] ; ?>"></div>
                <div class="lb-content">
                    <div class="lb-date"><?php echo $data2['game']; ?></div>
                    <p><?php echo $data2['deskripsi']; ?></p>
                    <p class="lb-author"><?php echo $total_data; ?> Transaksi</p>
                </div>
            </div>
        </div>
        <?php
    }
}
?>


					</div>
					<!-- widget -->
					<div class="widget-item">
						<h4 class="widget-title">New Player</h4>
						<?php 
         include "koneksi.php";
         $query = "SELECT * FROM tb_akun ORDER BY level='admin' DESC LIMIT 3";
         $hasil = mysqli_query($koneksi, $query);
				 $no = 1;
				 $jum = mysqli_num_rows($hasil);
				 if ($jum > 0) {
					while ($data = mysqli_fetch_assoc($hasil)) {
						$image = $data["gambar"];
			?>
						<div class="top-comment">
							<div class="tc-item">
								<div class="tc-thumb"><img src="file/<?php echo $image; ?>" title="<?php echo $image; ?>"></div>
								<div class="tc-content">
									<p><a href="#"><?php echo $data['nama']; ?></a><span> <?php echo $data['jenis']; ?></span><br> <?php echo $data['deskripsi_diri']; ?></p>
									<div class="tc-date"><?php echo $data['game']; ?></div>
								</div>
							</div>
						</div>
						<?php
					}
				}
						?>
					</div>

					<!-- widget -->
					<div class="widget-item">
						<?php
					$query1 = "SELECT nama_game, COUNT(*) as jumlah
          FROM (
              SELECT nama_game FROM transaksi_mabar
              UNION ALL
              SELECT nama_game FROM transaksi_joki
          ) combined_data
          GROUP BY nama_game
          ORDER BY jumlah DESC
          LIMIT 1";

$result1 = mysqli_query($koneksi, $query1);

// Loop untuk mengambil game-game tersebut
while ($row1 = mysqli_fetch_assoc($result1)) {
    $game = $row1['nama_game'];
    // Query untuk mengambil data game
    $query2 = "SELECT * FROM tb_game WHERE game = '$game'";
    $result2 = mysqli_query($koneksi, $query2);

    // Menghitung jumlah data game
    $query3 = "SELECT COUNT(*) as jumlah FROM transaksi_mabar WHERE nama_game = '$game' UNION ALL SELECT COUNT(*) as jumlah FROM transaksi_joki WHERE nama_game = '$game'";
    $result3 = mysqli_query($koneksi, $query3);
    $total_data = 0;
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $total_data += $row3['jumlah'];
    }

    if (mysqli_num_rows($result2) > 0) {
        $data2 = mysqli_fetch_assoc($result2);
        ?>
						<div class="review-item">
							<div class="review-cover set-bg" data-setbg="file/<?php echo $data2['gambar']; ?>">
							</div>
							<div class="review-text">
								<h5><?php echo $data2['game']; ?></h5>
								<p><?php echo $data2['deskripsi']; ?>.</p>
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
	</section>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
    </body>
</html>