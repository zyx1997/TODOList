<?php	
	function add_todo($del_file, $str){
		$todo = trim($str);
		if(empty($todo)){
			echo "todo";
		}else{
			file_put_contents($del_file, "$todo\n", FILE_APPEND);
			echo "success";
			//header("Location: notes.php");
		}
		
	}
?>