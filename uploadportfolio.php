<?php
include('config.php');

include('sdk.class.php');

$uploaddir = getcwd();

$UserID = $_POST['userid'];
$fromcomputer = $_POST['fromcomputer'];
$fromfacebook = $_POST['fromfacebook'];

if($fromcomputer!=null && $fromcomputer=='computer'){

	$txtTitle = $_POST['txtTitle'];
	$ProviderId = $_POST['ProviderId'];

	$filename = $_FILES['userfile']['name'];

	if($filename!=null && $filename!=''){
		$filename = time()."_".$filename;
//		$imagePath = "uploaded/". basename($filename);
		$imagePath = "/ProfileImages/CropImage/". basename($filename);

		//$uploadfile = $uploaddir . basename($filename);
		$uploadfile = "C:\\ftp\\TalentWeb\\ProfileImages\\CropImage\\". basename($filename);
//		$uploadfile = $uploaddir."/uploaded/". basename($filename);
		$facebookimagepath = '';
	}


	if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		$insertpersonaldata  = "Insert into tbluserimage (UserId,Title,Description,ImageName,UploadImageUrl,CreatedBy,CreatedOn,IsActive,IsApprooved) values ('".$UserID."', '".$txtTitle."', '', '".$imagePath."', '".$imagePath."', '".$UserID."', now(), 1, 1)";
				  mysql_query($insertpersonaldata);

	//	include('session.php');

		header("Location: imagesupload.php");


	}else{
		echo "not upload";
	}
}else if($fromfacebook!=null && $fromfacebook=='facebook'){

	$facebookimagepath = $_POST['UploadImageUrl'];

	$getimagepath = explode(",", $facebookimagepath);
	foreach($getimagepath as $getimage) {
    		$getimage= trim($getimage);
	$insertpersonaldata  = "Insert into tbluserimage (UserId,Title,Description,ImageName,UploadImageUrl,CreatedBy,CreatedOn,IsActive,IsApprooved) values ('".$UserID."', '".$txtTitle."', '', '".$getimage."', '".$getimage."', '".$UserID."', now(), 1, 1)";
				  mysql_query($insertpersonaldata);
    	}

	echo "1";
	
}



?>
