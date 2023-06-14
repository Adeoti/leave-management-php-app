<?php
	require("../config/config.php");
	if(isset($_GET['decline'])){
		$tag = preg_replace('/[^0-9]/',"",$_GET['decline']);
			$dec = $con -> prepare("UPDATE leavee SET leave_status = ? WHERE ref = ?");
				if($dec -> execute(array(4,$tag))){
					echo "<script>window.alert('Declined Successfully')</script>";
				}
	}

?>