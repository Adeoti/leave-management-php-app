<?php
	session_start();
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
	<div class="container">
		<div class="row">
				<div class="col-sm-4 col-md-4"></div>
				<div class="col-sm-4 col-md-4 jumbotron" style="margin-top:100px;">
					<?php
					if(isset($_GET['log'])){
						echo "<center><span class='badge text-info'><i class='fa fa-thumbs-up'></i> You just logged out!</span></center><br/>";
					}
							require("../module/maintainer.php");
						if(isset($_POST['login'])){
								$uname = htmlspecialchars(trim($_POST['uname']));
								$password = htmlspecialchars(trim($_POST['password']));
							$X = new Admin();
							$X -> login_admin($uname,$password);
						}
					?>
					
					<div class="bg-info text-white" style="padding:10px; border-radius:3px;"> <i class="fa fa-unlock"></i> &nbsp;  &nbsp; Supply your credentials </div><br/>
	<form action="" method="post">
			<label for="uname">Username</label><br/>
				<input type="text" name="uname" id="uname" required style="width:100%; border-radius:5px; border:1px solid #eee; height:34px; text-indent:10px;"/><br/>
				<br/>
			<label for="password">Password</label><br/>
				<input type="password" name="password" id="password" required style="width:100%; border-radius:5px; border:1px solid #eee; height:34px; text-indent:10px;"/><br/>
				<div style="float:right;"><br/>
					<button class="btn btn-sm btn-outline-primary" name="login"><i class="fa fa-sign-in"></i> Login</button>
				</div>
				<div style="clear:both;"></div>
	</form>
				</div>
				<div class="col-sm-4 col-md-4"></div>
	</div>
	</div>




<script src="js/qwrs.js"></script>
	<script src="boot/js/bootstrap.min.js"></script>
</body>
</html>