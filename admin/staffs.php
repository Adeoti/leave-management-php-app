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
				
				<div class="modal fade staff">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3>Add new staff</h3>
									<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<div class="row">
										<div class="col-sm-6 col-md-6">
								<label for="fname">First name</label><br/>
									<input type="text" name="fname" id="fname" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										
										<div class="col-sm-6 col-md-6">
								<label for="lname">Last name</label><br/>
									<input type="text" name="lname" id="lname" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										<div class="col-sm-6 col-md-6"><br/>
								<label for="email">Email</label><br/>
									<input type="email" name="email" id="email" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										<div class="col-sm-6 col-md-6"><br/>
								<label for="password">Password</label><br/>
									<input type="password" name="password" id="password" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										
										<div class="col-sm-6 col-md-6"><br/>
								<label for="dept">Department</label><br/>
									<select  name="dept" id="dept" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;">
										<option value="">choose department</option>
										<?php
											$INK = new Admin();
											$INK -> fetch_garax("combo","department");
										?>
									</select>
										</div>
										<div class="col-sm-6 col-md-6"><br/>
								<label for="level">Level</label><br/>
									<select  name="level" id="level" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;">
										<option value="">choose level</option>
										<?php
											$INK = new Admin();
											$INK -> fetch_garax("combo","level");
										?>
									</select>
										</div>
										
										<div class="col-sm-6 col-md-6"><br/>
								<label for="rank">Rank</label><br/>
									<input type="text" name="rank" id="rank" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										<div class="col-sm-6 col-md-6" style="margin-top:10px;"><br/><br/>
								<div style="float:right;"><button name="add_staff" class="btn btn-md btn-primary"><i class="fa fa-check"></i> Add now</button>
								</div>
								<div style="clear:both;"></div>
									</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					</div>
				<div class="modal fade update">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3>Edit Staff</h3>
									<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<div class="row">
										<div class="col-sm-6 col-md-6">
								<label for="fname">First name</label><br/>
									<input type="text" name="fname" id="fname" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										<input type="hidden" value="" name="trans" id="trans"/>
										</div>
										
										<div class="col-sm-6 col-md-6">
								<label for="lname">Last name</label><br/>
									<input type="text" name="lname" id="lname" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										<div class="col-sm-6 col-md-6"><br/>
								<label for="email">Email</label><br/>
									<input type="email" name="email" id="email" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										<div class="col-sm-6 col-md-6"><br/>
								<label for="password">Password</label><br/>
									<input type="text" name="password" id="password" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										
										<div class="col-sm-6 col-md-6"><br/>
								<label for="dept">Department</label><br/>
									<select  name="dept" id="dept" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;">
										<option value="">choose department</option>
										<?php
											$INK = new Admin();
											$INK -> fetch_garax("combo","department");
										?>
									</select>
										</div>
										<div class="col-sm-6 col-md-6"><br/>
								<label for="level">Level</label><br/>
									<select  name="level" id="level" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;">
										<option value="">choose level</option>
										<?php
											$INK = new Admin();
											$INK -> fetch_garax("combo","level");
										?>
									</select>
										</div>
										
										<div class="col-sm-6 col-md-6"><br/>
								<label for="rank">Rank</label><br/>
									<input type="text" name="rank" id="rank" required style="text-indent:10px; width:100%; border:2px solid #eee; border-radius:6px; height:35px;"/>
										</div>
										<div class="col-sm-6 col-md-6" style="margin-top:10px;"><br/><br/>
								<div style="float:right;"><button name="update_staff" class="btn btn-md btn-primary"><i class="fa fa-check"></i> Add now</button>
								</div>
								<div style="clear:both;"></div>
									</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-10 col-md-10">
					<div style="padding-top:20px;">
						<a href="javascript:void(null)" class="btn staff btn-sm btn-primary " title="click to add staff"><i class="fa fa-user-plus"></i> add new staff</a>
					</div>
					<hr/>
						<?php
							if(isset($_POST['add_staff'])){
									$fname = htmlspecialchars(trim($_POST['fname']));
									$lname = htmlspecialchars(trim($_POST['lname']));
									$email = htmlspecialchars(trim($_POST['email']));
									$password = htmlspecialchars(trim($_POST['password']));
									$rank = htmlspecialchars(trim($_POST['rank']));
									$level = htmlspecialchars(trim($_POST['level']));
									$dept = htmlspecialchars(trim($_POST['dept']));
									
									$add = new Admin();
										$add -> addStaff($fname,$lname,$email,$password,$rank,$dept,$level);
									
									
								
							}
							require("../config/config.php");
							if(isset($_POST['update_staff'])){
								$fname = htmlspecialchars(trim($_POST['fname']));
									$lname = htmlspecialchars(trim($_POST['lname']));
									$email = htmlspecialchars(trim($_POST['email']));
									$password = htmlspecialchars(trim($_POST['password']));
									$rank = htmlspecialchars(trim($_POST['rank']));
									$level = htmlspecialchars(trim($_POST['level']));
									$dept = htmlspecialchars(trim($_POST['dept']));
									$ref_ree = $_POST['trans'];
										$update = $con -> prepare("UPDATE staff SET fname = ?, lname = ?, email = ?, signature = ?, rank = ?, level = ?, department = ? WHERE ref = ?");
										if($update -> execute(array($fname,$lname,$email,$password,$rank,$level,$dept,$ref_ree))){
											echo "<span class='text-primary'>Updated successfully</span>";
										}else{
											echo "<span class='text-danger'>Error Occurred</span>";
										}
								
								
								
							}
							$fetch_staff  = $con -> prepare("SELECT * FROM staff ORDER BY dated");
								if($fetch_staff -> execute()){
									
									if($fetch_staff -> rowCount() > 0){
											$sn = 0;
											echo '
												<table class="table table-light table-striped">
													<tr>	
														<th>S/N</th>
														<th>Name</th>
														<th>email</th>
														<th>rank</th>
														<th>DEPT.</th>
														<th>Level</th>
														<th>Since</th>
														<th>Action</th>
													</tr>
											';
											$rankingBtn = "";
										$fetch_staff -> setFetchMode(PDO::FETCH_ASSOC);
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
													switch($rank_st){
														case 'supervisor': $rankingBtn = "<a href='ranking.php?rif=$ref_staff' class='btn btn-sm btn-warning' title='click to remove supervisorship'>demote</a>";
														break;
														default :
															$rankingBtn = "<a href='ranking.php?ref=$ref_staff' class='btn btn-sm btn-success' title='click to assign as supervisor'>assign</a>";
															
													}
												echo '<tr>
													<td>'.$sn.'</td>
													<td>'.$fname_st." ".$lname_st.'</td>
													<td>'.$email_st.'</td>
													<td>'.ucfirst($rank_st).'</td>
													<td>'.$dept_st.'</td>
													<td>'.$level_st.'</td>
													<td>'.$dated_st.'</td>
													<td>
														'.$rankingBtn.'
														<a href="javascript:void(null)" data-pass="'.$pass_st.'" data-ref="'.$ref_staff.'" data-fname="'.$fname_st.'" data-lname="'.$lname_st.'" data-email="'.$email_st.'" data-rank="'.$rank_st.'" data-dept="'.$dept_st.'" data-level="'.$level_st.'" class="btn btn-sm update btn-info"><i class="fa fa-pencil"></i></a>
														<a href="trash.php?ref='.$ref_staff.'&tab=staff&path=staffs" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
													</td>
												</tr>';
												
											}
											echo '</table>';
									}else{
										echo "No Staff Added";
									}
								}else{
									echo "ERROR OCCURRED";
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
			
			$('a.btn.update').on('click', function(){
				let t_ref = $(this).data('ref');
				let t_fname = $(this).data('fname');
				let t_lname = $(this).data('lname');
				let t_email = $(this).data('email');
				let t_rank = $(this).data('rank');
				let t_dept = $(this).data('dept');
				let t_level = $(this).data('level');
				let t_pass = $(this).data('pass');
				let mum = $('.modal.fade.update');
					mum.find('input#fname').val(t_fname);
					mum.find('input#lname').val(t_lname);
					mum.find('input#email').val(t_email);
					mum.find('input#password').val(t_pass);
					mum.find('input#rank').val(t_rank);
					mum.find('input#trans').val(t_ref);
					mum.find('select#level').append("<option value='"+t_level+"' selected>"+t_level+"</option>");
					mum.find('select#dept').append("<option value='"+t_dept+"' selected>"+t_dept+"</option>");
					mum.modal("show");
			});
			
			
			$('a.btn.staff').on('click', function(){
				$('div.modal.staff').modal("show");
			});
		});
	</script>
</body>
</html>