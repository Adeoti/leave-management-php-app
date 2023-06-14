<?php
session_start();
	require("../config/config.php");
	require("../module/maintainer.php");
		if(isset($_GET['ref']) && isset($_GET['staff'])){
			$ref = preg_replace('/[^0-9]/', "", $_GET['ref']);
			$staff = preg_replace('/[^0-9]/', "", $_GET['staff']);
				$reverse = $con -> prepare("UPDATE leavee SET leave_status = ? WHERE ref = ?");
					if($reverse -> execute(array(1,$ref))){
						$sp_name = $_SESSION['adm_name'];
							$notify = new Staff();
							$notify -> notify($_SESSION['adm_ref'],$sp_name,$staff,"Reversed","Your Approved leave has been reversed (stoped).");
						echo "Reversed Successfully !";
					}else{
						echo "Error Occurred!";
					}
			
		}
?>