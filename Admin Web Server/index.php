<?php include_once("define.php"); ?>
<?php include_once("controllers/Controller.php"); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php session_start(); ?>
<?php
	$controller = new Controller();
	$isLogged = false;
	if(isset($_SESSION['logged'])){
		$isLogged = $_SESSION['logged'];
	}

	$task = "frmLogin"; 
	if(isset($_GET['task'])){
		if($_GET['task'] == "loginSystem"){
			$task = $_GET['task'];
		}
	}

	if($isLogged){
		$task = "showListAdapter";	
		if(isset($_GET['task'])){
			$task = $_GET['task'];
		}
	}
		
	$check = method_exists($controller, $task);
	if($check === false){
		$task = "showError404"; 
	}
	$controller->$task();
	return;
	
?>