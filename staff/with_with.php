<?php
session_start();
require("../module/maintainer.php");
	if(isset($_GET['tagrf'])){
		$tag = preg_replace('/[^0-9]/',"",$_GET['tagrf']);
			$withdraw = new Staff();
				$done = $withdraw -> withdraw_leave($_SESSION['sid_ref'],$tag);
				if($done){
					echo "<script>window.alert('Withdrew successfully!')</script>";
					echo "<script>window.open('leave_history.php?tab=Leave+History','_self')</script>";
				}else{
					echo "<script>window.alert('Error Occurred !')</script>";
					echo "<script>window.open('leave_history.php?tab=Leave+History','_self')</script>";
				}
				
	}
?>