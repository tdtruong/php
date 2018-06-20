<?php
	function stripUnicode($str) {
		if (!$str) {return false;}
		$unicode = array(
			'a' => 'á|à|ả|ã|ạ|ă|â|ấ|ầ|ẩ|ẫ|ậ',
			'A' => 'Á|À|Ả|Ã|Ạ|Ă|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'd' => 'đ',
			'D' => 'Đ',
			'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'i' => 'í|ì|ỉ|ĩ|ị',
			'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
			'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ổ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ổ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	
			'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
			'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
		);
		
		foreach($unicode as $khongdau => $codau) {
			$arr = explode("|", $codau);
			$str = str_replace($arr, $khongdau, $str);	
		}
		return $str;
	}
	
	function changeTitle($str) {
		$str = trim($str);
		if ($str =="") {return "";}
		$str = str_replace("",'', $str);
		$str = str_replace("'", '', $str);
		$str = stripUnicode($str);
		$str = mb_convert_case($str, MB_CASE_TITLE, 'utf-8');
		$str = str_replace(' ', '-', $str);
		return $str;
	}
	
	// Lấy toàn bộ thể loại
	function DanhSachTheLoai() {
		$query = "SELECT * FROM theloai ORDER BY idTL DESC";
		return mysql_query($query);	
	}
	
	// Lấy thể loại theo id
	function LayTheLoaiTheoId($idTL) {
		$query = "SELECT * FROM theloai WHERE idTL = $idTL";
		$row = mysql_query($query);
		return mysql_fetch_array($row);
	}
	
	// Lấy danh sách loại tin
	function DanhSachLoaiTin() {
		$query = "
			SELECT * FROM loaitin, theloai
			WHERE loaitin.idTL = theloai.idTL
			ORDER BY loaitin.idLT DESC
		";	
		return mysql_query($query);
	}
	
	// Lấy loại tin theo id
	function LayLoaiTinTheoId($idLT) {
		$query = "SELECT * FROM loaitin WHERE idLT = $idLT";
		$row = mysql_query($query);
		return mysql_fetch_array($row);
	}
	
	// Lấy danh sách tin tức
	function LayDanhSachTin() {
		$query = "
			SELECT tin.*, TenTL, Ten
			FROM tin, loaitin, theloai
			WHERE tin.idLT = loaitin.idLT
			AND tin.idTL = theloai.idTL
			ORDER BY idTin DESC
		";	
		return mysql_query($query);
	}
	
	// Lấy danh sách tin tức và phân trang
	function LayDanhSachTin_PhanTrang($from, $sotin_mottrang) {
		$query = "
			SELECT tin.*, TenTL, Ten
			FROM tin, loaitin, theloai
			WHERE tin.idLT = loaitin.idLT
			AND tin.idTL = theloai.idTL
			ORDER BY idTin DESC
			LIMIT $from, $sotin_mottrang
		";	
		return mysql_query($query);
	}
	
	// Lấy tin tức theo id
	function LayTinTheoId($idTin) {
		$query = "
			SELECT * FROM tin
			WHERE idTin = $idTin
		";
		$row = mysql_query($query);
		return mysql_fetch_array($row);
	}
	
	// Lấy danh sách quảng cáo
	function LayDanhSachQuangCao() {
		$query = "
			SELECT * FROM quangcao
			ORDER BY idQC DESC
		";	
		return mysql_query($query);
	}
	
	// Lấy quảng cáo theo id
	function LayQuangCaoTheoId($idQC) {
		$query = "
			SELECT * FROM quangcao
			WHERE idQC = $idQC
		";	
		$row = mysql_query($query);
		return mysql_fetch_array($row);
	}
?>