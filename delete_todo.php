<?php	
	function del_todo($del_file, $del_todo){
		$infos = file_get_contents($del_file);
		//$founded = array_search("do:$del_todo", $infos);
		$infos = str_replace("do:$del_todo", "done:$del_todo", $infos);
		file_put_contents($del_file, $infos);
		echo "success";
		//header("Location: notes.php");
	}
?>