<?php
session_start();
require("../count_views.php");
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>myAppface.com</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="../boot/css/bootstrap.min.css" media="all"/>
			<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
			<style>
				.row .col-md-4 .card{
					box-shadow:0 1px 4px rgba(0,0,0,0.1);
					-webkit-box-shadow:0 1px 4px rgba(0,0,0,0.1);
					-moz-box-shadow:0 1px 4px rgba(0,0,0,0.1);
				}
			</style>
		</head>
		<body class="container-fluid" style="background-color:#e5e5e5;">
			<div class="row">
			<?php require("../header_course.php");?>
				<div class="col-sm-12 col-md-12" >
					<div class="container">
					
						<!---Newest Row--->
						<div class="row">
							<div class="col-sm-12 col-md-12" style="padding:0px;">
							<br/><span class="badge badge-secondary"><i class="fa fa-flag"></i> Easy To Apply Blog Posts</span><br/>
								<br/><strong><i class="fa fa-leaf"style="color:gray;"></i> Newest</strong><br/><br/>
							</div>
							
								<?php 
									require("../lib/config.php");
											$fetch_posts = $con -> prepare("SELECT * FROM posts WHERE media_of != ? AND face = ? ORDER BY ref DESC LIMIT 0,6");
												if($fetch_posts -> execute(array("none","Blog"))){
													if($fetch_posts -> rowCount()>0){
														$fetch_posts -> setFetchMode(PDO::FETCH_ASSOC);
															while($row = $fetch_posts -> fetch()){
																$ref = $row['ref'];
																$title = $row['title'];
																$face = $row['face'];
																$caption = $row['caption'];
																$media = $row['media_of'];
																$dated = $row['date'];
																
																
																?>
																
															<div class="col-sm-4 col-md-4" style="padding:15px; margin-top:28px; mix-height:300px;">
																<div class="card" style="border-radius:0px;">
																
																<img style="height:260px;" src="../media/<?php echo $media; ?>" class="img img-fluid card-img-top"/>
																<div class="title" style="padding-top:16px; padding-bottom:16px;  height:110px; padding-left:9px; padding-right:5px;">
																	<a href="../collapse__.php?refrtd=<?php echo $ref; ?>" style="color:gray; font-weight:bold;"><i class="fa fa-tag" style="color:gray;"></i> <?php echo $title; ?></a>
																		<div style="float:right; margin-right:5px; font-family:calibri;"><i class="fa fa-eye" style="color:gray;"></i> <span style="font-family:nyala;">
																						<?php
																
									$fetch_view = $con -> prepare("SELECT * FROM views WHERE disc_ref=?");
									$fetch_view -> execute(array($ref));
									if($fetch_view -> rowCount() > 0){
										// Squeezing count
										
										$count = $fetch_view -> rowCount();
										$_len = strlen($count);
											_squeezeCount($count,$_len);
											
									}else{
										echo 0;
									}
								?>
																		</span> views</div>
																		<div style="clear:both;"></div>
																</div>
																</div>
															
															</div>	
																
																
																
																<?php
																
																
															}
													}else{
														
													echo "<b class='badge badge-danger badge-sm'><i class='fa fa-times'></i> No new (blog) post yet</b>";
													}
												}else{
													echo "<b class='badge badge-danger badge-sm'><i class='fa fa-times'></i> Something isn't right</b>";
												}
								
								
								
								
								
								?>
							
							
							
							
							
							
						</div><br/><br/><br/><br/>
						<!---Newest Row Ends--->
						<!---Featured Row--->
						<div class="row">
							<div class="col-sm-12 col-md-12" style="padding:0px;">
							
								<br/><strong><i class="fa fa-star"style="color:gray;"></i> Featured</strong><br/><br/>
							</div>
							
								<?php 
									require("../lib/config.php");
											$fetch_posts = $con -> prepare("SELECT * FROM posts WHERE face = ? ORDER BY ref DESC LIMIT 6,12");
												if($fetch_posts -> execute(array("Blog"))){
													if($fetch_posts -> rowCount()>0){
														$fetch_posts -> setFetchMode(PDO::FETCH_ASSOC);
															while($row = $fetch_posts -> fetch()){
																$ref = $row['ref'];
																$title = $row['title'];
																$face = $row['face'];
																$caption = $row['caption'];
																$media = $row['media_of'];
																$dated = $row['date'];
																
																
																?>
																
															<div class="col-sm-4 col-md-4" style="padding:15px; margin-top:28px; mix-height:300px;">
																<div class="card" style="border-radius:0px;">
																
																<img style="height:260px;" src="../media/<?php echo $media; ?>" class="img img-fluid card-img-top"/>
																<div class="title" style="padding-top:16px; padding-bottom:16px;  height:110px; padding-left:9px; padding-right:5px;">
																	<a href="../collapse__.php?refrtd=<?php echo $ref; ?>" style="color:gray; font-weight:bold;"><i class="fa fa-tag" style="color:gray;"></i> <?php echo $title; ?></a>
																		<div style="float:right; margin-right:5px; font-family:calibri;"><i class="fa fa-eye" style="color:gray;"></i> <span style="font-family:nyala;">
																		
																					<?php
																
									$fetch_view = $con -> prepare("SELECT * FROM views WHERE disc_ref=?");
									$fetch_view -> execute(array($ref));
									if($fetch_view -> rowCount() > 0){
										// Squeezing count
										
										$count = $fetch_view -> rowCount();
										$_len = strlen($count);
											_squeezeCount($count,$_len);
											
									}else{
										echo 0;
									}
								?>
																		
																		</span> views</div>
																		<div style="clear:both;"></div>
																</div>
																</div>
															
															</div>	
																
																
																
																<?php
																
																
															}
													}else{
														
													echo "<b class='badge badge-danger badge-sm'><i class='fa fa-times'></i> No new (blog) post yet</b>";
													}
												}else{
													echo "<b class='badge badge-danger badge-sm'><i class='fa fa-times'></i> Something isn't right</b>";
												}
								
								
								
								
								
								?>
							
							
							
							
							
							
						</div>
						<br/>
							<center><b class="badge badge-primary badge-pill"> *****PAGINATION HERE....******</center></b>
						<br/>
						<!---Featured Row Ends--->
					</div>
				</div>
							<?php require("../footer_course.php"); ?>
			</div>
		
		
		
		
			<script src="../js/qwrs.js"></script>
			<script src="../js/typed.min.js"></script>
			<script src="../js/src-noconflict/ace.js"></script>
	<script src="../boot/js/bootstrap.min.js"></script>

		</body>