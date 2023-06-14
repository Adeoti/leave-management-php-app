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
				<div class="col-sm-2 jumbotron bg-white col-md-2"></div>
				<div class="col-sm-5 jumbotron bg-light col-md-5" style="height:580px; margin-top:30px; line-height:60px;">
						<?php
							require("../config/config.php");
							$fetch_account = $con -> prepare("SELECT * FROM staff WHERE ref = ?");
								if($fetch_account -> execute(array($_SESSION['sid_ref']))){
									if($fetch_account -> rowCount() > 0 ){
											echo "<h3>My Account Details</h3><hr/>";
										$fetch_account -> setFetchMode(PDO::FETCH_ASSOC);
											while($row = $fetch_account -> fetch()){
												$ref = $row['ref'];
												$fname = $row['fname'];
												$lname = $row['lname'];
												$email = $row['email'];
												$department = $row['department'];
												$level = $row['level'];
												$rank = $row['rank'];
												$date = $row['dated'];
												
													echo "<div><b>First Name : </b>". $fname."</div>";
													echo "<div><b>Last Name : </b>". $lname."</div>";
													echo "<div><b>Department : </b>". $department."</div>";
													echo "<div><b>Rank : </b>". $rank."</div>";
													echo "<div><b>Level : </b>". $level."</div>";
													echo "<div><b>Joined since : </b>". $date."</div>";
												
												
												
											}
									}
								}else{
									echo 'ERROR OCCURRED';
								}
									$fetch_supervisor = $con -> prepare("SELECT * FROM staff WHERE rank = ? AND department = ?");
										if($fetch_supervisor -> execute(array("supervisor",$_SESSION['sid_dept']))){
											if($fetch_supervisor -> rowCount() > 0){
												echo "<b style='display:inline-block; margin-bottom:-30px;'>Supervisor</b> : ";
												$fetch_supervisor -> setFetchMode(PDO::FETCH_ASSOC);
													while($row = $fetch_supervisor -> fetch()){
														
															$cref = $row['ref'];
															$cfname = $row['fname'];
															$clname = $row['lname'];
																if($cref == $ref){
																	echo $cfname." ".$clname." (you)";
																}else{
																	echo "<span style='color:tomato;'>".$cfname." ".$clname."</span>";
																	}
														
														
													}
											}else{
												echo "You have no Supervisor fo now";
											}
										}else{
											echo "ERROR OCCURRED !";
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