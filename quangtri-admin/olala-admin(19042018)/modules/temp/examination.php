<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function examination($act, $typeFunc, $examination_id, $product_menu_id, $product_id, $title, $count, $time, $start, array $to_role, array $to_product, array $to_personal, $is_active, $error) {
    global $corePrivilegeSlug;
    dashboardCoreAdmin();
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Tạo nội dung bài kiểm tra tự động
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>">
                        <input type="hidden" name="examination_id" value="<?php echo $examination_id?>">
						<div class="panel-show-error">
							<?php echo $error?>
						</div>
						<table class="table table-hover" style="width: 60%;">
							<tr>
								<td width="25%"><label>Tiêu đề bài kiểm tra:</label></td>
								<td width="75%"><input class="form-control" type="text" name="title" maxlength="250" value="<?php echo stripslashes($title)?>" required="required"></td>
							</tr>
                            <tr>
                                <td><label>Chủ đề khóa học:</label></td>
                                <td><?php echo categoryName($product_menu_id);?></td>
                            </tr>
                            <tr>
                                <td><label>Khóa học:</label></td>
                                <td id="_product"><?php echo productList($product_menu_id, $product_id);?></td>
                            </tr>
							<tr>
								<td><label>Số câu hỏi:</label></td>
								<td><input class="form-control auto-number" type="text" name="count" maxlength="3" style="width: 125px;" value="<?php echo stripslashes($count)?>" data-a-sep="." data-a-dec="," data-v-max="999" data-v-min="0" autocomplete="off"></td>
							</tr>
                            <tr>
                                <td><label>Thời gian làm bài:</label> (phút)</td>
                                <td><input class="form-control auto-number" type="text" name="time" maxlength="3" style="width: 125px;" value="<?php echo stripslashes($time)?>" data-a-sep="." data-a-dec="," data-v-max="999" data-v-min="0" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td><label>Lúc bắt đầu:</label></td>
                                <td><input class="form-control" id="input-datetime" type="text" name="start" maxlength="15" style="width: 125px;" value="<?php echo stripslashes($start)?>" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td><label>Thành phần:</label></td>
                                <td><?php echo listTo($to_role, $to_product, $to_personal);?></td>
                            </tr>
                            <?php
                            if(in_array("examination_active", $corePrivilegeSlug)) {
                            ?>
							<tr>
								<td><label>Trạng thái:</label></td>
								<td>
									<label class="radio-inline"><input type="radio" name="is_active" value="0" <?php echo $is_active==0?"checked":""?> > Đóng</label>
									<label class="radio-inline"><input type="radio" name="is_active" value="1" <?php echo $is_active==1?"checked":""?> > Mở</label>
								</td>
							</tr>
                            <?php } ?>
							<tr>
								<td colspan="2" align="center">
									<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
									<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=examination_list'">Thoát</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $('#input-datetime').datetimepicker({
        mask:'39/19/9999 29:59',
        lang:'vi',
        format:'<?php echo TTH_DATETIME_FORMAT?>'
    });

    function product_list(id) {
        showLoader();
        $.ajax({
            url: '/olala-admin/action.php',
            type: 'POST',
            data: 'url=product_list&id=' + id,
            dataType: 'html',
            success: function (data) {
                showResult('_product', data);
                return true;
            }
        });
        return false;
    }
</script>
<?php
}
/**
 * @param $id
 * @param $par
 */
function categoryName($id) {
    global $db;
    $result = '';
    $result .= '<select name="product_menu_id" onchange="return product_list(this.value);" class="form-control">';
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
    return $result;

}

/**
 * @param $db
 * @param $level
 * @param $parent
 * @param $category_id
 * @param $par
 */
function loadMenuCategory($db, $level, $parent, $category_id, $id) {
    $result = '';
    $space = '--';
    for($i=0; $i<$level; $i++){
        $space .= '-';
    }
    $db->table = "product_menu";
    $db->condition = "`is_active` = 1 AND `category_id` = ".$category_id." AND `parent` = ".$parent;
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
    $result .= '<option value="0"' . $selected .'>[ALL] - Dành cho tất cả các khóa học trong chủ đề...</option>';
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

function listTo(array $to_role, array $to_product, array $to_personal) {
    global $db;

    $result = '<select name="to[]" class="selectpicker" multiple data-live-search="true" data-selected-text-format="count" data-live-search-placeholder="Tìm..." title="Chọn học viên...">';
    // Theo nhóm học viên
    $db->table = "core_role";
    $db->condition = "";
    $db->order = "`role_id` ASC";
    $db->limit = "";
    $rows = $db->select();
    if($db->RowCount > 0) {
        $result .= '<optgroup label="Theo nhóm học viên">';
        foreach($rows as $row) {
            $selected = '';
            if(in_array($row['role_id'], $to_role)) $selected = 'selected';
            $result .= '<option value="r;' . $row['role_id'] . '" ' . $selected . '>' . stripslashes($row['name']) . '</option>';
        }
        $result .= '</optgroup>';
    }

    // Theo khóa học
    $db->table = "product";
    $db->condition = "`is_active` = 1";
    $db->order = "`created_time` DESC";
    $db->limit = "";
    $rows = $db->select();
    if($db->RowCount > 0) {
        $result .= '<optgroup label="Theo khóa học">';
        foreach($rows as $row) {
            $selected = '';
            if(in_array($row['product_id'], $to_product)) $selected = 'selected';
            $result .= '<option value="p;' . $row['product_id'] . '" ' . $selected . '>' . stripslashes($row['name']) . '</option>';
        }
        $result .= '</optgroup>';
    }

    // --- Theo từng học viên.
    $db->table = "core_user";
    $db->condition = "`is_active` = 1";
    $db->order = "`sort` ASC";
    $db->limit = "";
    $rows = $db->select();
    if($db->RowCount > 0) {
        $result .= '<optgroup label="Theo từng học viên">';
        foreach($rows as $row) {
            $selected = '';
            if(in_array($row['user_id'], $to_personal)) $selected = 'selected';
            $result .= '<option value="u;' . $row['user_id'] . '" ' . $selected . '>' . stripslashes($row['full_name']) . '</option>';
        }
        $result .= '</optgroup>';
    }

    $result .= '</select>';
    return $result;
}