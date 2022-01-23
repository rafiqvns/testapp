<?php include('header.php');?>
<?php
//include('config.php');
$prid = $_GET['id'];
$audtionSql = "select Ta.*, TaT.Type,tpd.ProductionName,tuc.Category as PerformerTypeName from tblaudition Ta left join tblauditionagreementtype TaT on Ta.AgreementType=TaT.Id  
left join tblproductiondetails tpd on tpd.UserId=Ta.UserId left join tblcategories tuc on tuc.Id=Ta.PerformerType where Ta.Id =$prid ";
$auditionDetail = mysql_query($audtionSql);

if(isset($_SESSION['UserId'])){
	$userMobileSql = "select ContactNumber from tbluserpersonaldetails where UserId=".$_SESSION['UserId'];
	$userMobileDetail = mysql_query($userMobileSql);
	$userMobileNumber = '';
		while($row = mysql_fetch_array($userMobileDetail)){
			$userMobileNumber = $row['ContactNumber'];
		}
}


?>
<div style="border: 0px; margin: 5px 0 15px; padding-bottom: 5px;font-size:15px;" class="login-content">
    <div id="container">
        <div style="float: none;text-shadow:none;padding: 3px 10px;" class="all-pink-heading">
            Audition Detail<span id="goback" style="float:right;color:#fff;cursor:pointer;"><!--<a href="audition.php" style="color:#fff;">-->Back<!--</a>--></span>

        </div>
            <div style="background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #D3D3D3; line-height: 25px;padding: 5px 30px;font-size:14px; ">
			 <?php
				while($row = mysql_fetch_array($auditionDetail))
					{
						$BannerImage = $row['BannerImage'];
						$BannerImage = "http://www.filmipassion.com/".$BannerImage;
			 ?>
                <div>
                    <div style="">
                        <div style="margin-top: 5px; background-color: #FFFFFF; border: 1px solid #D3D3D3; border-radius: 3px; height: 120px; padding: 6px; width: 120px;">
                            <img width="120" height="120" class="all-cimg-normal" src="<?php echo $BannerImage ?>" alt=""> 
				<?php
						$checkapplySql= "select * from tbluserrequest where ProductionHouseId='".$row['UserId']."' and UserId='".$_SESSION['UserId']."' and AuditionId='".$row['Id']."' ";
						$applyDetail= mysql_query($checkapplySql);
						if(mysql_num_rows($applyDetail)==0){
				?>
				<form style="display:none;" action="applyaudition.php" id="applyauditionid" name="applyauditionid" method="POST">
					<input type="hidden" name="productionid" value="<?php echo $row['UserId'] ?>"/>
					<input type="hidden" name="auditionid" value="<?php echo $row['Id'] ?>"/>
					<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['UserId'] ?>" />
					<input type="hidden" name="selectpage" id="selectpage" value="Details" />
					<input type="hidden" name="pagenumber" id="pagenumber" value="" />
				</form>
				<span style="float:left;margin-left:140px;margin-top:-90px;width:135px">
					<a style="font-size:14px" href="#" onclick="applyAudtion('<?php echo $_SESSION['UserId'] ?>','<?php echo $userMobileNumber; ?>');">
						<div class="pink-btn">Apply For Audition</div>
					</a>
				<?php } ?>
				</span>
				<div>
                        </div>
                    </div>
			<div style="clear:both;">&#160;</div>
                    <div style="float: left; line-height: 25px; margin-top: 0px;">

                        <div style="margin-bottom: 0px; width: 350px" class="txt-color-pink">
                            <?php echo $row['AuditionTitle'] ?>
                        </div>
                        <div style="padding-top: 2px;">
                            <div class="audi-detail-left">
                                Pr. House :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['ProductionName'] ?></div>
                            <div class="clear">
                            </div>
                        </div>

                        <div style="padding-top: 2px;">
                            <div class="audi-detail-left">
                                Last Date To Apply :    
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['LastDateToApply'] ?></div>
                            <div class="clear">
                            </div>
                        </div>

                        <div>
                            <div class="audi-detail-left">
                                Gender :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['RequiedGender'] ?></div>
                            <div class="clear">
                            </div>
                        </div>


                        <div>
                        </div>


                        <div>
                            <div class="audi-detail-left">
                                Age :
                            </div>
                            <div class="audi-detail-right main-lable-width">
                                <?php echo $row['AgeRange'] ?>
                            </div>
                            <div class="clear">
                            </div>
                        </div>


                        <div>
                            <div class="audi-detail-left">
                                Performer Type :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['PerformerTypeName'] ?></div>
                            <div class="clear">
                            </div>
                        </div>
                            <div>
                                <div class="audi-detail-left">
                                    Venue :
                                </div>
                                <div class="audi-detail-right main-lable-width"><?php echo $row['Location'] ?></div>
                                <div class="clear">
                                </div>
                            </div>
                        <div>
                            <div class="audi-detail-left">
                                City :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['City'] ?></div>
                            <div class="clear">
                            </div>
                        </div>
                        <div>
                            <div class="audi-detail-left">
                                State :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['State'] ?></div>
                            <div class="clear">
                            </div>
                        </div>

                            <div>
                                <div class="audi-detail-left">
                                    Contact Person :
                                </div>
                                <div class="audi-detail-right"><?php echo $row['ContactPerson'] ?></div>
                                <div class="clear">
                                </div>
                            </div>
                            <div>
                                <div class="audi-detail-left">
                                    Email Address :
                                </div>
                                <div class="audi-detail-right main-lable-width"><?php echo $row['EmailAddress'] ?></div>
                                <div class="clear">
                                </div>
                            </div>

                        <div>
                            <div class="audi-detail-left">
                                Facebook URL :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['FaceBookProfileUrl'] ?></div>
                            <div class="clear">
                            </div>
                        </div>
                        <div>
                            <div class="audi-detail-left">
                                Website :
                            </div>
                            <div class="audi-detail-right dark_grey_link main-lable-width"><a href="http://" target="_blank" style="color:#787878"></a></div>
                            <div class="clear">
                            </div>
                        </div>

                    </div>
                    <div class="clear">
                    </div>
                </div>
                <div style="line-height: 18px; margin-top: 15px;">
                    <div class="txt-color-pink">
                        Additional Information :
                    </div>
                    <div class="audi-detail-right"></div>
                    <div class="clear">
                    </div>
                </div>
                <div style="margin-top: 15px; padding-bottom: 30px; line-height: 18px; line-height: 18px;">
                    <div class="txt-color-pink">
                        Audition Description
                    </div>
                    <div style="color: #787878; font-weight: normal;"><?php echo $row['AuditionDescription'] ?>
                    </div>

                </div>

				<?php  } ?>

            </div>

   </div>
</div>
<script>
	function applyAudtion(loginuser,usermobilenumber)
	{
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		if(loginuser==null && loginuser==''){
			alert('Please login to your Facebook account!');
			window.location="index.php";
			try{
				disablePopup('pageLoader');
			}catch(e){}
		}else if(usermobilenumber==null || usermobilenumber==''){
			alert("Please update your mobile number.");
			window.location="uploadprofile.php";
		}else{
			var formObj=document.getElementById('applyauditionid');
 			formObj.action = 'applyaudition.php';
 			formObj.method='POST';
	  		document.forms['applyauditionid'].submit();
		}
	}
$("#goback").click(function(){	
				history.go(-1);
		});
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