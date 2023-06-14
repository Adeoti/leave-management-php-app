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
				<?php require('myleft.php'); ?>
			<div class="modal fade leave_type">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title">Add new leave type</h3>
								<a href="javascript:void(0)" class="close" data-dismiss="modal">&times;</a>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<label for="leave_name">Conraiss Name</label><br/>
									<input type="text" id="leave_name" name="leave_name" required style="height:35px; text-indent:10px; border:1px solid #eee; border-radius:5px; width:100%;"/><br/><br/>
									
								<label for="leave_department">Department</label><br/>
									<select type="text" id="leave_department" name="leave_department" required style="height:35px; text-indent:10px; border:1px solid #eee; border-radius:5px; width:100%;">
										<option value="all">All</option>
										<?php
											
											$INK = new Admin();
											$INK -> fetch_garax("combo","department");
										?>
									</select><br/><br/>	
								<label for="leave_level">Level</label><br/>
									<select type="text" id="leave_level" name="leave_level" required style="height:35px; text-indent:10px; border:1px solid #eee; border-radius:5px; width:100%;">
										<option value="all">All</option>
										<?php
											
											$INK -> fetch_garax("combo","level");
										?>
									</select><br/><br/>
									
								<label for="leave_duration">Duration</label><br/>
									<input type="text" id="leave_duration" name="leave_duration" required style="height:35px; text-indent:10px; border:1px solid #eee; border-radius:5px; width:100%;"/><br/><br/>
									<div style="float:right;">
										<button class="btn btn-sm btn-primary" name="add_leave"><i class="fa fa-plus"></i> add</button>
									</div>
									<div style="clear:both;"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		
				
				<div class="col-sm-10 col-md-10">
					<div style="padding-top:20px;">
						<a href="javascript:void(null)" class="btn leave_type btn-sm btn-secondary " title="click to add leave type"><i class="fa fa-user-plus"></i> add new</a>
						<?php
							if(isset($_POST['add_leave'])){
								$name = htmlspecialchars(trim($_POST['leave_name']));
								$dept = htmlspecialchars(trim($_POST['leave_department']));
								$level = htmlspecialchars(trim($_POST['leave_level']));
								$duration = htmlspecialchars(trim($_POST['leave_duration']));
								
									$add_leave = new Admin();
								$add_leave -> create_leave($name,$dept,$level,$duration);
								
							}
						
						
						?>
					</div>
					<hr/>
					
										<?php
						require("../config/config.php");
							$fetch_leaveType = $con -> prepare("SELECT * FROM leave_type ORDER BY name");
								if($fetch_leaveType -> execute()){
									if($fetch_leaveType -> rowCount() > 0 ){
											echo '
												<table class="table table-dark table-striped">
													<tr>
														<th>S/N</th>
														<th>Name</th>
														<th>Department</th>
														<th>Conraiss</th>
														<th>Duration</th>
														<th>Controls</th>
													</tr>
											';$sn = 0;
										$fetch_leaveType -> setFetchMode(PDO::FETCH_ASSOC);
											while($ree = $fetch_leaveType -> fetch()){
												$sn++;
												$ref_type = $ree['ref'];
												$name_l = $ree['name'];
												$dept_l = $ree['department'];
												$level_l = $ree['level'];
												$duration_l = $ree['duration'];
												
													echo '
														<tr>
															<td>'.$sn.'</td>
															<td>'.$name_l.'</td>
															<td>'.$dept_l.'</td>
															<td>'.$level_l.'</td>
															<td>'.$duration_l.'</td>
															<td>
																<a href="" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> edit</a>
																<a href="trash.php?ref='.$ref_type.'&tab=leave_type&path=leave_type" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
															</td>
														
														</tr>
													';
												
											}
											echo "</table>";
									}else{
										Print "No leave type added";
									}
									}else{
										Print "Something went wrong";
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
			$('a.btn.leave_type').on('click', function(){
				$('div.modal.leave_type').modal("show");
			});
			
		});
	</script>
</body>
</html>