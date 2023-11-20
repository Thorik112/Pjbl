<?php
if (isset($_COOKIE['remember_me_cookie'])) {
    list($username, $password) = explode('|', base64_decode($_COOKIE['remember_me_cookie']));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background-color: #f5f5f5; padding: 20px; border-radius: 10px;">
    <h2 style="font-size: 24px; font-weight: bold; color: #333;">Mengubah Permainan Anda, Sesuai Aturan Anda!</h2>
    <p style="font-size: 16px; color: #555;">Di Jockey Game, kami memahami bahwa setiap pemain memiliki gaya dan tujuan permainan yang berbeda. Itulah mengapa kami menawarkan joki game berpengalaman yang siap membantu Anda mencapai apa pun yang Anda inginkan dalam permainan Anda.</p>
    <p style="font-size: 16px; color: #555;">Tentukan sendiri bagaimana Anda ingin bermain. Jadilah komandan dalam permainan favorit Anda. Kami menyediakan tim joki game yang dapat disesuaikan dengan preferensi dan kebutuhan Anda.</p>
    <a href="login.php" style="text-decoration: none; color: #0099cc; font-size: 16px; font-weight: bold;">Temukan Bagaimana</a>
</div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                    include "koneksi.php";
                                    $query = "SELECT * FROM tb_akun";
                                    $hasil = mysqli_query($koneksi, $query);
                                    $no = 1;
                                    $jum = mysqli_num_rows($hasil);
                                    if ($data = mysqli_fetch_array($hasil)) {
                                    ?>
                                    <form class="user" action="submit_login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control form-control-user" id="exampleName"
                                                placeholder="Enter Name..." value="<?php echo isset($username) ? $username : ''; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>" required>
                                            <input type="checkbox" id="showPassword" style="margin-left: 5px;"> Show Password
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="remember_me" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="Submit">Login</button>
                                    </form>
                                    <?php
                                    }
                                    ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // Tambahkan fungsi untuk menampilkan atau menyembunyikan kata sandi
        var passwordInput = document.getElementById("exampleInputPassword");
        var showPasswordCheckbox = document.getElementById("showPassword");

        showPasswordCheckbox.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>

</body>

</html>
