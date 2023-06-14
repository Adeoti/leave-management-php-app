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
					<div class="col-sm-10 col-md-10 ">
						<br/>
						<center><form action="accepted.php?tab=Accepted+Leaves" method="get" >
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
				if(isset($_GET['year_of'])){
					$fetch = "SELECT * FROM leavee WHERE leave_status = ? AND leave_year = ?";
					$data = array(3,$_GET['year_of']);
						$titleD = "Year ".$_GET['year_of']." Leave history";
						$no_value = "No approved leave in the selected year (".$_GET['year_of'].")";
				}else{
					
					$no_value = "No approved leave yet.";
					$fetch = "SELECT * FROM leavee WHERE leave_status = ?";
					$data = array(3);
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
														<th>Date Approved</th>
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
															<span class='badge badge-secondary disabled' title='forwarded'><i class='fa fa-check'></i> active</span>
															<a href='javascript:void(null)' data-ref = '$ref' data-staff='$staff_ref' class='btn reverse btn-sm btn-info' title='click to unapprove'><i class='fa fa-refresh'></i> reverse</a>
															";
														
														echo '
																<tr>
																	<td>'.$sn.'</td>
																	<td>'.$staff_name.'</td>
																	<td>'.$leave_name.'</td>
																	<td>'.$leave_contact.'</td>
																	<td>'.$leave_year.'</td>
																	<td>'.$date_approved.'</td>
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
				$('a.btn.reverse').on('click', function(){
					let ref = $(this).data('ref');
					let staff_key = $(this).data('staff');
						$.get('reverseleave.php', {ref:ref, staff:staff_key}, function(data){
							alert(data);
						});
					
				});
				
			});
		
		</script>
</body>
</html>