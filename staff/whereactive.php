<?php
	require("../config/config.php");
	$fetch = "SELECT * FROM leavee WHERE staff_dept = ? AND staff_ref != ? AND leave_status = ?";
								$fetch_leaveHistory = $con -> prepare($fetch);
									if($fetch_leaveHistory -> execute(array($_SESSION['sid_dept'],$_SESSION['sid_ref'],3))){
										if($fetch_leaveHistory -> rowCount() > 0){
											echo '
												<table class="table  table-light table-striped table-fluid">
													<tr>
														<th>S/N</th>
														<th>Staff Name</th>
														<th>Type</th>
														<th>Contact on leave</th>
														<th>Year</th>
														<th>Date</th>
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
															<span class='badge badge-secondary disabled' title='forwarded'><i class='fa fa-times'></i> active</span>
															<a href='javascript:void(null)' data-ref = '$ref' data-staff='$staff_ref' class='btn elapse btn-sm btn-info' title='click to elapse'><i class='fa fa-lock'></i></a>
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
											echo "<center><b>No active leave in your department!</b></center>";
										}
									}else{
										echo "ERROR OCCURRED!";
										}

?>