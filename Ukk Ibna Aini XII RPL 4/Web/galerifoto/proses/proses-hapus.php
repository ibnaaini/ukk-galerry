<?php

include 'koneksi.php';

if(isset($_GET['idk'])){
	$delete = mysqli_query($conn, "DELETE FROM album WHERE albumid = '".$_GET['idk']."' ");
	echo '<script>window.location="../album.php"</script>';
}

if(isset($_GET['idp'])){
	$foto = mysqli_query($conn, "SELECT lokasifile FROM foto WHERE fotoid = '".$_GET['idp']."' ");
	$p = mysqli_fetch_object($foto);

	unlink('../foto/'.$p->lokasifile);

	$delete = mysqli_query($conn, "DELETE FROM foto WHERE fotoid = '".$_GET['idp']."' ");
	echo '<script>window.location="../foto.php"</script>';
}

?>