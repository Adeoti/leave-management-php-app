<div class="col-sm-2 bg-light col-md-2 jumbotron" style=" padding-top:17px; border-radius:0px; border-right:2px solid #eee;">

					<a href="../staff/" class="btn btn-sm btn-primary" style="width:100%;"><i class="fa fa-tachometer"></i> Dashboard</a><br/><hr/>
					<center><b><i class="fa fa-cogs"></i> Q-Tools</b></center><hr/>
					<a href="javascript:void(0)" class="btn requleave btn-sm btn-outline-secondary" style="width:100%;"><i class="fa fa-bolt"></i> make request</a><br/><br/>
					<a href="leave_history.php?tab=Leave+History" class="btn btn-sm btn-outline-secondary" style="width:100%;"><i class="fa fa-history"></i> leave history</a><br/><br/>
					<a href="eligibility.php?tab=Eligibility_Status" class="btn btn-sm btn-outline-secondary" style="width:100%;"><i class="fa fa-eye"></i> view eligibility</a><br/><br/>
					<a href="levels.php?tab=Levels" class="btn btn-sm btn-outline-secondary" style="width:100%;"><i class="fa fa-money"></i> query balance</a><br/><br/>
					
					<br/>
					<center><b><i class="fa fa-key"></i> Account</b></center><hr/>
					<a href="myaccount.php?tab=My+Account" class="btn btn-sm btn-secondary" title="create &amp; manage leave types" style="width:100%;"><i class="fa fa-briefcase"></i> my account</a><br/><br/>
					<a href="javascript:void(0)" class="btn password_chng btn-sm btn-secondary" style="width:100%;"><i class="fa fa-lock"></i> change password</a><br/><br/>
					<a href="notification.php?tab=Notification" class="btn  btn-sm btn-outline-secondary" title="Notifications" style="width:100%;"><i class="fa fa-bell"></i> Notification</a><br/><br/>
				</div>
				<div class="modal fade requleave">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4>Request for leave</h4>
									<a href="javascript:void(null)" class="close" data-dismiss="modal">&times;</a>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<label for="leave_type" style="font-weight:600; color:#0671a7;">Leave Type</label>
									<select required name="leave_name" id="leave_type" style="width:100%; height:35px; text-indent:10px; border:2px solid #eee; border-radius:5px;">
										<?php
											$leave_ = new Staff();
												$leave_ -> fetch_garaxt("combo");
										?>
									</select><br/><br/>
									<label for="leave_contact" style="font-weight:600; color:#0671a7;">Contact on leave</label>
									<input type="text" required name="leave_contact" id="leave_contact" style="width:100%; text-indent:10px; height:35px; border:2px solid #eee; border-radius:5px;"/>
										<br/><br/>
									<label for="leave_reason" style="font-weight:600; color:#0671a7;">Reason for leave</label>
									<textarea required name="leave_reason" id="leave_reason" style="width:100%; resize:none; text-indent:10px; height:95px; border:2px solid #eee; border-radius:5px;"></textarea>
										
										<div style="float:right;"><br/>
											<button name="mkrqst" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> place request</button>
										</div>
										<div style="clear:both;"></div>
										
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade password_chng">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4>Change Your Password</h4>
									<a href="javascript:void(0)" class="close" data-dismiss="modal">&times;</a>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<label for="oldPass">Old Password</label><br/>
										<input type="password" name="oldPass" id="oldPass" required style="height:35px; text-indent:10px; width:100%; border:2px solid #eee; border-radius:5px;"/><br/><br/>
									<label for="newPass">New Password</label><br/>
										<input type="password" name="newPass" id="newPass" required style="height:35px; text-indent:10px; width:100%; border:2px solid #eee; border-radius:5px;"/><br/><br/>
								<label for="newPass">Re-type New Password</label><br/>
										<input type="password" name="rePass" id="newPass" required style="height:35px; text-indent:10px; width:100%; border:2px solid #eee; border-radius:5px;"/><br/><br/>
								<div style="float:right;"><br/>
									<button name="chng_pass" class="btn  btn-sm btn-info"><i class="fa fa-check"></i> Change now</button>
								</div>
								<div style="clear:both;"></div>
								</form>
							
							</div>
						</div>
					</div>
				</div>
				
				
				<?php
					require("../config/config.php");
					
					if(isset($_POST['chng_pass'])){
						$oldPass = htmlspecialchars(trim($_POST['oldPass']));
						$newPass = htmlspecialchars(trim($_POST['newPass']));
						$rePass = htmlspecialchars(trim($_POST['rePass']));
						
							if($newPass === $rePass){
								$chke = $con -> prepare("SELECT * FROM staff WHERE signature = ? AND ref = ? ");
									if($chke -> execute(array($oldPass,$_SESSION['sid_ref']))){
										if($chke -> rowCount() > 0){
											$change_now = $con -> prepare("UPDATE staff SET signature = ? WHERE ref = ?");
												if($change_now -> execute(array($newPass,$_SESSION['sid_ref']))){
								?><script>window.alert('Your password has been changed successfully. \n Ensure you log in with the new password when next you are signing in. \n Thanks !')</script>
											<?php	}else{
								?>
								<script>window.alert('Something went wrong')</script>
										<?php			
												}
										}else{
								?><script>window.alert('Invalid old password. Try again!')</script>
									<?php	}
									}else{
								?>
								<script>window.alert('Something went wrong')</script>
								<?php		
									}
							}else{
								?>
								<script>window.alert('Password Confirmation Error. \n Password do not match!')</script>
								<?php
							}
						
					}
					
					
					if(isset($_POST['mkrqst'])){
						
						
						$leave_name = htmlspecialchars(trim($_POST['leave_name']));
						$leave_contact = htmlspecialchars(trim($_POST['leave_contact']));
						$leave_reason = htmlspecialchars(trim($_POST['leave_reason']));
						$leave_status = 0;
						$staff_ref = $_SESSION['sid_ref'];
						$staff_name = $_SESSION['sid_fname']." ".$_SESSION['sid_lname'];
						$staff_level = $_SESSION['sid_level'];
						$staff_dept = $_SESSION['sid_dept'];
						$leave_year = date("Y");
						$supervisor_ref = "";
						$supervisor_name = "";
						$date_approved = "";
						$action_reason = "";
						$date_requested = date("M d,Y");
								$crt = new Staff();
					$crt -> request_leave($leave_name,$staff_ref,$staff_name,$staff_dept,$staff_level,$leave_reason,$action_reason,$leave_contact,$leave_year,$leave_status,$supervisor_ref,$supervisor_name,$date_approved,$date_requested);
									//$crt -> request_leave($leave_type,$staff_ref,$staff_name,$staff_dept,$staff_level,$leave_reason,$leave_contact,$leave_year,$leave_status,$supervisor_ref,$supervisor_name);
						
					}
				?>