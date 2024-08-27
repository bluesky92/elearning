<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['id'])) {
	$menu = intval($_POST['id']);
	//--
    $result = '<select name="product_id" class="form-control">';
    $result .= '<option value="0" selected>[ALL] - Dành cho tất cả các khóa học trong chủ đề...</option>';
    $db->table = "product";
    $db->condition = "`is_active` = 1 AND `product_menu_id` = $menu";
    $db->order = "`created_time` ASC";
    $db->limit = "";
    $rows = $db->select();
    // var_dump($rows);
    foreach($rows as $row) {
        $selected = '';
        $result .= '<option value="' . $row["product_id"] . '">' . stripslashes($row["name"]) . '</option>';
    }
    $result .= '</select>';
    echo $result;
}