<?php 
session_start();
require 'functions.php';
$user_id = $_SESSION["user_id"];
$id_wishlist = $_GET["id_wishlist"];
if(hapuswishlist($id_wishlist,$user_id)> 0){
	echo "
		<script>
		alert('data berhasil dihapus');
		document.location.href = 'wishlist.php';
		</script>
		";
	}else{
		echo "
		<script>
		alert('data gagal dihapus');
		document.location.href = 'wishlist.php';
		</script>
		";
	}
 ?>
