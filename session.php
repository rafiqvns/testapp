<?php
include('config.php');

echo $ProviderId = $_SESSION['ProviderId'];

echo $getLoginUser = "select tul.*,tupd.FirstName,tupd.LastName,tupd.ThumbnailImage as uimage, tp.ThumbnailImage as pimage,tp.ProductionName from tbluserlogin tul left join tbluserpersonaldetails tupd on tul.id=tupd.UserId left join tblproductiondetails tp on tul.id=tp.UserId join socialmedia_user su on su.UserId=tul.Id where su.ProviderId = '$ProviderId' ";
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

?>
