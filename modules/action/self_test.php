<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
    $result = '';

    $result .= '<div class="modal-dialog" style="width: auto !important;"><div class="modal-content">';
    $result .= '<div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button><h3 class="modal-title">TỰ KIỂM TRA</h3></div>';

    $result .= '<div class="modal-body">';
    $result .= '<form id="self-test" name="library" method="post" onsubmit="return self_test();">';

    $result .= '<div class="examination-info">';
    $result .= '<div class="exa-item"><label>Chủ đề khóa học:</label><label class="inp">' . categoryName(0) . '</label></div>';
    $result .= '<div class="exa-item"><label>Chuyên đề:</label><label id="_product" class="inp">' . productList(0, 0) . '</label></div>';
    $result .= '</div>';
    $result .= '<div class="exa-btn text-center"><button type="submit" class="btn btn-danger btn-round">Bắt đầu kiểm tra</button></div>';

    $result .= '</form>';
    $result .= '</div>';

    $result .= '<div class="modal-footer"></div></div></div>';


    echo $result;
	
} else echo 'Error--';


function categoryName($id) {
    global $db;
    $result = '';
    $result .= '<select name="product_menu_id" onclick="return product_list(this.value);" class="form-control" id="product_menu_dropdown">';
    $db->table = "category";
    $db->condition = "`is_active` = 1 AND `type_id` = 6";
    $db->order = "sort ASC";
    $db->limit = "";
    $rows = $db->select();
    foreach($rows as $row) {
        $result .= '<option value="' .$row["category_id"] . '" disabled>' . stripslashes($row["name"]) . '</option>';
        $result .= loadMenuCategory($db, 0, 0, $row["category_id"], $id);
    }
    $result .= '</select>';
    $result .= '<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dropdown = document.getElementById("product_menu_dropdown");
        // echo (111);
        if (dropdown.options.length >= 1) { // 1 item + 1 disabled placeholder
            dropdown.selectedIndex = 1; // Select the first (and only) valid option
            dropdown.dispatchEvent(new Event("change")); // Trigger the onchange event
        }
    });
    </script>';
    return $result;

}

function loadMenuCategory($db, $level, $parent, $category_id, $id) {
    $result = '';
    $space = '--';
    for($i=0; $i<$level; $i++){
        $space .= '-';
    }
    $db->table = "product_menu";
    $db->condition = "`is_active` = 1 AND `category_id` = " . intval($category_id) . " AND `parent` = " . intval($parent);
    $db->order = "sort ASC";
    $db->limit = "";
    $rows2 = $db->select();
    foreach($rows2 as $row) {
        if ($level <= 8){
            $selected = '';
            if($id==$row["product_menu_id"]) $selected = ' selected';
            $result .= '<option value="' . $row["product_menu_id"] . '"' . $selected .'>' . $space  . '✦ ' . stripslashes($row["name"]) . '</option>';
            $result .= loadMenuCategory($db, $level+2, $row["product_menu_id"]+0, $row["category_id"]+0, $id);
        }
    }
    return $result;
}

function productList($menu, $id) {
    global $db;
    $result = '<select name="product_id" class="form-control">';
    $selected = '';
    if($id==0) $selected = ' selected';
    $result .= '<option value="0"' . $selected .'>[ALL in] - Dành cho tất cả các khóa học trong chủ đề...</option>';
    $db->table = "product";
    $db->condition = "`is_active` = 1 AND `product_menu_id` = $menu";
    $db->order = "`created_time` DESC";
    $db->limit = "";
    $rows = $db->select();
    foreach($rows as $row) {
        $selected = '';
        if($id==$row["product_id"]) $selected = ' selected';
        $result .= '<option value="' . $row["product_id"] . '"' . $selected .'>' . stripslashes($row["name"]) . '</option>';
    }
    $result .= '</select>';
    return $result;
}