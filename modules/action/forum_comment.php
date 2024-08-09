<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$rs     = 0;
$msg    = '';
$load   = 0;
$button = '';
$id     = isset($_POST['id']) ? intval($_POST['id']) : 0;
$type   =  isset($_POST['type']) ? (string) $_POST['type'] : '';
$date   = new DateClass();
//---
if($type=='add') {
	if($account["id"]>0) {
		$content =  isset($_POST['content']) ? (string) $_POST['content'] : '';
        $content = htmlentities($content);

		$db->table = "forum";
		$db->condition = "`is_active` = 1 AND `forum_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();

		if($db->RowCount==0) {
			$msg = 'Chuyên mục diễn đàn không tồn tại.';
		} elseif(empty($content)) {
			$msg = 'Vui lòng nhập nội dung bình luận.';
		} else {
			//---
			$current_time = time();
			$db->table = "forum_comment";
			$data = array(
					'forum_id' => $id,
					'content' => $db->clearText($content),
					'created_time' => $current_time,
					'user_id' => $account["id"]
			);
			$db->insert($data);
			$insert = $db->LastInsertID;
			if($insert>0) {
				$rs = 1;
				$f_user = getInfoUser($account["id"]);
				//---
				$f_update = ' <span><a class="edit" href="javascript:;" onclick="return update_comment_forum($(this), \'edit\', ' . $insert . ');" title="Chỉnh sửa"><i class="fa fa-wrench fa-fw" title="Chỉnh sửa"></i> Chỉnh sửa</a></span> <span><a class="delete" href="javascript:;" onclick="return update_comment_forum($(this), \'delete\', ' . $insert . ');" title="Xóa bình luận"><i class="fa fa-trash fa-fw" title="Xóa bình luận"></i> Xóa bình luận</a></span>';

				$msg .= '<div class="row forum-view">';
				$msg .= '<div class="col-sm-2 f-line-right">';
				$msg .= '<div class="img text-right"><img class="f-user-avatar" src="' . $f_user[4] . '" alt="' . $f_user[0] . '"></div>';
				$msg .= '<div class="f-user-info f-comment"><h4>' . $f_user[6] . '</h4><p>' . $f_user[0] . '</p></div>';
				$msg .= '</div>';
				$msg .= '<div class="col-sm-10 f-line-left">';
				$msg .= '<p class="f-info"><span><i class="fa fa-user fa-fw" title="Đăng bởi"></i> ' . $f_user[6] . '</span> <span><i class="fa fa-calendar fa-fw" title="Đăng lúc"></i> ' . $date->vnFull($current_time) . ' (lúc ' . $date->vnTime($current_time) . ')</span>' . $f_update . '</p>';
				$msg .= '<div class="detail-wp">' . stripslashes($content) . '</div>';
				$msg .= '</div>';
				$msg .= '</div>';

				// Ghi thông báo.
				insertNotify(9, 'forum', $id, $account["id"]);
			} else {
				$msg = 'Có lỗi hệ thống, bạn vui lòng thực hiện lại.';
			}
		}
	} else $msg = 'Vui lòng đăng nhập trước khi gửi bình luận.';

} elseif($type=='edit') {
	if($account["id"]>0) {
		$db->table = "forum_comment";
		$db->condition = "`forum_comment_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach ($rows as $row) {
				$rs = 1;
				$msg = '<div class="forum-form">';
				$msg .= '<form id="_fm_comment' . md5($id) . '" method="post" onsubmit="return edit_comment_forum(\'update\', ' . $id . ', \'_fm_comment' . md5($id) . '\');">';
				$msg .= '<div class="forum-f-item"><label><textarea name="content" class="summernote" rows="5" placeholder="Viết nội dung bình luận...">' . stripslashes($row['content']) . '</textarea></label></div>';
				$msg .= '<div class="forum-f-item f-margin5 text-right"><label style="display: inline-block;"><input type="submit" class="btn btn-primary" name="edit" value="Cập nhật bình luận"></label></div>';
				$msg .= '</form>';
			}
		} else {
			$rs = 0;
			$msg = 'Dữ liệu rỗng, bình luận chọn chỉnh sửa không tồn tại.';
		}
	} else $msg = 'Vui lòng đăng nhập trước khi chỉnh sửa bình luận.';

} elseif($type=='update') {
	if($account["id"]>0) {
		$content = isset($_POST['content']) ? (string) $_POST['content'] : '';
        $content = htmlentities($content);

		$db->table = "forum_comment";
		$db->condition = "`forum_comment_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if(empty($content)) {
			$rs = 0;
			$msg = 'Vui lòng không để trống nội dung bình luận.';
		} elseif($db->RowCount>0) {
			$forum = 0;
			foreach($rows as $row) {
				$forum = $row['forum_id'];
			}

			$db->table = "forum_comment";
			$data = array(
				'content' => $db->clearText($content),
				'modified_time' => time(),
				'modified_user' => $account["id"]
			);
			$db->condition = "`forum_comment_id` = $id";
			$db->update($data);
			if($db->AffectedRows>0) {
				$rs = 1;
				$msg = $content;

				// Ghi thông báo.
				insertNotify(10, 'forum', $forum, $account["id"]);
			} else {
				$msg = 'Có lỗi hệ thống, bạn vui lòng thực hiện lại.';
			}
		} else {
			$rs = 0;
			$msg = 'Dữ liệu rỗng, bình luận chọn cập nhật không tồn tại.';
		}

	} else $msg = 'Vui lòng đăng nhập trước khi cập nhật bình luận.';

} elseif($type=='delete') {
	if($account["id"]>0) {
		$forum = 0;

		$db->table = "forum_comment";
		$db->condition = "`forum_comment_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		foreach ($rows as $row) {
			$forum = $row['forum_id'];
		}

		$db->table = "forum_comment";
		$db->condition = "`forum_comment_id` = $id";
		$db->delete();
		if ($db->AffectedRows > 0) {
			$rs = 1;
			$msg = 'Xóa bình luận thành công.';

			// Ghi thông báo.
			insertNotify(11, 'forum', $forum, $account["id"]);
		} else {
			$msg = 'Có lỗi, chuyên đề bạn chọn xóa không tồn tại.';
		}

	} else $msg = 'Vui lòng đăng nhập trước khi cập nhật bình luận.';
} elseif($type=='load') {
	$post = isset($_POST['post']) ? intval($_POST['post']) : 0;

	$db->table = "forum";
	$db->condition = "`forum_id` = $id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	if($db->RowCount>0) {
		$id_load = 0;
		$db->table = "forum_comment";
		$db->condition = "`forum_id` = $id AND `forum_comment_id` < $post";
		$db->order = "`created_time` DESC";
		$db->limit = 10;
		$rows2 = $db->select();
		if($db->RowCount>0) {
			foreach($rows2 as $row2) {
				$f_user = getInfoUser($row2['user_id']);
				$id_load = $row2['forum_comment_id'];
				//---
				$f_update = '';
				if($row2['user_id']==$account["id"]) $f_update = ' <span><a class="edit" href="javascript:;" onclick="return update_comment_forum($(this), \'edit\', ' . $row2['forum_comment_id'] . ');" title="Chỉnh sửa"><i class="fa fa-wrench fa-fw" title="Chỉnh sửa"></i> Chỉnh sửa</a></span> <span><a class="delete" href="javascript:;" onclick="return update_comment_forum($(this), \'delete\', ' . $row2['forum_comment_id'] . ');" title="Xóa bình luận"><i class="fa fa-trash fa-fw" title="Xóa bình luận"></i> Xóa bình luận</a></span>';

				$msg .= '<div class="row forum-view">';
				$msg .= '<div class="col-sm-2 f-line-right">';
				$msg .= '<div class="img text-right"><img class="f-user-avatar" src="' . $f_user[4] . '" alt="' . $f_user[0] . '"></div>';
				$msg .= '<div class="f-user-info f-comment"><h4>' . $f_user[6] . '</h4><p>' . $f_user[0] . '</p></div>';
				$msg .= '</div>';
				$msg .= '<div class="col-sm-10 f-line-left">';
				$msg .= '<p class="f-info"><span><i class="fa fa-user fa-fw" title="Đăng bởi"></i> ' . $f_user[6] . '</span> <span><i class="fa fa-calendar fa-fw" title="Đăng lúc"></i> ' . $date->vnFull($row2['created_time']) . ' (lúc ' . $date->vnTime($row2['created_time']) . ')</span>' . $f_update . '</p>';
				$msg .= '<div class="detail-wp">' . stripslashes($row2['content']) . '</div>';
				$msg .= '</div>';
				$msg .= '</div>';
			}
			$rs = 1;
			$load = $id_load;

			$db->table = "forum_comment";
			$db->condition = "`forum_id` =  $id AND `forum_comment_id` < $id_load";
			$db->order = "`created_time` DESC";
			$db->limit = "";
			$db->select();
			if($db->RowCount>0) {
				$button = 'XEM THÊM CÁC BÌNH LUẬN (' . $db->RowCount . ')';
			} else {
				$button = 'XEM THÊM CÁC BÌNH LUẬN (0)';
			}
		} else {
			$rs = 0;
			$msg = 'Hết dữ liệu.';
			$button = 'XEM THÊM CÁC BÌNH LUẬN (0)';
		}
	} else {
		$rs = 0;
		$msg = 'Dữ liệu rỗng.';
		$button = 'XEM THÊM CÁC BÌNH LUẬN (0)';
	}
}

echo json_encode( array("rs" => $rs, "msg" => $msg, "load" => $load, "button" => $button));