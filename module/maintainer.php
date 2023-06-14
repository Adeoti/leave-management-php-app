<?php
	//Interface Class
		class Gui{
			public $gridpane;
			public function grid($table = array()){
					$gridpane =  "<table class='table table-light table-stripped'>";
						foreach($table as $th => $td){
							$gridpane .= '<tr><th>'.$th.'<th></tr>';
						}
						$gridpane .= "</table>";
				}
				
				
				public function showTab(){
						if(isset($_GET['tab'])){
							echo "<span class='badge badge-pill badge-info'><i class='fa fa-folder-open'></i> ".ucfirst($_GET['tab'])."</span>";
						}else{
							echo "<span class='badge badge-pill badge-info'><i class='fa fa-folder-open'></i> Dashboard </span>";
							}
					}
				
			
		}
	
	
	
	// Admin Class
	class Admin extends Staff{
		public function addStaff($fname,$lname,$email,$pass,$rank,$dept,$level){
			require("../config/config.php");
				$add_ = $con -> prepare("INSERT INTO staff(fname,lname,email,signature,rank,department,level,dated) VALUES(?,?,?,?,?,?,?,?)");
					if($add_ -> execute(array($fname,$lname,$email,$pass,$rank,$dept,$level,date("M d,Y")))){
						$this -> echo_success("Staff added successfully!!");
					}else{
						$this -> echo_error("Application Error !");
					}
				
		}
		public function fetch_garax($style,$tbl){
			require("../config/config.php");
			if(isset($style) && $style == "combo"){
				$fetch = $con -> prepare("SELECT * FROM $tbl ORDER BY name");
					if($fetch -> execute()){
						if($fetch -> rowCount() > 0){
							$fetch -> setFetchMode(PDO::FETCH_ASSOC);
								while($row = $fetch -> fetch()){
									echo "<option value='".$row['name']."'>".$row['name']."</option>";
								}
						}else{
							return "<option value=''>Empty directory</option>";
						}
					}else{
						$this -> echo_error("Error Occurred!");
					}
			}
		}
		public function create_leave($name,$department,$level,$duration){
			require("../config/config.php");
			$chech_exist = $con -> prepare("SELECT * FROM leave_type WHERE name = ? AND department = ? AND level = ?");
				if($chech_exist -> execute(array($name,$department,$level))){
					if($chech_exist -> rowCount() > 0){
						$this -> echo_error("You've already created this leave type.");
					}else{
							$create_now = $con -> prepare("INSERT INTO leave_type(name,department,level,duration) VALUES(?,?,?,?)");
							if($create_now -> execute(array($name,$department,$level,$duration))){
								$this -> echo_success("The leave has been added successfully");
							}else{
					$this -> echo_error("Something went wrong. SORRY");
							}
					}
				}else{
					$this -> echo_error("Something went wrong. SORRY");
				}
		}
		public function login_admin($uname,$pword){
			require("../config/config.php");
			$chk = $con -> prepare("SELECT * FROM admin WHERE uname = ? AND password = ?");
			if($chk -> execute(array($uname,$pword))){
				if($chk -> rowCount() > 0){
					$chk -> setFetchMode(PDO::FETCH_ASSOC);
						while($row = $chk -> fetch()){
							$_SESSION['adm_ref'] = $row['ref'];
							$_SESSION['adm_name'] = $row['name'];
								
						}
					header("Location:dashboard.php");
				exit();
				}else{
				$this -> echo_error("Invalid admin login details");
				}
			}else{
				$this -> echo_error("Application Error");
			}
			
		}
		public function addDeptLevel($name,$tbl){
			require("../config/config.php");
			if(isset($name)){
				$check_exist = $con -> prepare("SELECT * FROM $tbl WHERE name = ?");
					if($check_exist -> execute(array($name))){
						if($check_exist -> rowCount() > 0){
							
						$this -> echo_error("The $tbl has already been added!");
						}else{
								$create_deptlevel = $con -> prepare("INSERT INTO $tbl(name,date) VALUES(?,?)");
										$the_fuel = array($name,date("M d,Y"));
									if($create_deptlevel -> execute($the_fuel))
									{
										$this -> echo_success("Added Successfully");
									}else{
						$this -> echo_error("Application Error @ $tbl creation!");
									}
							}
					}else{
						$this -> echo_error("Application Error @ $tbl creation!");
					}
			}
		}
		public function remove($agent,$table){
			require("../config/config.php");
			if(isset($agent) && isset($table)){
				$remove = $con -> prepare("DELETE FROM $table WHERE ref = ?");
					if($remove -> execute(array($agent))){
						$this -> echo_success("Successfully Deleted");
						return true;
					}else{
						return false;
						$this -> echo_error("Deleting failed!");
						}
			}
		}
		public function updateDeptLev($ref,$tbl){
			$update = $con -> prepare("UPDATE $tbl SET name = ? WHERE ref  = ?");
			$update_fuel = array($ref);
				if($update -> execute($update_fuel)){
					$this -> echo_success("Updated Successfully!");
				}else{
					$this -> echo_error("Problem occurred while altering $tbl");
				}
		}
		
	}
	
	
	// Supervisor Class
	class Supervisor extends Staff{
		
		public function handleLeave($action,$ref,$reason,$supervior_id){
				//########
				//	Approve
				//########
				if(isset($action) && $action == "approve"){
					$approve = $con -> prepare("UPDATE leave SET status = ?, reason = ?, action_by = ? WHERE ref = ?");
					if($approve -> execute(array(1,$reason,$supervior_id,$ref))){
						$this -> echo_success("Approved Successfully!");
					}else{
						$this -> echo_error("Error Occurred");
					}
				}
				//########
				//	Reject
				//#########
				if(isset($action) && $action == "decline"){
					$decline = $con -> prepare("UPDATE leave SET status = ?, reason = ?, action_by = ? WHERE ref = ?");
					if($decline -> execute(array(3,$reason,$supervior_id,$ref))){
						$this -> echo_success("Declined Successfully!");
					}else{
						$this -> echo_error("Error Occurred");
					}
				}
			
		}
		
	}
	
	
					
	// Staff Class
	class Staff{
			public function notify($from1,$from2,$to,$subject,$msg){
				require("../config/config.php");
					$notify = $con -> prepare("INSERT INTO notification(subject,msg,sender_ref,sender_name,receiver_ref,date) VALUES(?,?,?,?,?,?)");
						if($notify -> execute(array($subject,$msg,$from1,$from2,$to,date("M d,Y")))){
							//give no sign!
						}else{
							$this -> echo_error("Error Occurred");
						}
			}
		public function fetch_garaxt($style){
			require("../config/config.php");
			if(isset($style) && $style == "combo"){
				$fetch = $con -> prepare("SELECT * FROM leave_type WHERE department = ? OR department = ? AND level = ? OR level = ? ORDER BY name");
					if($fetch -> execute(array("all",$_SESSION['sid_dept'],"all",$_SESSION['sid_level']))){
						if($fetch -> rowCount() > 0){
							$fetch -> setFetchMode(PDO::FETCH_ASSOC);
								while($row = $fetch -> fetch()){
									echo "<option value='".$row['name']."'>".$row['name']."</option>";
								}
						}else{
							return "<option value=''>Empty directory</option>";
						}
					}else{
						$this -> echo_error("Error Occurred!");
					}
			}
		}
			public function echo_error($error = ""){
				if(isset($error) && $error != "")
				{
					echo  "<div style='background:#fff; color:#f00; padding:6px;'><i class='fa fa-warning'></i> ".$error."</div>";
				}
			}
			public function echo_success($success = ""){
				if(isset($success) && $success != "")
				{
					echo  "<div style='background:#fff; color:#2e9fff; padding:6px;'><i class='fa fa-check'></i> ".$success."</div>";
				}
			}
		public function verify_login($email,$password){
			require("config/config.php");
				$check = $con -> prepare("SELECT * FROM staff WHERE email = ? AND signature = ? ");
					if($check -> execute(array($email,$password))){
						if($check -> rowCount() > 0){
							//Establish Session !
							$check -> setFetchMode(PDO::FETCH_ASSOC);
							while($red = $check -> fetch()){
								$_SESSION['sid_ref'] = $red['ref'];
								$_SESSION['sid_fname'] = $red['fname'];
								$_SESSION['sid_lname'] = $red['lname'];
								$_SESSION['sid_email'] = $red['email'];
								$_SESSION['sid_rank'] = $red['rank'];
								$_SESSION['sid_level'] = $red['level'];
								$_SESSION['sid_dept'] = $red['department'];
								$_SESSION['sid_dated'] = $red['dated'];
								
								
							}
							
							return true;
						}else{
							return false;
						}
					}else{
						$this -> echo_error("Application Error");
					}
		}
		public function login($email,$password){
			if($this -> verify_login($email,$password)){
				header("Location:staff/");
				exit();
			}else{
				$this -> echo_error("Invalid Login Details");
			}
		}
		public function request_leave($leave_name,$staff_ref,$staff_name,$staff_dept,$staff_level,$leave_reason,$action_reason,$leave_contact,$leave_year,$leave_status,$supervisor_ref,$supervisor_name,$date_approved,$date_requested){
			require("../config/config.php");
				$post_request = $con -> prepare("INSERT INTO leavee(leave_name,staff_ref,staff_name,staff_dept,staff_level,leave_reason,action_reason,leave_contact,leave_year,leave_status,supervisor_ref,supervisor_name,date_approved,date_requested) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$request_fuel = array($leave_name,$staff_ref,$staff_name,$staff_dept,$staff_level,$leave_reason,$action_reason,$leave_contact,$leave_year,$leave_status,$supervisor_ref,$supervisor_name,$date_approved,$date_requested);
					if($post_request -> execute($request_fuel)){
						echo "<script>window.alert('Your request has been made. Thanks!')</script>";
					}else{
						$this -> echo_error("Couldn't make leave request! Try again please");
					}
		}
		public function alter_password($staff_id, $old_password, $new_password){
			$check_compatible = $con -> prepare("SELECT * FROM staff WHERE password = ? AND ref = ?");
				$check_fuel = array($old_password,$new_password);
				if($check_compatible -> execute($check_fuel)){
					if($check_compatible -> rowCount() > 0){
						$change_it = $con -> prepare("UPDATE staff SET password = ? WHERE ref = ?");
							$change_it_fuel = array($new_password,$staff_id);
						if($change_it -> execute($change_it_fuel)){
							$this -> echo_success("Your password has been changed successfully");
						}else{
						$this -> echo_error("Application Error while updating. We're sorry!");
						}
					}else{
						$this -> echo_error("Incorrect old password");
					}
				}else{
					$this -> echo_error("Error Occurred");
				}
		}
		public function withdraw_leave($staff_id,$leave_id){
			require("../config/config.php");
			$check_approval = $con -> prepare("SELECT * FROM leavee WHERE leave_status = ? AND staff_ref = ? AND ref = ?");
				$check_approval_fuel = array(0,$staff_id,$leave_id);
					if($check_approval -> execute($check_approval_fuel)){
						if($check_approval -> rowCount() < 1 ){
						$this -> echo_error("Sorry. The leave has been approved and cannot be cancelled");
						}else{
							$withdraw = $con -> prepare("DELETE FROM leavee WHERE ref = ? AND staff_ref = ?");
								$withdraw_fuel = array($leave_id,$staff_id);
									if($withdraw -> execute($withdraw_fuel)){
										return true;
										//$this -> echo_success("The leave has been cancelled!");
									}else{
						$this -> echo_error("Application Error !");
									}
							}
					}else{
						$this -> echo_error("Application Error !");
					}
		}
		
	}



?>