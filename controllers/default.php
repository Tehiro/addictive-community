<?php

	## ---------------------------------------------------
	#  ADDICTIVE COMMUNITY
	## ---------------------------------------------------
	#  Developed by Brunno Pleffken Hosti
	#  File: default.php
	#  Release: v1.0.0
	#  Copyright: (c) 2014 - Addictive Software
	## ---------------------------------------------------

	// ---------------------------------------------------
	// Format page title
	// ---------------------------------------------------

	if($pageinfo['title'] != "") {
		$html['title'] = $pageinfo['title'] . " - ";
	}
	else {
		$html['title'] = "";
	}

	// ---------------------------------------------------
	// SEO: If reading thread, META description should be
	// the first 200 characters of the first post
	// ---------------------------------------------------

	if($this->info['module'] == "thread") {
		$this->Core->config['seo_description'] = substr($firstPostInfo['post'], 0, 200);
	}

	// ---------------------------------------------------
	// Set canonical tag in Thread
	// ---------------------------------------------------

	$pageinfo['canonical_address'] = (isset($pageinfo['canonical_address'])) ?  "<link rel='canonical' href='{$pageinfo['canonical_address']}'>\n" : "";

	// ---------------------------------------------------
	// Format breadcrumbs
	// ---------------------------------------------------

	$html['breadcrumb'] = "";

	foreach($pageinfo['bc'] as $item) {
		$html['breadcrumb'] .= " &raquo; " . $item;
	}

	// ---------------------------------------------------
	// SIDEBAR: get member information (when logged in)
	// ---------------------------------------------------

	if($this->member['m_id'] != 0) {
		$m_id = $this->member['m_id'];
		// Get user avatar
		$this->member['avatar'] = $this->Core->GetGravatar(
			$this->member['email'], $this->member['photo'], 60, $this->member['photo_type']
		);

		// Number of new messages
		$this->Db->Query("SELECT COUNT(*) AS total FROM c_messages WHERE to_id = '{$m_id}' AND status = 1;");
		$unreadMessages = $this->Db->Fetch();
	}

	// ---------------------------------------------------
	// SIDEBAR: get list of rooms
	// ---------------------------------------------------

	$rooms = $this->Db->Query("SELECT c_rooms.r_id, c_rooms.name, c_rooms.password,
			(SELECT COUNT(*) FROM c_threads WHERE c_threads.room_id = c_rooms.r_id) AS threads
			FROM c_rooms WHERE invisible = 0;");

	while($result = $this->Db->Fetch($rooms)) {
		$_siderooms[] = $result;
	}

	// ---------------------------------------------------
	// SIDEBAR: get members online
	// ---------------------------------------------------

	// Members online

	$online = array();
	$sessionExpiration = $this->Core->config['general_session_expiration'];

	$members_online = $this->Db->Query("SELECT s.*, m.username FROM c_sessions s
			INNER JOIN c_members m ON (s.member_id = m.m_id)
			WHERE s.member_id <> 0 AND s.activity_time > '{$sessionExpiration}' AND s.anonymous = 0
			ORDER BY s.activity_time DESC;");

	while($members = $this->Db->Fetch($members_online)) {
		$online[] = "<a href=\"index.php?module=profile&amp;id={$members['member_id']}\">{$members['username']}</a>";
	}

	$memberCount = count($online);
	$memberList  = implode(", ", $online);

	// Number of guests

	$this->Db->Query("SELECT COUNT(s_id) AS count FROM c_sessions WHERE member_id = 0;");

	$guestsCount = $this->Db->Fetch();
	$guestsCount = $guestsCount['count'];

	// ---------------------------------------------------
	// SIDEBAR: get community statistics
	// ---------------------------------------------------

	$this->Db->Query("SELECT * FROM c_stats;");
	$statsResultTmp = $this->Db->Fetch();

	$_stats['threads'] = $statsResultTmp['total_threads'];
	$_stats['replies'] = $statsResultTmp['total_posts'];
	$_stats['members'] = $statsResultTmp['member_count'];

	$this->Db->Query("SELECT m_id, username FROM c_members ORDER BY m_id DESC LIMIT 1;");
	$statsResultTmp = $this->Db->Fetch();

	$_stats['lastmemberid']   = $statsResultTmp['m_id'];
	$_stats['lastmembername'] = $statsResultTmp['username'];

?>