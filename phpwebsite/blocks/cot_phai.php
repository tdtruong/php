<!-- box cat -->
<div class="box-cat">
	<div class="cat">
        <?php
            $idLT = 5;
        ?>

    	<div class="main-cat">
        	<a href="#"><?php echo TenLoaiTin($idLT); ?></a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col1">
                <?php
                    $loaitin_mottin = LayMotTinMoiNhat_TheoLoai($idLT);
                    $row_mottin = mysql_fetch_array($loaitin_mottin);
                ?>
            	<div class="news">
                <h3 class="title" ><a href="chitiet/<?php echo $row_mottin['idTin'] ?>-<?php echo $row_mottin['TieuDe_KhongDau'] ?>.html"> <?php echo $row_mottin['TieuDe'] ?> </a></h3>
                  <img class="images_news" src="upload/tintuc/<?php echo $row_mottin['urlHinh'] ?>" align="left" />
                    <div class="des"><?php echo $row_mottin['TomTat'] ?> </div>
                  
                  
                    <div class="clear"></div>
                   
				</div>
            </div>
            <div class="col2">
                <?php
                    $loaitin_bontin = LayBonTinMoiNhat_TheoLoai($idLT);
                    while($row_bontin = mysql_fetch_array($loaitin_bontin)) {
                ?>
                <h3 class="tlq"><a href="chitiet/<?php echo $row_bontin['idTin'] ?>-<?php echo $row_bontin['TieuDe_KhongDau'] ?>.html"><?php echo $row_bontin['TieuDe'] ?></a></h3>
                <?php
                    }
                ?>
            </div> 
           
        </div>
    
    </div>

</div>
<div class="clear"></div>
<!-- //box cat -->


<!-- box cat -->
<div class="box-cat">
    <div class="cat">
        <?php
            $idLT = 1;
        ?>

        <div class="main-cat">
            <a href="#"><?php echo TenLoaiTin($idLT); ?></a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
            <div class="col1">
                <?php
                    $loaitin_mottin = LayMotTinMoiNhat_TheoLoai($idLT);
                    $row_mottin = mysql_fetch_array($loaitin_mottin);
                ?>
                <div class="news">
                <h3 class="title" ><a href="chitiet/<?php echo $row_mottin['idTin'] ?>-<?php echo $row_mottin['TieuDe_KhongDau'] ?>.html"> <?php echo $row_mottin['TieuDe'] ?> </a></h3>
                  <img class="images_news" src="upload/tintuc/<?php echo $row_mottin['urlHinh'] ?>" align="left" />
                    <div class="des"><?php echo $row_mottin['TomTat'] ?> </div>
                  
                  
                    <div class="clear"></div>
                   
                </div>
            </div>
            <div class="col2">
                <?php
                    $loaitin_bontin = LayBonTinMoiNhat_TheoLoai($idLT);
                    while($row_bontin = mysql_fetch_array($loaitin_bontin)) {
                ?>
                <h3 class="tlq"><a href="chitiet/<?php echo $row_bontin['idTin'] ?>-<?php echo $row_bontin['TieuDe_KhongDau'] ?>.html"><?php echo $row_bontin['TieuDe'] ?></a></h3>
                <?php
                    }
                ?>
            </div> 
           
        </div>
    
    </div>

</div>
<div class="clear"></div>
<!-- //box cat -->

<!-- box cat -->
<div class="box-cat">
    <div class="cat">
        <?php
            $idLT = 12;
        ?>

        <div class="main-cat">
            <a href="#"><?php echo TenLoaiTin($idLT); ?></a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
            <div class="col1">
                <?php
                    $loaitin_mottin = LayMotTinMoiNhat_TheoLoai($idLT);
                    $row_mottin = mysql_fetch_array($loaitin_mottin);
                ?>
                <div class="news">
                <h3 class="title" ><a href="chitiet/<?php echo $row_mottin['idTin'] ?>-<?php echo $row_mottin['TieuDe_KhongDau'] ?>.html"> <?php echo $row_mottin['TieuDe'] ?> </a></h3>
                  <img class="images_news" src="upload/tintuc/<?php echo $row_mottin['urlHinh'] ?>" align="left" />
                    <div class="des"><?php echo $row_mottin['TomTat'] ?> </div>
                  
                  
                    <div class="clear"></div>
                   
                </div>
            </div>
            <div class="col2">
                <?php
                    $loaitin_bontin = LayBonTinMoiNhat_TheoLoai($idLT);
                    while($row_bontin = mysql_fetch_array($loaitin_bontin)) {
                ?>
                <h3 class="tlq"><a href="chitiet/<?php echo $row_bontin['idTin'] ?>-<?php echo $row_bontin['TieuDe_KhongDau'] ?>.html"><?php echo $row_bontin['TieuDe'] ?></a></h3>
                <?php
                    }
                ?>
            </div> 
           
        </div>
    
    </div>

</div>
<div class="clear"></div>
<!-- //box cat -->
