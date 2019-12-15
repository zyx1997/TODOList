<?php
	include("include/util.php");
	$title = trim($_POST["note_title"]);
	session_start();
	check();
	$login = $_SESSION["login"];
	if(empty($title)){
		echo "note";
		//error_print("note");
	}else{
		$dir = glob(dbpath()."$login/notes/*");
		$note_id = note_id($dir[count($dir)-1], $login)+1;
		file_put_contents(dbpath()."$login/notes/$note_id", $title."\nCreated ".date("Y-m-d h:ia")."\n");
		echo "success";
		//header("Location: notes.php");
	}
?>