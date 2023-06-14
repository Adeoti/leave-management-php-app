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
		<div class="row bg-light">
				<?php require("header2.php"); ?>
					<div class="col-sm-2 col-md-2"></div>
				<div class="col-sm-8 jumbotron bg-white col-md-8">
						<center><h3>Site Map - List of pages in the app</h3></center>
							<p style="text-align:justify;">
								This page lists the structure and layout of this application and how pages are constructed to give the user the easiest possible navigational and pictographic experience. We tried as much as possible to present the material in the best and simplest format possible so users feel satisfied while using this system.
							
								<h4>Admin Dashboard</h4>
								<ul>
									<li>
										Dashboard	
											<ul>
												<li>Add Staff</li>
												<li>Manage Staff</li>
												<li>Add Department</li>
												<li>Manage Department</li>
												<li>Add Level</li>
												<li>Manage Level</li>
												<li>Add Leave Type</li>
												<li>Manage Leave Type</li>
												<li>Access Pending Leaves</li>
												<li>View Accepted (approved) Leaves</li>
												<li>Documentation</li>
												<li>Logout</li>
											</ul>
									</li>
								</ul>
							<h4>Supervisor Dashboard</h4>
								<ul>
									<li>
										Dashboard	
											<ul>
												<li>Make Leave Request</li>
												<li>Leave History</li>
												<li>Eligibility Status</li>
												<li>Account Details</li>
												<li>Change Password</li>
												<li>Notification</li>
												<li>Manage Leave</li>
												<li>View Staff</li>
												<li>Documentation</li>
												<li>Logout</li>
											</ul>
										<li>Special Action	
											<ul>
												<li>Forward Leave</li>
												<li>Decline Leave</li>
												<li>Elapse Leave</li>
											</ul>
												</li>
									</li>
								</ul>
							
							
							<h4>Staff Dashboard</h4>
								<ul>
									<li>
										Dashboard	
											<ul>
												<li>Make Leave Request</li>
												<li>Leave History</li>
												<li>Eligibility Status</li>
												<li>Account Details</li>
												<li>Change Password</li>
												<li>Notification</li>
												<li>Documentation</li>
												<li>Logout</li>
												
											</ul>
									</li>
								</ul>
							
							
							
							
							
							</p>
				</div>
			
				
				
				
				<?php require("staff/footer.php"); ?>
	</div>
	</div>




<script src="js/qwrs.js"></script>
	<script src="boot/js/bootstrap.min.js"></script>
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