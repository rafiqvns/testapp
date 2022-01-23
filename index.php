<?php include('headerindex.php');?>
<?php
//include('config.php');

$user_table = "select * from tbluserpersonaldetails order by CountNoOfvisit desc limit 12";
$userDetail = mysql_query($user_table);

//$audtionSql = "select *,p.ProductionName, a.Id as auditionid from tblaudition a left join tblproductiondetails p on a.userId = p.Userid order by a.Id desc limit 2 ";
$audtionSql = "select *,p.ProductionName, a.Id as auditionid from tblaudition a left join tblproductiondetails p on a.userId = p.Userid Where a.IsPublish=true and a.IsActive=1 and p.IsActive = 1 and p.IsApprooved = 1 and p.IsDeleted = 0 order by a.Id desc limit 2 ";
$auditionDetail = mysql_query($audtionSql);
?>

<div id="my-slide">
            <img data-lazy-src="images/mob-s-1.png" />
            <img data-lazy-src="images/mob-s-2.png" />
            <img data-lazy-src="images/mob-s-3.png" />
        </div>
         
        <script type="text/javascript">
            $(document).ready(function(){
                $('#my-slide').DrSlider();
            });
        </script>
<div style="color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(253, 83, 70); width: 325px; height: auto;margin:auto;">
	<div style=" margin: auto; padding-top: 6px;">
		<div>
		    <div style="font-size: 14px; margin-left:12px;">
		        New Auditions <span style="float:right;margin-right:6px;font-size: 14px;"><a onclick="goingToAuditionpage('1');" style="cursor: pointer;color:#fff;">View All</a></span>
		    </div>
		    <!--<div onclick="location.href='audition.php'" class="LucidaGrande viewall-audition-div" style="cursor: pointer;float: right;margin-right:12px;font-size: 12px;">
		    	
		    </div>-->
		    <div class="clear"></div>
		</div>
 		<div style="margin-top: 8px;">
			<div id="">
				<div id="" style="overflow: hidden; width: auto; height: auto; padding-bottom: 5px; position: relative;">
					<div class="" style="position: relative;">
					<?php
						while($row = mysql_fetch_array($auditionDetail))
						{
							$BannerImage = $row['BannerImage'];
							$BannerImage = "http://www.filmipassion.com/".$BannerImage;
	 					?>
						<div style="margin-right: 1px; display: inline-block; float: left;width: 48%;font-size:12px;" class="">
							<!--<div class="audition-detail-img-div">    
								<img class="audition-detail-img" src="<?php echo $BannerImage ?>"> 
							</div>-->
							<div class="" style="background-color: #9999ff">
								<div class="audition-detail-main"> 
									<div class="audition-detail-inner">
										<div>
											<span class="LucidaGrandeBold audition-detail-name"><?php echo substr($row['AuditionTitle'],0,19); ?><br></span>
											<div class="LucidaGrande audition-detail-des"><?php echo substr($row['AuditionDescription'],0,15); ?>...</div>
										</div>
										<a style="cursor:pointer" onclick="checkLogin('<?php echo isset($_SESSION['UserId']) ?>','<?php echo $row['auditionid']; ?>');">
											<div class="LucidaGrande bttnWNormal">View Details</div></a>
									</div>
								</div>
							</div>
						</div>
						
						<?php } ?>
					</div>
				</div>
			</div>
            <div class="clear"></div>
		</div>
	</div>
</div>
<div style="clear:both;height:10px;">&#160;</div>
<div class="top-login" style="" id="login_div">
	<div style="">
		
		<?php if(!isset($_SESSION['UserId'])){ ?>
		 <div style="margin:auto;width:200px; cursor: pointer;" onclick="SignInSocialMedia(SignInSMCallback,'facebook')">
			 <img src="images/login-artist-bttn.png">
		</div>
		<div onclick="location.href='fashioncarnival.php'" style="" class="click-here-blink">
			Register for Fashion Carnival
        </div>
		<?php }else if(isset($_SESSION['UserId'])){ ?>
		<div style="margin:auto; cursor: pointer;width: 188px;">
			<a onclick="viewDashboard()" class="myButton_dash" style="font-weight:normal;color:#fff;cursor: pointer;">View Dashboard</a>
		</div>
		<?php } ?>
	</div>
</div>
<div style="height:10px;clear:both;">&#160;</div>
<div class="heading" style="text-shadow:none;width:325px;margin:auto;float:none;background-color:#FD5346;padding: 3px 0px;">&#160;&#160;&#160;MOST POPULAR</div>
<div id="carousel" style="width:320px">
	<ul>
						   <?php
		while($row = mysql_fetch_array($userDetail))
			{
			$ThumbnailImage = $row['ThumbnailImage'];
			if(strpos($ThumbnailImage, 'http') !== false){
				$ThumbnailImage = $row['ThumbnailImage'];
			}else{
				$ThumbnailImage = "http://www.filmipassion.com/".$row['ThumbnailImage'];
			}
	?>							    
		<li><a onclick="artistDetils('<?php echo $row['Id'] ?>');" style="cursor: pointer;"><img alt="" src="<?php echo $ThumbnailImage ?>" style="height: 70px;width: 70px;"  /></a>
		<figcaption class="index-p-text"><a style="font-size:12px;cursor: pointer;" onclick="artistDetils('<?php echo $row['Id'] ?>');" ><?php echo  substr($row['FirstName'],0,9); ?></a></figcaption>
</li>
<?php } ?>
	</ul>
	</div>
	<div style="clear:both;">&#160;</div>
<script type="text/javascript">

function artistDetils(id){
	callJQureyMagicPopUp('pageLoader','pageLoaderClose');
	window.location="artistdetils.php?id="+id;
}

function viewDashboard(){
	callJQureyMagicPopUp('pageLoader','pageLoaderClose');
	window.location="dashboard.php";
}

function goingToAuditionpage(pageno){

	callJQureyMagicPopUp('pageLoader','pageLoaderClose');
	
	window.location="audition.php?page=1";

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
 function SignInSMCallback(response) {
        SignInByProviderId(response);
    }

function SignInByProviderId(response) {
	callJQureyMagicPopUp('pageLoader','pageLoaderClose');
    var action = "usersignin.php";
	try{
		var randompassword = Math.random().toString(36).slice(-8);
	}catch(e){}
    $.ajax({
        type: 'POST',
        url: action,
        data: { ProviderId: response.ProviderId, FacebookPhotos: response.Photos, UserName: response.Email, DOB: response.Birthday, ThumbnailImage: response.ImageURL, Gender: response.Gender, ProviderName: response.Provider, randompassword:randompassword },
        success: function (data) {
//	     alert(data);	
	     if (data == 1) {
			window.location="dashboard.php";
         }else {
                SignUpClick(response.Firstname, response.Lastname, response.Email, response.ProviderId, response.Birthday, response.ImageURL, response.Provider, response.Gender, randompassword);
            }
        }
    });

}

function SignUpClick(fn, ln, email, pid,dob,ImageURL,ProviderName,Gender,randompassword) {

        var password = randompassword;

		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
        var action = 'usersignup.php';
        $.ajax({
            type: 'POST',
            url: action,
            data: { FirstName: fn, LastName: ln, UserName: email, Password: password, UserType: 1, ProviderId: pid, DOB : dob, ThumbnailImage: ImageURL,ProviderName:ProviderName,Gender:Gender,IsPaidUser: 'No'},
            success: function (data) {
			//	alert("SingUP------"+data);
			window.location="uploadprofile.php";

                //if (data == 1) {
  //                   action = '@Url.Action("Dashboard", "UserDashboard")';
  //                  window.location.href = action;
                //}
                //else {
                   // AlertMessage(data.data.Message, "");
                //}
               // $('.popupSocialLogin').find(".ajax_overlay").remove();
            }
        });
    }
	window.setInterval(function(){
		$('.click-here-blink').toggleClass('blink');
	}, 500); 
	$('#carousel').infiniteCarousel({
		transitionSpeed: 1000,
		displayTime: 6000,
		inView:3,
		advance:3,
		imagePath: 'images/',
/*		easeLeft: 'easeOutBounce',
		easeRight:'easeOutQuart',*/
		textholderHeight : .25,
		padding:'14px',
	});
	$('div.thumb').parent().css({'margin':'0 auto','width':'900px'});
</script>
<style>
.click-here-blink {
    background: none repeat scroll 0 0 #FBFBFB;
    border: 1px solid #FD5346;
    color: #FD5346;
    cursor: pointer;
    margin: 10px auto;
    padding: 10px;
    text-align: center;
    transition: color 200ms ease 0s;
    width: 292px;
	border-radius:3px;
}
.click-here-blink.blink {
    background: none repeat scroll 0 0 #000000;
    color: #FFFFFF;
}
#carousel {

	/*-moz-box-shadow: 0px 0px 10px #333;
	-webkit-box-shadow:  0px 0px 10px #333;
	box-shadow:  0px 0px 10px #333;*/
	clear:right;
	margin: 4px auto 0 auto;
	border: 0px solid #aaa;
}
</style>
<?php include('footer.php')?>