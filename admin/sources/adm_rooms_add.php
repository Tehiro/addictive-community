<?php

	## ---------------------------------------------------
	#  ADDICTIVE COMMUNITY
	## ---------------------------------------------------
	#  Developed by Brunno Pleffken Hosti
	#  File: adm_rooms_add.php
	#  Release: v1.0.0
	#  Copyright: (c) 2014 - Addictive Software
	## ---------------------------------------------------
		
	// ---------------------------------------------------
	// Create permission matrix
	// ---------------------------------------------------
	
	// View
	
	function MatrixView()
	{
		global $Db;

		$Db->Query("SELECT * FROM c_usergroups;");
		
		$title = "";
		$checkboxes = "";
		
		while($view_g = $Db->Fetch()) {
			$title .= "<td>{$view_g['name']}</td>";

			if($view_g['view_board'] == 1) {
				$checkboxes .= "<td class=\"center\"><input type=\"checkbox\" name=\"view[]\" value=\"V_{$view_g['g_id']}\" checked></td>";
			}
			else {
				$checkboxes .= "<td class=\"center\"><input type=\"checkbox\" name=\"view[]\" value=\"V_{$view_g['g_id']}\"></td>";
			}
		}
		
		$view = "
		<table cellspacing=\"0\"><tr>
			{$title}
			</tr><tr>
			{$checkboxes}
		</tr></table>";
		
		return $view;
	}
	
	// Post
	
	function MatrixPost()
	{
		global $Db;

		$Db->Query("SELECT * FROM c_usergroups;");
		
		$title = "";
		$checkboxes = "";
		
		while($view_g = $Db->Fetch()) {
			$title .= "<td>{$view_g['name']}</td>";
			
			if($view_g['post_new_threads'] == 1) {
				$checkboxes .= "<td class=\"center\"><input type=\"checkbox\" name=\"post[]\" value=\"V_{$view_g['g_id']}\" checked></td>";
			}
			else {
				$checkboxes .= "<td class=\"center\"><input type=\"checkbox\" name=\"post[]\" value=\"V_{$view_g['g_id']}\"></td>";
			}
		}
		
		$post = "
		<table cellspacing=\"0\"><tr>
			{$title}
			</tr><tr>
			{$checkboxes}
		</tr></table>";
		
		return $post;
	}
	
	// Reply
	
	function MatrixReply()
	{
		global $Db;

		$Db->Query("SELECT * FROM c_usergroups;");
		
		$title = "";
		$checkboxes = "";
		
		while($view_g = $Db->Fetch()) {
			$title .= "<td>{$view_g['name']}</td>";
			
			if($view_g['reply_threads'] == 1) {
				$checkboxes .= "<td class=\"center\"><input type=\"checkbox\" name=\"reply[]\" value=\"V_{$view_g['g_id']}\" checked></td>";
			}
			else {
				$checkboxes .= "<td class=\"center\"><input type=\"checkbox\" name=\"reply[]\" value=\"V_{$view_g['g_id']}\"></td>";
			}
		}
		
		$reply = "
		<table cellspacing=\"0\"><tr>
			{$title}
			</tr><tr>
			{$checkboxes}
		</tr></table>";
		
		return $reply;
	}
	
?>

<script type="text/javascript">

	function CustomRulesSelect() {
		var checkbox = document.getElementById('rules_visible');
		var rules_title = document.getElementById('rules_title');
		var rules_text = document.getElementById('rules_text');
		
		if(checkbox.checked) {
			rules_title.disabled = false;
			rules_text.disabled = false;
		}
		if(checkbox.checked == false) {
			rules_title.disabled = true;
			rules_text.disabled = true;
		}
	}

</script>

<h1>Add New Room</h1>

<div id="content">

	<div class="grid-row">
		<!-- LEFT -->
		<form action="process.php?do=newroom" method="post">
		
			<table class="table-list">
				<tr>
					<th colspan="2">Room Settings</th>
				</tr>
				
				<tr>
					<td class="title-fixed">Room Name</td>
					<td><input type="text" name="name" class="medium"></td>
				</tr>
				<tr>
					<td class="title-fixed">Room Description</td>
					<td><textarea name="description" class="large" rows="5"></textarea></td>
				</tr>
			</table>
			
			<table class="table-list">
				<tr>
					<th colspan="2">Security</th>
				</tr>
				
				<tr>
					<td class="title-fixed">Password Protection<span class="title-desc">Leave empty if not required</span></td>
					<td><input type="password" name="password" class="small"></td>
				</tr>
				<tr>
					<td class="title-fixed">Read Only</td>
					<td><label><input type="checkbox" name="read_only"> Mark room as Read Only (post and reply not allowed).</label></td>
				</tr>
				<tr>
					<td class="title-fixed">Invisible</td>
					<td><label><input type="checkbox" name="invisible"> Set room as invisible for members, except Administrators.</label></td>
				</tr>
				<tr>
					<td class="title-fixed">Uploads</td>
					<td><input type="checkbox" name="upload" checked="checked"> Allow file uploads in this room.</td>
				</tr>
			</table>
			
			<table class="table-list">
				<tr>
					<th colspan="2">Permissions</th>
				</tr>
				
				<tr>
					<td class="title-fixed">Read Threads</td>
					<td>
						<?php echo MatrixView() ?>
					</td>
				</tr>
				
				<tr>
					<td class="title-fixed">Post New Thread</td>
					<td>
						<?php echo MatrixPost() ?>
					</td>
				</tr>
				
				<tr>
					<td class="title-fixed">Reply Threads</td>
					<td>
						<?php echo MatrixReply() ?>
					</td>
				</tr>
			</table>
			
			<table class="table-list">
				<tr>
					<th colspan="2">Rules</th>
				</tr>
				
				<tr>
					<td class="title-fixed">Enable custom rules<span class="title-desc">Add specific rules to this room?</span></td>
					<td><label><input type="checkbox" id="rules_visible" name="rules_visible" onclick="CustomRulesSelect()"> Enable custom rules to this room.</label></td>
				</tr>
				<tr>
					<td class="title-fixed">Rules Title</td>
					<td><input type="text" name="rules_title" id="rules_title" class="medium" disabled></td>
				</tr>
				<tr>
					<td class="title-fixed">Rules Description</td>
					<td><textarea name="rules_text" id="rules_text" class="large" rows="8" disabled></textarea></td>
				</tr>
			</table>
			
			<div class="box fright"><input type="submit" value="Create Room"></div>
			
		</form>
	</div>

</div>