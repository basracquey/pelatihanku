<?php 
      session_start();
      //cek apakah user sudah login
      if(isset($_SESSION["login"])){
      		echo "
		<script>
		alert('anda sudah login,klik ok untuk kembali');
		document.location.href = 'index.php?page=home';
		</script>
		";
      }
require 'functions.php';
if (isset($_POST["register"])) {
	if (registrasi($_POST)>0) {
		echo "<script>
		alert('user baru berhasil ditambahkan');
		</script>";
	} else{
		echo mysqli_error($conn);
	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="../style.css"/>
	<title>Halaman Registrasi</title>
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
.kotak_registrasi{
	width: 350px;
	background: white;
	/*meletakkan form ke tengah*/
	margin: 80px auto;
	padding: 30px 20px 10px 10px;
	box-shadow: 0px 0px 100px 4px #d6d6d6;
}
.tulisan_registrasi{
	color : black;
	text-align: center;
	/*membuat semua huruf menjadi kapital*/
	text-transform: uppercase;
}
.form_registrasi{
	/*membuat lebar form penuh*/
	background : white;
	box-sizing : border-box;
	width: 100%;
	padding: 10px;
	font-size: 11pt;
	margin-bottom: 20px;
}
.tombol_registrasi{
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
<h1>Halaman Registrasi</h1>
<div class="kotak_registrasi">
	<p class="tulisan_registrasi">Silahkan Registrasi</p>
<form action="" method="post">
	<ul>
			<label for="username"></label>
			<input type="text" name="username" id="username" class="form_registrasi" placeholder="username">
			<br>
			<label for="password"></label>
			<input type="password" name="password" id="password" class="form_registrasi" placeholder="password">
			<br>
			<label for="password2"></label>
			<input type="password" name="password2" id="password2" class="form_registrasi" placeholder="konfirmasi password">
			<br>
			<br>
			<button type="submit" class="tombol_registrasi" name="register">Registrasi</button>
			<p>sudah punya akun?</p><a href="login.php">login</a>
		
	</ul>
</form>
</div>
</center>
</body>
</html>