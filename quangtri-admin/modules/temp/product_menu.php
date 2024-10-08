<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function productMenu($act, $typeFunc, $product_menu_id, $category_id, $name, $slug, $plus, $font_icon, $title, $description, $keywords, $parent, $is_active, $hot, $folder, $img, $error) {
	global $tth, $corePrivilegeSlug;
	dashboardCoreAdminTwo($tth.";".$category_id);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Mục chủ đề
			</div>
			<div class="panel-body">
				<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>" />
					<input type="hidden" name="parent" value="<?php echo $parent?>" />
					<input type="hidden" name="product_menu_id" value="<?php echo $product_menu_id?>" />
					<input type="hidden" name="category_id" value="<?php echo $category_id?>" />
					<input type="hidden" name="img" value="<?php echo $img?>" />
					<div class="panel-show-error">
						<?php echo $error?>
					</div>
					<table class="table table-hover" style="width: 70%;">
						<tr>
							<td width="150px"><label>Tên mục:</label></td>
							<td><input class="form-control" type="text" id="name" name="name" maxlength="255" value="<?php echo stripslashes($name)?>" required="required" ></td>
						</tr>
						<tr>
							<td width="150px"><label>Liên kết tĩnh:</label></td>
							<td class="element-relative">
								<input class="form-control" type="text" id="slug" name="slug" maxlength="255" value="<?php echo stripslashes($slug)?>" >
								<div data-toggle="tooltip" data-placement="top" title="Tạo liên kết tĩnh" class="btn-get-slug" onclick="return getSlug('product')"></div>
							</td>
						</tr>
						<tr>
							<td><label>Material Icons:</label></td>
							<td><input class="form-control" type="text" name="font_icon" maxlength="255" value="<?php echo stripslashes($font_icon)?>" ><label><a href="?<?php echo TTH_PATH?>=sys_info_expansion" target="_blank">Tham khảo Material Icons</a></label></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Mô tả:</label></td>
							<td><textarea id="comment" class="form-control" name="plus" rows="3"><?php echo stripslashes($plus)?></textarea></td>
						</tr>
						<tr>
							<td><label>Mục cha:</label></td>
							<td><?php categoryName($category_id, $parent);?></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Hình đại diện:</label></td>
							<td>
								<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*">
							</td>
						</tr>
                        <?php
                        if(in_array("active;".$category_id, $corePrivilegeSlug)) {
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
							<td><label>Nổi bật:</label></td>
							<td>
								<label class="radio-inline"><input type="radio" name="hot" value="0" <?php echo $hot==0?"checked":""?> > Đóng</label>
								<label class="radio-inline"><input type="radio" name="hot" value="1" <?php echo $hot==1?"checked":""?> > Mở</label>
							</td>
						</tr>
						<tr>
							<td class="tth-bg-df" colspan="2"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>
						</tr>
						<tr>
							<td class="tth-gp-l"><label>Title:</label></td>
							<td class="tth-gp-r"><input class="form-control" type="text" name="title" maxlength="255" value="<?php echo stripslashes($title)?>" ></td>
						</tr>
						<tr>
							<td class="tth-gp-l"><label>Description:</label></td>
							<td class="tth-gp-r"><input class="form-control" type="text" name="description" maxlength="255" value="<?php echo stripslashes($description)?>" ></td>
						</tr>
						<tr>
							<td class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>
							<td class="tth-gp-r tth-gp-b"><input class="form-control" type="text" name="keywords" data-role="tagsinput" value="<?php echo stripslashes($keywords)?>" ></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
								<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
								<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=product_manager'">Thoát</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('.file-img').fileinput({
		<?php if($img!='' && $img!='-no-') { ?>
		initialPreview: [
			"<img src='../uploads/product_menu/<?php echo str_replace(DS, '/', $folder) . $img;?>' class='file-preview-image' title='<?php echo $img?>' alt='<?php echo $img?>'>"
		],
		<?php } ?>
		allowedFileExtensions : ['jpg', 'png','gif']
	});
	CKEDITOR.replace('comment', {
		height: 250,
		toolbar: [
			[ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],
			[ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
			[ 'Link', 'Unlink', 'Anchor' ],
			[ 'Image', 'Flash', 'Table', 'HorizontalRule' ],
			[ 'Styles', 'Format', 'Font', 'FontSize' ],
			[ 'TextColor', 'BGColor' ],
			[ 'Source', '-', 'Maximize', 'ShowBlocks' ]
		]
	});
</script>
<?php
}

/**
 * @param $id
 * @param $par
 */
function categoryName($id, $par) {
	echo '<select class="form-control" disabled>';
	global $db;
	$db->table = "category";
	$db->condition = "type_id = 6";
	$db->order = "sort ASC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		echo "<option value='".$row["category_id"]."'";
		if ($id==$row["category_id"] && $par==0) echo " selected ";
		echo ">".stripslashes($row["name"])."</option>";
		loadMenuCategory($db, 0, 0, $row["category_id"], $par);
	}
	echo '</select>';

}

/**
 * @param $db
 * @param $level
 * @param $parent
 * @param $category_id
 * @param $par
 */
function loadMenuCategory($db, $level, $parent, $category_id, $par){
	$db->table = "product_menu";
	$db->condition = "category_id = ".$category_id." and parent = ".$parent;
	$db->order = "sort ASC";
	$db->limit = "";
	$rows2 = $db->select();
	foreach($rows2 as $row) {
		if ($level <= 3){
			echo "<option value='".$row["category_id"]."'";
			if ($par==$row["product_menu_id"]) echo " selected ";
			echo ">".stripslashes($row["name"])."</option>";
				loadMenuCategory($db, $level+2, $row["product_menu_id"]+0, $row["category_id"]+0, $par);
		}
	}
}

/**
 * @param $id
 * @param $parent
 * @return mixed
 */
function sortAcs($id,$parent){
	global $db;
	$db->table = "product_menu";
	$db->condition = "category_id = ".($id+0)." and parent = ".($parent+0);
	$db->order = "";
	$db->limit = "";
	$db->select();
	return $db->RowCount;
}

function loadTrainers($id) {
	$rs = "";
	$rs .= '<select class="form-control" name="trainers">';
	global $db;
	$rs .= '<option value="0">Chọn giảng viên...</option>';

	$db->table = "article";
	$db->condition = "`is_active` = 1 AND `article_menu_id` IN (SELECT `article_menu_id` FROM `".TTH_DATA_PREFIX."article_menu` WHERE `category_id` = 95)";
	$db->order = "`created_time` DESC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		$selected = "";
		if($id==$row["article_id"]) $selected = " selected";
		$rs .= '<option value="' . $row["article_id"] . '"' . $selected . '>' . stripslashes($row["name"]) . '</option>';
	}
	$rs .= '</select>';

	return $rs;
}