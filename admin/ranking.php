<?php
require("../config/config.php");
if(isset($_GET['ref'])){
	$ref = preg_replace('/[^0-9]/',"",$_GET['ref']);
	$makesuperv = $con -> prepare("UPDATE staff SET rank = ? WHERE ref = ?");
		if($makesuperv -> execute(array("supervisor",$ref))){
			echo "<script>window.alert('Asigned successfully')</script>";
			echo "<script>window.open('staffs.php?tab=Staff','_self')</script>";
		}
}
if(isset($_GET['rif'])){
	$rif = preg_replace('/[^0-9]/',"",$_GET['rif']);
	$makesuperv = $con -> prepare("UPDATE staff SET rank = ? WHERE ref = ?");
		if($makesuperv -> execute(array("normal staff",$rif))){
			echo "<script>window.alert('Demoted successfully')</script>";
			echo "<script>window.open('staffs.php?tab=Staff','_self')</script>";
		}
}

?>