<?php include('header.php');?>
<?php
include('config.php');

$audtionSql = "select *,p.ProductionName, a.Id as auditionid from tblaudition a left join tblproductiondetails p on a.userId = p.Userid order by a.Id desc limit 8 ";
$auditionDetail = mysql_query($audtionSql);

?>
<div style="clear:both;">&#160;</div>
<div style="float: none;text-shadow:none;" class="all-pink-heading">
            Audition Detail <span style="float:right;color:#fff;"><a href="index.php" style="color:#fff;">Back</a></span>
        </div>
<div class="login-content">
	<div id="content" style="min-height: 695px;">
	 <?php
		while($row = mysql_fetch_array($auditionDetail))
			{
				$BannerImage = $row['BannerImage'];
				$BannerImage = "http://www.filmipassion.com/".$BannerImage;
	 ?>
		<div style="padding-top: 10px; display: block; opacity: 1;" class="pro-content-row" id="div_14">
			<div style="margin-top: 5px;">
			    <div style="">
				<div class="img-border100p margin-right10">
				    <img style="margin-right:20px;float:left;width:100px; height:100px;" src="<?php echo $BannerImage ?>" alt="Image Required">
				</div>
				<div style="float: right; width: 73%;height:126px;">
				    <div class="txt-color-pink">
						<?php echo $row['AuditionTitle'] ?>
				    </div>
				    <div class="txt-color-pink">
                       		 <?php echo $row['ProductionName'] ?>
                                </div>
				    <div class="txt-color-pink" style="">
					LastDate To Apply :&nbsp;&nbsp;&nbsp;   <?php echo substr($row['LastDateToApply'],0,11) ?>
				    </div>
				    <div style="margin-top: 5px; color: #757575; height: 40px; line-height: 18px;">
						<?php echo substr($row['AuditionDescription'],0,50); ?>... &#160; <a href="auditiondetails.php?id=<?php echo $row['auditionid'] ?>">View Details</a>
				    </div>

				</div>
				<div style="margin-top: 0px; float: right">
				</div>
			    </div>
			    <div style="clear: both"></div>
			</div>
		  </div>
		  <?php } ?>
	</div>
</div>
