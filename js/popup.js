/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;
var globaldivid;
//loading popup with jQuery magic!
	function loadPopup( divid){
		//loads popup only if it is disabled
		if(popupStatus==0){
			$("#backgroundPopup").css({
				"opacity": "0.7"
			});
			$("#backgroundPopup").fadeIn("slow");
			$("#"+divid).fadeIn("slow");
			popupStatus = 1;
		}
	}

//disabling popup with jQuery magic!
	function disablePopup( divid){
		//disables popup only if it is enabled
		if(popupStatus==1){
			$("#backgroundPopup").fadeOut("slow");
			$("#"+divid).fadeOut("slow");
			popupStatus = 0;
		}
	}
	
	function disablePopup( ){
		//disables popup only if it is enabled
		if(popupStatus==1){
			$("#backgroundPopup").fadeOut("slow");
			$("#"+globaldivid).fadeOut("slow");
			popupStatus = 0;
		}
	}

// Generalised method for any divid by kamlesh
	
	function callJQureyMagicPopUp( divid, divClose, windowWidth, windowHeight){
		globaldivid = divid;
		var windowWidth = document.documentElement.clientWidth;
	    var windowHeight = document.documentElement.clientHeight;
	    var popupHeight = $("#"+divid).height();
	    var popupWidth = $("#"+divid).width();
	    var top = ($("#"+divid).offset().top - popupHeight) + 250;
	    
		$("#"+divid).css({
			"position": "fixed",
			"top": windowHeight / 2 - popupHeight / 2,
	        "left": windowWidth / 2 - popupWidth / 2
		});
	
		//only need force for IE6
		$("#backgroundPopup").css({
			"height": windowHeight
		});
		loadPopup(divid);
		$(window).scroll(function () {
	   		var windowHeight = document.documentElement.clientHeight;
	        var popupHeight = $("#"+divid).height();
	        $("#"+divid).css({
	        	"position": "fixed",
	            "top": windowHeight / 2 - popupHeight / 2
	         	});
	    });
		
		//CLOSING POPUP
		//Click the x event!
		$("#"+divClose).click(function(){
			disablePopup(divid);
		});
		//Click out event!
		//$("#backgroundPopup").click(function(){
		//	disablePopup(divid);
		//});
	}
	
	
	//Press Escape event!
	//$(document).keypress(function(e){
		//if(e.keyCode==27 && popupStatus==1){
		//	disablePopup(globaldivid);
		//}
	//});
	
	
	
	 
	