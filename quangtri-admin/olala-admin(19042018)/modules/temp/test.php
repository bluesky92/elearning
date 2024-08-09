<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function test($act, $typeFunc, $test_id, $courses_id, $product_id, $category_id_core, $type, $content, $is_active, $error) {
	global $db;
	dashboardCoreAdminTwo("product_" . $typeFunc . ";". $category_id_core);
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
						<input type="hidden" name="test_id" value="<?php echo $test_id?>">
						<div class="panel-show-error">
							<?php echo $error?>
						</div>
						<table class="table table-hover">
							<tr>
								<td width="12%"><label>Loại câu:</label></td>
								<td width="88%" colspan="3">
									<label class="radio-inline"><input type="radio" name="type" value="0" <?php echo $type==0?"checked":""?>> Trắc nghiệm</label>
									<label class="radio-inline"><input type="radio" name="type" value="1" <?php echo $type==1?"checked":""?>> Tự luận</label>
								</td>
							</tr>
							<tr>
								<td><label>Bài giảng:</label></td>
								<td colspan="3"><?php echo loadCourses($courses_id, $product_id);?></td>
							</tr>
							<tr>
								<td class="ver-top"><label>Nội dung câu hỏi:</label></td>
								<td colspan="3"><textarea class="form-control" id="content" name="content"><?php echo stripslashes($content)?></textarea></td>
							</tr>
							<tr id="test-choice">
								<td class="ver-top"><label>Đáp án trắc nghiệm:</label></td>
								<td colspan="3">
									<table id="multiple-choice" class="table table-hover" style="width:auto;margin:0;">
										<tbody>
										<?php
										if($test_id>0) {
											$db->table = "answer";
											$db->condition = "`test_id` = $test_id";
											$db->order = "`answer_id` ASC";
											$db->limit = "";
											$rows = $db->select();
											foreach($rows as $row) {
												echo '<tr class="item">';
												echo '<td><span><input class="form-control" type="text" name="title[]" value="' . stripslashes($row['title']) . '" placeholder="Nhập đáp án..." autocomplete="off"></span></td>';
												if($row['correct']==1) echo '<td align="center"><span><input type="checkbox" name="correct[]" value="1" checked data-toggle="tooltip" data-placement="top" title="Chọn đáp án ĐÚNG"><input type="checkbox" name="correct[]" value="0"></span></td>';
												else  echo '<td align="center"><span><input type="checkbox" name="correct[]" value="1" data-toggle="tooltip" data-placement="top" title="Chọn đáp án ĐÚNG"><input type="checkbox" name="correct[]" value="0" checked></span></td>';
												echo '<td align="center"><button type="button" class="btn btn-danger btn-circle delete"><i class="fa fa-remove"></i></button></td>';
												echo '</tr>';
											}
										}
										?>
										<tr class="item inactive">
											<td><span><input class="form-control" type="text" name="title[]" placeholder="Nhập đáp án..." autocomplete="off"></span></td>
											<td align="center"><span><input type="checkbox" name="correct[]" value="1" data-toggle="tooltip" data-placement="top" title="Chọn đáp án ĐÚNG"><input type="checkbox" name="correct[]" value="0" checked></span></td>
											<td align="center"><button type="button" class="btn btn-danger btn-circle delete"><i class="fa fa-remove"></i></button></td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td><label>Trạng thái:</label></td>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="is_active" value="0" <?php echo $is_active==0?"checked":""?> > Đóng</label>
									<label class="radio-inline"><input type="radio" name="is_active" value="1" <?php echo $is_active==1?"checked":""?> > Mở</label>
								</td>
							</tr>
							<tr>
								<td colspan="4" align="center">
									<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
									<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=test_list&id=<?php echo $courses_id?>'">Thoát</button>
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
	CKEDITOR.replace('content', {
		height: 120,
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
	$('input[type="radio"][name="type"]').click(function() {
		$("#test-choice").toggle('slow');
	});

	$(document).ready(function() {
		$('input[type="radio"][name="type"]:checked').each(function () {
			if(parseInt($(this).val())==1) $("#test-choice").hide();
		});
	});
</script>
<?php
}
/**
 * @param $id
 * @param $par
 */
function loadCourses($id, $product) {
	global $db;
	$rs = "";
	$rs .= '<select class="form-control" name="courses_id">';
	$rs .= '<option value="0" disabled>Chọn bài giảng...</option>';
	$db->table = "courses";
	$db->condition = "`is_active` = 1 AND `product_id` = $product";
	$db->order = "`sort` ASC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		$selected = "";
		if($id==$row["courses_id"]) $selected = " selected";
		$rs .= '<option value="' . $row["courses_id"] . '"' . $selected . '>' . stripslashes($row["name"]) . '</option>';
	}
	$rs .= '</select>';
	return $rs;
}

function sortAcs($id = 0){
	global $db;
	$db->table = "test";
	$db->condition = "`courses_id` = $id";
	$db->limit = "";
	$db->select();
	return $db->RowCount;
}