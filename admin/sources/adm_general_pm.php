<?php

	## ---------------------------------------------------
	#  ADDICTIVE COMMUNITY
	## ---------------------------------------------------
	#  Developed by Brunno Pleffken Hosti
	#  File: adm_general_pm.php
	#  Release: v1.0.0
	#  Copyright: (c) 2014 - Addictive Software
	## ---------------------------------------------------
	
	$msg = (Html::Request("msg")) ? Html::Request("msg") : "";
	
	switch($msg) {
		case 1:
			$message = Html::Notification("The settings has been changed successfully.", "success");
			break;
		default:
			$message = "";
			break;
	}
	
?>

	<h1>Personal Messages</h1>
	
	<div id="content">
		<div class="grid-row">
			<form action="process.php?do=save" method="post">
			
				<?php echo $message ?>
			
				<table class="table-list">
					<tr>
						<th colspan="2">PMs Settings</th>
					</tr>
					<tr>
						<td class="title-fixed">Enable personal messages</td>
						<td><label><?php echo $Admin->SelectCheckbox("member_pm_enable") ?> Enable personal messages to all registered members</label></td>
					</tr>
					<tr>
						<td class="title-fixed">Inbox storage size</td>
						<td><input type="text" name="member_pm_storage" class="nano" value="<?php echo $Admin->SelectConfig("member_pm_storage") ?>"> personal messages</td>
					</tr>
				</table>
				
				<div class="box fright"><input type="submit" value="Save Settings"></div>
			</form>
		</div>
	</div>