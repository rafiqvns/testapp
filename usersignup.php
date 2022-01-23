<?php
include('config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$ProviderId=addslashes($_POST['ProviderId']);
$FirstName=addslashes($_POST['FirstName']);
$LastName=addslashes($_POST['LastName']);
$UserName=addslashes($_POST['UserName']);
$DOB=addslashes($_POST['DOB']);
$ThumbnailImage=addslashes($_POST['ThumbnailImage']);
$UserType=addslashes($_POST['UserType']);
$Gender=addslashes($_POST['Gender']);
$Password=addslashes($_POST['Password']);
$ImageURL=addslashes($_POST['ImageURL']);
$ProviderName=addslashes($_POST['ProviderName']);
$IsPaidUser=addslashes($_POST['IsPaidUser']);
if($IsPaidUser!=null && $IsPaidUser!='' && $IsPaidUser=='Yes'){
	$IsPaidUser = 1;
}else{
	$IsPaidUser = 0;
}


	$checkProviderID = "select * from socialmedia_user where ProviderId='$ProviderId'";
	$queryCheck = mysql_query($checkProviderID);

	if(mysql_num_rows($queryCheck)==0){
		$insertUser = "INSERT INTO tbluserlogin (Type,Username,Password,CreatedOn,IsActive,VerifyGuid,AccountComplete,IsVerified,LastLogindate,IsPaidUser) VALUES ('1', '".$UserName."', '".$Password."',  now(), 1, '', 0, 1,now(),".$IsPaidUser.")"; 
		if(mysql_query($insertUser)){
			$user_id = mysql_insert_id();

			$insertPersonal = "INSERT INTO tbluserpersonaldetails (UserId,EmailAddress,FirstName, LastName, DateOfBirth, FaceBookProfileUrl, CreatedBy, CreatedOn, CountNoOfvisit, userType, IsApprooved, IsActive, ThumbnailImage,IsCalled) VALUES ('".$user_id."', '".$UserName."', '".$FirstName."', '".$LastName."', '".$DOB."', '', '".$user_id."', now(), 0, 1, 0, 0, '".$ThumbnailImage."',0)";
			mysql_query($insertPersonal);
			
			$insertPhysical = "Insert into tbluserphysicaldetails (UserId,Gender,CreatedBy,CreatedOn) Values ('".$user_id."', '".$Gender."', '".$user_id."', now())";
			mysql_query($insertPhysical);

			$insertProffessional = "Insert into tbluserproffessionaldetails (UserID,CreatedBy,CreatedOn )Values ('".$user_id."', '".$user_id."', now())";
			mysql_query($insertProffessional);

			$insertSocial = "Insert into socialmedia_user (UserId,ProviderId,ProviderName) values ('".$user_id."', '".$ProviderId."', '".$ProviderName."')";
			mysql_query($insertSocial);

		}
	}

	$getLoginUser = "select tul.*,tupd.FirstName,tupd.LastName,tupd.ThumbnailImage as uimage, tp.ThumbnailImage as pimage,tp.ProductionName from tbluserlogin tul left join tbluserpersonaldetails tupd on tul.id=tupd.UserId left join tblproductiondetails tp on tul.id=tp.UserId join socialmedia_user su on su.UserId=tul.Id where su.ProviderId = '$ProviderId' ";

		$variable = mysql_query($getLoginUser);
		while($row = mysql_fetch_array($variable))
		{
			$_SESSION['UserId']=$row['Id'];
			$_SESSION['UserEmail']=$row['Username'];
			$_SESSION['First_Name']=$row['FirstName'];
			$_SESSION['Last_Name']=$row['LastName'];
			$_SESSION['FBimage']=$row['uimage'];
			$_SESSION['ProviderId']=$ProviderId;

		}
}
?>
