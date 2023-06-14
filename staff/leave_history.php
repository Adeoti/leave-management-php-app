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
								
								$fetch = "SELECT * FROM leavee WHERE staff_ref = ?";
								$fetch_leaveHistory = $con -> prepare($fetch);
									if($fetch_leaveHistory -> execute(array($_SESSION['sid_ref']))){
										if($fetch_leaveHistory -> rowCount() > 0){
											echo '
												<table class="table  table-light table-striped table-fluid">
													<tr>
														<th>S/N</th>
														<th>Type</th>
														<th>Contact</th>
														<th>Year</th>
														<th>Date</th>
														<th>Status</th>
														<th>Control</th>
													</tr>
											';
											$fetch_leaveHistory -> setFetchMode(PDO::FETCH_ASSOC);
											$sn = 0;
												$status = $ctrl =  "";
												while($row = $fetch_leaveHistory -> fetch()){
													$sn++;
													$ref = $row['ref'];
													$leave_name = $row['leave_name'];
													$staff_ref = $row['staff_ref'];
													$staff_name = $row['staff_name'];
													$staff_dept = $row['staff_dept'];
													$staff_level = $row['staff_level'];
													$leave_reason = $row['leave_reason'];
													$action_reason = htmlspecialchars($row['action_reason']);
													$leave_contact = $row['leave_contact'];
													$leave_year = $row['leave_year'];
													$leave_status = $row['leave_status'];
													$supervisor_ref = $row['supervisor_ref'];
													$supervisor_name = $row['supervisor_name'];
													$date_approved = $row['date_approved'];
													$date_requested = $row['date_requested'];
														switch($leave_status){
															case 0: $status = "<span class='badge badge-warning'>pending</span>";
																	$ctrl = "<a href='with_with.php?tagrf=$ref' class='btn btn-sm btn-danger' title='click to withdraw'><i class='fa fa-times'></i></a>";
																break;
															case 1: $status = "<span class='badge badge-info'>forwarded</span>";
																	$ctrl = " <a href='javascript:void(null)' title='read reason' data-reason='$action_reason'  class='btn act_res btn-sm btn-primary'><i class='fa fa-envelope'></i></a>";
																break;
															case 3: $status = "<span class='badge badge-success'>started</span>";
																	$ctrl = " <a href='javascript:void(null)' title='read reason' data-reason='$action_reason'  class='btn act_res btn-sm btn-primary'><i class='fa fa-envelope'></i></a>";
																	//$ctrl .= " <a href='javascript:void(null)' title='read info' data-reason='$action_reason'  class='btn act_res btn-sm btn-primary'><i class='fa fa-info'></i></a>";
																break;
															case 4: $status = "<span class='badge badge-danger'>declined</span>";
																	$ctrl = " <a href='javascript:void(null)' title='read reason' data-reason='$action_reason' class='btn btn-sm btn-primary'><i class='fa fa-envelope'></i></a>";
																break;
															case 5: $status = "<span class='badge badge-warning'><i class='fa fa-clock-o'></i> time up</span>";
															$ctrl = "
															<span class='badge badge-secondary disabled' title='declined'><i class='fa fa-lock'></i> elapsed </span>
															";
															break;
															}
														
														echo '
																<tr>
																	<td>'.$sn.'</td>
																	<td>'.$leave_name.'</td>
																	<td>'.$leave_contact.'</td>
																	<td>'.$leave_year.'</td>
																	<td>'.$date_requested.'</td>
																	<td>'.$status.'</td>
																	<td>'.$ctrl.'</td>
																</tr>
														
														';
													
													
												}
												echo "</table>";
										}else{
											echo "No Leave history for you !";
										}
									}else{
										echo "ERROR OCCURRED!";
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
								//alert(reason_);
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