<?php
$conn = mysqli_connect("localhost", "root", "", "pelatihanonline");
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Website Title</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
    		<a href="dataCourse.php"><i class="fas fa-address-book"></i>Daftar Pelatihan</a>
            <a href="read.php"><i class="fas fa-address-book"></i>Daftar Wishlist</a>
            <a class="nav-link navbar-right" href="../index.php?page=logout">Logout</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>