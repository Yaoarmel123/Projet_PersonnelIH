<?php
	try{
		$pdo=new PDO("mysql:host=localhost;dbname=bd_etudiants","root","");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
?>