<?php
session_start();
	if(!isset($_SESSION['adm_ref'])){
		header("Location: index.php");
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
				
					<div class="modal fade forward">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4>Why approving this leave ? </h4>
										<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<textarea name="reason" required style="text-indent:10px; height:60px; width:100%; border:2px solid #eee; border-radius:8px; resize:none;"></textarea>
										<br/><br/><b>Date to elapse</b>
										<input type="date" name="date_elp" style="width:100%; text-indent:10px; height:34px; border:2px solid #eee;" />
										<input type="hidden"  class="ring" name="tag" />
										<input type="hidden" class="staff_key" name="staff_key" />
										<div style="float:right;"><br/>
										<button name="forward" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> approve</button>
										</div>
										<div style="clear:both;"></div>
										
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade decline">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4>State why you are rejecting this leave</h4>
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
					<div class="col-sm-10 col-md-10 ">
					
						<br/>
						<center><form action="" method="get" >
												<select name="year_of" style="height:33px;">
													<option value="">view by year</option>
													<option value="2019">2019</option>
													<option value="2020">2020</option>
													<option value="2021">2021</option>
													<option value="2022">2022</option>
													<option value="2023">2023</option>
													<option value="2024">2024</option>
													<option value="2025">2025</option>
													<option value="2026">2026</option>
													<option value="2027">2027</option>
													<option value="2028">2028</option>
													<option value="2029">2029</option>
													<option value="2030">2030</option>
												</select>
												<button name="" class="btn btn-sm">Go</button>
											</form></center><hr/>
						
						<?php
	require("../config/config.php");
	$fetch = $data = $titleD = $no_value = "";
								if(isset($_POST['forward'])){
									$reason = htmlspecialchars(trim($_POST['reason']));
									$target = $_POST['tag'];
									$date_elapsed = $_POST['date_elp'];
									$staff_key = $_POST['staff_key'];
									$sp_name = $_SESSION['adm_name'];
										$decline = $con -> prepare("UPDATE leavee SET leave_status = ?, action_reason = ?, supervisor_ref = ?, supervisor_name = ?, date_approved = ?, date_elapsed = ? WHERE ref = ?");
											if($decline -> execute(array(3,$reason,$_SESSION['adm_ref'],$sp_name,date("M d,Y"),$date_elapsed,$target))){
												echo "<span style='color:#2e9fff;'><i class='fa fa-check'></i> The leave has been approved !</span>";
											$notify = new Staff();
												$notify -> notify($_SESSION['adm_ref'],$sp_name,$staff_key,"Approved","Your request has been Approved by " .$sp_name.".");
											}else{
												echo "ERROR OCCURRED. SORRY!";
											}
								}
								
								
								if(isset($_POST['decline'])){
									$reason = htmlspecialchars(trim($_POST['reason']));
									$target = $_POST['tag'];
									$staff_key = $_POST['staff_key'];
									$sp_name = $_SESSION['adm_name'];
										$decline = $con -> prepare("UPDATE leavee SET leave_status = ?, action_reason = ?, supervisor_ref = ?, supervisor_name = ? WHERE ref = ?");
											if($decline -> execute(array(4,$reason,$_SESSION['adm_ref'],$sp_name,$target))){
												echo "<span style='color:#2e9fff;'><i class='fa fa-check'></i> The leave has been rejected !</span>";
											$notify = new Staff();
												$notify -> notify($_SESSION['adm_ref'],$sp_name,$staff_key,"Leave Rejected","Your request has been rejected by ".$sp_name.".");
											
											}else{
												echo "ERROR OCCURRED. SORRY!";
											}
								}
								
				if(isset($_GET['year_of'])){
					$fetch = "SELECT * FROM leavee WHERE leave_status = ? AND leave_year = ?";
					$data = array(1,$_GET['year_of']);
						$titleD = "Year ".$_GET['year_of']." pending Leave history";
						$no_value = "No pending leave in the selected year (".$_GET['year_of'].")";
				}else{
					
					$no_value = "No pending leave year";
					$fetch = "SELECT * FROM leavee WHERE leave_status = ?";
					$data = array(1);
				}
	
								$fetch_leaveHistory = $con -> prepare($fetch);
									if($fetch_leaveHistory -> execute($data)){
										if($fetch_leaveHistory -> rowCount() > 0){
											echo '<br/><br/>
												<b>'.$titleD.'</b>
												<table class="table  table-light table-striped table-fluid">
													<tr>
														<th>S/N</th>
														<th>Staff Name</th>
														<th>Type</th>
														<th>Contact on leave</th>
														<th>Year</th>
														<th>Date Requested</th>
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
														$ctrl = "
															<a href='javascript:void(null)' data-ref = '$ref' data-staff='$staff_ref' class='btn decline btn-sm btn-danger' title='click to reject'><i class='fa fa-times'></i> reject</a>
															<a href='javascript:void(null)' data-ref = '$ref' data-staff='$staff_ref' class='btn forward btn-sm btn-primary' title='click to approve'><i class='fa fa-check'></i> approve</a>
															";
														
														echo '
																<tr>
																	<td>'.$sn.'</td>
																	<td>'.$staff_name.'</td>
																	<td>'.$leave_name.'</td>
																	<td>'.$leave_contact.'</td>
																	<td>'.$leave_year.'</td>
																	<td>'.$date_requested.'</td>
																	<td>'.$ctrl.'</td>
																</tr>
														
														';
													
													
												}
												echo "</table>";
										}else{
											echo "<center><b> ".$no_value." </b></center>";
										}
									}else{
										echo "ERROR OCCURRED!";
										}

?>
						
						
					</div>
			<?php require("footer.php"); ?>
	</div>
	</div>




<script src="../js/qwrs.js"></script>
	<script src="../boot/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
						$('a.btn.forward').click(function(){
							let erl = $(this).data('ref');
							let staff = $(this).data('staff');
								$('div.modal.forward .modal-body .ring').val(erl);
								$('div.modal.forward .modal-body .staff_key').val(staff);
								$('.modal.forward').modal("show");
								
						});
						
						$('a.btn.decline').click(function(){
							let erl = $(this).data('ref');
							let staff = $(this).data('staff');
								$('div.modal.decline .modal-body .ring').val(erl);
								$('div.modal.forward .modal-body .staff_key').val(staff);
								$('.modal.decline').modal("show");
								
						});
			
		});
	</script>
</body>
</html>