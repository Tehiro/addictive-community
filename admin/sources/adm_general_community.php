<?php

	## ---------------------------------------------------
	#  ADDICTIVE COMMUNITY
	## ---------------------------------------------------
	#  Developed by Brunno Pleffken Hosti
	#  File: adm_general_community.php
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

	<h1>Community</h1>
	
	<div id="content">
	
		<div class="grid-row">
			<!-- LEFT -->
			<form action="process.php?do=save" method="post">
			
				<?php echo $message ?>
			
				<table class="table-list">
					<tr>
						<th colspan="2">General Settings</th>
					</tr>
					
					<tr>
						<td class="title-fixed">Community name</td>
						<td><input type="text" name="general_communityname" value="<?php echo $Admin->SelectConfig("general_communityname") ?>" class="medium"></td>
					</tr>
					<tr>
						<td class="title-fixed">Root path (URL)<span class="title-desc">Absolute URL of your community</span></td>
						<td><input type="text" name="general_communityurl" value="<?php echo $Admin->SelectConfig("general_communityurl") ?>" class="large"></td>
					</tr>
				</table>
				
				<table class="table-list">
					<tr>
						<th colspan="2">Host Website Information</th>
					</tr>
					
					<tr>
						<td class="title-fixed">Website name</td>
						<td><input type="text" name="general_websitename" value="<?php echo $Admin->SelectConfig("general_websitename") ?>" class="medium"></td>
					</tr>
					<tr>
						<td class="title-fixed">Website URL</td>
						<td><input type="text" name="general_websiteurl" value="<?php echo $Admin->SelectConfig("general_websiteurl") ?>" class="medium"></td>
					</tr>
				</table>
				
				<table class="table-list">
					<tr>
						<th colspan="2">Interface Elements</th>
					</tr>
					
					<tr>
						<td class="title-fixed">Logo image name</td>
						<td><input type="text" name="general_communitylogo" value="<?php echo $Admin->SelectConfig("general_communitylogo") ?>" class="small"></td>
					</tr>
					<tr>
						<td class="title-fixed">Breadcrumb separator</td>
						<td><input type="text" name="general_bread_separator" value="<?php echo $Admin->SelectConfig("general_bread_separator") ?>" class="small"></td>
					</tr>
					<tr>
						<td class="title-fixed">Show members online</td>
						<td><label><?php echo $Admin->SelectCheckbox("general_sidebar_online") ?> Show members online in sidebar.</label></td>
					</tr>
					<tr>
						<td class="title-fixed">Show statistics</td>
						<td><label><?php echo $Admin->SelectCheckbox("general_sidebar_stats") ?> Show community statistics in sidebar.</label></td>
					</tr>
				</table>
				
				<table class="table-list">
					<tr>
						<th colspan="2">SEO (Search Engine Optimization) Settings</th>
					</tr>
					
					<tr>
						<td class="title-fixed">META Description</td>
						<td><textarea name="seo_description" class="large" rows="3"><?php echo $Admin->SelectConfig("seo_description") ?></textarea></td>
					</tr>
					<tr>
						<td class="title-fixed">META Keywords</td>
						<td><textarea name="seo_keywords" class="large" rows="3"><?php echo $Admin->SelectConfig("seo_keywords") ?></textarea></td>
					</tr>
				</table>
				
				<div class="box fright"><input type="submit" value="Save Settings"></div>
				
			</form>
		</div>

	</div>