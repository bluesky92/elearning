<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$rs = 0;
$msg = '';
if($account["id"]>0) {
	$msg = '';
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$db->table = "forum_like";
	$db->condition = "`forum_id` = $id AND `user_id` = " . $account["id"];
	$db->order = "";
	$db->limit = 1;
	$db->select();
	if($db->RowCount>0) {
		$db->delete();
		//---
		$c_like = 0;
		$db->table = "forum";
		$db->condition = "`forum_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach ($rows as $row) {
				$c_like = $row['c_like'] - 1;
				$data = array(
						'c_like' => ($c_like),
				);
				$db->update($data);
				$rs = 1;
				$msg = '<i class="fa fa-thumbs-o-up fa-fw" title="Lượt thích"></i> ' . formatNumberVN($c_like) . ' (Thích)';
			}
		}
	} else {
		$data = array(
			'forum_id'=>$id,
			'user_id'=>$account["id"],
			'modified_time'=>time()
		);
		$db->insert($data);
		if($db->LastInsertID) {
			// Ghi thông báo.
			insertNotify(8, 'forum', $id, $account["id"]);

			$c_like = 0;
			$db->table = "forum";
			$db->condition = "`forum_id` = $id";
			$db->order = "";
			$db->limit = 1;
			$rows = $db->select();
			if($db->RowCount>0) {
				foreach($rows as $row) {
					$c_like = $row['c_like']+1;
					$data = array(
						'c_like'=>($c_like),
					);
					$db->update($data);
					$rs = 1;
					$msg = '<i class="fa fa-thumbs-o-up fa-fw" title="Lượt thích"></i> ' . formatNumberVN($c_like) . ' (Bỏ thích)';
				}
			}
		}
	}
}
echo json_encode( array("rs" => $rs, "msg" => $msg) );
