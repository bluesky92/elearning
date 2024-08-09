<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

function courses($act, $typeFunc, $courses_id, $product_id, $name, $name_video, $name_document, $document_title, $content, $test, $practice, $is_active, $hot, $error) {
	global $db,  $corePrivilegeSlug;
	$category_id_core = $product_menu_id = 0;
	$db->table = "product";
	$db->condition = "`product_id` = $product_id";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row){
		$product_menu_id = $row['product_menu_id'];
	}
	$category_id_core = getTableOl($product_menu_id, 'product_menu', 'product_menu_id', 'category_id');
	dashboardCoreAdminTwo("product_" . $typeFunc . ";". $category_id_core);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Nội dung bài giảng
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>">
						<input type="hidden" name="courses_id" value="<?php echo $courses_id?>">
						<input type="hidden" name="name_video" value="<?php echo $name_video?>">
						<input type="hidden" name="name_document" value="<?php echo $name_document?>">
						<div class="panel-show-error">
							<?php echo $error?>
						</div>
						<table class="table table-hover">
							<tr>
								<td width="12%"><label>Tiêu đề:</label></td>
								<td width="88%" colspan="3"><input class="form-control" type="text" name="name" maxlength="255" value="<?php echo stripslashes($name)?>" required="required"></td>
							</tr>
							<tr>
								<td><label>Khóa học:</label></td>
								<td><?php echo loadProduct($product_id);?></td>
								<td><label>Kiểm tra:</label></td>
								<td><?php echo loadCountTest($test, $courses_id);?></td>
							</tr>
							<tr>
								<td><label>Video:</label></td>
								<td colspan="3"><input class="form-control file file-video" type="file" name="video" data-show-upload="false" data-show-preview="false" data-max-file-count="1" accept="video/*"></td>
							</tr>
							<tr>
								<td><label>Tên tài liệu:</label></td>
								<td><input class="form-control" type="text" name="document_title" maxlength="255" value="<?php echo stripslashes($document_title)?>"></td>
								<td><label>Tài liệu:</label></td>
								<td><input class="form-control file document" type="file" name="document" data-show-upload="false" data-show-preview="false" data-max-file-count="1"></td>
							</tr>
							<tr>
								<td class="ver-top"><label>Nội dung:</label></td>
								<td colspan="3"><textarea class="form-control" id="content" name="content"><?php echo stripslashes($content)?></textarea></td>
							</tr>
							<tr>
								<td><label>Link bài thực hành:</label></td>
								<td colspan="3"><input class="form-control" type="text" name="practice" maxlength="255" value="<?php echo stripslashes($practice)?>"></td>
							</tr>
                            <?php
                            if(in_array("active;".$category_id_core, $corePrivilegeSlug)) {
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
								<td colspan="4" align="center">
									<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
									<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=courses_list&id=<?php echo $product_id?>'">Thoát</button>
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
	$('.file-video').fileinput({
		<?php if($name_video !='' && $name_video !='-no-') echo 'initialPreview: ["' . $name_video . '"]'; ?>
	});
	$('.document').fileinput({
		<?php if($name_document !='' && $name_document !='-no-') echo 'initialPreview: ["' . $name_document . '"]'; ?>
	});
	CKEDITOR.replace('content', {
		height: 250
	});
</script>
<?php
}
/**
 * @param $id
 * @param $par
 */
function loadProduct($id) {
	global $db;
	$rs = "";
	$rs .= '<select class="form-control" name="product_id">';
	$rs .= '<option value="0" disabled>Chọn khóa học...</option>';
	$db->table = "product";
	$db->condition = "`is_active` = 1 AND `product_menu_id` IN (SELECT `product_menu_id` FROM `".TTH_DATA_PREFIX."product_menu` WHERE `category_id` = 89)";
	$db->order = "`created_time` DESC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		$selected = "";
		if($id==$row["product_id"]) $selected = " selected";
		$rs .= '<option value="' . $row["product_id"] . '"' . $selected . '>' . stripslashes($row["name"]) . '</option>';
	}
	$rs .= '</select>';
	return $rs;
}


function loadCountTest($id, $courses) {
	global $db;
	$rs = "";
	$rs .= '<select class="form-control" name="test">';
	$rs .= '<option value="0">Số câu trắc nghiệm bắt buộc vượt qua...</option>';
	$db->table = "test";
	$db->condition = "`is_active` = 1 AND `courses_id` = $courses";
	$db->order = "`sort` ASC";
	$db->limit = "";
	$db->select();
	$total = $db->RowCount;
	for($i=1; $i<=$total; $i++) {
		$selected = "";
		if($id==$i) $selected = " selected";
		$rs .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
	}
	$rs .= '</select>';
	return $rs;
}

function sortAcs($id = 0){
	global $db;
	$db->table = "courses";
	$db->condition = "`product_id` = $id";
	$db->limit = "";
	$db->select();
	return $db->RowCount;
}