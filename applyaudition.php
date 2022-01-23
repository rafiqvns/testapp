<?php
include('config.php');
?>
<?php 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
$productionid=addslashes($_POST['productionid']);
$auditionid=addslashes($_POST['auditionid']);
$userid=addslashes($_POST['userid']);
$selectpage=addslashes($_POST['selectpage']);
$pagenumber=addslashes($_POST['pagenumber']);

$insertApply = "Insert into  tbluserrequest (ProductionHouseId,UserId,Subject,Body,AuditionId,CreatedBy,CreatedON,IsActive,IsApproved,IsConfirmed,ReadMessage) values ('".$productionid."','".$userid."','','','".$auditionid."','".$userid."',now(),1,1,0,0)";
if($userid!=null && $userid!=''){
	mysql_query($insertApply);
}
if($selectpage!=null && $selectpage=='Audition'){
	header("Location: audition.php?page=$pagenumber");
}else if($selectpage!=null && $selectpage=='Dashboard'){
	header("Location: dashboard.php");	
}else if($selectpage!=null && $selectpage=='Details'){
	header("Location: auditiondetails.php?id=$auditionid");	
}else{
	header("Location: index.php");	
}


}
?>
