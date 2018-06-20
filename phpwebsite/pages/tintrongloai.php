<?php
    $idLT = $_GET['idLT'];
    settype($idLT, 'int');
?>

<?php
    $bc = BreadCrumb($idLT);
    $row_bc = mysql_fetch_array($bc);
?>

<div>
    Trang chủ >> <?php echo $row_bc['TenTL'] ?> >> <?php echo $row_bc['Ten'] ?>
</div>

<?php
    $sotin_mottrang = 4;
    if (isset($_GET['trang'])) {
        $trang = $_GET['trang'];
        settype($trang, 'int');
    } else {
        $trang = 1;
    }

    $from = ($trang - 1)  * $sotin_mottrang;

    $tin = LayTinTheoTheLoai_PhanTrang($idLT, $from, $sotin_mottrang);
    while ($row_tin = mysql_fetch_array($tin)) {
?>
<div class="box-cat">
	<div class="cat1">
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col0 col1">
            	<div class="news">
                    <h3 class="title" ><a href="chitiet/<?php echo $row_tin['idTin'] ?>-<?php echo $row_tin['TieuDe_KhongDau'] ?>.html"><?php echo $row_tin['TieuDe'] ?></a></h3>
                    <img class="images_news" src="upload/tintuc/<?php echo $row_tin['urlHinh'] ?>" align="left" />
                    <div class="des"><?php echo $row_tin['TomTat'] ?></div>
                    <div class="clear"></div>
                   
				</div>
            </div>
            
        </div>
    </div>
</div>
<div class="clear"></div>
<!-- box cat-->
<?php
    }
?>

<div id="phantrang">
<?php
    $t = LayTinTheoTheLoai($idLT);
    $total = mysql_num_rows($t);

    $totalpage = ceil($total/$sotin_mottrang);

    for ($i = 1; $i <= $totalpage; $i++) {
		if ($i == $trang) {
		?>
        	<span class="active"><?php echo $i ?></span>
        <?php
		} else {
		?>
			<a href = "loaitin/<?php echo $i ?>/<?php echo $idLT ?>-<?php echo $row_bc['Ten'] ?>.html"><?php echo $i ?></a>		
<?php
		}
    }
?>
</div>