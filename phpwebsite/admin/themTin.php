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
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	function BrowseServer( startupPath, functionData ){
		var finder = new CKFinder();
		finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
		//finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
		finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
		finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
		//finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn	
		finder.popup(); // Bật cửa sổ CKFinder
	} //BrowseServer
	
	function SetFileField( fileUrl, data ){
		document.getElementById( data["selectActionData"] ).value = fileUrl;
	}
	function ShowThumbnails( fileUrl, data ){	
		var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
		document.getElementById( 'thumbnails' ).innerHTML +=
		'<div class="thumb">' +
		'<img src="' + fileUrl + '" />' +
		'<div class="caption">' +
		'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
		'</div>' +
		'</div>';
		document.getElementById( 'preview' ).style.display = "";
		return false; // nếu là true thì ckfinder sẽ tự đóng lại khi 1 file thumnail được chọn
	}
</script>

<script type="text/javascript" src="../jquery-slider-master/js/jquery-2.1.0.min.js"></script>
<script>
	$(document).ready(function() {
		var idTL = $("#idTL").val();
		$.get("loaitin.php", {idTL:idTL}, function(data) {
			$("#idLT").html(data);	
		});

		$("#idTL").change(function() {
			var id = $(this).val();
			$.get("loaitin.php", {idTL:id}, function(data) {
				$("#idLT").html(data);	
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
	if (isset($_POST['btnThemTin'])) {
		$TieuDe = $_POST['TieuDe'];
		$TieuDe_KhongDau = changeTitle($TieuDe);
		$TomTat = $_POST['TomTat'];
		$urlHinh = $_POST['urlHinh'];
		$Ngay = date('Y-m-d');
		$idUser = $_SESSION['idUser'];
		settype($idUser, 'int');
		$Content = $_POST['Content'];
		$idTL = $_POST['idTL'];
		settype($idTL, 'int');
		$idLT = $_POST['idLT'];
		settype($idLT, 'int');
		$SoLanXem = 0;
		$TinNoiBat = $_POST['TinNoiBat'];
		settype($TinNoiBat, 'int');
		$AnHien = $_POST['AnHien'];
		settype($AnHien, 'int');
		$query = "INSERT INTO tin
			VALUES(null, '$TieuDe', '$TieuDe_KhongDau', '$TomTat', '$urlHinh', '$Ngay', '$idUser', '$Content', '$idLT', '$idTL', '$SoLanXem', '$TinNoiBat', '$AnHien')
		";
		mysql_query($query);
		header('location:listTinTuc.php');
	}
?>

<form id="formThemTin" method="POST">
    <table class="theloai" width="1000px" align="center" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <td colspan="5" class="header">THÊM TIN TỨC</td>
        </tr>
        <tr>
            <td class="title tin">Tiêu Đề</td>
            <td>
                <input type="text" name="TieuDe"/>
            </td>
        </tr>
        <tr>
            <td class="title tin">Tóm Tắt</td>
            <td>
            	<textarea name="TomTat" cols="10" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td class="title tin">Hình Ảnh</td>
            <td>
            	<input class="hinhanh" type="text" name="urlHinh"/>
                <button type="button" id="btnChonFile" name="btnChonFile" onclick="BrowseServer('Images:/','urlHinh')">Chọn Hình</button>
            </td>
        </tr>
        <tr>
            <td class="title tin">Content</td>
            <td>
            	<textarea name="Content" cols="10" rows="10"></textarea>
                <script type="text/javascript">
				var editor = CKEDITOR.replace( 'Content',{
					uiColor : '#9AB8F3',
					language:'vi',
					enterMode: CKEDITOR.ENTER_BR,
					skin:'v2',
					filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
					filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
					filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
					toolbar:[
					['Source','-','Save','NewPage','Preview','-','Templates'],
					['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
					['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
					['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
					['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
					['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['Link','Unlink','Anchor'],
					['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
					['Styles','Format','Font','FontSize'],
					['TextColor','BGColor'],
					['Maximize', 'ShowBlocks','-','About']
					]
				});		
				</script>
            </td>
        </tr>
        <tr>
            <td class="title tin">Thể Loại</td>
            <td>
            	<select name="idTL" id="idTL">
                	<?php
                    	$theloai = DanhSachTheLoai();
						while ($row_theloai = mysql_fetch_array($theloai)) {
					?>
                	<option value="<?php echo $row_theloai['idTL'] ?>"><?php echo $row_theloai['TenTL'] ?></option>
                    <?php
						}
					?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="title tin">Loại Tin</td>
            <td>
            	<select name="idLT" id="idLT">
                	<?php
                    	$loaitin = DanhSachLoaiTin();
						while ($row_loaitin = mysql_fetch_array($loaitin)) {
					?>
                	<option value="<?php echo $row_loaitin['idLT'] ?>"><?php echo $row_loaitin['Ten'] ?></option>
                    <?php
						}
					?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="title tin">Tin Nổi Bật</td>
            <td>
            	<p>
            	  <label>
            	    <input type="radio" name="TinNoiBat" value="1" id="noibat" />
            	    Nổi Bật</label>
            	  <br />
            	  <label>
            	    <input type="radio" name="TinNoiBat" value="0" id="binhthuong" />
            	    Bình Thường</label>
            	  <br />
       	    	</p>
            </td>
        </tr>
        <tr>
            <td class="title tin">Ẩn Hiện</td>
            <td>
           	  	<p>
            	  <label>
            	    <input type="radio" name="AnHien" value="1" id="hien" />
            	    Hiện</label>
            	  <br />
            	  <label>
            	    <input type="radio" name="AnHien" value="0" id="an" />
            	    Ẩn</label>
            	  <br />
       	    	</p>
            </td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td>
            	<button type="submit" name="btnThemTin">Thêm</button>
            </td>
        </tr>
    </table>
</form>

</body>
</html>