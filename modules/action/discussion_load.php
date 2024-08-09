<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$type = isset($_POST['type']) ? intval($_POST['type']) : 0;
	if($type==1) {
		$product = 0;
		$result = '';
		
		$db->table = "discussion";
		$db->condition = "`discussion_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach ($rows as $row) {
				$product = $row['product_id'];
			}
		}
		$id_load = 0;
		$db->table = "discussion";
		$db->condition = "`is_active` = 1 AND `parent` = 0 AND `discussion_id` < $id AND `product_id` = $product";
		$db->order = "`created_time` DESC";
		$db->limit = 5;
		$rows_cm = $db->select();
		foreach ($rows_cm as $row_cm) {
			$USER_CM = getInfoUser($row_cm['user_id']);
			$id_load = $row_cm['discussion_id'];
			$result .= '<div class="discussion-parent no-margin row">';
			$result .= '<div class="left"><img class="discussion-avatar" src="' . $USER_CM[4] . '" alt=""></div>';
			$result .= '<div class="right">';
			$result .= '<div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CM[0] . '</label> <label class="created_at">- ' . convertTimeAgo($row_cm['created_time']) . '</label></div>';
			$result .= '<div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($row_cm['content']) . '</div></div>';

			$db->table = "discussion";
			$db->condition = "`parent` = " . $row_cm['discussion_id'];
			$db->order = "`created_time` ASC";
			$db->limit = "";
			$rows_cmp = $db->select();
			$b_id = md5('list' . $row_cm['discussion_id']);
			$result .= '<div class="col-xs-12 col-sm-12 no-padding">';
			$result .= '<label class="reply" discussion-id="' . $b_id . '"> Phản hồi (' . $db->RowCount . ')</label>';
			$result .= '<div class="row no-margin discussion-parent-options" id="' . $b_id . '">';

			$result .= '<div class="row no-margin discussion-child-list">';
			foreach ($rows_cmp as $row_cmp) {
				$USER_CMP = getInfoUser($row_cmp['user_id']);
				$result .= '<div class="discussion-child no-margin row">';
				$result .= '<div class="left"><img class="discussion-avatar" src="' . $USER_CMP[4] . '" alt=""></div>';
				$result .= '<div class="right">';
				$result .= '<div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CMP[0] . '</label> <label class="created_at">- ' . convertTimeAgo($row_cmp['created_time']) . '</label></div>';
				$result .= '<div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($row_cmp['content']) . '</div></div>';
				$result .= '</div>';
				$result .= '</div>';
			}
			$result .= '</div>';
			$result .= '<div class="row no-margin discussion-reply"><form id="form-' . $b_id . '" class="discussion" method="post" onsubmit="return post_discussion(\'form-' . $b_id . '\', \'' . $b_id . '\', ' . $row_cm['discussion_id'] . ');"><label><textarea class="form-control discussion-content" name="content" placeholder="Nhập nội dung phản hồi..." rows="3" required></textarea></label><label><button type="submit" name="discussion" class="btn btn-primary lecture-discussion-submit">Đăng thảo luận</button></label></form></div>';

			$result .= '</div>';
			$result .= '</div>';

			$result .= '</div>';
			$result .= '</div>';
		}

		echo json_encode( array( "msg_content" => $result, "msg_id" => $id_load ) );
	} elseif($type==2) {
		$course = 0;
		$result = '';

		$db->table = "discussion";
		$db->condition = "`discussion_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach ($rows as $row) {
				$course = $row['courses_id'];
			}
		}
		$id_load = 0;
		$db->table = "discussion";
		$db->condition = "`is_active` = 1 AND `parent` = 0 AND `discussion_id` < $id AND `courses_id` = $course";
		$db->order = "`created_time` DESC";
		$db->limit = 5;
		$rows_cm = $db->select();
		foreach ($rows_cm as $row_cm) {
			$USER_CM = getInfoUser($row_cm['user_id']);
			$id_load = $row_cm['discussion_id'];
			$result .= '<div class="discussion-parent no-margin row">';
			$result .= '<div class="left"><img class="discussion-avatar" src="' . $USER_CM[4] . '" alt=""></div>';
			$result .= '<div class="right">';
			$result .= '<div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CM[0] . '</label> <label class="created_at">- ' . convertTimeAgo($row_cm['created_time']) . '</label></div>';
			$result .= '<div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($row_cm['content']) . '</div></div>';

			$db->table = "discussion";
			$db->condition = "`parent` = " . $row_cm['discussion_id'];
			$db->order = "`created_time` ASC";
			$db->limit = "";
			$rows_cmp = $db->select();
			$b_id = md5('list' . $row_cm['discussion_id']);
			$result .= '<div class="col-xs-12 col-sm-12 no-padding">';
			$result .= '<label class="reply" discussion-id="' . $b_id . '"> Phản hồi (' . $db->RowCount . ')</label>';
			$result .= '<div class="row no-margin discussion-parent-options" id="' . $b_id . '">';

			$result .= '<div class="row no-margin discussion-child-list">';
			foreach ($rows_cmp as $row_cmp) {
				$USER_CMP = getInfoUser($row_cmp['user_id']);
				$result .= '<div class="discussion-child no-margin row">';
				$result .= '<div class="left"><img class="discussion-avatar" src="' . $USER_CMP[4] . '" alt=""></div>';
				$result .= '<div class="right">';
				$result .= '<div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CMP[0] . '</label> <label class="created_at">- ' . convertTimeAgo($row_cmp['created_time']) . '</label></div>';
				$result .= '<div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($row_cmp['content']) . '</div></div>';
				$result .= '</div>';
				$result .= '</div>';
			}
			$result .= '</div>';
			$result .= '<div class="row no-margin discussion-reply"><form id="form-' . $b_id . '" class="discussion" method="post" onsubmit="return post_discussion(\'form-' . $b_id . '\', \'' . $b_id . '\', ' . $row_cm['discussion_id'] . ');"><label><textarea class="form-control discussion-content" name="content" placeholder="Nhập nội dung phản hồi..." rows="3" required></textarea></label><label><button type="submit" name="discussion" class="btn btn-primary lecture-discussion-submit">Đăng thảo luận</button></label></form></div>';

			$result .= '</div>';
			$result .= '</div>';

			$result .= '</div>';
			$result .= '</div>';
		}

		echo json_encode( array( "msg_content" => $result, "msg_id" => $id_load ) );
	}
} else echo json_encode(false);