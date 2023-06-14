<?php
	require("../module/maintainer.php");
	if(isset($_GET['ref'])){
		$tbl = $_GET['tab'];
		$path = $_GET['path'];
		$ref = preg_replace('/[^0-9]/','',$_GET['ref']);
		$trash = new Admin();
			if($trash -> remove($ref,$tbl)){
				 echo "<a href='".$path.".php?tab=$tbl'> return</a>";
			}
				
	}
?>

