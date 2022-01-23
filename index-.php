<?php include('header.php');?>
<?php
include('config.php');

?>

<script type="text/javascript">

	$(document).ready(function(){
	});
</script>
    <div class="clear"></div>
<div class="top-login" style="height: 34px; width: 350px;" id="login_div">
	<div style="margin-top: 47px;">
		
		 <div style="float: left; margin-left: 5px; cursor: pointer;" onclick="openSocialLoginpopup('popupOpenSocialLogin');">
			 <img src="images/login-artist-bttn.png">
		</div>
		<div class="clear"></div>
		<div style="float: left; margin-left: 5px;margin-top: 15px; cursor: pointer;" onclick="openSocialLoginpopup('popupOpenSocialLogin');">
			 <input type="button" value="Current Audition"/>
		</div>
	</div>
</div>

<?php include('footer.php')?>