<?php
	require "../lib/dbCon.php";
	require "../lib/trangchu.php";
	
	$idTL = $_GET['idTL'];
	$loaitin = DanhSachLoaiTin_TheoTheLoai($idTL);
	while ($row_loaitin = mysql_fetch_array($loaitin)) {
?>
	<option value="<?php echo $row_loaitin['idLT'] ?>"><?php echo $row_loaitin['Ten'] ?></option>
<?php
	}
?>
