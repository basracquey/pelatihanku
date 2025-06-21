<?php
session_start();
      //cek apakah user sudah login
if(isset($_SESSION["login"])){
	echo "
	<script>
	alert('anda sudah login,klik ok untuk kembali');
	document.location.href = 'index.php';
	</script>
	";
}

require 'functions.php'; 
if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

    // melakukan query sql untuk mengambil data user dan user level
	$query = "SELECT * FROM db_users WHERE username = '$username'";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);

        // erifikasi password
		if (password_verify($password, $row["password"])) {
            // menetapkan variabel sesi
			$_SESSION["user_id"] = $row["id"];
			$_SESSION["login"] = true;
			$_SESSION["username"] = $username;
            $_SESSION["user_level"] = $row["user_level"]; // Store the user's level

            if ($row["user_level"] === "admin") {
                // mengarahkan admin ke dashboard admin
            	header("Location:../halaman_admin/indexadmin.php");
            	exit;
            } else if ($row["user_level"] === "user") {
                // mengarahkan  user ke dashboard user
            	header("Location:index.php");
            	exit;
            }
        }
    }
    // Jika nama pengguna dan kata sandi tidak cocok atau pengguna tidak ada, maka akan error.
    $error = true;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link type="text/css" rel="stylesheet" href="../style.css"/>
	<style>
		p,h1{
			color : black;
		}
		body {
			background-color: #ebf9fb;
			padding: 0px;
			color: #f0edee;
		}
		form {
			background-color: white;
			padding: 20px;
			border-radius: 10px;
			margin-top: 0px;
			box-shadow: 0px 0px 0px 0px #000000;
		}
		.box{
			background: #2C666E;
			height: 200px;
			width: 300px;
			margin: 20px;
		}
		.kotak_login{
			width: 350px;
			background: white;
			/*meletakkan form ke tengah*/
			margin: 80px auto;
			padding: 30px 20px 10px 10px;
			box-shadow: 0px 0px 100px 4px #d6d6d6;
		}
		.tulisan_login{
			color : black;
			text-align: center;
			/*membuat semua huruf menjadi kapital*/
			text-transform: uppercase;
		}
		.form_login{
			/*membuat lebar form penuh*/
			background : white;
			box-sizing : border-box;
			width: 100%;
			padding: 10px;
			font-size: 11pt;
			margin-bottom: 20px;
		}
		.tombol_login{
			background: #2aa7e2;
			color: white;
			font-size: 11pt;
			width: 100%;
			border: none;
			border-radius: 3px;
			padding: 10px 20px;
		}
	</style>
</head>
<body>

	<center>
		<h1>Halaman Login</h1>
		<div class="kotak_login">
			<p class="tulisan_login">Silahkan login</p>
			<form action="" method="post">
				<ul>
					<label for="username"></label>
					<input type="text" name="username" id="username" class="form_login" placeholder="username" required>
					<br>
					<label for="password"></label>
					<input type="password" name="password" id="password" class="form_login" placeholder="password" required>
					<br>
					<?php 
					if(isset($error)): ?>
						<p style="color:red; font-style:italic;">username atau password salah!</p>
					<?php endif; ?>
					<br>
					<button type="submit" name="login" class="tombol_login">Login</button>
					<br>
					<p>belum punya akun?</p><a href="registrasi.php">registrasi</a>
				</ul>
			</form>
		</div>
	</div>
</div>
</center>	


</body>
</html>