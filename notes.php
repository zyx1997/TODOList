<?php
	include("include/util.php");
	session_start();
	check();
	$login = $_SESSION["login"];
	$notes = glob(dbpath()."$login/notes/*");
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title>2DO</title>
    <meta charset="utf-8" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <script src="js/simpleajax.js"></script>
    <script src="js/exercise-4.js"></script>
  </head>
<body>
	
	<a id="logout" href="logout.php">
		<input class="button" type="button" value="Logout" />
	</a>
	
	<div id="top_banner">
		<form>
			<div>
				<span class="left"><?= get_name($login) ?>'s <span id="logo">2DO</span> notes</span>
			</div>
			<div class="right">
				<input class="button right" type="button" name = "add_note" value="Add note" title="add a new note"/>
				<input class="right" type="text" name="note_title" />
				<div>Enter the title of your new note here</div>
			</div>
		</form>
	</div>
	
	<div id="content">
	<?php foreach ($notes as $note) { 
		$info = get_items($note);
	?>
		<form class="list left">	
			<input type="hidden" name="todo_id" value=<?= note_id($note, $login) ?> />
			<div class="note_title" title="<?=get_date($note) ?>" >
				<?= htmlspecialchars(get_title($note)) ?><input class="button right" type="button" name="delete_note" value="X" title="delete this note"/>
			</div>	
			<ul>
				<?php foreach ($info as $item) {
					$it = explode(":",$item);
				?>
					<li><span class="todo <?= $it[0]?>"><?= htmlspecialchars($it[1])?></span></li>
				<?php } ?>
			</ul>
			<div>
				<input class ='left text_input' type="text" name="new_todo" />
			<input class ='right button' name="add_todo" type="button" value="+" title="add a todo"/>
		</div>	
	</form>
	<?php } ?>
	
</div>
</body>
</html>