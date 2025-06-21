<?php 
require 'functions.php';
 $id_pelatihan = $_GET["id_pelatihan"];

if(tambahwishlist($id_pelatihan)> 0){
	echo "
		<script>
		alert('data berhasil ditambahkan ke wishlist');
		document.location.href = '../index.php?page=tutorial';
		</script>
		";
	}else{

		echo "
		<script>
		alert('data gagal ditambahkan ke wishlist');
		document.location.href = '../index.php?page=tutorial';
		</script>
		";
	}
 ?>