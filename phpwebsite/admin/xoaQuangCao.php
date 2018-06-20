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
	$idQC = $_GET['idQC'];
	$query = "
		DELETE FROM quangcao
		WHERE idQC = $idQC
	";
	mysql_query($query);
	header('location:listQuangCao.php');
?>