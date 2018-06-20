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
	$idTL = $_GET['idTL'];
	settype($idTL, 'int');
	$row_theloai = LayTheLoaiTheoId($idTL);

	if(isset($_POST['btnSua'])) {
		$TenTL = $_POST['TenTL'];
		$TenTL_KhongDau = changeTitle($TenTL);
		$ThuTu = $_POST['ThuTu'];
		settype($ThuTu, 'int');
		$AnHien = $_POST['AnHien'];
		settype($AnHien, 'int');
		echo $query = "UPDATE theloai SET
			TenTL = '$TenTL',
			TenTL_KhongDau = '$TenTL_KhongDau',
			ThuTu = '$ThuTu',
			AnHien = '$AnHien'
			WHERE idTL = '$idTL'
		";
		mysql_query($query);
		header('location:listTheLoai.php');
	}
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

<form name="formSuaTL" method="POST" action="">
    <table class="theloai" width="1000px" align="center" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <td colspan="6" class="header">SỬA THỂ LOẠI</td>
        </tr>
        <tr>
            <td>Tên Thể Loại</td>
            <td>
                <input value="<?php echo $row_theloai['TenTL'] ?>" type="text" name="TenTL" />
            </td>
        </tr>
        <tr>
            <td>Thứ Tự</td>
            <td>
                <input value="<?php echo $row_theloai['ThuTu'] ?>" type="number" name="ThuTu" />
            </td>
        </tr>
        <tr>
            <td>Ẩn Hiện</td>
            <td>
                <label>
                  <input <?php if($row_theloai['AnHien'] == 1) echo 'checked="checked"' ?> type="radio" name="AnHien" value="1" id="an" />
                  Hiện</label>
                <label>
                  <input <?php if($row_theloai['AnHien'] == 0) echo 'checked="checked"' ?> type="radio" name="AnHien" value="0" id="hien" />
                  Ẩn</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button type="submit" name="btnSua">Sửa</button>
            </td>
        </tr>
    </table>
</form>

</body>
</html>