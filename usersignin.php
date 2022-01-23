<?php
include('config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$ProviderId=addslashes($_POST['ProviderId']);
$FacebookPhotos=addslashes($_POST['FacebookPhotos']);
$UserName=addslashes($_POST['UserName']);
$ProviderName=addslashes($_POST['ProviderName']);
$DOB=addslashes($_POST['DOB']);
$ThumbnailImage=addslashes($_POST['ThumbnailImage']);
$Gender=addslashes($_POST['Gender']);
$randompassword=addslashes($_POST['randompassword']);


	$checkProviderID = "select * from socialmedia_user where ProviderId='$ProviderId'";
	$queryCheck = mysql_query($checkProviderID);

	if(mysql_num_rows($queryCheck)>0){
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
			echo "1";
	}else{
		$checkEmail = "select * from tbluserlogin where Username='$UserName'";
		$queryCheckEmail = mysql_query($checkEmail);

		if(mysql_num_rows($queryCheckEmail)>0){
			while($row = mysql_fetch_array($variable))
			{
				$insertSocial = "Insert into socialmedia_user (UserId,ProviderId,ProviderName) values ('".$row['id']."','".$ProviderId."','".$ProviderName."')";
				mysql_query($insertSocial);

			}

			$getLoginUser = "select tul.*,tupd.FirstName,tupd.LastName,tupd.ThumbnailImage as uimage, tp.ThumbnailImage as pimage,tp.ProductionName from tbluserlogin tul left join  tbluserpersonaldetails tupd on tul.id=tupd.UserId left join tblproductiondetails tp on tul.id=tp.UserId join socialmedia_user su on su.UserId=tul.Id where tul.Username = '$UserName' ";
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
			echo "1";
		}
	}
}
?>
