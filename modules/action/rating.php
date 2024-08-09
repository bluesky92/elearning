<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$vote = isset($_POST['vote']) ? intval($_POST['vote']) : 0;
	$p_vote = $p_click = 0;

	$db->table = "product_vote";
	$db->condition = "`product_id` = $id AND `user_id` = " . $account["id"];
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	if($db->RowCount>0) {
		foreach($rows as $row) {
			$v_old = $row['vote'];
			$db->table = "product_vote";
			$data = array(
					'vote' => $vote,
					'modified_time' => time()
			);
			$db->condition = "`product_id` = $id AND `user_id` = " . $account["id"];
			$db->update($data);
			//-----------------
			$db->table = "product";
			$db->condition = "`product_id` = $id";
			$db->order = "";
			$db->limit = 1;
			$rows1 = $db->select();
			foreach($rows1 as $row1) {
				$p_vote = doubleval($row1['vote']);
				$p_click = doubleval($row1['click_vote']);
			}

			$p_vote = $p_vote - $v_old + $vote;
			$db->table = "product";
			$data = array(
					'vote' => $p_vote
			);
			$db->condition = "`product_id` = $id";
			$db->update($data);
		}
	} else {
		$db->table = "product_vote";
		$data = array(
			'product_id' => $id,
			'vote' => $vote,
			'user_id' => $account["id"],
			'modified_time' => time()
		);
		$db->insert($data);
		//-----------------
		$db->table = "product";
		$db->condition = "`product_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows1 = $db->select();
		foreach($rows1 as $row1) {
			$p_vote = doubleval($row1['vote']);
			$p_click = doubleval($row1['click_vote']);
		}
		//-----------------
		$p_vote = $p_vote + $vote;
		$p_click = $p_click+1;
		$db->table = "product";
		$data = array(
			'vote' => $p_vote,
			'click_vote' => $p_click
		);
		$db->condition = "`product_id` = $id";
		$db->update($data);
	}

	echo '<label>Đánh giá ngay</label>' . showRatings($p_vote/$p_click);
}