<?php
	ob_start();
	session_start();
	if (!isset($_SESSION['idUser']) || $_SESSION['idGroup'] != 1) {
		header('location:../index.php');
	}
	
	require "../lib/dbCon.php";
	require "../lib/quantri.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang quản trị</title>
<link rel="stylesheet" type="text/css" href="layout.css"/>
</head>

<body>
<table width="1000" align="center" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td id="tieude">TRANG QUẢN TRỊ
    	<div class="welcome">
    		<div>Xin chào: <?php echo $_SESSION['HoTen']; ?></div>
            <div>
            	<form method="POST" class="logout-form">
                    <input type="submit" value="  Thoát  " name="btnLogout">
                </form>
            </div>
            <?php
            	if (isset($_POST['btnLogout'])) {
					unset($_SESSION['idUser']);
					unset($_SESSION['HoTen']);
					unset($_SESSION['Username']);
					unset($_SESSION['idGroup']);	
					header('location:../index.php');
				}
			?>
        </div>
    </td>
  </tr>
  <tr>
    <td id="menu">
    	<?php require "menu.php"; ?>
    </td>
  </tr>
</table>

<table class="theloai" width="1000px" align="center" cellpadding="0" cellspacing="0" border="1">
	<tr>
    	<td colspan="5" class="header">QUẢN LÝ TIN TỨC</td>
    </tr>
	<tr>
    	<td class="title">ID</td>
        <td class="title">Tiêu Đề - Hình Ảnh - Tóm Tắt</td>
        <td class="title">Tên Thể Loại - Tên Loại Tin</td>
        <td class="title">Số Lần Xem - Tin Nổi Bật - Ẩn Hiện</td>
        <td><a href="themTin.php">Thêm</a></td>
    </tr>
    <?php
		$sotin_mottrang = 100;
		if (isset($_GET['trang'])) {
			$trang = $_GET['trang'];
			settype($trang, 'int');
		} else {
			$trang = 1;
		}
	
		$from = ($trang - 1)  * $sotin_mottrang;
    	$tin = LayDanhSachTin_PhanTrang($from, $sotin_mottrang);
		while ($row_tin = mysql_fetch_array($tin)) {
			ob_start();
	?>
    <tr>
    	<td>{idTin}</td>
        <td class="content">
        	<span>{TieuDe}</span><br/>
   	    	<img src="../upload/tintuc/{urlHinh}" width="150" height="100" style="float:left; margin-right:5px;" />
            {TomTat}
        </td>
        <td>{TenTL} <br/> {Ten}</td>
        <td>Số lần xem: {SoLanXem} <br/> Tin nổi bật: {TinNoiBat} <br/> Ẩn hiện: {AnHien}</td>
        <td>
       	  <a href="suaTin.php?idTin={idTin}">Sửa</a> - <a href="xoaTin.php?idTin={idTin}" onclick="return confirm('Bạn có chắc chắn muốn xóa hay không?');">Xóa</a>
        </td>
    </tr>
    <?php
		$s = ob_get_clean();
		$s = str_replace("{idTin}", $row_tin['idTin'], $s);
		$s = str_replace("{TieuDe}", $row_tin['TieuDe'], $s);
		$s = str_replace("{urlHinh}", $row_tin['urlHinh'], $s);
		$s = str_replace("{TomTat}", $row_tin['TomTat'], $s);
		$s = str_replace("{TenTL}", $row_tin['TenTL'], $s);
		$s = str_replace("{Ten}", $row_tin['Ten'], $s);
		$s = str_replace("{SoLanXem}", $row_tin['SoLanXem'], $s);
		$s = str_replace("{TinNoiBat}", $row_tin['TinNoiBat'], $s);
		$s = str_replace("{AnHien}", $row_tin['AnHien'], $s);
		echo $s;
		}
   	?>
    <tr>
    	<td colspan="5">
    	<div id="phantrang">
        	<?php
            	$t = LayDanhSachTin();
				$total = mysql_num_rows($t);
				$totalpage = ceil($total/$sotin_mottrang);

				for ($i = 1; $i <= $totalpage; $i++) {
					if ($i == $trang) {
				?>
                	<span class="active"><?php echo $i ?></span>
                <?php
					} else {
				?>         
					<a href = "listTinTuc.php?trang=<?php echo $i ?>"><?php echo $i ?></a>
			<?php
					}
                }
            ?>
        </div>
        </td>
    </tr>
</table>

</body>
</html>