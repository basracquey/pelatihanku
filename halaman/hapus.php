<?php 
require 'functions.php';
$id_pelatihan = $_GET["id_pelatihan"];
if(hapus($id_pelatihan)> 0){
	echo "
		<script>
		alert('data berhasil dihapus');
		document.location.href = '../index.php?page=tutorial';
		</script>
		";
	}else{
		echo "
		<script>
		alert('data gagal dihapus');
		document.location.href = '../index.php?page=tutorial';
		</script>
		";
	}
 ?>
