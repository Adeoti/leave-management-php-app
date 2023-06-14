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
					
					<div class="modal fade decline">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4>State why you are declining this leave</h4>
										<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<textarea name="reason" required style="text-indent:10px; height:60px; width:100%; border:2px solid #eee; border-radius:8px; resize:none;"></textarea>
										<input type="hidden" class="ring" name="tag"/>
										<input type="hidden" class="staff_key" name="staff_key"/>
										<div style="float:right;"><br/>
										<button name="decline" class="btn btn-sm btn-info">continue</button>
										</div>
										<div style="clear:both;"></div>
										
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade forward">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4>State why you deem it fit to forward this leave</h4>
										<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<textarea name="reason" required style="text-indent:10px; height:60px; width:100%; border:2px solid #eee; border-radius:8px; resize:none;"></textarea>
										<input type="hidden" class="ring" name="tag" />
										<input type="hidden" class="staff_key" name="staff_key" />
										<div style="float:right;"><br/>
										<button name="forward" class="btn btn-sm btn-info">continue</button>
										</div>
										<div style="clear:both;"></div>
										
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade act_res">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4>Reason For The Action</h4>
										<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
								</div>
								<div class="modal-body">
									<article></article>
								</div>
							</div>
						</div>
					</div>
				<div class="col-sm-8 jumbotron bg-white col-md-8">
					<center>
							<?php
							$text_pane = "";
								if(isset($_GET['tabul'])){
									$ax = $_GET['tabul'];
										if($ax == "pending"){
									$text_pane = "Pending leaves";
										}elseif($ax == "active"){
									$text_pane = "Active leaves";
										}elseif($ax == "wildcard"){
									$text_pane = "Pending + Active + Elapsed leaves";
										}
									
							echo "<span class='bg-light' style='padding:7px; color:tomato; font-weight:500;'>".$text_pane."</span><br/><br/>";
								}
								
							?>
						<a href="leave_manager.php?tab=Leave Manager&tabul=pending" class="btn btn-sm btn-secondary"><i class="fa fa-unlock"></i> pending</a>
						<a href="leave_manager.php?tab=Leave Manager&tabul=active" class="btn btn-sm btn-primary"><i class="fa fa-wheelchair"></i> active</a>
						<a href="leave_manager.php?tab=Leave Manager&tabul=wildcard" class="btn btn-sm btn-success"><i class="fa fa-star"></i> wildcard</a><hr/>
					</center>
						<?php
							require("../config/config.php");
								
								if(isset($_POST['decline'])){
									$reason = htmlspecialchars(trim($_POST['reason']));
									$target = $_POST['tag'];
									$staff_key = $_POST['staff_key'];
									$sp_name = $_SESSION['sid_fname']." ".$_SESSION['sid_lname'];
										$decline = $con -> prepare("UPDATE leavee SET leave_status = ?, action_reason = ?, supervisor_ref = ?, supervisor_name = ? WHERE ref = ?");
											if($decline -> execute(array(4,$reason,$_SESSION['sid_ref'],$sp_name,$target))){
												echo "<span style='color:#2e9fff;'><i class='fa fa-check'></i> The leave has been declined !</span>";
											$notify = new Staff();
												$notify -> notify($_SESSION['sid_ref'],$sp_name,$staff_key,"Declination","Your request has been declined by ".$sp_name.".");
											
											}else{
												echo "ERROR OCCURRED. SORRY!";
											}
								}
								
								
								if(isset($_POST['forward'])){
									$reason = htmlspecialchars(trim($_POST['reason']));
									$target = $_POST['tag'];
									$staff_key = $_POST['staff_key'];
									$sp_name = $_SESSION['sid_fname']." ".$_SESSION['sid_lname'];
										$decline = $con -> prepare("UPDATE leavee SET leave_status = ?, action_reason = ?, supervisor_ref = ?, supervisor_name = ? WHERE ref = ?");
											if($decline -> execute(array(1,$reason,$_SESSION['sid_ref'],$sp_name,$target))){
												echo "<span style='color:#2e9fff;'><i class='fa fa-check'></i> The leave has been forwarded !</span>";
											$notify = new Staff();
												$notify -> notify($_SESSION['sid_ref'],$sp_name,$staff_key,"Forwarded","Your request has been forwarded by " .$sp_name.".");
											}else{
												echo "ERROR OCCURRED. SORRY!";
											}
								}
								
								$tablar = "";
								
								if(isset($_GET['tabul'])){
									$ax = $_GET['tabul'];
										if($ax == "pending"){
											require("wherepending.php");
										}elseif($ax == "active"){
											require("whereactive.php");
										}elseif($ax == "wildcard"){
											require("wherewildcard.php");
										}
										}
										else{
											require("wherepending.php");
										}
									
								
								
								
						
						?>
						
						
						
						
						
						
						
						
						
						
				</div>
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
						
						$('a.btn.decline').click(function(){
							let erl = $(this).data('ref');
							let staff = $(this).data('staff');
								$('div.modal.decline .modal-body .ring').val(erl);
								$('div.modal.forward .modal-body .staff_key').val(staff);
								$('.modal.decline').modal("show");
								
						});
						$('a.btn.elapse').click(function(){
							let erl = $(this).data('ref');
							let staff = $(this).data('staff');
								$.get("elapseleave.php",{ref:erl, staff_key:staff}, function(data){
									alert(data);
								});
								
						});
						$('a.btn.forward').click(function(){
							let erl = $(this).data('ref');
							let staff = $(this).data('staff');
								$('div.modal.forward .modal-body .ring').val(erl);
								$('div.modal.forward .modal-body .staff_key').val(staff);
								$('.modal.forward').modal("show");
								
						});
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