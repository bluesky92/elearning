<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['q'])) {
	//$search = (string) $_POST['q'];
    $search = htmlspecialchars($_POST['q'], ENT_QUOTES, 'UTF-8');
	$result = array();
	$stringObj = new StringClass();

	$loc = getListMenuChild('product_menu', 89);
	$slug = getSlugCategory(89);
	$db->table = "product";
	$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc) AND CONCAT_WS(`name`, `comment`, `content`, `title`, `description`, `keywords`) LIKE '%" . $db->clearText($search) . "%'";
	$db->order = "`created_time` DESC";
	$db->limit = 5;
	$rows = $db->select();
	$total = $db->RowCount;
	if ($total > 0) {
		foreach ($rows as $row) {
			$alias = HOME_URL_LANG . '/' . $slug . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']);
			if($row['img']!="" && $row['img']!="no") {
				$image = HOME_URL . '/uploads/product/' . str_replace(DS, '/', $row['folder']) . 'course-'. $row['img'];
			} else {
				$image = HOME_URL . '/images/404-course.jpg';
			}
			$name = stripslashes($row['name']);
			$trainer = getNameTrainers($row['trainers']);

			array_push($result, array(
				'alias_name' => $alias,
				'image' => $image,
				'name' => $name,
				'user_name' => $trainer
			));
		}
		$result = array_filter($result);
	}

	echo json_encode($result);

} else echo 'Error--';