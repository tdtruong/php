<?php
	$target_dir = "../upload/quangcao/";
	$target_file = $target_dir . basename($_FILES["urlHinh"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Kiểm tra file upload có là hình ảnh hay không
	$check = getimagesize($_FILES["urlHinh"]["tmp_name"]);
	if ($check !== false) {
		//echo "File là hình ảnh - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File không phải là hình ảnh.";
		$uploadOk = 0;	
	}
	
	// Kiểm tra file đã tồn tại hay chưa
	if (file_exists($target_file)) {
		echo "Xin lỗi bạn, file đã tồn tại.";
		$uploadOk = 0;
	}

	// Kiểm tra kích thước file
	if ($_FILES["urlHinh"]["size"] > 500000) {
		echo "Xin lỗi bạn, file quá nặng.";
		$uploadOk = 0;
	}
	
	// Format file
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "Xin lỗi, chỉ các file JPG, JPEG, PNG & GIF được phép.";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {
		echo "Không thể upload file.";
	// Nếu ok, upload file
	} else {
		if (move_uploaded_file($_FILES["urlHinh"]["tmp_name"], $target_file)) {
			//echo "File ". basename( $_FILES["urlHinh"]["name"]). " has been uploaded.";
		} else {
			echo "Có lỗi khi upload file.";
		}
	}
?>