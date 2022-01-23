@*---------------------- Facebook album script start -------------------------------*@
<script>
    function GetFbAlbums()
    {
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
        {    $("#popupOpenFBPhotos").css("margin-top","-310px");
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
        var imageObj=$("#divPhotosByAlbumsId").find('.active-photo-facebook');
        if(imageObj.length>0)
        {
            var imageUrl=imageObj.attr('src');

            $('#imgProfileImage1').attr('src',imageUrl);
            $('#hdnUserImage').val(imageUrl);

            $('#hdnImgUloadType').val('');
            $('#hdnImgUloadType').val('1');  // 2 for Upload pics

            //$('#imgProfileImage1').css("width","100px");  $('#imgProfileImage1').css("height","100px");
           
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
        margin: 20px 0 0 15px;
        cursor: pointer;
    }

    .divfbalbums2
    {
        height: 184px;
        width: 150px;
        border: 1px solid #cccccc;
        float: left;
        margin: 73px 0 0 15px;
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
        padding: 0px 0 0 6px;
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
                    Your Facebook Albums
                </div>
            </div>
        </div>
        <div>
            <div id="divFBAlbums" style="max-height: 435px; overflow: auto; display: none;">
                @*<div class="divfbalbums">
                    <div style="background-image: url(); height: 160px; width: 160px;" onclick="GetPhotosByAlbumId('')"></div>
                    <p class="divfbalbums-name">Photo name</p>
                    <p class="divfbalbums-count">10 Photos</p>
                </div>*@
            </div>
            <div id="divPhotosByAlbumsId" style="max-height: 435px; overflow: auto; display: none;">
                @*<div class="divfbalbums2">
                    <img src="http://graph.facebook.com/100001110638422/picture?height=300&type=normal&width=300" class="img-fb" height="160" width="160" pid="123456789" onclick="OnCheckFbPhotoImage(this)" />
                    <div>
                        <div class="float-left">
                            <input type="checkbox" onclick="OnCheckFbPhoto(this)" />
                        </div>
                        <div class="div-all-pop-chktxt">xyz  </div>
                        <div class="clear"></div>
                    </div>
                </div>*@
            </div>
            <div style="clear: both;"></div>
            <div id="fbphoto_save_back">

                <div style="text-align: center; margin-top: 20px; margin-bottom: 15px;">
                    <input type="Submit" onclick="SavePhotoFromAlbum()" name="done" value="Done" class="pink-btn">
                    <input type="Submit" onclick="returnToAlbums()" name="back" value="Back" style="margin-left: 20px;" class="pink-btn">
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
        top: 50%;
        left: 50%;
        z-index: 99999; /*--CSS3 Box Shadows--*/
        -webkit-box-shadow: 0px 0px 20px #000;
        -moz-box-shadow: 0px 0px 20px #000;
        box-shadow: 0px 0px 20px #000; /*--CSS3 Rounded Corners--*/
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
    }
</style>


<script type="text/javascript">
        function openFBAlbumPopup(ID) {
            var popID = ID;
            var popmaxWidth = 865;
            $('#' + popID).fadeIn().css({ 'width': Number(popmaxWidth) }).prepend('<a href="#" class="close"><img onclick="OnCancelFBPopup();" class="btn_close" src="/images/close_pop.png" style="margin-left: 840px;  width: 20px;" class="embedlbtn_close" title="Close Window" alt="Close" /></a>');
            var popMargTop = ($('#' + popID).height() + 80) / 2;
            var popMargLeft = ($('#' + popID).width() + 80) / 2;
            $('#' + popID).css({
                'margin-top': -popMargTop,
                'margin-left': -popMargLeft
            });
            $('body').append('<div id="fade1"></div>');
            $('#fade1').css({ 'filter': 'alpha(opacity=80)' }).fadeIn();
        }

        function OnCancelFBPopup() {
            $('#fade1 , .Masterpopup_block').fadeOut(function () {
                $('#fade1, a.close').remove();
                $("#popupOpenFBPhotos").hide();
                $("#ConfirmPopup").hide();
                
            });
        }
       

    </script>
	
@*---------------------- Facebook album script end -------------------------------*@