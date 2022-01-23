<?php include('headerindex.php');?>
<?php
//include('config.php');
?>
<style>
ul li {
    list-style: disc;
    margin: 0;
}
</style>
<div style="float:none" class="all-pink-heading">
   Fashion Carnival
</div>
<div>
    <img alt="FilmiPassion Fashion Show" src="images/FilmiPassionStrip.jpg">
</div>
<div style="padding: 10px; background: none repeat scroll 0px 0px rgb(255, 255, 255);color:#000;">
<div style="">
        <div style="float: left; width: 290px;" class="contentRow7-box1-top">
            <div style="float: left;margin-top:-5px;">
                <img alt="Actors" src="images/actor-img.png">
            </div>
            <div style="font-size: 15px; font-weight: bold;float: left; margin: 10px 15px;">
                Benefits for Models
            </div>
            <div class="clear">
            </div>
        </div>
        <div class="clear">
        </div>
</div>
<div style="font-size:12px;">

    <div style="margin-top:5px;">
        <div>
            <ul style="">
                <li>WIN Cash prize of 50,000 on the spot. </li>
                <li>Chance to walk on ramp.</li>
                <li>Wear renowned fashion designer's collection and showcase your talent among 500 audience.</li>
                <li>Get noticed among bollywood community like film director, Ad film maker and fashion designers.</li>
                <li>Get media coverage on TV channels like Zoom, NDTV,AAj tak, HT media, TOI- Delhi Times.</li>
				
            </ul>
        </div>
    </div>
	<div style="margin-top: 15px;">
         Total No Of Seats :50 (Hurry Up )
    </div>
	<div onclick="SignInSocialMedia(SignInSMCallbackFassionArtist,'facebook')" style="font-size: 22px; cursor: pointer; text-align: center; margin-top: 20px; background: #FD5346; border-radius: 10px; padding: 8px 10px;color: #ffffff; font-size: 16px;">Register Now</div>

<div style="margin-top:5px;">
        
        <div style="font-weight:bold;">
            <span><a target="_blank" href="http://www.filmipassion.com" style="font-size:12px;font-weight:bold;" class="footer-link">www.filmipassion.com</a></span> is free to join now.
            </div>
    </div>

</div>
</div>
<div class="clear">&#160;</div>
<script>
	function SignInSMCallbackFassionArtist(response) {
		SignInByProviderFassionId(response, 1);
	}
	
	function SignInByProviderFassionId(response,type) {
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		var action = "usersignin.php";
		try{
			var randompassword = Math.random().toString(36).slice(-8);
		}catch(e){}
		$.ajax({
			type: 'POST',
			url: action,
			data: { ProviderId: response.ProviderId, FacebookPhotos: response.Photos, UserName: response.Email, DOB: response.Birthday, ThumbnailImage: response.ImageURL, Gender: response.Gender, ProviderName: response.Provider, randompassword:randompassword},
			success: function (data) {
	//	     alert(data);	
			 if (data == 1) {
				window.location="dashboard.php";
			 }else {
					SignUpClickPaid(response.Firstname, response.Lastname, response.Email, response.ProviderId, response.Birthday, response.ImageURL, response.Provider, response.Gender, randompassword,type);
				}
			}
		});
	}

	function SignUpClickPaid(fn, ln, email, pid,dob,ImageURL,ProviderName,Gender,randompassword,type) {

        var password = randompassword;

		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
        var action = 'usersignup.php';
        $.ajax({
            type: 'POST',
            url: action,
            data: { FirstName: fn, LastName: ln, UserName: email, Password: password, UserType: 1, ProviderId: pid, DOB : dob, ThumbnailImage: ImageURL,ProviderName:ProviderName,Gender:Gender,IsPaidUser: 'Yes'},
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
</script>
<?php include('footer.php')?>