<!DOCTYPE html lang="en-US">
<html>
<head>
    <meta name="viewport" content="width=device-width, maximum-scale = 1, minimum-scale=1">
    <title>Filmi Passion</title>
    <meta name='robots' content='noindex,nofollow' />
	<link rel="icon" type="image/png" href="images/favicon.ico" />
    <link rel='stylesheet' id='style-css' href='css/style.css' type='text/css' media='all' />
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="js/SocialMediaV2.js"></script>
	<script type="text/javascript" src="js/jquery.devrama.slider.js"></script>
	<script type="text/javascript" src="js/jquery.infinitecarousel2_0_2.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script src="js/popup.js"></script>
	

</head>
<body>
        <!-----------------------------Header------------------------------------>
<?php
	include('config.php');
?>
<div class="ind-main-outer" style="">
        <!-----------------------------Header------------------------------------>
		<div id='pageLoader' style="text-align:center" style='display:none;'>
			<img src="images/ajax-loader.gif" alt="Please wait.."/>
		</div>
		<div id="backgroundPopup"></div>
        <div style="width:100%">
            <div class="ind-img-t-space">
                <a href="index.php" target="_blank">
					<div class="logo">
						<img width="150" src="images/logo.png">
					</div>
				</a>
            </div>
	    <?php if(isset($_SESSION['UserId'])){ 
			
			$FBimage = $_SESSION['FBimage'];
			if(strpos($FBimage, 'http') !== false){
				$FBimage = $_SESSION['FBimage'];
			}else{
				$FBimage = "http://www.filmipassion.com/".$_SESSION['FBimage'];
			}
	    ?>
           	<div style="float:right;">
				<div style="background-color: #F7F7F7;border: 1px solid #E8E8E8;color: #000;height: 29px;margin: auto;padding: 1px;top: 18px;width: 110px;font-size:12px;">
				
					<div class="img-border32 margin-right5" style="padding:0px;">
						<a onclick="homePage()" style="cursor: pointer;" ><img src="<?php echo $FBimage; ?>" style="border-width: 0px;"></a>
					</div>
					<div class="detail">
						<a style="color: #000;margin-top:0px;cursor: pointer;" onclick="homePage()" class="fl100 link_violet"><?php echo substr($_SESSION['First_Name'],0,10); ?></a> 
						<a onclick="homePage()" style="cursor: pointer;" class="float-left">Home</a>
					</div>
				</div>
	     	</div>
            <?php } ?>
            <div class="clear" style="height:1px;">
            </div>
        </div>
		<!--<?php if(isset($_SESSION['UserId'])){ ?>
			<header id="header">
				<div class="account-info">
					<div class="img-border32 margin-right5">
						<img src="<?php echo $_SESSION['FBimage'] ?>" style="border-width: 0px;">
					</div>
					<div class="detail">
						<a style="color: #F50E55" href="#" class="fl100 link_violet"><?php echo $_SESSION['First_Name'] ?> </a> 
							<a href="index.php" class="float-left">Home</a>
							<span class="float-left margin-left10 margin-right10">|</span>
							<a href="logout.php" class="float-left">Logout</a>
					</div>
				</div>
			</header>
		<?php } ?>

		<?php if(isset($_SESSION['UserId'])){ ?>
			<header id="header">
				<div class="account-info">
					<div class="img-border32 margin-right5">
						<img src="<?php echo $_SESSION['FBimage'] ?>" style="border-width: 0px;">
					</div>
					<div class="detail">
						<a style="color: #F50E55" href="#" class="fl100 link_violet"><?php echo $_SESSION['First_Name'] ?> <?php echo $_SESSION['Last_Name'] ?></a> <a href="index.php" class="float-left">Home</a>
							<span class="float-left margin-left10 margin-right10">|</span>
							<a href="logout.php" class="float-left">Logout</a>
					</div>
				</div>
			</header>
		<?php } ?>-->
        <!-----------------------------Header End------------------------------------>
		<script>
		try{
		    (function (i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date(); a = s.createElement(o),
				m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
			ga('create', 'UA-48613944-1', 'filmipassion.com');
			ga('send', 'pageview');
		}catch(e){}
		function homePage(){
			callJQureyMagicPopUp('pageLoader','pageLoaderClose');
			window.location="index.php";
		}
		</script>
