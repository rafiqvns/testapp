<?php include('header.php');?>
<?php
//include('config.php');
include('lock.php');
?> 
 <div style="padding: 10px 10px 0px 10px;">
        <div onclick="DivGalleryClose(1);" style="background-color: rgb(231, 231, 231); border: 1px dotted rgb(205, 205, 205); border-radius: 5px 5px 0px 0px; display: none;" class="vslider-area closearrow" id="divCloseGallery_1">
            <span>PORTFOLIO</span>
        </div>
        <div onclick="DivGalleryOpen(1);" style="background-color: #FD5346; border: 1px dotted #FD5346;color:#fff; border-radius: 5px 5px 0px 0px;" class="vslider-area openarrow" id="divOpenGallery_1">
            <span>PORTFOLIO</span><span style="float:right;cursor:pointer;"><a href="dashboard.php" style="color:#fff;">Back</a></span>
        </div>
        <div style="" id="GalleryContent_1">
            <div style="background: #fff; border: 1px solid #cdcdcd; border-top: 0px; padding: 15px 0px;" class="login-content">
                <div style="margin-bottom: -10px; margin-left: 15px;">
                     <span style="color: #FF0000; color:#0b6809;font-size:13px;">Please complete your portfolio by adding more pictures to your gallery.</span><div style="height:10px;"></div>
                    <input type="button" onclick="UploadImage();" class="" value="Add Photo From Gallery">

                    <input type="button" onclick="GetFbAlbumsGallary();" class="" style="margin-left: 20px;" value="Add Photo From Facebook">

                    <!--<span style="color: #FF0000; float: left; margin-top: 7px;color:#0b6809;">* Maximum Six Photo(s) Allowed.</span>-->
                </div>
                <div style="margin-top: 10px;" id="gallery">
                    <div class="clear;height:3px;">&#160;</div>
                </div>
					<!--  upload images  -->
				<div style="display: none;margin:auto; width: 95%; border:1px solid #CDCDCD;" id="popup1">
						<!--<a class="close" href="#">
							<img alt="Close" title="Close Window" class="btn_close" src="images/close_pop.png" style="margin: 6px 0px 0px 660px;">
						</a>-->
						<div class="all-pink-heading" onclick="CloseDiv();" style="float: none;cursor:pointer;text-shadow:none;">
							Add Photo <span style="float:right;">Close</span>
						</div>
							<div class="popup_inner">
								<!--<div class="popup_header">
										<div class="popup-top-txt" id="divtype">Add Photo</div>
								</div>-->
								 <form enctype="multipart/form-data" action="uploadportfolio.php" id="uploadForm" data-ajax="false" method="POST">
										<input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
										<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['UserId'] ?>" />
										<input type="hidden" name="fromcomputer" id="fromcomputer" value="computer" />
										<input type="hidden" name="ProviderId" id="ProviderId" value="<?php echo $_SESSION['ProviderId'] ?>" />
										<div style="padding: 15px;">
											<div id="divImageDetail">
												<div style="margin-top: 15px;display:none;">
															<div style="width: 110px;" class="audi-detail-left">
																Title <span style="color: #FF0000;">*</span>
															</div>
															<div style="float: left;width: 100%;">
																<input type="text" class="input-div" id="txtTitle" name="txtTitle" style="width: 100%;">
															</div>
															<div style="clear: both;"></div>
												</div>
												<div id="divUpload" style="margin-top: -10px;">
													<div>
														<div style="width: 110px;" class="audi-detail-left">
															Select Image <span style="color: #FF0000;">*</span>
														</div>
														<div class="browse100" style="float: left; width: 100%;">
															<input type="file" style="width: 100%;height:40px;" name="userfile" id="file" />
															<span style="color:red;" id="selectfileerror">&#160;</span><br/>
											                            <a  onclick="return checkemptyval()" style="font-weight:normal;color:#fff;cursor: pointer;" class="myButton_dash">Upload</a>
															<!--<input type="Submit" onclick="return checkemptyval()" name="save" value="Save" class="">-->
														</div>
														<div style="clear: both;">
														</div>
													</div>
												</div>
											</div>
										</div>
								</form>
						</div>
					</div>
					<div style="margin:auto; width: 95%; border:1px solid #CDCDCD;" id="popup1">
						<div class="all-pink-heading" style="float: none;text-shadow:none;">
							Uploaded Photo
						</div>
						<div style="clear:both;">&#160;</div>
						<div id="container_img">
						   <?php 
										
							$getAllImage = "Select * from tbluserimage Where UserId='$_SESSION[UserId]' and IsActive = 1 order by CreatedOn desc";
							$getImage = mysql_query($getAllImage);
							while($row = mysql_fetch_array($getImage))
							     {
								$UploadImageUrl = $row['UploadImageUrl'];
								if(strpos($UploadImageUrl, 'http') !== false){
									$UploadImageUrl = $row['UploadImageUrl'];
								}else{
									$UploadImageUrl = "http://www.filmipassion.com/".$row['UploadImageUrl'];
								}
						       ?>
							    <a href="<?php echo $UploadImageUrl; ?>">
								<figure>
								     <img src="<?php echo $UploadImageUrl; ?>" class="all-cimg-normal" width="100px" height="100px" />
								    <figcaption><a style="font-size:14px;cursor: pointer;" onclick="removeImage('<?php echo $row['Id'] ?>');">Remove</a></figcaption>
								</figure>
							    </a>
						    <?php } ?>
						</div>
					</div>
            </div>
        </div>
    </div>
<style>
.all-cimg-normal {
    border: 2px solid #C3C3C3;
    box-shadow: 0 0 2px #101010;
    cursor: pointer;
    height: 97px;
    max-width: 80.5%;
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
<script>

	function removeImage(removeid){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		var action = 'removeimages.php';
        $.ajax({
            type: 'GET',
            url: action,
            data: {id:removeid},
            success: function (data) {
		window.location="imagesupload.php";
            }
        });
	}

	function checkemptyval() {
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		//$('input:submit').attr("disabled", true);
		if (!CheckVal('file', 'spnPhoneNumber')){
           	 return false;
		}else{
			var formObj=document.getElementById('uploadForm');
 			formObj.action = 'uploadportfolio.php';
 			formObj.method='POST';
	  		document.forms['uploadForm'].submit();
		}
    }
     function CheckVal(txtId, spnID) {
		var errmsg = null;
        var Empty = null;
        var txtval = document.getElementById(txtId).value;
        errmsg = "Please select " + txtId;
		if (txtval == "" || txtval == Empty) {
			alert("Please select image.");
//			$('input:submit').attr("disabled", false);
			disablePopup('pageLoader');
//			$('#' + spnID).text(errmsg);
			$('#' + spnID).show();
			return false;
		}
		return true;

    }
    function GetFbAlbumsGallary() {
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
        GetAlbumsFacebook(GetFbAlbumsCallback);
    }

    function GetFbAlbumsCallback(response) {
        var script = '';

        if (response.Albums.length > 0) {
            for (var i = 0; i < response.Albums.length; i++) {

                var pId = response.ProviderId;
                var imageSrc = response.Albums[i].CoverImage;
                var count = response.Albums[i].Count;
                var name = response.Albums[i].Name;
                var aid = response.Albums[i].Id;

                script = script + '<div class="divfbalbums">' +
                   ' <div style="background-image: url(' + imageSrc + '); height: 155px; width: 150px;" onclick="GetPhotosByAlbumId(' + aid + ')"></div>' +
                   '<p class="divfbalbums-name">' + name + '</p>' +
                   '<p class="divfbalbums-count">' + ((count > 1) ? count + " Photos" : count + " Photo") + '</p>' +
                '</div>';
            }

            $('#divFBAlbums_fb').html(script);
            $('#divFBAlbums_fb').show();
            $('#divPhotosByAlbumsId_fb').hide();
            $('#fbphoto_save_back').hide();
            openFBAlbumPopup("popupOpenFBPhotos_fb");
        }
        else {

        }
    }

    function GetPhotosByAlbumId(id) {
        GetPhotosFromAlbum(GetPhotosByFbAlbumsCallback, id);
    }

    function GetPhotosByFbAlbumsCallback(response) {
        var script = '';

        if (response.PhotosByAlbum.length > 0) {
            //$("#popupOpenFBPhotos_fb").css("margin-top", "-310px");
            for (var i = 0; i < response.PhotosByAlbum.length; i++) {
                var imageSrc = response.PhotosByAlbum[i].ImageUrl;

                script = script + '<div class="divfbalbums2">' +
                    '<img src="' + imageSrc + '" class="img-fb" style="height:160px; width:160px" onclick="OnCheckFbPhotoImage(this)" />' +
                    '<div>' +
                        '<div class="float-left">' +
                            '<input type="checkbox" onclick="OnCheckFbPhoto(this)" />' +
                        '</div>' +
                        '<div class="div-all-pop-chktxt">xyz  </div>' +
                        '<div class="clear"></div>' +
                    '</div>' +
               ' </div>';
            }

            $('#divPhotosByAlbumsId_fb').html(script);
            $('#divFBAlbums_fb').hide();
            $('#divPhotosByAlbumsId_fb').show();
            $('#fbphoto_save_back').show();
        }
        else {

        }
    }

    function returnToAlbums() {
        $('#divFBAlbums_fb').show();
        $('#divPhotosByAlbumsId').hide();
        $('#fbphoto_save_back').hide();
        $('#divPhotosByAlbumsId_fb').html('');
    }

    function OnCheckFbPhotoImage(me) {
        var fbPhotoMe = $(me).parent().find('input:checkbox');
        if (fbPhotoMe.is(':checked')) {
            fbPhotoMe.prop('checked', false);
            $(me).closest('.divfbalbums2').children('.img-fb').removeClass('active-photo-facebook');
        } else {
            var selected = new Array();
            $('input:checked').each(function () {
                selected.push($(this).attr('name'));
            });

            if (selected.length >= 6) {
                alert("You have select Maximum 6 Photos.")
            }
            else {
                fbPhotoMe.prop('checked', true);
                fbPhotoMe.closest('.divfbalbums2').children('.img-fb').addClass('active-photo-facebook');
            }
        }
    }

    function OnCheckFbPhoto(me) {
        var fbPhotoMe = $(me);

        if (fbPhotoMe.is(':checked')) {
            var selected = new Array();
            $('input:checked').each(function () {
                selected.push($(this).attr('name'));
            });

            if (selected.length > 6) {
                fbPhotoMe.prop('checked', false);
                alert("You have select Maximum 6 Photos.");
            }
            else {
                fbPhotoMe.prop('checked', true);
                $(me).closest('.divfbalbums2').children('.img-fb').addClass('active-photo-facebook');
            }

        } else {
            fbPhotoMe.closest('.divfbalbums2').children('.img-fb').removeClass('active-photo-facebook');
        }
    }

    function SavePhotoFromAlbum() {
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
        var imageObj = $("#divPhotosByAlbumsId_fb").find('.active-photo-facebook');
        var imageUrl = "";
        if (imageObj.length > 0) {
            for (var i = 0; i < imageObj.length; i++) {
                imageUrl = imageUrl + "," + $(imageObj[i]).attr('src');
            }
            imageUrl = imageUrl.replace(/^,|,$/g, '');
            SaveGalleryImage(imageUrl);
            OnCancelFBPopup();

            //Update data base and reload page;
        }
        else {
            alert('Please select a image.');
        }
    }

    function SaveGalleryImage(Images) {

        var UserId = "<?php echo $_SESSION['UserId'] ?>";
        var action = 'uploadportfolio.php';
        $.ajax({
            type: 'POST',
            url: action,
            data: { userid: UserId, UploadImageUrl: Images, fromfacebook:'facebook'},
            success: function (data) {
                if (data == 1) {
                    window.location = "imagesupload.php";
					disablePopup('pageLoader');
					OnCancelFBPopup();
                }

            }
        });
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
        margin: 2px 0 0 33px;
        cursor: pointer;
    }

    .divfbalbums-name
    {
        color: #3B5998;
        text-decoration: none;
        font-size: 11px;
        text-align: left;
        word-wrap: break-word;
        padding: 4px 0 0 6px;
    }

    .divfbalbums-count
    {
        color: #808080;
        font-size: 11px;
        line-height: inherit;
        font-weight: normal;
        padding: 0px 0 0 6px;
    }

    .div-all-pop-chktxt
    {
        color: #808080;
        font-size: 11px;
        float: left;
    }
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
<div id="popupOpenFBPhotos_fb" class="popupOpenFBPhotoss">
    <div class="popup_inner">
        <div style="height: 35px;">
            <div class="popup_header">
                <div id="Sharedivtype1" class="popup-top-txt">
                    Facebook Albums<span style="float:right;margin-right:1px;cursor: pointer;"><img onclick="OnCancelFBPopup();" width="20px" height="20px" src="images/close_pop.png" /></span>
                </div>
            </div>
        </div>
        <div>
            <div id="divFBAlbums_fb" style="display: none;">
            </div>
            <div id="divPhotosByAlbumsId_fb" style="display: none;">
            </div>
            <div style="clear: both;"></div>
            <div id="fbphoto_save_back">

                <div style="text-align: center; margin-top: 20px; margin-bottom: 1px;">
                    <div style="float:left"><input type="Submit" onclick="SavePhotoFromAlbum()" name="done" value="Done" class=""></div>
                    <div style="margin-left:10px;float:left"><input type="Submit" onclick="returnToAlbums()" name="back" value="Back" style="margin-left: 0px;" class=""></div>
                </div>
            </div>
            <div style="height: 10px;">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function openFBAlbumPopup(ID) {
        var popID = ID;
        var popmaxWidth = 235;
        $('#' + popID).fadeIn().prepend('<a href="#" class="close"><img onclick="OnCancelFBPopup();" class="btn_close" src="/images/close_pop.png" style="margin-left: 840px;  width: 20px;" class="embedlbtn_close" title="Close Window" alt="" /></a>');
//        $('#' + popID).fadeIn().css({ 'width': Number(popmaxWidth) }).prepend('<a href="#" class="close"><img onclick="OnCancelFBPopup();" class="btn_close" src="/images/close_pop.png" style="margin-left: 840px;  width: 20px;" class="embedlbtn_close" title="Close Window" alt="Close" /></a>');
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
            $("#popupOpenFBPhotos_fb").hide();
        });
    }


</script>
    <script type="text/javascript">
	function UploadImage(){
		var ele = document.getElementById("popup1");
	 
		if(ele.style.display == "block") {
			 ele.style.display = "none";
    			$('#popup1').fadeOut();
 	 	}
		else {
			 ele.style.display = "block";
    			$('#popup1').fadeIn();
		}
	}
	function CloseDiv(){
		var ele = document.getElementById("popup1");
	 
		if(ele.style.display == "block") {
			 ele.style.display = "none";
    			$('#popup1').fadeOut();
 	 	}
		else {
			 ele.style.display = "block";
    			$('#popup1').fadeIn();
		}
	}
    </script>
    <?php include('footer.php')?>