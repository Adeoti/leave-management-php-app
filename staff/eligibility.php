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
							
							<?php
								require("../config/config.php");
									$elig_stat = $con -> prepare("SELECT * FROM leave_type WHERE department = ? AND level = ? OR department = ? AND level = ? OR department = ? AND level = ?");
										if($elig_stat -> execute(array("all","all", $_SESSION['sid_dept'], $_SESSION['sid_level'],$_SESSION['sid_dept'],"all" ))){
											if($elig_stat -> rowCount() > 0){
													echo "<center><h4>You're eligible for the following leave type(s)</h4></center>";
														echo "
															<table class='table table-bordered table-light'>
																<tr>
																	<th>S/N</th>
																	<th>Leave Name</th>
																	<th>Duration</th>
																</tr>
														";
														$sn = 0;
													$elig_stat -> setFetchMode(PDO::FETCH_ASSOC);
														while($row  = $elig_stat -> fetch()){
															$sn ++;
																$refl = $row['ref'];
																$name = $row['name'];
																$duration = $row['duration'];
															echo '
																<tr>
																	<td>'.$sn.'</td>
																	<td>'.$name.' leave</td>
																	<td><span class="badge badge-light text-info">'.$duration.'</span> in a year</td>
																</tr>
															';
															
														}
														echo "</table>";
												}else{
													echo "<center><h3>SORRY: You're not eligible for any rated leave.</h3></center>";
												}
										}else{
											echo "ERROR OCCURRED !!!!";
											}
							?>
							
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