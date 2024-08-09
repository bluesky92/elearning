<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$result = '';
	$db->table = "notify_status";
	$db->condition = "`type` = 1 AND `notify_status_id` < $id AND `user_id` = " . $account["id"];
	$db->order = "`notify_status_id` DESC";
	$db->limit = 10;
	$rows = $db->select();
	if($db->RowCount>0) {
		$date = new DateClass();
		$stringObj = new StringClass();
		foreach ($rows as $row) {
			$result .= infoItemNotify($row['notify_status_id'], $row['notify_id'], $row['status']);
		}
	}
	echo $result;
}