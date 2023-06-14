<div class="col-sm-12 col-md-12" style="background:#fff; border-bottom:1px solid lime; padding-top:5px; padding-bottom:5px;">
					
						&nbsp; &nbsp; &nbsp; &nbsp; <span  class="text-success" style="font-size:19px;"><img src="../gallery/logo.jpg" style="height:80px; width:80px;"><span style="color:green; font-family:Dancing Script, cursive; font-weight:700; ">Leave Management System</span></span>
				 
				
				&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
				<?php
					require("../module/maintainer.php");
					$Gui = new Gui();
						$Gui -> showTab("tab");
				
				?>
				&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
				<span class="badge  badge-light" style="padding:4px; border-radius:5px; font-weight:600; color:;"><i class="fa fa-user"></i>	<?php echo $_SESSION['sid_fname']." ".$_SESSION['sid_lname']?></span>
				 
					<div style="float:right; margin-top:4px; margin-right:100px;">
					
						<a href="logout.php" title="documentation" class="btn btn-sm btn-secondary"><i class="fa fa-question-circle"></i></a>
						<a href="logout.php" title="log out" class="btn btn-sm btn-danger"><i class="fa fa-power-off"></i></a>
					</div>
				
				</div>