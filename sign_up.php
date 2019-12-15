<?php 
	include("include/util.php");

	$firstname = trim($_POST["firstname"]);
	$lastname = trim($_POST["lastname"]);
	$login = trim($_POST["login"]);
	$password = trim($_POST["password"]);
	if(empty($firstname)){
		error_print("firstname");
	}else if(empty($lastname)){
		error_print("lastname");
	}else if(empty($login)){
		error_print("logup");
	}else if(empty($password)){
		error_print("pwdup");
	}else{
		$dir = dbpath().$login;
		mkdir($dir);
		mkdir("$dir/notes");
		$str = $password."\n".$firstname."\n".$lastname;
		file_put_contents("$dir/info.txt", $str);
		header("Location: sign_in_form.php");
	}

?>