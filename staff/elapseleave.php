<?php
session_start();
	require("../config/config.php");
	require("../module/maintainer.php");
	if(isset($_GET['ref']) && isset($_GET['staff_key'])){
		$ref = preg_replace('/[^0-9]/',"",$_GET['ref']);
		$staff = preg_replace('/[^0-9]/',"",$_GET['staff_key']);
		$elapse = $con -> prepare("UPDATE leavee SET leave_status = ? WHERE ref = ?");
			if($elapse -> execute(array(5, $ref))){
				$notify = new Staff();
					$notify -> notify($_SESSION['sid_ref'],$_SESSION['sid_fname']." ".$_SESSION['sid_lname'],$staff,"Time Out !","Your leave has been brought to an end! ".$_SESSION['sid_fname']." ".$_SESSION['sid_lname'].".");
					echo "Elapsed!";
			}else{
				echo "Error Occurred";
			}
			
	}

?>