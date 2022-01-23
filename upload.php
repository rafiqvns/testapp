<?php
include('config.php');

include('sdk.class.php');

$uploaddir = getcwd();

$ProviderId = $_POST['ProviderId'];
$phonenumber = $_POST['ContactNumber'];
$city = $_POST['location'];
$UserID = $_POST['userid'];
$facebookimagepath = $_POST['facebookimagepath'];

$filename = $_FILES['userfile']['name'];

if($filename!=null && $filename!=''){
	$filename = time()."_".$filename;
//	$imagePath = "uploaded/". basename($filename);
	$imagePath = "/ProfileImages/CropImage/". basename($filename);

	//$uploadfile = $uploaddir . basename($filename);
	$uploadfile = "C:\\ftp\\TalentWeb\\ProfileImages\\CropImage\\". basename($filename);
//	echo $uploadfile = $uploaddir."/uploaded/". basename($filename);
	
	//C:\ftp\TalentWeb\ProfileImages\CropImage
    //C:\ftp\mTalenWeb\FilmiPassion/uploaded/1397194583_search.jpg
}


if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

	$insertpersonaldata  = "update tbluserpersonaldetails set ContactNumber='".$phonenumber."',City='".$city."',ThumbnailImage='".$imagePath."' WHERE UserId =".$UserID ;
//	  mysql_query($insertpersonaldata);

	if(mysql_query($insertpersonaldata)){
	
		$updateUserdetail = "update tbluserlogin set AccountComplete=1 where Id =".$UserID;
			mysql_query($updateUserdetail);

		$updatePersonaldetail = "update tbluserpersonaldetails set UpdatedBy='".$UserID."', UpdatedOn=now(),IsActive=1 where UserId =".$UserID;
			mysql_query($updatePersonaldetail);

		$updatePhysicaldetail = "update tbluserphysicaldetails set UpdatedBy='".$UserID."', UpdatedOn=now(),IsActive=1 where UserId =".$UserID;
			mysql_query($updatePhysicaldetail);

		$updateProffessionaldetail = "update tbluserproffessionaldetails set UpdatedBy='".$UserID."', UpdatedOn=now(),IsActive=1 where UserId =".$UserID;
			mysql_query($updateProffessionaldetail);

	}

	include('session.php');

	header("Location: imagesupload.php");


}else if($facebookimagepath!=null && $facebookimagepath!=''){

	$insertpersonalfb  = "update tbluserpersonaldetails set ContactNumber='".$phonenumber."',City='".$city."',ThumbnailImage='".$facebookimagepath."' WHERE UserId =".$UserID ;

//	mysql_query($insertpersonalfb);
	if(mysql_query($insertpersonalfb)){
	
		$updateUserdetail = "update tbluserlogin set AccountComplete=1 where Id =".$UserID;
			mysql_query($updateUserdetail);

		$updatePersonaldetail = "update tbluserpersonaldetails set UpdatedBy='".$UserID."', UpdatedOn=now(),IsActive=1 where UserId =".$UserID;
			mysql_query($updatePersonaldetail);

		$updatePhysicaldetail = "update tbluserphysicaldetails set UpdatedBy='".$UserID."', UpdatedOn=now(),IsActive=1 where UserId =".$UserID;
			mysql_query($updatePhysicaldetail);

		$updateProffessionaldetail = "update tbluserproffessionaldetails set UpdatedBy='".$UserID."', UpdatedOn=now(),IsActive=1 where UserId =".$UserID;
			mysql_query($updateProffessionaldetail);

	}

	include('session.php');

	header("Location: imagesupload.php");

}else{
	echo "not upload";
}

?>
