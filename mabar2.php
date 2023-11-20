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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "kirimemail/library/PHPMailer.php";
require_once "kirimemail/library/Exception.php";
require_once "kirimemail/library/OAuth.php";
require_once "kirimemail/library/POP3.php";
require_once "kirimemail/library/SMTP.php";
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
		<div class="ln-title">Latest News</div>
		<div class="news-ticker">
			<div class="news-ticker-contant">
				<div class="nt-item"><span class="new">new</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
				<div class="nt-item"><span class="strategy">strategy</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
				<div class="nt-item"><span class="racing">racing</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
			</div>
		</div>
	</div>
	<!-- Latest news section end -->

	<!-- Page section -->
	<section class="page-section spad contact-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 mb-5 mb-lg-0">
					<h4 class="comment-title">Mabar</h4>
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
						<form class="comment-form" method="post" action="">
							<div class="row">
								<div class="col-md-12">
									<input type="text" placeholder="Username Game" class="username_game" name="username_game">
								</div>
								<div class="col-lg-12">
									<textarea placeholder="Pesan" class="pesan" name="pesan"></textarea>
									<div class="form-group">
				<h4 class="text-warning">*Optional</h4>
				<label>Coupon Code</label>
				<input class="form-control" type="text" id="coupon" style="width: 100%;" name="promo_code"/>
				<input type="text" class="harga" name="price" id="price" value="<?php echo $_GET['harga'] ?>"readonly>
				<div id="result"></div>
				<button class="btn btn-primary" id="activate">Activate Code</button>
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
@$game = $_GET['game'];
@$pemain = $_GET['pemain'];
@$hasil = "menunggu";
@$tanggal = date("Y-m-d H:i:s");
@$harga = $_GET['harga'];
@$username_game = $_POST['username_game'];
@$pesan = $_POST['pesan'];
@$kirim = $_POST['submit'];

function addNotification2($pemain, $message) {
    if (!isset($_SESSION['notif2'][$pemain])) {
        $_SESSION['notif2'][$pemain] = array();
    }
    $_SESSION['notif2'][$pemain][] = $message;
}

// Fungsi untuk mengirim notifikasi
// function transaksiBaru($pemain) {
//     // Anda bisa menambahkan notifikasi ke pengguna atau penjual
//     $message = "Ada pesanan baru untuk permainan $game";
// 		addNotification2($pemain, $message);
// }

	if ($kirim) {
		$promoCheckQuery = "SELECT * FROM tb_promo_usage WHERE coupon_code = '$promoCode' AND user_id = '$username'";
					$promoResult = $koneksi->query($promoCheckQuery);
	
					if ($promoResult->num_rows == 0) {
						$insertPromoQuery = "INSERT INTO tb_promo_usage (coupon_code, user_id) VALUES ('$promoCode', '$user_id')";
            $koneksi->query($insertPromoQuery);
    // Periksa jumlah koin pengguna
    $queryKoin = mysqli_query($koneksi, "SELECT koin FROM tb_akun WHERE nama = '$username'");
    $dataKoin = mysqli_fetch_assoc($queryKoin);
    $koinPengguna = $dataKoin['koin'];

    if ($koinPengguna >= $harga) {
        // Jika jumlah koin mencukupi, proses transaksi
				$query = "INSERT INTO transaksi_mabar (nama_game, nama_pemain, nama_pemesan, username_game, harga, pesan, hasil, waktu_pemesanan) VALUES ('$game','$pemain','$username','$username_game','$harga','$pesan','$hasil','$tanggal')";
    if ($koneksi->query($query) === TRUE) {
			$mail = new PHPMailer;
 
			//Enable SMTP debugging. 
			$mail->SMTPDebug = 3;                               
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();            
			//Set SMTP host name                          
			$mail->Host = "tls://smtp.gmail.com"; //host mail server
			//Set this to true if SMTP host requires authentication to send email
			$mail->SMTPAuth = true;                          
			//Provide username and password     
			$mail->Username = "mochthoriqul12@gmail.com";   //nama-email smtp          
			$mail->Password = "plwaodbrzzozaktz";           //password email smtp
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";                           
			//Set TCP port to connect to 
			$mail->Port = 587;                                   
		 
			$mail->From = "mochthoriqul12@gmail.com"; //email pengirim
			$mail->FromName = "Notifikasi Jockey"; //nama pengirim
		 
			 $mail->addAddress($_GET['email'], $_GET['penjoki']); //email penerima
		 
			$mail->isHTML(true);
		 
			$mail->Subject= "Ada Pesanan Mabar"; //subject
				$mail->Body    = "Tanggal Pemesanan $tanggal Harga $harga penerima $pemain"; //isi email
						$mail->AltBody = "PHP mailer"; //body email (optional)
		 
			if(!$mail->send()) 
			{
					echo "Mailer Error: " . $mail->ErrorInfo;
					echo $_GET['email'];
			} 
			else 
			{
        $query = mysqli_query($koneksi, "UPDATE tb_akun SET koin = koin - $harga WHERE nama = '$username'");
        echo "<script>window.alert('Pesanan Mabar terkirim tunggu balasan dari admin')
        window.location='pesan.php'</script>";
			}
    } else {
        echo "<script>window.alert('Data gagal tersimpan')
        window.location='pesan.php'</script>";
    }
	} else {
		// Jika jumlah koin tidak mencukupi
		echo "<script>window.alert('Koin Anda tidak mencukupi untuk transaksi ini.');
		window.location='pesan.php';</script>";
}
} else {
	echo "<script>alert('Kode promo sudah digunakan oleh Anda sebelumnya.');
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
				<li><a href="categories.html"></a>Pesan</li>
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#activate').on('click', function(event){
            event.preventDefault(); // Menghentikan default behavior dari tombol

            var coupon = $('#coupon').val();
            var price = $('#price').val();
            if(coupon == ""){
                alert("Please enter a coupon code!");
            } else {
                $.post('get_discount.php', {coupon: coupon, price: price}, function(data){
                    if(data == "error"){
                        alert("Invalid Coupon Code!");
                        $('#price').val(price); // Update total jika kupon tidak valid
                        $('#result').html('');
                    } else{
                        var json = JSON.parse(data);
                        $('#result').html("<h4 class='pull-right text-danger'>"+json.discount+"% Off</h4>");
                        $('#price').val(json.price); // Update total dengan diskon dari kupon
                    }
                });
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
    </body>
</html>