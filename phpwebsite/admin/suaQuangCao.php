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
<script type="text/javascript" src="../jquery-slider-master/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btnChonHinh').on('click', function() {
			$('#urlHinh').click();	
			$('#urlHinh').change(function() {
				var filename = $('#urlHinh').val();
        		$('#hinhanh').html(filename.split('\\')[2]);
			});
		});
	});
</script>
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

<?php
	$idQC = $_GET['idQC'];
	$row_quangcao = LayQuangCaoTheoId($idQC);
	
	if (isset($_POST['btnSuaQC'])) {
		require "uploadfile.php";

		$vitri = $_POST['vitri'];
		settype($vitri, 'int');
		$MoTa = $_POST['MoTa'];
		$Url = $_POST['Url'];
		$urlHinh = $_FILES["urlHinh"]["name"];
		$SoLanClick = $_POST['SoLanClick'];
		settype($SoLanClick, 'int');
		$query = "
			UPDATE quangcao SET
			vitri = '$vitri',
			MoTa = '$MoTa',
			Url = '$Url',
			urlHinh = '$urlHinh',
			SoLanClick = '$SoLanClick'
			WHERE idQC = $idQC
		";
		mysql_query($query);
		header('location:listQuangCao.php');
	}
?>

<form id="formSuaQC" method="POST" enctype="multipart/form-data">
	<table class="theloai" width="1000px" align="center" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <td colspan="7" class="header">SỬA QUẢNG CÁO</td>
        </tr>
        <tr>
            <td class="title qc">Vị Trí</td>
            <td>
            	<input type="number" name="vitri" value="<?php echo $row_quangcao['vitri']; ?>"/>
            </td>
        </tr>
        
        <tr>
            <td class="title qc">Mô Tả</td>
            <td>
            	<input type="text" name="MoTa" value="<?php echo $row_quangcao['MoTa']; ?>"/>
            </td>
        </tr>
        <tr>
            <td class="title qc">Url</td>
            <td>
            	<input type="text" name="Url" value="<?php echo $row_quangcao['Url']; ?>"/>
            </td>
        </tr>
        <tr>
            <td class="title qc">Url Hình</td>
            <td>
            	<label id="hinhanh"><?php echo $row_quangcao['urlHinh']; ?></label>
                <button type="button" id="btnChonHinh">Chọn Hình</button>
                <input type="file" class="hide" name="urlHinh" id="urlHinh" value="<?php echo $row_quangcao['urlHinh']; ?>"/>
            </td>
        </tr>
        <tr>
            <td class="title qc">Số Lần Click</td>
            <td>
            	<input type="number" name="SoLanClick" value="<?php echo $row_quangcao['SoLanClick']; ?>"/>
            </td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td>
            	<button type="submit" name="btnSuaQC">Sửa</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>