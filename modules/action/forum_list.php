<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$db->table = "forum_menu";
$db->condition = "`is_active` = 1 AND `forum_menu_id` = $id AND `category_id` = 96";
$db->order = "`sort` ASC";
$db->limit = "";
$rows_f = $db->select();
if($db->RowCount>0) {
	$requestData = $_REQUEST;
	$date = new DateClass();
	$stringObj = new StringClass();
	$columns = array(
			0 => '`created_time`',
			1 => '`name`',
			2 => '`c_comment`',
			3 => '`views`',
			4 => '`c_like`'
	);
	$query = "`is_active` = 1 AND `forum_menu_id` = $id";
	if (!empty($requestData['search']['value'])) {
	    $search = htmlentities($requestData['search']['value']);
		$query .= " AND CONCAT(`name`, `content`) LIKE '%" . $db->clearText($search) . "%'";
	}

	$db->table = "forum";
	$db->condition = $query;
	$db->order = "";
	$db->limit = "";
	$db->select();
	$totalData = $db->RowCount;
	$totalFiltered = $totalData;

	$db->table = "forum";
	$db->condition = $query;
	$db->order = intval($columns[$requestData['order'][0]['column']]) . " " . intval($requestData['order'][0]['dir']);
	$db->limit = intval($requestData['start']) . " ," . intval($requestData['length']);
	$rows = $db->select();
	$data = array();
	$i = $requestData['start'];
	$slug = getSlugCategory(96);
	foreach ($rows as $row) {
		$countComments = intval(countForumComments($row['forum_id']));
		$db->table = "forum";
		$dataUpdate = array(
			'c_comment' => $countComments
		);
		$db->condition = "`forum_id` = " . $row['forum_id'];
		$db->update($dataUpdate);

		$f_user = getInfoUser($row['user_id']);
		$f_user_time = '<p><label class="f-user">Đăng bởi ' . $f_user[6] . ',</label><label class="f-time" title="' . $date->vnFull($row['created_time']) . ' (lúc ' . $date->vnTime($row['created_time']) . ')">' . convertTime5DayAgo($row['created_time']) . '</label></p>';
		$i++;
		$nestedData = array();
		$nestedData[] = '<img class="f-user-avatar" src="' . $f_user[4] . '" alt="' . $f_user[0] . '">';
		$nestedData[] = '<h4 class="f-title"><a href="' . HOME_URL_LANG . '/' . $slug . '/' . getSlugMenu($row['forum_menu_id'], 'forum') . '/' . $stringObj->getLinkHtml($row['name'], $row['forum_id']) . '" title="' . stripslashes($row['name']) . '">' . $stringObj->crop(stripslashes($row['name']), 12) . '</a></h4>' . $f_user_time;
		$nestedData[] = formatNumberVN($countComments);
		$nestedData[] = formatNumberVN($row['views']);
		$nestedData[] = formatNumberVN($row['c_like']);
		$nestedData[] = commentLastForum($row['forum_id']);
		$data[] = $nestedData;
	}

	$json_data = array(
			"draw" => intval($requestData['draw']),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
	);
} else $json_data = array();

echo json_encode($json_data);