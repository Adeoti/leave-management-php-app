<?php
session_start();
if(!isset($_SESSION['sid_ref'])){
	header("Location: ../");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
		<title>Leave Manager - User Dashboard</title>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="../boot/css/bootstrap.min.css" media="all"/>
			<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"/>
</head>

	

<body>
	<div class="container-fluid">
		<div class="row">
				<?php require("header.php"); ?>
				
				<?php require("myleft.php"); ?>
					<div class="col-md-2 col-sm-2"></div>
				<div class="col-sm-5 jumbotron bg-white col-md-5">
							<article>
								<?php
									require("../config/config.php");
										$fetch_notific = $con -> prepare("SELECT * FROM notification WHERE receiver_ref = ?");
										if($fetch_notific -> execute(array($_SESSION['sid_ref']))){
											if($fetch_notific -> rowCount() > 0){
												$fetch_notific -> setFetchMode(PDO::FETCH_ASSOC);
													while($row = $fetch_notific -> fetch()){
														$refg = $row['ref'];
														$subject = $row['subject'];
														$sender_ref = $row['sender_ref'];
														$sender_name = $row['sender_name'];
														$msg = $row['msg'];
														$datesx = $row['date'];
														
															?>
															<div style="padding:8px; background:#eadcae; border-radius:5px;">
															<b><i class="fa fa-bell-o"></i> <?php echo $subject; ?> </b>	<article><?php echo $msg;?></article>
																<span class="badge badge-light"><?php echo $datesx; ?></span>
															</div><hr/>
															
															
															<?php
														
														
													}
											}else{
												echo "<center><b>You've gotten no notification!</b></center>";
											}
										}else{
											echo "ERROR OCCURRED";
										}
								?>
							</article>
				</div>
				<div class="col-md-1"></div>
				<?php
					if($_SESSION['sid_rank'] == "supervisor"){
						//echo "Supervors' Tools show here";
						require("superSide.php");
					}
				
				
				?>
				<?php require("footer.php"); ?>
	</div>
	</div>




<script src="../js/qwrs.js"></script>
	<script src="../boot/js/bootstrap.min.js"></script>
	<script>
					$(document).ready(function(){
						$('a.btn.requleave').on('click', function(){
							$('div.modal.requleave').modal("show");
						});
						$('a.btn.password_chng').on('click', function(){
							$('div.modal.password_chng').modal("show");
						});
					});
				</script>
</body>
</html>