</div>
<div class="footer-main">
            <div align="center" class="footer-inner">
                <div class="footer-menu-txt" style="width:75px;">
                    <span onclick="indexPage()" class="footer-nav-link">Home</span>
                </div>
                <div class="footer-menu-txt" style="width:127px;">
                    <span onclick="aboutuspage()" class="footer-nav-link">About Us</span>
                </div>
                <div class="footer-menu-txt">
                    <span onclick="contactuspage()" class="footer-nav-link">Contact Us</span>
                </div>
                <div class="clear" style="height:5px;">&#160;
                </div>
                <div class="LucidaGrande footer-reserved-txt">
                    filmipassion 2014 . All rights reserved
                </div>
                <div class="clear" style="height:5px;">&#160;
                </div>
            </div>
        </div>
		<script>
			function indexPage(){
				callJQureyMagicPopUp('pageLoader','pageLoaderClose');
				window.location="index.php";
			}
			function aboutuspage(){
				callJQureyMagicPopUp('pageLoader','pageLoaderClose');
				window.location="aboutus.php";
			}
			function contactuspage(){
				callJQureyMagicPopUp('pageLoader','pageLoaderClose');
				window.location="contactus.php";
			}
		</script>
</body>
</html>