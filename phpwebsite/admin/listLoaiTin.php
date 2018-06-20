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
    	<td colspan="6" class="header">QUẢN LÝ LOẠI TIN</td>
    </tr>
	<tr>
    	<td class="title">ID</td>
        <td class="title">Tên</td>
        <td class="title">Tên - Không Dấu</td>
        <td class="title">Thứ Tự</td>
        <td class="title">Ẩn Hiện</td>
        <td class="title">Thể Loại</td>
        <td><a href="themLoaiTin.php">Thêm</a></td>
    </tr>
    <?php
    	$loaitin = DanhSachLoaiTin();
		while ($row = mysql_fetch_array($loaitin)) {
			ob_start();
	?>
    <tr>
    	<td>{idLT}</td>
        <td>{Ten}</td>
        <td>{Ten_KhongDau}</td>
        <td>{ThuTu}</td>
        <td>{AnHien}</td>
        <td>{TenTL}</td>
        <td>
        	<a href="suaLoaiTin.php?idLT={idLT}">Sửa</a> - <a href="xoaLoaiTin.php?idLT={idLT}" onclick="return confirm('Bạn có chắc chắn muốn xóa hay không?');">Xóa</a>
        </td>
    </tr>
    <?php
		$s = ob_get_clean();
		$s = str_replace('{idLT}', $row['idLT'], $s);
		$s = str_replace('{Ten}', $row['Ten'], $s);
		$s = str_replace('{Ten_KhongDau}', $row['Ten_KhongDau'], $s);
		$s = str_replace('{ThuTu}', $row['ThuTu'], $s);
		$s = str_replace('{AnHien}', $row['AnHien'], $s);
		$s = str_replace('{TenTL}', $row['TenTL'], $s);
		echo $s;
		}
   	?>
</table>
</body>
</html>