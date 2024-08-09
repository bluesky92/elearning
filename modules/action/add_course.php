<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$db->table = "product_logs";
	$data = array(
		'product_id' => $id,
		'user_id' => $account["id"],
		'created_time' => time()
	);
	$db->insert($data);
	echo $db->LastInsertID;
} else echo 'Error--';