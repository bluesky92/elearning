<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function articleCat($act, $typeFunc, $category_id, $name, $slug, $txt_plus, $title, $description, $keywords, $comment, $is_active, $hot, $folder, $img, $menu_main, $type_id, $font_icon, $error) {
	global $tth, $corePrivilegeSlug;
	dashboardCoreAdminTwo($tth.";".$category_id);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Thể loại nội dung
			</div>
			<div class="panel-body">
				<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>">
					<input type="hidden" name="category_id" value="<?php echo $category_id?>">
					<input type="hidden" name="type_id" value="<?php echo $type_id?>">
					<input type="hidden" name="img" value="<?php echo $img?>">
					<div class="panel-show-error">
						<?php echo $error?>
					</div>
					<table class="table table-hover" style="width: 70%;">
						<tr>
							<td width="150px"><label>Tên thể loại:</label></td>
							<td><input class="form-control" type="text" name="name" maxlength="200" value="<?php echo stripslashes($name)?>" required="required" ></td>
						</tr>
						<tr>
							<td><label>Liên kết tĩnh:</label></td>
							<td><input class="form-control" readonly type="text" name="slug" maxlength="200" value="<?php echo stripslashes($slug)?>" ></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Mô tả:</label></td>
							<td>
								<textarea class="form-control" rows="3" name="comment"><?php echo stripslashes($comment)?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Class Font Awesome:</label></td>
							<td><input class="form-control" type="text" name="font_icon" maxlength="255" value="<?php echo stripslashes($font_icon)?>" ></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Hình đại diện:</label></td>
							<td>
								<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*">
							</td>
						</tr>
						<tr>
							<td><label>Bổ sung:</label></td>
							<td><input class="form-control" type="text" name="txt_plus" maxlength="255" value="<?php echo stripslashes($txt_plus)?>"></td>
						</tr>
						<tr>
							<td><label>Vào menu chính:</label></td>
							<td>
								<label class="radio-inline"><input type="radio" name="menu_main" value="0" <?php echo $menu_main==0?"checked":""?> > Không</label>
								<label class="radio-inline"><input type="radio" name="menu_main" value="1" <?php echo $menu_main==1?"checked":""?> > Có</label>
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
								<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH."=".getSlugCat($type_id)?>'">Thoát</button>
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
			"<img src='../uploads/category/<?php echo str_replace(DS, '/', $folder) . $img?>' class='file-preview-image' title='<?php echo $img?>' alt='<?php echo $img?>'>"
		],
		<?php } ?>
		allowedFileExtensions : ['jpg', 'png','gif']
	});
</script>
<?php
}