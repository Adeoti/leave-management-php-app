
<!DOCTYPE html>
<html>
<head>
		<title>Leave Manager - User Dashboard</title>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="boot/css/bootstrap.min.css" media="all"/>
			<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
</head>

	

<body>
	<div class="container-fluid">
		<div class="row">
				<?php require("header2.php"); ?>
				
					<div class="col-md-2 col-sm-2"></div>
				<div class="col-sm-5 jumbotron bg-white col-md-5">
							<article>
								<h4>About This App</h4><br/>
								This is a web based online Employee Leave Management System which aimed at keeping the track of employees leave activities. 
The design of this system is to automate the existing manual management of leave within the Institute minimizing the work load and providing efficient and timely leave service delivery.
This integrated software is being developed in Javascript, CSS3, PHP, and MySQL:PDO technology and the entire database with back up even will be stored in the server. 

							</article>
								<br/>	<br/>	<br/>	<br/>	<br/>	<br/>
				</div>
				<div class="col-md-1"></div>
			
				<?php require("staff/footer.php"); ?>
	</div>
	</div>




<script src="js/qwrs.js"></script>
	<script src="boot/js/bootstrap.min.js"></script>
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