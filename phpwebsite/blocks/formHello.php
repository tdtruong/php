<h3>Xin chào bạn: <?php echo $_SESSION['HoTen'] ?></h3>
<?php
	if ($_SESSION['idGroup'] == 1) {
		
	
?>
	<a href="./admin" target="_blank" class="admin-link">Quản trị website</a>
<?php
	}
?>
<form method="POST" class="logout-form">
	<input type="submit" value="  Thoát  " name="btnLogout">
</form>