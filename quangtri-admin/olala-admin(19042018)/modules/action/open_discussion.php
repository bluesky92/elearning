<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['id'])) {
	$id = intval($_POST['id']);
	$date = new DateClass();
	$content = '';

	$db->table = "discussion";
	$db->condition = "`parent` = $id";
	$db->order = "`created_time` ASC";
	$db->limit = "";
	$rows = $db->select();
	if($db->RowCount) {
		$content .= '<div class="dc-fb-list"><form id="_fm_list_discussion" method="post" onsubmit="return remove_discussion(\'_fm_list_discussion\', ' . $id . ');">';
		foreach ($rows as $row) {
			$content .= '<div class="dc-fb-item"><input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" name="del[]" value="' . $row['discussion_id'] . '">' . stripslashes($row['content']) . '</div>';
		}
		$content .= '<div class="dc-fb-item"><button type="submit" class="btn btn-form-danger btn-form btn-round">Xoá</button></div>';
		$content .= '</form></div>';
	}

	$db->table = "discussion";
	$db->condition = "`discussion_id` = $id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	if($db->RowCount > 0) {
		foreach($rows as $row) {
			$content = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel">Thảo luận (' . $date->vnDateTime($row['created_time']) . ' | ' . getUserName($row['user_id']) . ')</h4></div><div class="modal-body">' . stripslashes($row['content']) . $content . '</div><div class="modal-footer"><button type="button" class="btn btn-form-danger btn-form" onclick="return remove_discussion_all(' . $id . ');">Xoá</button><button type="button" class="btn btn-form-primary btn-form" data-dismiss="modal">Đóng</button></div></div></div>';
		}
	}
	echo $content;
}