<?php
	ob_start();
	session_start();
	if (!isset($_SESSION['idUser']) || $_SESSION['idGroup'] != 1) {
		header('location:../index.php');
	}
	
	require "../lib/dbCon.php";
	require "../lib/quantri.php";
?>
<?php
	$idTin = $_GET['idTin'];
	$query = "
		DELETE FROM tin
		WHERE idTin = $idTin;
	";
	mysql_query($query);
	header('location:listTinTuc.php');
?>