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
    	<td colspan="7" class="header">QUẢN LÝ QUẢNG CÁO</td>
    </tr>
	<tr>
    	<td class="title">ID</td>
        <td class="title">Vị Trí</td>
        <td class="title">Mô Tả</td>
        <td class="title">Url</td>
        <td class="title">Url Hình</td>
        <td class="title">Số Lần Click</td>
        <td><a href="themQuangCao.php">Thêm</a></td>
    </tr>
    <?php
    	$quangcao = LayDanhSachQuangCao();
		while ($row_quangcao = mysql_fetch_array($quangcao)) {
			ob_start();
	?>
    <tr>
    	<td>{idQC}</td>
        <td>{vitri}</td>
        <td>{MoTa}</td>
        <td>{Url}</td>
        <td>{urlHinh}</td>
        <td>{SoLanClick}</td>
        <td>
       	  <a href="suaQuangCao.php?idQC={idQC}">Sửa</a> - <a href="xoaQuangCao.php?idQC={idQC}" onclick="return confirm('Bạn có chắc chắn muốn xóa hay không?');">Xóa</a>
        </td>
    </tr>
    <?php
		$s = ob_get_clean();
		$s = str_replace("{idQC}", $row_quangcao['idQC'], $s);
		$s = str_replace("{vitri}", $row_quangcao['vitri'], $s);
		$s = str_replace("{MoTa}", $row_quangcao['MoTa'], $s);
		$s = str_replace("{Url}", $row_quangcao['Url'], $s);
		$s = str_replace("{urlHinh}", $row_quangcao['urlHinh'], $s);
		$s = str_replace("{SoLanClick}", $row_quangcao['SoLanClick'], $s);
		echo $s;
		}
   	?>
</table>
</body>
</html>