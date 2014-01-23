<?php

	## ---------------------------------------------------
	#  ADDICTIVE COMMUNITY
	## ---------------------------------------------------
	#  Developed by Brunno Pleffken Hosti
	#  File: profile.php
	#  Release: v1.0.0
	#  Copyright: (c) 2014 - Addictive Software
	## ---------------------------------------------------
	
	// ---------------------------------------------------
	// Which member are we seeing?
	// ---------------------------------------------------

	$id = Html::Request("id");

	// ---------------------------------------------------
	// Get member info
	// ---------------------------------------------------

	$this->Db->Query("SELECT * FROM c_members
		WHERE m_id = '{$id}';");

	$info = $this->Db->Fetch();

	// ---------------------------------------------------
	// Member profile subsections
	// ---------------------------------------------------

	$act = (Html::Request("act")) ? Html::Request("act") : "profile";

	switch($act) {

		// ---------------------------------------------------
		// Profile page
		// ---------------------------------------------------

		case "profile":
			break;

		// ---------------------------------------------------
		// Posts and threads page
		// ---------------------------------------------------

		case "posts":
			break;

		// ---------------------------------------------------
		// Social updates
		// ---------------------------------------------------

		case "updates":
			break;
	}

	// ---------------------------------------------------
	// Where are we?
	// ---------------------------------------------------
	
	// Page information
	$pageinfo['title'] = "{$info['username']}";
	$pageinfo['bc'] = array("Profile: {$info['username']}");

?>