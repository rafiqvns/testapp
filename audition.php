<?php include('header.php');?>
<?php
//include('config.php');
include ('paginate.php'); //include of paginat page

if(isset($_SESSION['UserId'])){
	$userMobileSql = "select ContactNumber from tbluserpersonaldetails where UserId=".$_SESSION['UserId'];
	$userMobileDetail = mysql_query($userMobileSql);
	$userMobileNumber = '';
		while($row = mysql_fetch_array($userMobileDetail)){
			$userMobileNumber = $row['ContactNumber'];
		}
}

$per_page = 3;         // number of results to show per page

//$result = mysql_query("select *,p.ProductionName, a.Id as auditionid from tblaudition a left join tblproductiondetails p on a.userId = p.Userid order by a.Id desc");
$result = mysql_query("select p.ProductionName,p.UserId as prid,p.ThumbnailImage,p.ContactNumber, a.* from tblaudition a left join tblproductiondetails p on a.userId = p.Userid Where a.IsPublish=true and a.IsActive=1 and p.IsActive = 1 and p.IsApprooved = 1 and p.IsDeleted = 0  order by a.Id desc");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);//total pages we going to have
//-------------if page is setcheck------------------//
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will telles the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
	$show_page = 1;
    $start = 0;
    $end = $per_page;
}
// display pagination
$page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;

?>
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
.ui-body-c, .ui-overlay-c {
    background: none;
    border: 0px solid #AAAAAA;
    color: #333333;
    text-shadow: 0 0px 0 #FFFFFF;
}

.pagination{height:40px;margin:20px 30px 0px -10px}

.pagination li{display:inline}.pagination a,.pagination span{float:left;padding:0 14px;line-height:38px;text-decoration:none;background-color:#fff;border:1px solid #ddd;border-radius: 3px}.pagination a:hover,.pagination .active a,.pagination .active span{background-color:#f5f5f5}.pagination .active a,.pagination .active span{color:#999;cursor:default}.pagination .disabled span,.pagination .disabled a,.pagination .disabled a:hover{color:#999;cursor:default;background-color:transparent}.pagination li:first-child a,.pagination li:first-child span{border-left-width:1px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.pagination li:last-child a,.pagination li:last-child span{-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.pagination-centered{text-align:center}.pagination-right{text-align:right}.pager{margin:20px 0;text-align:center;list-style:none;*zoom:1}.pager:before,.pager:after{display:table;line-height:0;content:""}.pager:after{clear:both}.pager li{display:inline}.pager a{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px}.pager a:hover{text-decoration:none;background-color:#f5f5f5}.pager .next a{float:right}.pager .previous a{float:left}.pager .disabled a,.pager .disabled a:hover{color:#999;cursor:default;background-color:#fff}.modal-open .dropdown-menu{z-index:2050}.modal-open .dropdown.open{*z-index:2050}.modal-open .popover{z-index:2060}.modal-open .tooltip{z-index:2080}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}.modal-backdrop.fade{opacity:0}.modal-backdrop,.modal-backdrop.fade.in{opacity:.8;filter:alpha(opacity=80)}.modal{position:fixed;top:50%;left:50%;z-index:1050;width:560px;margin:-250px 0 0 -280px;overflow:auto;background-color:#fff;border:1px solid #999;border:1px solid rgba(0,0,0,0.3);*border:1px solid #999;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 3px 7px rgba(0,0,0,0.3);-moz-box-shadow:0 3px 7px rgba(0,0,0,0.3);box-shadow:0 3px 7px rgba(0,0,0,0.3);-webkit-background-clip:padding-box;-moz-background-clip:padding-box;background-clip:padding-box}.modal.fade{top:-25%;-webkit-transition:opacity .3s linear,top .3s ease-out;-moz-transition:opacity .3s linear,top .3s ease-out;-o-transition:opacity .3s linear,top .3s ease-out;transition:opacity .3s linear,top .3s ease-out}.modal.fade.in{top:50%}.modal-header{padding:9px 15px;border-bottom:1px solid #eee}.modal-header .close{margin-top:2px}.modal-header h3{margin:0;line-height:30px}.modal-body{max-height:400px;padding:15px;overflow-y:auto}.modal-form{margin-bottom:0}.modal-footer{padding:14px 15px 15px;margin-bottom:0;text-align:right;background-color:#f5f5f5;border-top:1px solid #ddd;-webkit-border-radius:0 0 6px 6px;-moz-border-radius:0 0 6px 6px;border-radius:0 0 6px 6px;*zoom:1;-webkit-box-shadow:inset 0 1px 0 #fff;-moz-box-shadow:inset 0 1px 0 #fff;box-shadow:inset 0 1px 0 #fff}.modal-footer:before,.modal-footer:after{display:table;line-height:0;content:""}.modal-footer:after{clear:both}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}.modal-footer .btn-group .btn+.btn{margin-left:-1px}.tooltip{position:absolute;z-index:1030;display:block;padding:5px;opacity:0;filter:alpha(opacity=0);visibility:visible}.tooltip.in{opacity:.8;filter:alpha(opacity=80)}.tooltip.top{margin-top:-3px}.tooltip.right{margin-left:3px}.tooltip.bottom{margin-top:3px}.tooltip.left{margin-left:-3px}.tooltip-inner{max-width:200px;padding:3px 8px;color:#fff;text-align:center;text-decoration:none;background-color:#000;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.tooltip-arrow{position:absolute;width:0;height:0;border-color:transparent;border-style:solid}.tooltip.top .tooltip-arrow{bottom:0;left:50%;margin-left:-5px;border-top-color:#000;border-width:5px 5px 0}.tooltip.right .tooltip-arrow{top:50%;left:0;margin-top:-5px;border-right-color:#000;border-width:5px 5px 5px 0}.tooltip.left .tooltip-arrow{top:50%;right:0;margin-top:-5px;border-left-color:#000;border-width:5px 0 5px 5px}.tooltip.bottom .tooltip-arrow{top:0;left:50%;margin-left:-5px;border-bottom-color:#000;border-width:0 5px 5px}.popover{position:absolute;top:0;left:0;z-index:1010;display:none;width:236px;padding:1px;background-color:#fff;border:1px solid #ccc;border:1px solid rgba(0,0,0,0.2);-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,0.2);-moz-box-shadow:0 5px 10px rgba(0,0,0,0.2);box-shadow:0 5px 10px rgba(0,0,0,0.2);-webkit-background-clip:padding-box;-moz-background-clip:padding;background-clip:padding-box}.popover.top{margin-bottom:10px}.popover.right{margin-left:10px}.popover.bottom{margin-top:10px}.popover.left{margin-right:10px}.popover-title{padding:8px 14px;margin:0;font-size:14px;font-weight:normal;line-height:18px;background-color:#f7f7f7;border-bottom:1px solid #ebebeb;-webkit-border-radius:5px 5px 0 0;-moz-border-radius:5px 5px 0 0;border-radius:5px 5px 0 0}.popover-content{padding:9px 14px}.popover-content p,.popover-content ul,.popover-content ol{margin-bottom:0}.popover .arrow,.popover .arrow:after{position:absolute;display:inline-block;width:0;height:0;border-color:transparent;border-style:solid}.popover .arrow:after{z-index:-1;content:""}.popover.top .arrow{bottom:-10px;left:50%;margin-left:-10px;border-top-color:#fff;border-width:10px 10px 0}.popover.top .arrow:after{bottom:-1px;left:-11px;border-top-color:rgba(0,0,0,0.25);border-width:11px 11px 0}.popover.right .arrow{top:50%;left:-10px;margin-top:-10px;border-right-color:#fff;border-width:10px 10px 10px 0}.popover.right .arrow:after{bottom:-11px;left:-1px;border-right-color:rgba(0,0,0,0.25);border-width:11px 11px 11px 0}.popover.bottom .arrow{top:-10px;left:50%;margin-left:-10px;border-bottom-color:#fff;border-width:0 10px 10px}.popover.bottom .arrow:after{top:-1px;left:-11px;border-bottom-color:rgba(0,0,0,0.25);border-width:0 11px 11px}.popover.left .arrow{top:50%;right:-10px;margin-top:-10px;border-left-color:#fff;border-width:10px 0 10px 10px}.popover.left .arrow:after{right:-1px;bottom:-11px;border-left-color:rgba(0,0,0,0.25);border-width:11px 0 11px 11px}.thumbnails{margin-left:-20px;list-style:none;*zoom:1}.thumbnails:before,.thumbnails:after{display:table;line-height:0;content:""}.thumbnails:after{clear:both}.row-fluid .thumbnails{margin-left:0}.thumbnails>li{float:left;margin-bottom:20px;margin-left:20px}.thumbnail{display:block;padding:4px;line-height:20px;border:1px solid #ddd;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,0.055);-moz-box-shadow:0 1px 3px rgba(0,0,0,0.055);box-shadow:0 1px 3px rgba(0,0,0,0.055);-webkit-transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out}a.thumbnail:hover{border-color:#08c;-webkit-box-shadow:0 1px 4px rgba(0,105,214,0.25);-moz-box-shadow:0 1px 4px rgba(0,105,214,0.25);box-shadow:0 1px 4px rgba(0,105,214,0.25)}.thumbnail>img{display:block;max-width:100%;margin-right:auto;margin-left:auto}.thumbnail .caption{padding:9px;color:#555}.label,.badge{font-size:11.844px;font-weight:bold;line-height:14px;color:#fff;text-shadow:0 -1px 0 rgba(0,0,0,0.25);white-space:nowrap;vertical-align:baseline;background-color:#999}.label{padding:1px 4px 2px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.badge{padding:1px 9px 2px;-webkit-border-radius:9px;-moz-border-radius:9px;border-radius:9px}a.label:hover,a.badge:hover{color:#fff;text-decoration:none;cursor:pointer}.label-important,.badge-important{background-color:#b94a48}.label-important[href],.badge-important[href]{background-color:#953b39}.label-warning,.badge-warning{background-color:#f89406}.label-warning[href],.badge-warning[href]{background-color:#c67605}.label-success,.badge-success{background-color:#468847}.label-success[href],.badge-success[href]{background-color:#356635}.label-info,.badge-info{background-color:#3a87ad}.label-info[href],.badge-info[href]{background-color:#2d6987}.label-inverse,.badge-inverse{background-color:#333}.label-inverse[href],.badge-inverse[href]{background-color:#1a1a1a}.btn .label,.btn .badge{position:relative;top:-1px}.btn-mini .label,.btn-mini .badge{top:0}@-webkit-keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}@-moz-keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}@-ms-keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}@-o-keyframes progress-bar-stripes{from{background-position:0 0}to{background-position:40px 0}}@keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}.progress{height:20px;margin-bottom:20px;overflow:hidden;background-color:#f7f7f7;background-image:-moz-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:-webkit-gradient(linear,0 0,0 100%,from(#f5f5f5),to(#f9f9f9));background-image:-webkit-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:-o-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:linear-gradient(to bottom,#f5f5f5,#f9f9f9);background-repeat:repeat-x;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#fff5f5f5',endColorstr='#fff9f9f9',GradientType=0);-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,0.1);-moz-box-shadow:inset 0 1px 2px rgba(0,0,0,0.1);box-shadow:inset 0 1px 2px rgba(0,0,0,0.1)}.progress .bar{float:left;width:0;height:100%;font-size:12px;color:#fff;text-align:center;text-shadow:0 -1px 0 rgba(0,0,0,0.25);background-color:#0e90d2;background-image:-moz-linear-gradient(top,#149bdf,#0480be);background-image:-webkit-gradient(linear,0 0,0 100%,from(#149bdf),to(#0480be));background-image:-webkit-linear-gradient(top,#149bdf,#0480be);background-image:-o-linear-gradient(top,#149bdf,#0480be);background-image:linear-gradient(to bottom,#149bdf,#0480be);background-repeat:repeat-x;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#ff149bdf',endColorstr='#ff0480be',GradientType=0);-webkit-box-shadow:inset 0 -1px 0 rgba(0,0,0,0.15);-moz-box-shadow:inset 0 -1px 0 rgba(0,0,0,0.15);box-shadow:inset 0 -1px 0 rgba(0,0,0,0.15);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-transition:width .6s ease;-moz-transition:width .6s ease;-o-transition:width .6s ease;transition:width .6s ease}.progress .bar+.bar{-webkit-box-shadow:inset 1px 0 0 rgba(0,0,0,0.15),inset 0 -1px 0 rgba(0,0,0,0.15);-moz-box-shadow:inset 1px 0 0 rgba(0,0,0,0.15),inset 0 -1px 0 rgba(0,0,0,0.15);box-shadow:inset 1px 0 0 rgba(0,0,0,0.15),inset 0 -1px 0 rgba(0,0,0,0.15)}.progress-striped .bar{background-color:#149bdf;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);-webkit-background-size:40px 40px;-moz-background-size:40px 40px;-o-background-size:40px 40px;background-size:40px 40px}.progress.active .bar{-webkit-animation:progress-bar-stripes 2s linear infinite;-moz-animation:progress-bar-stripes 2s linear infinite;-ms-animation:progress-bar-stripes 2s linear infinite;-o-animation:progress-bar-stripes 2s linear infinite;animation:progress-bar-stripes 2s linear infinite}.progress-danger .bar,.progress .bar-danger{background-color:#dd514c;background-image:-moz-linear-gradient(top,#ee5f5b,#c43c35);background-image:-webkit-gradient(linear,0 0,0 100%,from(#ee5f5b),to(#c43c35));background-image:-webkit-linear-gradient(top,#ee5f5b,#c43c35);background-image:-o-linear-gradient(top,#ee5f5b,#c43c35);background-image:linear-gradient(to bottom,#ee5f5b,#c43c35);background-repeat:repeat-x;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#ffee5f5b',endColorstr='#ffc43c35',GradientType=0)}.progress-danger.progress-striped .bar,.progress-striped .bar-danger{background-color:#ee5f5b;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}.progress-success .bar,.progress .bar-success{background-color:#5eb95e;background-image:-moz-linear-gradient(top,#62c462,#57a957);background-image:-webkit-gradient(linear,0 0,0 100%,from(#62c462),to(#57a957));background-image:-webkit-linear-gradient(top,#62c462,#57a957);background-image:-o-linear-gradient(top,#62c462,#57a957);background-image:linear-gradient(to bottom,#62c462,#57a957);background-repeat:repeat-x;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#ff62c462',endColorstr='#ff57a957',GradientType=0)}.progress-success.progress-striped .bar,.progress-striped .bar-success{background-color:#62c462;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}.progress-info .bar,.progress .bar-info{background-color:#4bb1cf;background-image:-moz-linear-gradient(top,#5bc0de,#339bb9);background-image:-webkit-gradient(linear,0 0,0 100%,from(#5bc0de),to(#339bb9));background-image:-webkit-linear-gradient(top,#5bc0de,#339bb9);background-image:-o-linear-gradient(top,#5bc0de,#339bb9);background-image:linear-gradient(to bottom,#5bc0de,#339bb9);background-repeat:repeat-x;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#ff5bc0de',endColorstr='#ff339bb9',GradientType=0)}.progress-info.progress-striped .bar,.progress-striped .bar-info{background-color:#5bc0de;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}.progress-warning .bar,.progress .bar-warning{background-color:#faa732;background-image:-moz-linear-gradient(top,#fbb450,#f89406);background-image:-webkit-gradient(linear,0 0,0 100%,from(#fbb450),to(#f89406));background-image:-webkit-linear-gradient(top,#fbb450,#f89406);background-image:-o-linear-gradient(top,#fbb450,#f89406);background-image:linear-gradient(to bottom,#fbb450,#f89406);background-repeat:repeat-x;filter:progid:dximagetransform.microsoft.gradient(startColorstr='#fffbb450',endColorstr='#fff89406',GradientType=0)}.progress-warning.progress-striped .bar,.progress-striped .bar-warning{background-color:#fbb450;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}.accordion{margin-bottom:20px}.accordion-group{margin-bottom:2px;border:1px solid #e5e5e5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.accordion-heading{border-bottom:0}.accordion-heading .accordion-toggle{display:block;padding:8px 15px}.accordion-toggle{cursor:pointer}.accordion-inner{padding:9px 15px;border-top:1px solid #e5e5e5}.carousel{position:relative;margin-bottom:20px;line-height:1}.carousel-inner{position:relative;width:100%;overflow:hidden}.carousel .item{position:relative;display:none;-webkit-transition:.6s ease-in-out left;-moz-transition:.6s ease-in-out left;-o-transition:.6s ease-in-out left;transition:.6s ease-in-out left}.carousel .item>img{display:block;line-height:1}.carousel .active,.carousel .next,.carousel .prev{display:block}.carousel .active{left:0}.carousel .next,.carousel .prev{position:absolute;top:0;width:100%}.carousel .next{left:100%}.carousel .prev{left:-100%}.carousel .next.left,.carousel .prev.right{left:0}.carousel .active.left{left:-100%}.carousel .active.right{left:100%}.carousel-control{position:absolute;top:40%;left:15px;width:40px;height:40px;margin-top:-20px;font-size:60px;font-weight:100;line-height:30px;color:#fff;text-align:center;background:#222;border:3px solid #fff;-webkit-border-radius:23px;-moz-border-radius:23px;border-radius:23px;opacity:.5;filter:alpha(opacity=50)}.carousel-control.right{right:15px;left:auto}.carousel-control:hover{color:#fff;text-decoration:none;opacity:.9;filter:alpha(opacity=90)}.carousel-caption{position:absolute;right:0;bottom:0;left:0;padding:15px;background:#333;background:rgba(0,0,0,0.75)}.carousel-caption h4,.carousel-caption p{line-height:20px;color:#fff}.carousel-caption h4{margin:0 0 5px}.carousel-caption p{margin-bottom:0}.hero-unit{padding:60px;margin-bottom:30px;background-color:#eee;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px}.hero-unit h1{margin-bottom:0;font-size:60px;line-height:1;letter-spacing:-1px;color:inherit}.hero-unit p{font-size:18px;font-weight:200;line-height:30px;color:inherit}.pull-right{float:right}.pull-left{float:left}.hide{display:none}.show{display:block}.invisible{visibility:hidden}.affix{position:fixed}.mini-layout{border:1px solid #DDD;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 1px 2px rgba(0,0,0,.075);-moz-box-shadow:0 1px 2px rgba(0,0,0,.075);box-shadow:0 1px 2px rgba(0,0,0,.075);margin-bottom:20px;padding:9px}
</style>
<div style="float: none;text-shadow:none;" class="all-pink-heading">
            Audition Detail <span style="float:right;color:#fff;cursor:pointer;"><a onclick="forBack();" style="color:#fff;">Back</a></span>
        </div>
<?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
                    echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";?>
<div class="login-content">
	<div id="content" style="min-height: 459px;">
	 <?php
		for ($i = $start; $i < $end; $i++) {
			$BannerImage = mysql_result($result, $i, 'ThumbnailImage');
			if($BannerImage==null || $BannerImage==''){
				$BannerImage="images/no_image.jpg";	
			}
			$BannerImage = "http://www.filmipassion.com/".$BannerImage;
			if(mysql_result($result, $i, 'AuditionTitle')!=null || mysql_result($result, $i, 'ProductionName')!=null){
	 ?>
		<div style="padding-top: 10px; display: block; opacity: 1;" class="pro-content-row" id="div_14">
			<div style="margin-top: 5px;">
			    <div style="">
				<div class="img-border100p margin-right10">
				    <img style="margin-right:20px;float:left;width:100px; height:100px;" src="<?php echo $BannerImage ?>" alt="Image Required">
				</div>
				<div style="float: right; width: 66%;height:126px;">
				    <div class="txt-color-pink">
						<?php echo substr(mysql_result($result, $i, 'AuditionTitle'),0,27); ?>
				    </div>
				    <div class="txt-color-pink">
                       		 <?php echo mysql_result($result, $i, 'ProductionName') ?>
                                </div>
				    <div class="txt-color-pink" style="">
					LastDate To Apply :&nbsp;&nbsp;&nbsp;   <?php echo substr( mysql_result($result, $i, 'LastDateToApply'),0,11) ?>
				    </div>
				    <div style="margin-top: 5px; color: #757575; height: 40px;font-size:12px;">
					<?php echo substr(mysql_result($result, $i, 'AuditionDescription'),0,50); ?>... &#160; 
					<!--<a href="auditiondetails.php?id=<?php echo mysql_result($result, $i, 'Id') ?>">View Details</a>-->
					<a style="cursor:pointer;font-size:12px;" onclick="checkLogin('<?php echo isset($_SESSION['UserId']) ?>','<?php echo mysql_result($result, $i, 'Id') ?>');">View Details</a><br/>
						<?php
							if(isset($_SESSION['UserId'])){
								$checkapplySql= "select * from tbluserrequest where ProductionHouseId='".mysql_result($result, $i, 'prid')."' and UserId='".$_SESSION['UserId']."' and AuditionId='".mysql_result($result, $i, 'Id')."' ";
								$applyDetail= mysql_query($checkapplySql);
								if(mysql_num_rows($applyDetail)==0){
						 ?>	
							<form style="display:none;" action="applyaudition.php" id="applyauditionid<?php echo mysql_result($result, $i, 'Id'); ?>" name="applyauditionid<?php echo mysql_result($result, $i, 'Id'); ?>" method="POST">
								<input type="hidden" name="productionid" value="<?php echo mysql_result($result, $i, 'prid'); ?>"/>
								<input type="hidden" name="auditionid" value="<?php echo mysql_result($result, $i, 'Id'); ?>"/>
								<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['UserId'] ?>" />
								<input type="hidden" name="selectpage" id="selectpage" value="Audition" />
								<input type="hidden" name="pagenumber" id="pagenumber" value="<?php echo  $_GET['page'] ?>" />

							</form>		
							<a style="font-size:14px" href="#" onclick="applyAudtion('<?php echo $_SESSION['UserId'] ?>','<?php echo mysql_result($result, $i, 'Id'); ?>','<?php echo $userMobileNumber; ?>');">
								<div class="pink-btn">Apply For Audition</div>
							</a>
						<?php }else{ ?>
							<a style="font-size:14px" href="#">
								<div class="pink-btn">Already Applied</div>
							</a>
						<?php }} ?>
				    </div>

				</div>
				
				<div style="clear: both;height:5px;">&#160;</div>
				
			    </div>
				<?php
					if(isset($_SESSION['UserId'])){
				?>
			    <div style="clear: both;height:5px;">&#160;</div>
				<?php } ?>
			</div>
		  </div>
		  <?php }} ?>
	</div>
	<script>
	function forBack(){
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		window.location="index.php";
	}

	function applyAudtion(loginuser,auid,usercontactnumber)
	{
		callJQureyMagicPopUp('pageLoader','pageLoaderClose');
		if(loginuser==null && loginuser==''){
			alert('Please login to your Facebook account!');
			window.location="index.php";
			try{
				disablePopup('pageLoader');
			}catch(e){}
		}else if(usercontactnumber==null || usercontactnumber==''){
			callJQureyMagicPopUp('pageLoader','pageLoaderClose');
			alert("Please update your mobile number.");
			window.location="uploadprofile.php";
		}else{
			var formObj=document.getElementById('applyauditionid'+auid);
			formObj.action = 'applyaudition.php';
			formObj.method='POST';
			document.forms['applyauditionid'+auid].submit();
		}
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
						window.location="index.php";
					}
			}
	</script>
</div>
<?php include('footer.php');?>
