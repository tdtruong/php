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
	$idLT = $_GET['idLT'];
	settype($idLT, 'int');
	$query = "DELETE FROM loaitin WHERE idLT = $idLT";
	mysql_query($query);
	header('location:listLoaiTin.php');
?>