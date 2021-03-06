<?php

	## ---------------------------------------------------
	#  ADDICTIVE COMMUNITY
	## ---------------------------------------------------
	#  Developed by Brunno Pleffken Hosti
	#  File: class.html.php
	#  Release: v1.0.0
	#  Copyright: (c) 2014 - Addictive Software
	## ---------------------------------------------------

	class Html
	{
		// ---------------------------------------------------
		// Display formatted error message
		// ---------------------------------------------------

		public static function Error($message)
		{
			echo "<h1>Error!</h1><p>" . $message . "</p><hr><em>Addictive Community - (c) 2014 All rights reserved.</em>";
			exit;
		}

		// ---------------------------------------------------
		// Same as $_REQUEST['var'], but sanitized!
		// ---------------------------------------------------

		public static function Request($name, $numeric = false)
		{
			if(isset($_REQUEST[$name]) && $numeric == true && !is_numeric($_REQUEST[$name])) {
				Html::Error("Variable '{$name}' must be an integer.");
			}

			if(isset($_REQUEST[$name])) {
				$text = $_REQUEST[$name];

				$text = str_replace("&", "&amp;", $text);
				$text = str_replace("<", "&lt;", $text);
				$text = str_replace(">", "&gt;", $text);
				$text = str_replace('"', "&quot;", $text);
				$text = str_replace("'", "&#39;", $text);
				$text = str_replace("\\", "\\\\", $text);
			}
			else {
				return false;
			}

			return $text;
		}

		// ---------------------------------------------------
		// Get uploaded file
		// ---------------------------------------------------

		public static function File($name)
		{
			if(isset($_FILES[$name]) && !empty($_FILES[$name])) {
				return $_FILES[$name];
			}
			else {
				return false;
			}
		}

		// ---------------------------------------------------
		// Remove all non-alphanumeric character
		// ---------------------------------------------------

		public static function Sanitize($string, $allowed = array())
		{
			$allow = null;
			if(!empty($allowed)) {
				foreach ($allowed as $value) {
					$allow .= "\\$value";
				}
			}

			if(!is_array($string)) {
				return preg_replace("/[^{$allow}a-zA-Z0-9]/", "", $string);
			}

			$cleaned = array();
			foreach($string as $key => $clean) {
				$cleaned[$key] = preg_replace("/[^{$allow}a-zA-Z0-9]/", "", $clean);
			}

			return $cleaned;
		}

		// ---------------------------------------------------
		// List of days of the month (1 to 31)
		// ---------------------------------------------------

		public static function Days($name, $current = 1)
		{
			$retval = "<select name=\"{$name}\" id=\"{$name}\" class=\"select2-no-search\" style=\"width: 60px\">";

			for($i = 1; $i <= 31; $i++) {
				$selected = ($i == $current) ? "selected" : "";
				$retval .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
			}

			$retval .= "</select>";

			return $retval;
		}

		// ---------------------------------------------------
		// List of months of the year (Jan to Dec)
		// $lang is REQUIRED if $numeric = false
		// ---------------------------------------------------

		public static function Months($name, $numeric = true, $lang = array(), $current = 1)
		{
			$retval = "<select name=\"{$name}\" id=\"{$name}\" class=\"select2-no-search\" style=\"width: 110px\">";

			for($i = 1; $i <= 12; $i++) {
				$selected = ($i == $current) ? "selected" : "";
				if(!$numeric) {
					$monthName = i18n::Translate("M_" . $i);
					$retval .= "<option value=\"{$i}\" {$selected}>{$monthName}</option>";
				}
				else {
					$retval .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
				}
			}

			$retval .= "</select>";

			return $retval;
		}

		// ---------------------------------------------------
		// Really nice years drop-down generator
		// ---------------------------------------------------

		public static function Years($name, $before, $after, $current = 0)
		{
			$now = date("Y", time());
			$current = ($current == 0) ? $now : $current;

			$retval = "<select name=\"{$name}\" id=\"{$name}\" class=\"select2-no-search\" style=\"width: 75px\">";

			for($i = $now - $before; $i <= $now + $after; $i++) {
				$selected = ($i == $current) ? "selected" : "";
				$retval .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
			}

			$retval .= "</select>";

			return $retval;
		}

		// ---------------------------------------------------
		// List of hours (00 to 23)
		// ---------------------------------------------------

		public static function Hours($name, $current = 0)
		{
			$retval = "<select name=\"{$name}\" id=\"{$name}\" class=\"select2-no-search\">";

			for($i = 0; $i <= 23; $i++) {
				$selected = ($i == $current) ? "selected" : "";
				if($i < 10) {
					$i = "0" . $i;
				}
				$retval .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
			}

			$retval .= "</select>";

			return $retval;
		}

		// ---------------------------------------------------
		// List of minutes (00 to 45)
		// ---------------------------------------------------

		public static function Minutes($name, $current = 0)
		{
			$retval = "<select name=\"{$name}\" id=\"{$name}\" class=\"select2-no-search\">";

			for($i = 0; $i <= 45; $i += 15) {
				$selected = ($i == $current) ? "selected" : "";
				if($i < 10) {
					$i = "0" . $i;
				}
				$retval .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
			}

			$retval .= "</select>";

			return $retval;
		}

		// ---------------------------------------------------
		// Show notification message
		// ---------------------------------------------------

		public static function Notification($message, $code, $persistent = false, $customTitle = "")
		{
			switch($code) {
				case "warning":
					$title = "WARNING!";
					break;
				case "success":
					$title = "SUCCESS!";
					break;
				case "failure":
					$title = "ERROR!";
					break;
				case "info":
					$title = "INFORMATION:";
					break;
			}

			if($persistent) {
				$persistent = "persistent";
			}

			if($customTitle != "") {
				$title = $customTitle;
			}

			$html = "<div class=\"notification " . $code . " " . $persistent . "\"><p><strong>" . $title . "</strong> " . $message . "</p></div>";

			return $html;
		}

		// ---------------------------------------------------
		// "Forum Rules" template
		// ---------------------------------------------------

		public static function ForumRules($title, $text)
		{
			$html = "<div class=\"notification warning\"><p><strong>" . $title . "</strong> " . $text . "</p></div>";
			return $html;
		}

		// ---------------------------------------------------
		// Generate GD image
		// ---------------------------------------------------

		public static function ShowGDImage($content="")
		{
			flush();

			@header("Content-Type: image/jpeg");

			$font_style = 5;
			$no_chars   = strlen($content);

			$charheight = ImageFontHeight($font_style);
			$charwidth  = ImageFontWidth($font_style);
			$strwidth   = $charwidth * intval($no_chars);
			$strheight  = $charheight;

			$imgwidth   = $strwidth  + 15;
			$imgheight  = $strheight + 15;
			$img_c_x    = $imgwidth  / 2;
			$img_c_y    = $imgheight / 2;

			$im       = ImageCreate($imgwidth, $imgheight);
			$text_col = ImageColorAllocate($im, 0, 0, 0);
			$back_col = ImageColorAllocate($im, 240,240,240);

			ImageFilledRectangle($im, 0, 0, $imgwidth, $imgheight, $text_col);
			ImageFilledRectangle($im, 1, 1, $imgwidth - 2, $imgheight - 2, $back_col);

			$draw_pos_x = $img_c_x - ($strwidth  / 2) + 1;
			$draw_pos_y = $img_c_y - ($strheight / 2);

			ImageString($im, $font_style, $draw_pos_x, $draw_pos_y, $content, $text_col);

			ImageJPEG($im);
			ImageDestroy($im);

			exit();
		}

		// ---------------------------------------------------
		// Crop image to fill area
		// ---------------------------------------------------

		public static function Crop($image, $w, $h, $class = "")
		{
			$html = "<div style=\"display:inline-block; width:{$w}px; height:{$h}px; background: url('{$image}') no-repeat center top; background-size:cover; image-rendering: optimizeQuality;\" class=\"{$class}\"></div>";
			return $html;
		}

		// ---------------------------------------------------
		// Get current URL
		// ---------------------------------------------------

		public static function CurrentUrl()
		{
			$pageUrl = (@$_SERVER['HTTPS'] == "on") ? "https" : "http";

			$pageUrl .= "://";
			if($_SERVER['SERVER_PORT'] != "80") {
				$pageUrl .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			}
			else {
				$pageUrl .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}

			return $pageUrl;
		}

		// ---------------------------------------------------
		// Build textarea toolbar
		// ---------------------------------------------------

		public static function Toolbar()
		{
			$content = <<<HTML
				<div id="textareaToolbar">
					<i class="fa fa-fw fa-bold" data-tooltip="Bold"></i>
					<i class="fa fa-fw fa-italic" data-tooltip="Italic"></i>
					<i class="fa fa-fw fa-underline" data-tooltip="Underline"></i>
					<i class="fa fa-fw fa-strikethrough" data-tooltip="Strikethrough"></i>
					<i class="fa fa-fw fa-paint-brush" data-tooltip="Font Color"></i>
					<i class="fa fa-fw fa-link" data-tooltip="Hyperlink"></i>
					<i class="fa fa-fw fa-list-ul" data-tooltip="List"></i>
					<i class="fa fa-fw fa-code" data-tooltip="Code"></i>
					<i class="fa fa-fw fa-image" data-tooltip="Image"></i>
					<i class="fa fa-fw fa-video-camera" data-tooltip="YouTube"></i>
				</div>
HTML;

			return $content;
		}

		// ---------------------------------------------------
		// Redirect to an specific URL
		// ---------------------------------------------------

		public static function Redirect($url, $referer = false)
		{
			if($url = "") {
				Html::Error("Html::Redirect() method doesn't contain an argument.");
			}
			header("Location: " . $url);
			exit;
		}

		// ---------------------------------------------------
		// Remove any trace of markdown elements
		// For use in thread descriptions in Thread List
		// ---------------------------------------------------

		public static function RemoveMarkdown($string)
		{
			return preg_replace("/(__|\*\*|~~|\[\[|\]\]|{{|}}|\||``)/", "", html_entity_decode($string));
		}
	}

?>
