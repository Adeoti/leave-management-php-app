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
		<title>Leave Manager - Admin Dashboard</title>
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
						<?php
							require("../config/config.php");
								
							$fetch_staff  = $con -> prepare("SELECT * FROM staff WHERE department = ? ORDER BY dated");
								if($fetch_staff -> execute(array($_SESSION['sid_dept']))){
									if($fetch_staff -> rowCount() > 0){
											$sn = 0;
											echo '
											<center><h4>Staff In Your Department</h4></center>
												<table class="table table-light table-striped">
													<tr>	
														<th>S/N</th>
														<th>Name</th>
														<th>email</th>
														<th>rank</th>
														<th>Level</th>
														<th>Since</th>
													</tr>
											';
											$rankingBtn = "";
										$fetch_staff -> setFetchMode(PDO::FETCH_ASSOC);
										$paint = "";
											while($row = $fetch_staff -> fetch()){
												$sn ++;
												$ref_staff = $row['ref'];
												$fname_st = $row['fname'];
												$lname_st = $row['lname'];
												$email_st = $row['email'];
												$rank_st = $row['rank'];
												$dept_st = $row['department'];
												$level_st = $row['level'];
												$dated_st = $row['dated'];
												$pass_st = $row['signature'];
													if($ref_staff == $_SESSION['sid_ref']){
														$paint = "<span class='badge badge-pill badge-success'>you</span>";
													}else{
														$paint = "";
													}
												echo '<tr>
													<td>'.$sn.'</td>
													<td>'.$fname_st." ".$lname_st.$paint.'</td>
													<td>'.$email_st.'</td>
													<td>'.ucfirst($rank_st).'</td>
													<td>'.$level_st.'</td>
													<td>'.$dated_st.'</td>
													
												</tr>';
												
											}
											echo '</table>';
									}else{
										echo "You have no staff in your department";
									}
								}else{
									echo "ERROR OCCURRED";
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
						$('a.btn.act_res').click(function(){
							let reason_ = $(this).data('reason');
								alert(reason_);
								$('div.modal.act_res .modal-body article').html(reason_);
								$('.modal.act_res').modal("show");
								
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