<?php
try{
	session_start();

	$option = array(
		PDO::ATTR_ERRMODE 
			=> PDO::ERRMODE_EXCEPTION);

	$conn = new PDO(
		"mysql:host=localhost;dbname=test;charset=utf8",
		"root", "abc123456", $option);

}catch(PDOException $e){
	die($e->getMessage());
}
