<div id="slide-left">
  <?php
    $tinmoinhat_motin = LayMotTinMoiNhat();
    $row_tinmoinhat_mottin = mysql_fetch_array($tinmoinhat_motin);

  ?>

          <!-- Hiển thị 1 tin mới nhất -->
        	<div id="slideleft-main">
                <img src="upload/tintuc/<?php echo $row_tinmoinhat_mottin['urlHinh'] ?>"  /><br />
                <h2 class="title"><a href="chitiet/<?php echo $row_tinmoinhat_mottin['idTin'] ?>-<?php echo $row_tinmoinhat_mottin['TieuDe_KhongDau'] ?>.html"><?php echo $row_tinmoinhat_mottin['TieuDe'] ?></a> </h2>
                <div class="des">
                    <?php echo $row_tinmoinhat_mottin['TomTat'] ?>
                </div>
                
        	</div>

          <!-- Hiển thị 4 tin mới nhất tiếp theo -->
          <div id="slideleft-scroll">
            	
              <div class="content_scoller width_common">
            <ul>
                <!--  Lấy danh sách 4 tin mới nhất tiếp theo -->
                <?php
                  $bontinmoinhat = LayBonTinMoiNhat();
                  while($row_bontin = mysql_fetch_array($bontinmoinhat)) {
                ?>
                <li>
                  <div class="title_news">
               		 <a href="chitiet/<?php echo $row_bontin['idTin'] ?>-<?php echo $row_bontin['TieuDe_KhongDau'] ?>.html" class="txt_link"> <?php echo $row_bontin['TieuDe'] ?> </a> 
                  </div>
                </li>
                <?php
                  }
                ?>
            </ul>
            </div>			

      			<div id="gocnhin">
                <img alt="" src="http://khoapham.vn/images/logoKhoaPham.png" width="100%"></a>
                <div class="title_news"></div>
            </div>
                
      </div>
</div>


     