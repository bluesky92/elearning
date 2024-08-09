<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$parent = isset($_POST['parent']) ? intval($_POST['parent']) : 0;
	if($parent>0) {
		$content = isset($_POST['content']) ? (string) $_POST['content'] : '';
        $content = htmlentities($content);
		$time = time();

		$db->table = "discussion";
		$db->condition = "`discussion_id` = $parent";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			$product = $course = 0;
			foreach($rows as $row) {
				$product =  $row['product_id'];
				$course  =  $row['courses_id'];
			}
			$db->table = "discussion";
			$data = array(
					'product_id' => $product,
					'courses_id' => $course,
					'content' => $db->clearText($content),
					'parent' => $parent,
					'created_time' => $time,
					'user_id' => $account["id"]
			);
			$db->insert($data);
			if ($db->LastInsertID > 0) {
				$USER_CM = getInfoUser($account["id"]);
				echo '<div class="discussion-child no-margin row"><div class="left"><img class="discussion-avatar" src="' . $USER_CM[4] . '" alt=""></div><div class="right"><div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CM[0] . '</label> <label class="created_at">- ' . convertTimeAgo($time) . '</label></div><div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($content) . '</div></div></div></div>';
				// Ghi thông báo.
				insertNotify(2, 'product', $product, $account["id"]);
			} else echo false;
		} else echo false;

	} else {
		$product = isset($_POST['product']) ? intval($_POST['product']) : 0;
		$course = isset($_POST['course']) ? intval($_POST['course']) : 0;
		$content = isset($_POST['content']) ? (string) $_POST['content'] : '';
        $content = htmlentities($content);
		$time = time();

		$db->table = "discussion";
		$data = array(
				'product_id' => $product,
				'courses_id' => $course,
				'content' => $db->clearText($content),
				'parent' => 0,
				'created_time' => $time,
				'user_id' => $account["id"]
		);
		$db->insert($data);
		if ($db->LastInsertID > 0) {
			$USER_CM = getInfoUser($account["id"]);
			$b_id = md5('list' . $db->LastInsertID);
			echo '<div class="discussion-parent no-margin row"><div class="left"><img class="discussion-avatar" src="' . $USER_CM[4] . '" alt=""></div><div class="right"><div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CM[0] . '</label> <label class="created_at">- ' . convertTimeAgo($time) . '</label></div><div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($content) . '</div></div><div class="col-xs-12 col-sm-12 no-padding"><label class="reply" discussion-id="' . $b_id . '"> Phản hồi</label><div class="row no-margin discussion-parent-options" id="' . $b_id . '"><div class="row no-margin discussion-child-list"></div><div class="row no-margin discussion-reply"><form id="form-' . $b_id . '" class="discussion" method="post" onsubmit="return post_discussion(\'form-' . $b_id . '\', \'' . $b_id . '\', ' . $db->LastInsertID . ');"><label><textarea class="form-control discussion-content" name="content" placeholder="Nhập nội dung phản hồi..." rows="3" required></textarea></label><label><button type="submit" name="discussion" class="btn btn-primary lecture-discussion-submit">Đăng thảo luận</button></label></form></div></div></div></div></div>';
			// Ghi thông báo.
			insertNotify(1, 'product', $product, $account["id"]);
		} else echo false;
	}
} else echo 'Error--';