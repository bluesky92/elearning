<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['id'])) {
	$id = intval($_POST['id']);
	$db->table = "discussion";
	$db->condition = "`discussion_id` = $id  OR `parent` = ($id)";
	$db->delete();
}