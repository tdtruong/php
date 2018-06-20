<?php
	
	// Lấy 1 tin tức mới nhất
	function LayMotTinMoiNhat() {
		$query = "
			SELECT * FROM tin
			ORDER BY idTin DESC
			LIMIT 0,1
		";
		return mysql_query($query);
	}

	// Lấy 4 tin tức mới nhất
	function LayBonTinMoiNhat() {
		$query = "
			SELECT * FROM tin
			ORDER BY idTin DESC
			LIMIT 1,5
		";
		return mysql_query($query);
	}

	// Lấy 6 tin được xem nhiều nhất
	function TinXemNhieuNhat() {
		$query = "
			SELECT * FROM tin
			ORDER BY SoLanXem DESC
			LIMIT 0,6
		";
		return mysql_query($query);		
	}


	// Cột phải
	// Lấy 1 tin tức mới nhất
	function LayMotTinMoiNhat_TheoLoai($idLT) {
		$query = "
			SELECT * FROM tin
			WHERE idLT = $idLT
			ORDER BY idTin DESC
			LIMIT 0,1
		";
		return mysql_query($query);
	}

	// Lấy 4 tin tức mới nhất
	function LayBonTinMoiNhat_TheoLoai($idLT) {
		$query = "
			SELECT * FROM tin
			WHERE idLT = $idLT
			ORDER BY idTin DESC
			LIMIT 1,4
		";
		return mysql_query($query);
	}

	// Lấy tên loại tin theo id
	function TenLoaiTin($idLT) {
		$query = "
			SELECT Ten
			FROM loaitin
			WHERE idLT = $idLT
		";
		$loaitin = mysql_query($query);
		$row = mysql_fetch_array($loaitin);
		return $row['Ten'];
	}

	// Lấy danh sách hình ảnh theo vị trí
	function LayQuangCao($vitri) {
		$query = "SELECT * FROM quangcao
				WHERE vitri = $vitri
		";
		return mysql_query($query);
	}

	// Lấy danh sách thể loại
	function DanhSachTheLoai() {
		$query = "SELECT * FROM theloai";
		return mysql_query($query);
	}

	// Lấy loại tin theo thể loại
	function DanhSachLoaiTin_TheoTheLoai($idTL) {
		$query = "SELECT * FROM loaitin
					WHERE idTL = $idTL
		";
		return mysql_query($query);
	}

	// Lấy tin mới nhất ở trang chủ, bên trái
	function LayTinMoiNhatBenTrai($idTL) {
		$query = "
			SELECT * FROM tin
			WHERE idTL = $idTL
			ORDER BY idTin DESC
			LIMIT 0,1
		";
		return mysql_query($query);
	}

	// Lấy 2 tin mới nhất ở trang chủ, bên phải
	function LayTinMoiNhatBenPhai($idTL) {
		$query = "
			SELECT * FROM tin
			WHERE idTL = $idTL
			ORDER BY idTin DESC
			LIMIT 1,2
		";
		return mysql_query($query);
	}

	//Lấy các tin theo thể loại
	function LayTinTheoTheLoai($idLT) {
		$query = "
			SELECT * FROM tin
			WHERE idLT = $idLT
			ORDER BY idTin DESC
		";
		return mysql_query($query);
	}

	function BreadCrumb($idLT) {
		$query = "SELECT TenTL, Ten
			FROM theloai, loaitin
			WHERE theloai.idTL = loaitin.idTL
			AND idLT = $idLT";
		return mysql_query($query);	
	}

	// Phân trang
	function LayTinTheoTheLoai_PhanTrang($idLT, $from, $sotin_mottrang) {
		$query = "
			SELECT * FROM tin
			WHERE idLT = $idLT
			ORDER BY idTin DESC
			LIMIT $from, $sotin_mottrang
		";
		return mysql_query($query);
	}

	// Lấy chi tiết một tin
	function ChiTietTin($idTin) {
		$query = "
			SELECT * FROM tin
			WHERE idTin = $idTin
		";
		return mysql_query($query);
	}

	function LayTinCungLoai($idTin, $idLT) {
		$query = "
			SELECT * FROM tin
			WHERE idTin <> $idTin
			AND idLT = $idLT
			ORDER BY RAND()
			LIMIT 0, 3
		";
		return mysql_query($query);
	}

	// Cập nhật số lần xem tin
	function CapNhatSoLanXemTIn($idTin) {
		$query = "
			UPDATE tin
			SET SoLanXem = SoLanXem + 1
			WHERE idTin = $idTin
		";
		mysql_query($query);
	}

	// Tìm kiếm tin theo từ khóa
	function TimKiem($tukhoa) {
		$query = "
			SELECT * FROM tin
			WHERE TieuDe REGEXP '$tukhoa'
			ORDER BY idTin DESC
		";
		return mysql_query($query);
	}
?>