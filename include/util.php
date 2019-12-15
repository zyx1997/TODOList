<?php


# returns the relative path of the database folder
function dbpath() {
	return "2doDB/";
}

# returns the first name of the user of login $login
function get_name($login) {
	$info = file(dbpath()."$login/info.txt",FILE_IGNORE_NEW_LINES);
	return $info[1];
}

# extract the note id (a number) from the file path
# of the file. For example, note_id("2doDB/marc/notes/3") returns "3"
function note_id($note_file, $login) {
	return str_replace(dbpath()."$login/notes/", "", $note_file);
}

# returns the title of the $note array
function get_title($note) {
	$info = file($note,FILE_IGNORE_NEW_LINES);
	return $info[0];
}

# returns the date of the $note array
function get_date($note) {
	$info = file($note,FILE_IGNORE_NEW_LINES);
	return $info[1];
}
# returns the items of the $note array
function get_items($note) {
	$info = file($note,FILE_IGNORE_NEW_LINES);
	return array_slice($info,2);
}
#print the error messages
function error_print($type){
	header("Location: error.php?type=$type");
}
#check $login is correct
function check_log($login) {
	$names = glob(dbpath()."*");
	$tmp = dbpath().$login;
	if(in_array($tmp, $names)){
		return true;
	}
	return false;
	
}
#check $password is correct
function check_pwd($login,$pwd) {
	$info = file(dbpath()."$login/info.txt",FILE_IGNORE_NEW_LINES);
	if(strcmp($info[0],$pwd)==0){
		return true;
	}
	return false;
}
#check whether login
function check(){
	if(!isset($_SESSION["login"])){
		error_print("nologin");
		die();
	}

}

?>
