<?php	
	function del_note($del_file){
		unlink($del_file);
		echo "success";
		//header("Location: notes.php");
	}
?>