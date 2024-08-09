<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

function product($act, $typeFunc, $product_id, $product_menu_id, $name, $folder, $img, $img_note, $comment, $content, $trainers, $is_active, $hot, $created_time, $title, $description, $keywords, $error) {
	global $db, $tth, $corePrivilegeSlug;
    $category = 0;
	$db->table = "product_menu";
	$db->condition = "`product_menu_id` = $product_menu_id";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row){
		dashboardCoreAdminTwo($tth.";".$row['category_id']);
        $category = $row['category_id'];
	}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Nội dung khóa học
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>">
						<input type="hidden" name="product_id" value="<?php echo $product_id?>">
						<input type="hidden" name="img" value="<?php echo $img?>">
						<div class="panel-show-error">
							<?php echo $error?>
						</div>
						<table class="table table-hover">
							<tr>
								<td width="12%"><label>Tiêu đề:</label></td>
								<td width="88%" colspan="3"><input class="form-control" type="text" name="name" maxlength="255" value="<?php echo stripslashes($name)?>" required="required" ></td>
							</tr>
							<tr>
								<td><label>Mục.:</label></td>
								<td colspan="3"><?php echo categoryName($product_menu_id);?></td>
							</tr>
							<tr>
								<td width="12%" class="ver-top"><label>Hình đại diện:</label></td>
								<td width="38%" class="ver-top">
									<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*" >
								</td>
								<td width="12%" class="ver-top"><label>Ghi chú hình:</label></td>
								<td width="38%" class="ver-top"><input class="form-control" type="text" name="img_note" maxlength="255" value="<?php echo stripslashes($img_note)?>" ></td>
							</tr>
							<tr>
								<td class="ver-top"><label>Mô tả:</label></td>
								<td colspan="3"><textarea class="form-control" rows="3" name="comment"><?php echo stripslashes($comment)?></textarea></td>
							</tr>
							<tr>
								<td class="ver-top"><label>Mô tả chi tiết:</label></td>
								<td colspan="3"><textarea id="content" class="form-control" rows="3" name="content"><?php echo stripslashes($content)?></textarea></td>
							</tr>
							<tr>
								<td><label>Mục..:</label></td>
								<td colspan="3"><?php echo loadTrainers($trainers);?></td>
							</tr>
                            <?php
                            if(in_array("active;".$category, $corePrivilegeSlug)) {
                            ?>
							<tr>
								<td><label>Trạng thái:</label></td>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="is_active" value="0" <?php echo $is_active==0?"checked":""?> > Đóng</label>
									<label class="radio-inline"><input type="radio" name="is_active" value="1" <?php echo $is_active==1?"checked":""?> > Mở</label>
								</td>
							</tr>
                            <?php } ?>
							<tr>
								<td><label>Nổi bật:</label></td>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="hot" value="0" <?php echo $hot==0?"checked":""?> > Đóng</label>
									<label class="radio-inline"><input type="radio" name="hot" value="1" <?php echo $hot==1?"checked":""?> > Mở</label>
								</td>
							</tr>
							<tr>
								<td><label>Ngày đăng:</label></td>
								<td colspan="3"><input class="form-control input-datetime" type="text" name="created_time" style="width: 125px;"  value="<?php echo $created_time?>" ></td>
							</tr>
							<tr>
								<td class="tth-bg-df" colspan="4"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>
							</tr>
							<tr>
								<td class="tth-gp-l"><label>Title:</label></td>
								<td class="tth-gp-r" colspan="3"><input class="form-control" type="text" name="title" maxlength="255" value="<?php echo stripslashes($title)?>" ></td>
							</tr>
							<tr>
								<td class="tth-gp-l"><label>Description:</label></td>
								<td class="tth-gp-r" colspan="3"><input class="form-control" type="text" name="description" maxlength="255" value="<?php echo stripslashes($description)?>" ></td>
							</tr>
							<tr>
								<td class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>
								<td class="tth-gp-r tth-gp-b" colspan="3"><input class="form-control" type="text" name="keywords" data-role="tagsinput" value="<?php echo stripslashes($keywords)?>" ></td>
							</tr>
							<tr>
								<td colspan="4" align="center">
									<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
									<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=product_list&id=<?php echo $product_menu_id?>'">Thoát</button>
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
	$(".file-img").fileinput({
		<?php if($img!='no' && $img!='') { ?>
		initialPreview: [
			"<img src='../uploads/product/<?php echo str_replace(DS, '/', $folder) . $img;?>' class='file-preview-image' title='<?php echo $img?>' alt='<?php echo $img?>'>"
		],
		<?php } ?>
		'allowedFileExtensions' : ['jpg', 'png','gif']
	});
	CKEDITOR.replace('content', {
		height: 350
	});
	$('.input-datetime').datetimepicker({
		mask:'39/19/9999 29:59',
		lang:'vi',
		format:'<?php echo TTH_DATETIME_FORMAT?>'
	});
</script>
<?php
}
/**
 * @param $id
 * @param $par
 */
function categoryName($id) {
	global $db;
	echo '<select name="product_menu_id" class="form-control">';
	$db->table = "category";
	$db->condition = "type_id = 6";
	$db->order = "sort ASC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		echo "<option value='".$row["category_id"]."' disabled";
		echo ">".stripslashes($row["name"])."</option>";
		loadMenuCategory($db, 0, 0, $row["category_id"], $id);
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
function loadMenuCategory($db, $level, $parent, $category_id, $id){
	$space = "- ";
	for($i=0; $i<$level; $i++){
		$space.="- ";
	}
	$db->table = "product_menu";
	$db->condition = "category_id = ".$category_id." and parent = ".$parent;
	$db->order = "sort ASC";
	$db->limit = "";
	$rows2 = $db->select();
	foreach($rows2 as $row) {
		if ($level <= 8){
			echo "<option value='".$row["product_menu_id"]."'";
			if ($id==$row["product_menu_id"]) echo " selected ";
			echo ">".$space.stripslashes($row["name"])."</option>";
				loadMenuCategory($db, $level+2, $row["product_menu_id"]+0, $row["category_id"]+0, $id);
		}
	}
}

function loadTrainers($id) {
	global $db;
	$rs = "";
	$rs .= '<select class="form-control" name="trainers">';
	$rs .= '<option value="0">Chọn giảng viên...</option>';

	$db->table = "teachers";
	//$db->condition = "`is_active` = 1 AND `article_menu_id` IN (SELECT `article_menu_id` FROM `".TTH_DATA_PREFIX."article_menu` WHERE `category_id` = 95)";
	$db->condition = "`is_active` = 1";
	$db->order = "`created_time` DESC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		$selected = "";
		if($id==$row["teachers_id"]) $selected = " selected";
		$rs .= '<option value="' . $row["teachers_id"] . '"' . $selected . '>' . stripslashes($row["full_name"]) . '</option>';
	}
	$rs .= '</select>';

	return $rs;
}