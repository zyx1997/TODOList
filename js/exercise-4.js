
window.onload = function() {
	// to save time :)

	function on_failure(){
		alert("An error occured!");
	}
	function on_success(request){
		if(request.responseText!="success")
			window.location.href="error.php?type="+request.responseText;
		//else
			//window.location.href="notes.php";
	}

	function add_note(){
		var title = document.querySelector("input[name=note_title]").value;
		new SimpleAjax('add_note.php', 'POST', "note_title="+title, on_success, on_failure);
		add_note_page(title);
	}

	function add_date_title(){
		var title_info;
		var mydate = new Date();
		var y = mydate.getFullYear();
		var m = mydate.getMonth();
		var d = mydate.getDate();
		var h = mydate.getHours();
		var mm = mydate.getMinutes();
		if(Number(h)>12){
			title_info = "Created "+y+"-"+m+"-"+d+" 0"+(h-12)+":"+mm+"pm";
		}else{
			title_info = "Created "+y+"-"+m+"-"+d+" 0"+h+":"+mm+"am";
		}
		return title_info;
		//Created 2019-02-23 08:40am

	}

	function add_note_page(title){
		var new_form = document.createElement("form");
		new_form.className = "list left";
		document.getElementById("content").appendChild(new_form);
		//create hidden inform
		var new_todo_id = document.createElement("input");
		new_todo_id.type = "hidden";
		new_todo_id.name = "todo_id";
		new_todo_id.value = Number(new_form.previousElementSibling.firstElementChild.value)+1;
		new_form.appendChild( new_todo_id );
		//create title
		var new_title = document.createElement("div");
		new_title.className = "note_title";
		new_title.innerHTML = title;
		//add title information which is the creation time
		new_title.title = add_date_title();
		var new_del_note = document.createElement("input");
		new_del_note.className = "button right";
		new_del_note.type = "button";
		new_del_note.value = "X";
		new_del_note.title="delete this note";
		new_del_note.onclick = delete_note;
		new_title.appendChild(new_del_note);
		new_form.appendChild(new_title);
		//create empty ul
		var new_ul = document.createElement("ul");
		new_form.appendChild(new_ul);
		//create input infomation
		var new_buttons = document.createElement("div");
		var new_todo = document.createElement("input");
		new_todo.className = "left text_input";
		new_todo.type = "text";
		new_todo.name = "new_todo";
		var new_add_todo = document.createElement("input");
		new_add_todo.className = "right button";
		new_add_todo.name = "add_todo";
		new_add_todo.type="button";
		new_add_todo.value="+";
		new_add_todo.title="add a todo";
		new_add_todo.onclick = add_todo;
		new_buttons.appendChild(new_todo);
		new_buttons.appendChild(new_add_todo);
		new_form.appendChild(new_buttons);
	}

	function add_todo(obj){
		var id = obj.target.parentNode.parentNode.firstElementChild.value;
		var content = obj.target.previousElementSibling.value;
		new SimpleAjax('perform_action.php', 'POST', "todo_id="+id+"&new_todo=do:"+content, on_success, on_failure);
		add_todo_page(obj.target);
	}
	//add new todo item;
	function add_todo_page(obj){
		var new_li = document.createElement("li");
		var new_span = document.createElement("span");
		new_span.className = "todo do";
		new_span.onclick = delete_todo;
		new_span.innerHTML = obj.previousElementSibling.value;
		new_li.appendChild(new_span);
		obj.parentNode.previousElementSibling.appendChild(new_li);
		obj.previousElementSibling.value = "";
	}

	function delete_note(obj){
		var id = obj.target.parentNode.parentNode.firstElementChild.value;
		new SimpleAjax('perform_action.php', 'POST', "todo_id="+id+"&delete_note=X", on_success, on_failure);
		document.getElementById("content").removeChild(obj.target.parentNode.parentNode);

	}

	function delete_todo(obj){
		if(window.confirm('Change the item to be done?')){
            var id = obj.target.parentNode.parentNode.parentNode.firstElementChild.value;
			var content = obj.target.innerHTML;
			new SimpleAjax('perform_action.php', 'POST', "todo_id="+id+"&delete_todo=X"+"&del_todo="+content, on_success, on_failure);
			obj.target.className = "todo done";
        }
		
	}

	function add_onlick(objs,on_click){
		for(var i=0; i<objs.length; i++){
			objs[i].onclick = on_click;
		}
	}

	document.querySelector("input[name=add_note]").onclick = add_note;
	var add_todo_lists = document.querySelectorAll("input[name=add_todo]");
	add_onlick(add_todo_lists,add_todo);
	var del_note_lists = document.querySelectorAll("input[name=delete_note]");
	add_onlick(del_note_lists,delete_note);
	var del_todo_lists = document.getElementsByClassName("todo do");
	add_onlick(del_todo_lists,delete_todo);
};
