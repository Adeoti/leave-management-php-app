<?php

	try{
		$con = new PDO("mysql:dbhost=localhost; dbname=theleave", "root","");
	}catch(PDOException $e){
		echo $e -> getMessage();
	}

?>