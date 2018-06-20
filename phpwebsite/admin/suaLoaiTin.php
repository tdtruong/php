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
	$row_loaitin = LayLoaiTinTheoId($idLT);
	
	if (isset($_POST['btnSuaLT'])) {
		$Ten = $_POST['TenLT'];
		$Ten_KhongDau = changeTitle($Ten);
		$ThuTu = $_POST['ThuTu'];
		settype($ThuTu, 'int');
		$AnHien = $_POST['AnHien'];
		$idTL = $_POST['idTL'];
		settype($idTL, 'int');
		
		$query = "
			UPDATE loaitin SET
			Ten = '$Ten',
			Ten_KhongDau = '$Ten_KhongDau',
			ThuTu = '$ThuTu',
			AnHien = '$AnHien',
			idTL = '$idTL'
			WHERE idLT = '$idLT'
		";
		mysql_query($query);
		header('location:listLoaiTin.php');
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

<form name="formSuaLT" method="POST" action="">
    <table class="theloai" width="1000px" align="center" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <td colspan="6" class="header">SỬA LOẠI TIN</td>
        </tr>
        <tr>
            <td>Tên Loại Tin</td>
            <td>
                <input type="text" name="TenLT" value="<?php echo $row_loaitin['Ten']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Thứ Tự</td>
            <td>
                <input type="number" name="ThuTu" value="<?php echo $row_loaitin['ThuTu']; ?>" />
            </td>
        </tr>
        <tr>
            <td>Ẩn Hiện</td>
            <td>
                <label>
                  <input type="radio" name="AnHien" value="1" id="an" <?php if($row_loaitin['AnHien'] == 1) { echo 'checked="checked"';} ?> />
                  Hiện</label>
                <label>
                  <input type="radio" name="AnHien" value="0" id="hien" <?php if($row_loaitin['AnHien'] == 0) { echo 'checked="checked"';} ?> />
                  Ẩn</label>
            </td>
        </tr>
        <tr>
        	<td>Thể Loại</td>
            <td>
            	<select class="select-theloai" name="idTL" id="idTL">
                	<?php
                    	$theloai = DanhSachTheLoai();
						while ($row = mysql_fetch_array($theloai)) {
					?>
                    	<option <?php if($row_loaitin['idTL'] == $row['idTL']) { echo 'selected="selected"';} ?> value="<?php echo $row['idTL'] ?>"><?php echo $row['TenTL'] ?></option>
                    <?php
						}
					?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button type="submit" name="btnSuaLT">Sửa</button>
            </td>
        </tr>
    </table>
</form>

</body>
</html>