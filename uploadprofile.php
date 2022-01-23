<?php include('header.php');?>
<?php
//include('config.php');
include('lock.php');

$getphonenumber = "select ContactNumber,City from tbluserpersonaldetails where UserId=".$_SESSION['UserId'];
$getMobileNo = mysql_query($getphonenumber); 
if(mysql_num_rows($getMobileNo)>0){
	while($row = mysql_fetch_array($getMobileNo)){
		$mobilenumber = $row['ContactNumber'];
		$city = $row['City'];
	}
}else{
	$mobilenumber = '';
}

?> 
<div id="">
	 <div class="heading" style="text-shadow:none;padding: 3px 10px;">
		  <span>Please Complete Your Personal Profile</span> <span style=" margin-right: 25px;float:right;color:#fff;"><a href="dashboard.php" style="color:#fff;">Back</a></span>

	 </div> 
</div>
<div style="clear: both;height:3px;">&#160;</div>
 <form enctype="multipart/form-data" action="upload.php" id="uploadForm" data-ajax="false" method="POST">
 	<input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
	<input type="hidden" name="facebookimagepath" style="display:block;" id="facebookimagepath" value="<?php echo $_SESSION['FBimage'] ?>" />
	<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['UserId'] ?>" />
	<input type="hidden" name="ProviderId" id="ProviderId" value="<?php echo $_SESSION['ProviderId'] ?>" />

   <div style="padding: 10px 15px;" id="personalform_div">
                        <div style="margin-top: -10px;" id="divPersonalDetails">
                            

                            <div style="margin-top: 10px;">
                                <div style="width: 139px;" class="personal-detail-label">
                                    Mobile Number <span style="color: #FF0000;">*</span>
                                </div>
                                <div style="float: left;">
                                    <input type="text" value="<?php echo $mobilenumber; ?>" onblur="CheckVal(this.id,'spnPhoneNumber')" name="ContactNumber" maxlength="10" id="ContactNumber" class="input-div ad-pro-detail-input">

                                    <span style="display: block; margin-left: 3px; color: #0b6809;font-size:12px;" class="add-per-detail-error">*You will get Audition alerts sms  on this number.</span>
	                                <span style="display: none;color:red; margin-left: 3px;" id="spnPhoneNumber" class="add-per-detail-error"></span>
                                </div>
								<div style="clear: both;"></div>
                                <!--<span style="display: none;color:red; margin-left: 3px;" id="spnPhoneNumber" class="add-per-detail-error"></span>
                                <div style="clear: both;"></div>-->
                            </div>
							<div style="margin-top: 10px;">
                                <div style="width: 139px;" class="personal-detail-label">
                                    City <span style="color: #FF0000;">*</span>
                                </div>
                                <div style="float: left;">
                                    <input type="text" value="<?php echo $city; ?>" name="location" maxlength="255" id="location" class="input-div ad-pro-detail-input">
	                                <span style="display: none;color:red; margin-left: 3px;" id="spnLocation" class="add-per-detail-error"></span>
                                </div>
								<div style="clear: both;"></div>
                            </div>

                            <div style="margin-top: 10px;">
                                <div style="width: 139px;" class="personal-detail-label">
                                    Thumbnail 
                                </div>
					<?php  
						$FBimage = $_SESSION['FBimage'];
						if(strpos($FBimage, 'http') !== false){
							$FBimage = $_SESSION['FBimage'];
						}else{
							$FBimage = "http://www.filmipassion.com/".$_SESSION['FBimage'];
						}
	    				?>

                                <div style="background-color: #FFFFFF; border: 1px solid #D3D3D3; padding: 6px; border-radius: 3px; max-width: 97.5%; padding: 6px; width: 88px; height: 88px; float: left;">
                                    <!--<img id="imgProfileImage1" style="width:100px;height:100px;" src="http://graph.facebook.com/100005479513470/picture?height=500&amp;type=normal&amp;width=500">-->
                                    <img id="imgProfileImage1" style="width:88px;height:88px;" src="<?php echo $FBimage; ?>">
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            <div style="margin-top: 10px;">
                                <div style="width: 139px;" class="personal-detail-label">
                                     
                                </div>
                                <div style="float: left; width: 100%;">
                                    <div style="margin-left: 00px;">
                                        <a style="font-weight: bold;" onclick="UploadImage();" href="#">Edit Photo From Gallery</a>
						<input type="file" style="height:40px;" name="userfile" onchange="getFileName(this.files)" id="file_upload_input" />
                                        <div style="padding-bottom: 10px; margin-top: 11px;">
                                            <a style="font-weight: bold;" onclick="GetFbAlbums();" href="#">Edit Photo From Facebook</a>
                                        </div>
                                        <span class="add-per-detail-error" id="spnUserImageProfile" style="font-size:12px;display: block; margin-left: 0px; margin-top: 2px; color: #0b6809;">*This Photo will be seen
                                         by Modelling agencies and Production house.</span>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                           <div style="text-align: center; margin-top: 20px; margin-bottom: 15px;">
                                <a  onclick="return checkemptyval()" style="font-weight:normal;color:#fff;cursor: pointer;" class="myButton_dash">&#160;&#160;Save&#160;&#160;</a>
					<!--<input type="Submit" onclick="return checkemptyval()" name="save" value="Save" class="">-->
                            </div>
                        </div>
                    </div>
				 </form> 

 <!--<form enctype="multipart/form-data" action="upload.php" id="uploadForm" data-ajax="false" method="POST">
 	<input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
 	Select Picture/File To Upload: <input type="file" name="userfile" onchange="getFileName(this.files)" id="file" />
 	<input type="submit" value="Upload" data-role="button" />
 </form>
 <div>
	<a onclick="GetFbAlbums()">From FB</a>
	<img src=""  style="width:100px;height:100px;" id="imgProfileImage1" />
 </div> -->
<style>
.ui-body-c, .ui-overlay-c {
    background: none;
    border: 0px solid #AAAAAA;
    color: #333333;
    text-shadow: 0 0px 0 #FFFFFF;
}
</style>
<script>
function checkemptyval() {
	callJQureyMagicPopUp('pageLoader','pageLoaderClose');
	//	$('input:submit').attr("disabled", true);
		if (!CheckVal('ContactNumber', 'spnPhoneNumber')){
	            return false;
		}else{
			var formObj=document.getElementById('uploadForm');
 			formObj.action = 'upload.php';
 			formObj.method='POST';
	  		document.forms['uploadForm'].submit();
		}    
}
	function CheckVal(txtId, spnID) {
		var errmsg = null;
        var Empty = null;
        var txtval = document.getElementById(txtId).value;
        errmsg = "Please enter mobile number.";

		var numericExpression = /^[0-9]+$/;
		if (txtval == "" || txtval == Empty) {
			//$('#' + spnID).text(errmsg);
			 alert("Please enter mobile number.");
			$('#' + spnID).show();
			//$('input:submit').attr("disabled", false);
			disablePopup('pageLoader');
			return false;
		}
		if (txtval.match(numericExpression)) {
			$('#' + spnID).hide();
		}
		else {
			msg = "Only Number and No white Spaces";
			alert(msg);
			//$('input:submit').attr("disabled", false);
			disablePopup('pageLoader');
			//$('#' + spnID).text(msg);
			$('#' + spnID).show();
			return false;
		}

		return true;

	}

    function GetFbAlbums()
    {
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
        GetAlbumsFacebook(GetFbAlbumsCallback);
    }

    function GetFbAlbumsCallback(response)
    {
        var script='';

        if(response.Albums.length>0)
        {
            for(var i=0;i<response.Albums.length;i++)
            {

                var pId=response.ProviderId;
                var imageSrc=response.Albums[i].CoverImage;
                var count=response.Albums[i].Count;
                var name=response.Albums[i].Name;
                var aid=response.Albums[i].Id;

                script=script+'<div class="divfbalbums">'+
                   ' <div style="background-image: url('+imageSrc+'); height: 155px; width: 150px;" onclick="GetPhotosByAlbumId('+aid+')"></div>'+
                   '<p class="divfbalbums-name">'+name+'</p>'+
                   '<p class="divfbalbums-count">'+((count>1)?count+" Photos":count+" Photo")+'</p>'+
                '</div>';
            }

            $('#divFBAlbums').html(script);
            $('#divFBAlbums').show();
            $('#divPhotosByAlbumsId').hide();
            $('#fbphoto_save_back').hide();
            openFBAlbumPopup("popupOpenFBPhotos");
        }
        else
        {

        }
    }

    function GetPhotosByAlbumId(id)
    {
        GetPhotosFromAlbum(GetPhotosByFbAlbumsCallback,id);
    }

    function GetPhotosByFbAlbumsCallback(response)
    {
        var script='';

        if(response.PhotosByAlbum.length>0)
        {    
		//$("#popupOpenFBPhotos").css("margin-top","-30px");
            for(var i=0;i<response.PhotosByAlbum.length;i++)
            {
                var imageSrc=response.PhotosByAlbum[i].ImageUrl;

                script=script+'<div class="divfbalbums2">'+
                    '<img src="'+imageSrc+'" class="img-fb" style="height:160px; width:160px" onclick="OnCheckFbPhotoImage(this)" />'+
                    '<div>'+
                        '<div class="float-left">'+
                            '<input type="checkbox" onclick="OnCheckFbPhoto(this)" />'+
                        '</div>'+
                        '<div class="div-all-pop-chktxt">xyz  </div>'+
                        '<div class="clear"></div>'+
                    '</div>'+
               ' </div>';
            }

            $('#divPhotosByAlbumsId').html(script);
            $('#divFBAlbums').hide();
            $('#divPhotosByAlbumsId').show();
            $('#fbphoto_save_back').show();
        }
        else
        {

        }
    }

    function returnToAlbums()
    {
        $('#divFBAlbums').show();
        $('#divPhotosByAlbumsId').hide();
        $('#fbphoto_save_back').hide();
        $('#divPhotosByAlbumsId').html('');
    }

    function OnCheckFbPhotoImage(me) {
        var fbPhotoMe = $(me).parent().find('input:checkbox');

        if (fbPhotoMe.is(':checked')) {
            fbPhotoMe.prop('checked', false);
        }
        else {
            fbPhotoMe.prop('checked', true);
        }

        OnCheckFbPhoto(fbPhotoMe[0]);
    }

    function OnCheckFbPhoto(me) {
        $("#divPhotosByAlbumsId :checkbox").not($(me)).removeAttr("checked");
        $("#divPhotosByAlbumsId").find('.active-photo-facebook').removeClass('active-photo-facebook');
        if ($(me).is(':checked')) {
            $(me).closest('.divfbalbums2').children('.img-fb').addClass('active-photo-facebook');
        }
        else {
            $(me).closest('.divfbalbums2').children('.img-fb').removeClass('active-photo-facebook');
        }
    }

    function SavePhotoFromAlbum() {
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
        var imageObj=$("#divPhotosByAlbumsId").find('.active-photo-facebook');
        if(imageObj.length>0)
        {
            var imageUrl=imageObj.attr('src');
//			alert(imageUrl);

			$('#imgProfileImage1').attr('src',imageUrl);
			$('#facebookimagepath').attr('value',imageUrl);
			$('#file').attr('value','');
			
            $('#hdnUserImage').val(imageUrl);

            $('#hdnImgUloadType').val('');
            $('#hdnImgUloadType').val('1');  // 2 for Upload pics

            //$('#imgProfileImage1').css("width","100px");  $('#imgProfileImage1').css("height","100px");
           disablePopup('pageLoader');
            OnCancelFBPopup();

            //Update data base and reload page;
        }
        else{
            alert('Please select a image.');
        }
    }

    
</script>
<style>
    .divfbalbums
    {
        height: 193px;
        width: 150px;
        border: 1px solid #cccccc;
        float: left;
        margin: 16px 0 0 33px;
        cursor: pointer;
    }

    .divfbalbums2
    {
        height: 184px;
        width: 150px;
        border: 1px solid #cccccc;
        float: left;
        margin: 3px 0 0 32px;
        cursor: pointer;
    }

    .divfbalbums-name
    {
        color: #3B5998;
        text-decoration: none;
        font-size: 11px;
        text-align: left;
        word-wrap: break-word;
        padding: 0px 0 0 6px;
    }

    .divfbalbums-count
    {
        color: #808080;
        font-size: 11px;
        line-height: inherit;
        font-weight: normal;
        padding: 4px 0 0 6px;
    }

    .div-all-pop-chktxt
    {
        color: #808080;
        font-size: 11px;
        float: left;
    }
</style>
<div id="popupOpenFBPhotos" class="popupOpenFBPhotoss">
    <div class="popup_inner">
        <div style="height: 35px;">
            <div class="popup_header">
                <div id="Sharedivtype1" class="popup-top-txt">
                    Facebook Albums <span style="float:right;margin-right:1px;cursor: pointer;"><img onclick="OnCancelFBPopup();" width="20px" height="20px" src="images/close_pop.png" /></span>
                </div>
            </div>
        </div>
        <div>
            <div id="divFBAlbums" style="display: none;">
            </div>
            <div id="divPhotosByAlbumsId" style="display: none;">
            </div>
            <div style="clear: both;"></div>
            <div id="fbphoto_save_back">

                <div style="text-align: center; margin-top: 20px; margin-bottom: 1px;">
                    <div style="float:left"><input type="Submit" onclick="SavePhotoFromAlbum()" name="done" value="Done" class=""></div>
                    <div style="margin-left:10px;float:left"><input type="Submit" onclick="returnToAlbums()" name="back" value="Back" style="margin-left: 20px;" class=""></div>
                </div>
            </div>
            <div style="height: 10px;">
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    #fade
    {
        /*--Transparent background layer--*/
        display: none; /*--hidden by default--*/
        background: #000;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: .60;
        z-index: 9999;
    }

    img.btn_close
    {
        float: right !important;
        position: absolute;
        text-align: right !important;
        margin: 6px 0 0 645px;
        width: 20px;
    }

    /*--Making IE6 Understand Fixed Positioning--*/
    *html #fade
    {
        position: absolute;
    }

    *html .popup_block
    {
        position: absolute;
    }

    .popupOpenFBPhotoss
    {
        background-color: #FFFFFF;
        border: 2px solid #D43969;
        border-radius: 6px;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.4);
        display: none; /*--hidden by default--*/
        padding: 6px;
        float: left;
        font-size: 1.2em;
        position: fixed;
        top: 10%;
        left: 9%;
        z-index: 99999; /*--CSS3 Box Shadows--*/
        -webkit-box-shadow: 0px 0px 20px #000;
        -moz-box-shadow: 0px 0px 20px #000;
        box-shadow: 0px 0px 20px #000; /*--CSS3 Rounded Corners--*/
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
    }
</style>


<script type="text/javascript">
//alert(window.screen.availWidth);
        function openFBAlbumPopup(ID) {
            var popID = ID;
            var popmaxWidth = 235;
            $('#' + popID).fadeIn().prepend('<a href="#" class="close"><img onclick="OnCancelFBPopup();" class="btn_close" src="/images/close_pop.png" style="margin-left: 840px;  width: 20px;" class="embedlbtn_close" title="Close Window" alt="" /></a>');
            var popMargTop = ($('#' + popID).height() + 80) / 2;
            var popMargLeft = ($('#' + popID).width() + 80) / 2;
            /*$('#' + popID).css({
                'margin-top': -popMargTop,
                'margin-left': -popMargLeft
            });*/
            $('body').append('<div id="fade1"></div>');
            $('#fade1').css({ 'filter': 'alpha(opacity=80)' }).fadeIn();
        }

        function OnCancelFBPopup() {
			try{
				disablePopup('pageLoader');
			}catch(e){}
            $('#fade1 , .Masterpopup_block').fadeOut(function () {
                $('#fade1, a.close').remove();
                $("#popupOpenFBPhotos").hide();
                $("#ConfirmPopup").hide();
                
            });
        }
       

    </script>
	
 <script>
 	function getFileName(fileName) {
 		//alert(fileName[0].name);
 	   // alert(fileName[0].size);
 	
 	}
 </script>
 
<?php include('footer.php');?>
