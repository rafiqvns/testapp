<?php include('header.php');?>
<?php
//include('config.php');
$arid = $_GET['id'];
$artistSql = "select * from tbluserpersonaldetails where Id=".$arid;
$artistDetail = mysql_query($artistSql);

?>

<div style="clear:both;">&#160;</div>
<div style="border: 0px; margin: 5px 0 15px; padding-bottom: 5px;" class="login-content">
    <div id="container">
        <div style="float: none;text-shadow:none;" class="all-pink-heading">
            Artist Detail <span style="float:right;color:#fff;"><a href="index.php" style="color:#fff;">Back</a></span>
        </div>
            <div style="background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #D3D3D3; line-height: 25px;padding: 20px 30px; ">
			 <?php
						while($row = mysql_fetch_array($artistDetail))
						{
							$ThumbnailImage = $row['ThumbnailImage'];
							
								$ThumbnailImage = $row['ThumbnailImage'];
								if(strpos($ThumbnailImage, 'http') !== false){
									$ThumbnailImage = $row['ThumbnailImage'];
								}else{
									$ThumbnailImage = "http://www.filmipassion.com/".$row['ThumbnailImage'];
								}
				 ?>
                <div>
                    <div style="">
                        <div style="margin-top: 5px; background-color: #FFFFFF; border: 1px solid #D3D3D3; border-radius: 3px; height: 170px; padding: 6px; width: 170px;">
							<a href="<?php echo $ThumbnailImage ?>" title="<?php echo $row['FirstName'] ?>" class="ui-link">
								<img style="width:171px;height:171px;" src="<?php echo $ThumbnailImage ?>" alt="<?php echo $row['FirstName'] ?>">
							</a>
                        </div>
                    </div>
                    <div style="float: left; line-height: 25px; margin-top: 0px;">

                        <div style="padding-top: 2px;">
                            <div class="audi-detail-left">
                                Name :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['FirstName'] ?> <?php echo $row['LastName'] ?></div>
                            <div class="clear">
                            </div>
                        </div>

                        <div style="padding-top: 2px;">
                            <div class="audi-detail-left">
                                City :    
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['City'] ?></div>
                            <div class="clear">
                            </div>
                        </div>

                        <div>
                            <div class="audi-detail-left">
                               State :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['State'] ?></div>
                            <div class="clear">
                            </div>
                        </div>


                        <div>
                        </div>


                        <div>
                            <div class="audi-detail-left">
                                Country :
                            </div>
                            <div class="audi-detail-right main-lable-width">
                                <?php echo $row['Country'] ?>
                            </div>
                            <div class="clear">
                            </div>
                        </div>


                        <div>
                            <div class="audi-detail-left">
                                Date Of Birth :
                            </div>
                            <div class="audi-detail-right main-lable-width"><?php echo $row['DateOfBirth'] ?></div>
                            <div class="clear">
                            </div>
                        </div>
                           
                    </div>
                    <div class="clear">
                    </div>
                </div>

				<?php  } ?>

            </div>

   </div>
</div>
<?php include('footer.php');?>