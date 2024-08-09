<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$rs = 0;
$msg = '';
if($account["id"]>0) {
	$type       = isset($_POST['type']) ? (string) $_POST['type'] : '';
	$id         = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$post       = isset($_POST['post']) ? intval($_POST['post']) : 0;
	$title      = isset($_POST['title']) ? (string) $_POST['title'] : '';
	$content    = isset($_POST['content']) ? (string) $_POST['content'] : '';
    $title      = htmlentities($title);
    $content    = htmlentities($content);

	$db->table = "forum_menu";
	$db->condition = "`is_active` = 1 AND `forum_menu_id` = $id AND `category_id` = 96";
	$db->order = "`sort` ASC";
	$db->limit = 1;
	$db->select();
	if($db->RowCount==0) {
		$msg = 'Chuyên mục diễn đàn không tồn tại.';
	} elseif($type=='delete') {
		$db->table = "forum";
		$db->condition = "`forum_id` = $post";
		$db->delete();
		if($db->AffectedRows>0) {
			$db->table = "forum_comment";
			$db->condition = "`forum_id` = $post";
			$db->delete();
			//---
			$rs = 1;
			$msg = HOME_URL_LANG . '/' . getSlugCategory(96) . '/' . getSlugMenu($id, 'forum');
			// Ghi thông báo.
			insertNotify(7, 'forum', $post, $account["id"]);
		} else {
			$msg = 'Có lỗi, chuyên đề bạn chọn xóa không tồn tại.';
		}
	} elseif(empty($title)) {
		$msg = 'Vui lòng nhập tên chủ đề.';
	} elseif(empty($content)) {
		$msg = 'Vui lòng nhập nội dung chủ đề.';
	} else {
		if($type=='add') {
			$db->table = "forum";
			$data = array(
				'forum_menu_id' => $id,
				'name' => $db->clearText($title),
				'content' => $db->clearText($content),
				'created_time' => time(),
				'user_id' => $account["id"]
			);
			$db->insert($data);
			if($db->LastInsertID>0) {
				$rs = 1;
				$msg = HOME_URL_LANG . '/' . getSlugCategory(96) . '/' . getSlugMenu($id, 'forum');
				// Ghi thông báo.
				insertNotify(5, 'forum', $db->LastInsertID, $account["id"]);
			} else {
				$msg = 'Có lỗi hệ thống, bạn vui lòng thực hiện lại.';
			}
		} elseif($type=='edit') {
			$db->table = "forum";
			$data = array(
				'name' => $db->clearText($title),
				'content' => $db->clearText($content),
				'modified_time' => time(),
				'modified_user' => $account["id"]
			);
			$db->condition = "`forum_id` = $post";
			$db->update($data);
			if($db->AffectedRows>0) {
				$rs = 1;
				$stringObj = new StringClass();
				$msg = HOME_URL_LANG . '/' . getSlugCategory(96) . '/' . getSlugMenu($id, 'forum') . '/' . $stringObj->getLinkHtml($title, $post);
				// Ghi thông báo.
				insertNotify(6, 'forum', $post, $account["id"]);
			} else {
				$msg = 'Có lỗi hệ thống, bạn vui lòng thực hiện lại.';
			}
		} else $msg = 'Có lỗi xãy ra, bạn vui lòng thực hiện lại.';
	}

} else $msg = 'Vui lòng đăng nhập trước khi đăng đề tài mới.';

echo json_encode( array("rs" => $rs, "msg" => $msg));