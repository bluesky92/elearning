<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$sumView = 0;
$db->table = "forum";
$db->condition = "`is_active` = 1 AND `forum_id` = $id";
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
		$sumView = $row['views']+1;
		$f_user = getInfoUser($row['user_id']);
		//---
		$f_update = '';
		if($row['user_id']==$account["id"]) $f_update = ' <span><a class="edit" href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['forum_menu_id'], 'forum') . '/?af=edit&id=' . $id . '" title="Chỉnh sửa"><i class="fa fa-wrench fa-fw" title="Chỉnh sửa"></i> Chỉnh sửa</a></span> <span><a class="delete" href="javascript:;" onclick="return update_forum(\'_delete\', \'delete\', ' . $row['forum_menu_id'] . ', ' . $id . ');" title="Xóa bài"><i class="fa fa-trash fa-fw" title="Xóa bài"></i> Xóa bài</a></span>';
		//---
		$f_like = '';
		$db->table = "forum_like";
		$db->condition = "`forum_id` = $id AND `user_id` = " . $account["id"];
		$db->order = "";
		$db->limit = 1;
		$db->select();
		if($db->RowCount>0) $f_like = ' <span><a class="_fc_like" href="javascript:;" rel="' . $row['forum_id'] . '" title="Lượt thích"><i class="fa fa-thumbs-o-up fa-fw" title="Lượt thích"></i> ' . formatNumberVN($row['c_like']) . ' (Bỏ thích)</a></span>';
		else $f_like = ' <span><a class="_fc_like" href="javascript:;" rel="' . $row['forum_id'] . '" title="Lượt thích"><i class="fa fa-thumbs-o-up fa-fw" title="Lượt thích"></i> ' . formatNumberVN($row['c_like']) . ' (Thích)</a></span>';

		echo '<div class="row forum-view">';
		echo '<div class="col-sm-2 f-line-right">';
		echo '<div class="img"><img class="f-user-avatar" src="' . $f_user[7] . '" alt="' . $f_user[0] . '"></div>';
		echo '<div class="f-user-info"><h4>' . $f_user[6] . '</h4><p>' . $f_user[0] . '</p></div>';
		echo '</div>';
		echo '<div class="col-sm-10 f-line-left">';
		echo '<p class="f-info"><span><i class="fa fa-user fa-fw" title="Đăng bởi"></i> ' . $f_user[6] . '</span> <span><i class="fa fa-calendar fa-fw" title="Đăng lúc"></i> ' . $date->vnFull($row['created_time']) . ' (lúc ' . $date->vnTime($row['created_time']) . ')</span> <span><i class="fa fa-share-square fa-fw" title="Bình luận"></i> ' . formatNumberVN($row['c_comment']) . '</span> <span><i class="fa fa-eye fa-fw" title="Lượt xem"></i> ' . formatNumberVN($sumView) . '</span>' . $f_like . $f_update . '</p>';
		echo '<h2>' . stripslashes($row['name']) . '</h2>';
		echo '<div class="detail-wp">' . stripslashes($row['content']) . '</div>';
		echo '</div>';
		echo '</div>';
	}
	$db->table = "forum";
	$data = array(
			'views'=>$sumView
	);
	$db->condition = "`forum_id` = $id";
	$db->update($data);

	if($account["id"]>0) {
		//---
		echo '<div class="row forum-view">';

		echo '<div class="col-sm-2 f-line-right">';
		echo '<div class="img"><img class="f-user-avatar" src="' . $USER[7] . '" alt="' . $USER[0] . '"></div>';
		echo '</div>';

		echo '<div class="col-sm-10 f-line-left">';
		echo '<div class="forum-form">';
		echo '<form id="_fm_comment" method="post" onsubmit="return comment_forum(\'add\', ' . $id . ', \'_fm_comment\');">';
		echo '<div class="forum-f-item"><label><textarea name="content" class="summernote" rows="5" placeholder="Viết nội dung bình luận..."></textarea></label></div>';
		echo '<div class="forum-f-item f-margin5 text-right"><label style="display: inline-block;"><input type="submit" class="btn btn-primary" name="add" value="Gửi bình luận"></label></div>';
		echo '</form>';
		echo '</div>';
		echo '</div>';

		echo '</div>';
	}

	$id_load = 0;
	$db->table = "forum_comment";
	$db->condition = "`forum_id` = $id";
	$db->order = "`created_time` DESC";
	$db->limit = 10;
	$rows2 = $db->select();
	echo '<div id="_list_f_comment">';
	foreach($rows2 as $row2) {
		$f_user = getInfoUser($row2['user_id']);
		$id_load = $row2['forum_comment_id'];
		//---
		$f_update = '';
		if($row2['user_id']==$account["id"]) $f_update = ' <span><a class="edit" href="javascript:;" onclick="return update_comment_forum($(this), \'edit\', ' . $row2['forum_comment_id'] . ');" title="Chỉnh sửa"><i class="fa fa-wrench fa-fw" title="Chỉnh sửa"></i> Chỉnh sửa</a></span> <span><a class="delete" href="javascript:;" onclick="return update_comment_forum($(this), \'delete\', ' . $row2['forum_comment_id'] . ');" title="Xóa bình luận"><i class="fa fa-trash fa-fw" title="Xóa bình luận"></i> Xóa bình luận</a></span>';

		echo '<div class="row forum-view">';
		echo '<div class="col-sm-2 f-line-right">';
		echo '<div class="img text-right"><img class="f-user-avatar" src="' . $f_user[4] . '" alt="' . $f_user[0] . '"></div>';
		echo '<div class="f-user-info f-comment"><h4>' . $f_user[6] . '</h4><p>' . $f_user[0] . '</p></div>';
		echo '</div>';
		echo '<div class="col-sm-10 f-line-left">';
		echo '<p class="f-info"><span><i class="fa fa-user fa-fw" title="Đăng bởi"></i> ' . $f_user[6] . '</span> <span><i class="fa fa-calendar fa-fw" title="Đăng lúc"></i> ' . $date->vnFull($row2['created_time']) . ' (lúc ' . $date->vnTime($row2['created_time']) . ')</span>' . $f_update . '</p>';
		echo '<div class="detail-wp">' . stripslashes($row2['content']) . '</div>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	$db->table = "forum_comment";
	$db->condition = "`forum_id` = $id AND `forum_comment_id` < $id_load";
	$db->order = "`created_time` DESC";
	$db->limit = "";
	$db->select();
	if($db->RowCount>0) {
		echo '<div class="forum-btn-load text-center"><label><button class="btn btn-info btn-round" onclick="return load_comment_forum($(this), ' . $id . ');" rel="' . $id_load . '">XEM THÊM CÁC BÌNH LUẬN (' . $db->RowCount . ')</button></label></div>';
	}
}
else {
	include(_F_MODULES . DS . "error_404.php");
}
