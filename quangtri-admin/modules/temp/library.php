<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function library($act, $typeFunc, $library_id, $product_menu_id, $product_id, $is_active, $error) {
    global $db, $corePrivilegeSlug;
    dashboardCoreAdmin();
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Nội dung câu hỏi
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>">
                        <input type="hidden" name="library_id" value="<?php echo $library_id?>">
						<div class="panel-show-error">
							<?php echo $error?>
						</div>
						<table class="table table-hover" style="width: 50%;">
							<tr>
								<td width="25%"><label>Chủ đề khóa học:</label></td>
								<td width="75%"><?php echo categoryName($product_menu_id);?></td>
							</tr>
                            <tr>
                                <td><label>Khóa học:</label></td>
                                <td id="_product"><?php echo productList($product_menu_id, $product_id);?></td>
                            </tr>
                            <tr>
                                <td class="ver-top"><label>Chèn tệp câu hỏi:</label></td>
                                <td>
                                    <input class="form-control file" type="file" name="file" data-show-upload="false" data-show-preview="false" data-max-file-count="1" required accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </td>
                            </tr>
                            <?php
                            if(in_array("library_active", $corePrivilegeSlug)) {
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
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=library_list'">Thoát</button>
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
    function product_list(id) {
        showLoader();
        $.ajax({
            url: '/quangtri-admin/action.php',
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