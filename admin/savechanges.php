<?php
	if(isset($_GET['agent'])){
		require("../config/config.php");
		$agent  = preg_replace('/[^0-9]/',"",$_GET['agent']);
		$tbl = $_GET['whereTo'];
		$new_val = $_GET['newinput'];
		$old_val = $_GET['oldVal'];
		$tbbl = "";
			if($tbl == "level"){
				$new_val = preg_replace('/[^0-9]/',"",$new_val);
					$tbbl = "staff_level";
			}
			else
			{
				$tbbl = "staff_dept";
			}
			
			$change = $con -> prepare("UPDATE $tbl SET name = ? WHERE ref = ?");
				if($change -> execute(array($new_val,$agent))){
					echo "";
					//update staff in that category : level / department
						$update_staff = $con -> prepare("UPDATE staff SET $tbl = ? WHERE $tbl = ?");
							$update_staff -> execute(array($new_val,$old_val));
						
					//Update Leavee tbl
						$alter_leave = $con -> prepare("UPDATE leavee SET $tbbl = ? WHERE $tbbl = ?");
						$alter_leave -> execute(array($new_val,$old_val));
				
						
					//update leave type
					$update_leaveType = $con -> prepare("UPDATE leave_type SET $tbl = ? WHERE $tbl = ?");
						$update_leaveType -> execute(array($new_val,$old_val));
						
						
						
						
						
				}else{
					echo "Couldn't save changes!";
				}
	}

?>