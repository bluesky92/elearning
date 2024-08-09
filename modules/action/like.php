<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$type = isset($_POST['type']) ? intval($_POST['type']) : 0;
	if($type==0) {
		$db->table = "product_like";
		$data = array(
				'product_id' => $id,
				'user_id' => $account["id"],
				'created_time' => time(),
		);
		$db->insert($data);
	} else {
		$db->table = "product_like";
		$db->condition = "`product_id` = $id AND `user_id` = " . $account["id"];
		$db->delete();
	}
	echo true;
} else echo 'Error--';