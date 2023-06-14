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
					<div class="col-sm-1 col-md-1 "></div>
					<div class="col-sm-8 col-md-8 ">
						<article><br/>
								<h4>Welcome To The Control Dashboard</h4>
									This admin dashboard allows you to take full control of this leave application. It, however enables you (the administrator) to checkmate and oversee the tremendous activities of leaves in the Institute. Following are your designated duties as the admin:<br/>
<br/>

										<ul style="line-height:46px;">
											<li> Adding and managing Institute staff.</li>
											<li> Adding and managing leave types.</li>
											<li> Adding and modifying staff level in accordance to the Institute tone.</li>
											<li> Adding and manipulating available departments in the Institute.</li>
											<li> Approving forwarded leave requests.</li>
											<li> Ranking and de-ranking added staff.</li>
										
										</ul><hr/>
											<div style="float:right;"><b style="font-family:monotype corsiva;">Feel free ! It's user-friendly!</b></div>
												<div style="clear:both;"></div>
						</article>
					
					</div>
			<?php require("footer.php"); ?>
	</div>
	</div>




<script src="js/qwrs.js"></script>
	<script src="boot/js/bootstrap.min.js"></script>
</body>
</html>