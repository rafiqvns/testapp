<?php include('header.php');?>
<?php
//include('config.php');
include('lock.php');

if(isset($_SESSION['UserId'])){
	$userMobileSql = "select ContactNumber from tbluserpersonaldetails where UserId=".$_SESSION['UserId'];
	$userMobileDetail = mysql_query($userMobileSql);
	$userMobileNumber = '';
		while($row = mysql_fetch_array($userMobileDetail)){
			echo $userMobileNumber = $row['ContactNumber'];
		}
}

$audtionSql = "select p.ProductionName,p.UserId as prid,p.ThumbnailImage, a.* from tblaudition a left join tblproductiondetails p on a.userId = p.Userid Where a.IsPublish=true and a.IsActive=1 and p.IsActive = 1 and p.IsApprooved = 1 and p.IsDeleted = 0 order by a.Id desc limit 2 ";
$auditionDetail = mysql_query($audtionSql);

?>
<div style="border: 0px; margin: 5px 0 15px; padding-bottom: 5px;font-size:15px;" class="login-content">
        <div style="float: none;text-shadow:none;padding: 3px 10px;" class="all-pink-heading">
            Dashboard<span style="float:right;color:#fff;"><a onclick="forBack()" style="color:#fff; cursor: pointer;">Back</a></span>
        </div>
        <div style="background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #D3D3D3;padding: 5px 30px; ">
		<div class="">
			<!--<div style="display: block;font-size:10px;" class="vslider-area" id="divopen">
    				<span>Please Complete Your Personal Profile</span>
			</div>-->
			<div style="clear:both;height:5px;">&#160;</div>
			<div style="margin:auto; cursor: pointer;width: 133px;">
				<a onclick="uploadprofile()" class="myButton" style="cursor: pointer;color:#fff;">Edit Profile</a>
			</div>
			<div style="clear:both;height:7px;">&#160;</div>
			<div style="margin:auto; cursor: pointer;width: 133px;">
				<a onclick="imagesupload()" class="myButton" style="cursor: pointer;color:#fff;padding: 4px 32px;">Gallery</a>
			</div>
		</div>
		<div style="clear:both;height:3px;">&#160;</div>
	 </div>
	<div style="float: none;text-shadow:none;" class="all-pink-heading">
            Audition Apply <span style="float:right;margin-right:6px;font-size: 12px;"><a  onclick="goingToAuditionpage()" style="color:#fff;cursor: pointer;">View All</a></span>
        </div>
	<div class="login-content">
	<div id="content" style="">
	 <?php
		while($row = mysql_fetch_array($auditionDetail))
			{
				$BannerImage = $row['ThumbnailImage'];
				if($BannerImage==null || $BannerImage==''){
					$BannerImage="images/no_image.jpg";	
				}
				$BannerImage = "http://www.filmipassion.com/".$BannerImage;
	 ?>
		<div style="padding-top: 10px; display: block; opacity: 1;" class="pro-content-row" id="div_14">
			<div style="margin-top: 5px;">
			    <div style="">
				<div class="img-border100p margin-right10">
				    <img style="margin-right:20px;float:left;width:100px; height:100px;" src="<?php echo $BannerImage ?>" alt="Image Required">
				</div>
				<div style="float: right; width: 66%;">
				    <div class="txt-color-pink">
						<?php echo substr($row['AuditionTitle'],0,27); ?>...
				    </div>
					<div class="txt-color-pink">
                        <?php echo $row['ProductionName'] ?>
                    </div>
				    <div class="txt-color-pink" style="">
					LastDate To Apply :&nbsp;&nbsp;&nbsp;   <?php echo substr($row['LastDateToApply'],0,11) ?>
				    </div>
				    <div style="margin-top: 5px; color: #757575; height: 40px; font-size:12px">
						<?php echo substr($row['AuditionDescription'],0,50); ?>... &#160; 
						<a style="font-size:12px;cursor: pointer;" onclick="checkLogin('<?php echo isset($_SESSION['UserId']) ?>','<?php echo $row['Id'] ?>');" >View Details</a><br/>

						<?php
							$checkapplySql= "select * from tbluserrequest where ProductionHouseId='".$row['prid']."' and UserId='".$_SESSION['UserId']."' and AuditionId='".$row['Id']."' ";
							$applyDetail= mysql_query($checkapplySql);
							if(mysql_num_rows($applyDetail)==0){
						 ?>	
							<form style="display:none;" action="applyaudition.php" id="applyauditionid" name="applyauditionid" method="POST">
								<input type="hidden" name="productionid" value="<?php echo $row['prid'] ?>"/>
								<input type="hidden" name="auditionid" value="<?php echo $row['Id'] ?>"/>
								<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['UserId'] ?>" />
								<input type="hidden" name="selectpage" id="selectpage" value="Dashboard" />
								<input type="hidden" name="pagenumber" id="pagenumber" value="" />
							</form>		
							<a style="font-size:14px" href="#" onclick="applyAudtion('<?php echo $userMobileNumber; ?>');">
								<div class="pink-btn">Apply For Audition</div>
							</a>
						<?php }else{ ?>
							<a style="font-size:14px" href="#">
								<div class="pink-btn">Already Applied</div>
							</a>
						<?php } ?>
				    </div>
			    <div style="clear: both">&#160;</div>

				</div>
			    <div style="clear: both">&#160;</div>
			    </div>
			</div>
		  </div>
		  <?php } ?>
		</div>
	</div>

</div>
<script>
function forBack(){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		window.location="index.php";
	}
		function checkLogin(loginuser,id){
				callJQureyMagicPopUp('pageLoader','pageLoaderClose');
					if(loginuser!=null && loginuser!=''){
						window.location="auditiondetails.php?id="+id;
					}else{
						try{
							disablePopup('pageLoader');
						}catch(e){}
						alert('Please login to your Facebook account!');
					}
			}

function uploadprofile(){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		window.location="uploadprofile.php";
}
function imagesupload(){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		window.location="imagesupload.php";
}
function goingToAuditionpage(pageno){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		window.location="audition.php?page=1";
}

function applyAudtion(usermobilenumber)
{
	if(usermobilenumber==null || usermobilenumber==''){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		alert("Please update your mobile number.");
		window.location="uploadprofile.php";
	}else{
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		var formObj=document.getElementById('applyauditionid');
 		formObj.action = 'applyaudition.php';
 		formObj.method='POST';
  		document.forms['applyauditionid'].submit();
	}
}
</script>
<style>
.pink-btn {
    background: none repeat scroll 0 0 #FD756B;
    border: 1px solid #FD5346;
    border-radius: 5px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 12px;
    margin-top: 10px;
    padding: 5px 10px;
    text-align: center;
}
.pink-btn:hover {
    background: none repeat scroll 0 0 #FBFBFB;
    color: #FD5346;
}
.input-div {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    border-radius: 4px;
    box-shadow: 1px 2px 3px 0 #F2F2F2 inset;
    color: #AAAAAA;
    font-size: 13px;
    height: 18px;
    padding: 3px 3px 4px;
    width: 150px;
}

.myButton {
    background: linear-gradient(to bottom, #526DA4 5%, #526DA4 100%) repeat scroll 0 0 #007DC1;
    border: 1px solid #124D77;
    border-radius: 3px;
    box-shadow: -1px 0 0 -14px #54A3F7 inset;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    font-size: 14px;
    padding: 4px 18px;
    text-decoration: none;
    text-shadow: 0 1px 0 #154682;
}
.vslider-area {
    background-color: #E5E5E5;
    background-position: 98% 10px;
    background-repeat: no-repeat;
    border-bottom: 1px dashed #DEDEDE;
    color: #393C43;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 0px 7px;
    text-transform: uppercase;
    text-align:center;
}
.all-cimg-normal {
    border: 2px solid #C3C3C3;
    box-shadow: 0 0 2px #101010;
    cursor: pointer;
    height: 104px;
    max-width: 87.5%;
    padding: 6px;
    transition: all 0.3s ease 0s;
}
.ui-body-c, .ui-overlay-c {
    background: none;
    border: 0px solid #AAAAAA;
    color: #333333;
    text-shadow: 0 0px 0 #FFFFFF;
}
</style>
<?php include('footer.php');?>