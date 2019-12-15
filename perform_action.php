<?php
	include("include/util.php");
	session_start();
	check();
	$login = $_SESSION["login"];
	$note_id = $_POST["todo_id"];
	
	$del_file = dbpath()."$login/notes/$note_id";
	if ( isset($_POST["delete_note"])) {
		include("delete_note.php");
		del_note($del_file);
	}
	else if(isset($_POST["delete_todo"])){
		include("delete_todo.php");
		del_todo($del_file,$_POST["del_todo"]);
	}
	else {
		include("add_todo.php");
		add_todo($del_file, $_POST["new_todo"]);
	}
	
?>