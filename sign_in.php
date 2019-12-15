<?php 
	include("include/util.php");
	$login = trim($_POST["login"]);
	$password = trim($_POST["password"]);
	if(!check_log($login)){
		error_print("login1");
	}else if(!check_pwd($login,$password)){
		error_print("login2");
	}else{
		session_start();
		$_SESSION["login"] = $login;
		header("Location: notes.php");
	}

?>