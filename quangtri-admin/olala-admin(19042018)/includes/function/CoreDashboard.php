<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Chung
 * @param $role_id
 */
function showCoreCategory ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'category'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div style="padding: 10px; border-left: 1px solid #ddd;">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="selecctallCategory" value="ok" ><b>Chọn tất cả / Hủy tất cả</b>
				</label>
			</div>
		<?php
		$db->table = "category_type";
		$db->condition = "is_active = 1";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div class="checkbox">
				<label>
					<input type="checkbox" class="checkboxCategory" name="variable[]" <?php echo (in_array($row['slug'],$privilege)) ? "checked" : "" ?> value="<?php echo $row['slug']?>" ><?php echo stripslashes($row['name'])?>
				</label>
			</div>
		<?php
		}
		?>
			<div class="checkbox">
				<label>
					<input type="checkbox" class="checkboxCategory" name="variable[]" <?php echo (in_array("plugin_page",$privilege)) ? "checked" : "" ?> value="plugin_page" >Phần bổ sung
				</label>
			</div>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallCategory').click(function(event) {
			if(this.checked) {
				$('.checkboxCategory').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxCategory').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Bài viết
 * @param $role_id
 */
function showCoreArticle ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'article'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 1";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallArt<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
                <div class="checkbox" style="padding-left: 10px;">
                    <label>
                        <input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("active;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="active;<?php echo $row['category_id']?>">KIỂM DUYỆT NỘI DUNG
                    </label>
                </div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_list;<?php echo $row['category_id']?>">Danh sách bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_add;<?php echo $row['category_id']?>">Thêm bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_edit;<?php echo $row['category_id']?>">Chỉnh sửa bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxArt<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("article_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="article_del;<?php echo $row['category_id']?>">Xóa bài viết
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallArt<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxArt<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxArt<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Hình ảnh
 * @param $role_id
 */
function showCoreGallery ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'gallery'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 2";
		$db->order = "sort ASC";
		$rows = $db->select();
		$i = 0;
		$countList = 0;
		$countList = $db->RowCount;
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallGal<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
                <div class="checkbox" style="padding-left: 10px;">
                    <label>
                        <input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("active;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="active;<?php echo $row['category_id']?>">KIỂM DUYỆT NỘI DUNG
                    </label>
                </div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_list;<?php echo $row['category_id']?>">Danh sách hình ảnh
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_add;<?php echo $row['category_id']?>">Thêm hình ảnh
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_edit;<?php echo $row['category_id']?>">Chỉnh sửa hình ảnh
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGal<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gallery_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gallery_del;<?php echo $row['category_id']?>">Xóa hình ảnh
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallGal<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxGal<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxGal<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Văn bản / Tài liệu
 * @param $role_id
 */
function showCoreDocument ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'document'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 21";
		$db->order = "sort ASC";
		$rows = $db->select();
		$i = 0;
		$countList = 0;
		$countList = $db->RowCount;
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallDoc<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
                <div class="checkbox" style="padding-left: 10px;">
                    <label>
                        <input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("active;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="active;<?php echo $row['category_id']?>">KIỂM DUYỆT NỘI DUNG
                    </label>
                </div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_list;<?php echo $row['category_id']?>">Danh sách hình ảnh
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_add;<?php echo $row['category_id']?>">Thêm hình ảnh
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_edit;<?php echo $row['category_id']?>">Chỉnh sửa hình ảnh
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxDoc<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("document_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="document_del;<?php echo $row['category_id']?>">Xóa hình ảnh
					</label>
				</div>
				<script>
					$(document).ready(function() {
						$('#selecctallDoc<?php echo $row['slug']?>').click(function(event) {
							if(this.checked) {
								$('.checkboxDoc<?php echo $row['slug']?>').each(function() {
									this.checked = true;
								});
							}else{
								$('.checkboxDoc<?php echo $row['slug']?>').each(function() {
									this.checked = false;
								});
							}
						});
					});
				</script>
			</div>
			<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Diễn đàn
 * @param $role_id
 */
function showCoreForum ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'forum'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 17";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallforum<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
                <div class="checkbox" style="padding-left: 10px;">
                    <label>
                        <input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("active;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="active;<?php echo $row['category_id']?>">KIỂM DUYỆT NỘI DUNG
                    </label>
                </div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_list;<?php echo $row['category_id']?>">Danh sách bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_add;<?php echo $row['category_id']?>">Thêm bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_edit;<?php echo $row['category_id']?>">Chỉnh sửa bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxforum<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("forum_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="forum_del;<?php echo $row['category_id']?>">Xóa bài viết
					</label>
				</div>
				<script>
					$(document).ready(function() {
						$('#selecctallforum<?php echo $row['slug']?>').click(function(event) {
							if(this.checked) {
								$('.checkboxforum<?php echo $row['slug']?>').each(function() {
									this.checked = true;
								});
							}else{
								$('.checkboxforum<?php echo $row['slug']?>').each(function() {
									this.checked = false;
								});
							}
						});
					});
				</script>
			</div>
			<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Sản phẩm
 * @param $role_id
 */
function showCoreProduct ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'product'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 6";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallPro<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
                <div class="checkbox" style="padding-left: 10px;">
                    <label>
                        <input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("active;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="active;<?php echo $row['category_id']?>">KIỂM DUYỆT NỘI DUNG
                    </label>
                </div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa chủ đề
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_list;<?php echo $row['category_id']?>">Danh sách khóa học
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_add;<?php echo $row['category_id']?>">Thêm khóa học
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_edit;<?php echo $row['category_id']?>">Chỉnh sửa khóa học
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxPro<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("product_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="product_del;<?php echo $row['category_id']?>">Xóa khóa học
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallPro<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxPro<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						} else{
							$('.checkboxPro<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Thư viện đề thi
 * @param $role_id
 */
function showCoreLibrary ($role_id) {
    global $db;

    $privilege = array();
    $db->table = "core_privilege";
    $db->condition = "`role_id` = ".$role_id. " and `type` = 'library'";
    $db->order = "";
    $db->limit = "";
    $rows = $db->select();
    $stt = 0;
    foreach ($rows as $row) {
        $privilege[$stt] = $row['privilege_slug'];
        $stt++;
    }
    ?>
    <input type="hidden" name="role_id" value="<?php echo $role_id?>" />
    <div class="form-group">
        <div style="padding: 10px; border-left: 1px solid #ddd;">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="selecctalllibrary" ><b>Chọn tất cả / Hủy tất cả</b>
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxlibrary" name="variable[]" <?php echo (in_array("library_active",$privilege)) ? "checked" : "" ?> value="library_active">KIỂM DUYỆT NỘI DUNG
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxlibrary" name="variable[]" <?php echo (in_array("library_add",$privilege)) ? "checked" : "" ?> value="library_add">Thêm câu hỏi
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxlibrary" name="variable[]" <?php echo (in_array("library_edit",$privilege)) ? "checked" : "" ?> value="library_edit">Chỉnh sửa câu hỏi
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxlibrary" name="variable[]" <?php echo (in_array("library_del",$privilege)) ? "checked" : "" ?> value="library_del">Xóa câu hỏi
                </label>
            </div>
            <script>
                $(document).ready(function() {
                    $('#selecctalllibrary').click(function(event) {
                        if(this.checked) {
                            $('.checkboxlibrary').each(function() {
                                this.checked = true;
                            });
                        }else{
                            $('.checkboxlibrary').each(function() {
                                this.checked = false;
                            });
                        }
                    });
                });
            </script>
        </div>
        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
    </div>
    <?php
}


//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Kiểm tra - Kết quả
 * @param $role_id
 */
function showCoreExamination ($role_id) {
    global $db;

    $privilege = array();
    $db->table = "core_privilege";
    $db->condition = "`role_id` = ".$role_id. " and `type` = 'examination'";
    $db->order = "";
    $db->limit = "";
    $rows = $db->select();
    $stt = 0;
    foreach ($rows as $row) {
        $privilege[$stt] = $row['privilege_slug'];
        $stt++;
    }
    ?>
    <input type="hidden" name="role_id" value="<?php echo $role_id?>" />
    <div class="form-group">
        <div style="padding: 10px; border-left: 1px solid #ddd;">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="selecctallexamination" ><b>Chọn tất cả / Hủy tất cả</b>
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxexamination" name="variable[]" <?php echo (in_array("examination_active",$privilege)) ? "checked" : "" ?> value="examination_active">KIỂM DUYỆT NỘI DUNG
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxexamination" name="variable[]" <?php echo (in_array("examination_add",$privilege)) ? "checked" : "" ?> value="examination_add">Thêm mục
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxexamination" name="variable[]" <?php echo (in_array("examination_edit",$privilege)) ? "checked" : "" ?> value="examination_edit">Chỉnh sửa mục
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxexamination" name="variable[]" <?php echo (in_array("examination_del",$privilege)) ? "checked" : "" ?> value="examination_del">Xóa mục
                </label>
            </div>
            <div class="checkbox" style="padding-left: 10px;">
                <label>
                    <input type="checkbox" class="checkboxexamination" name="variable[]" <?php echo (in_array("examination_logs",$privilege)) ? "checked" : "" ?> value="examination_logs">Thành phần dự kiểm tra
                </label>
            </div>
            <script>
                $(document).ready(function() {
                    $('#selecctallexamination').click(function(event) {
                        if(this.checked) {
                            $('.checkboxexamination').each(function() {
                                this.checked = true;
                            });
                        }else{
                            $('.checkboxexamination').each(function() {
                                this.checked = false;
                            });
                        }
                    });
                });
            </script>
        </div>
        <label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
    </div>
    <?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Tour du lịch
 * @param $role_id
 */
function showCoreTour ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'tour'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 9";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallTour<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_list;<?php echo $row['category_id']?>">Danh sách bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_add;<?php echo $row['category_id']?>">Thêm bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_edit;<?php echo $row['category_id']?>">Chỉnh sửa bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxTour<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("tour_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="tour_del;<?php echo $row['category_id']?>">Xóa bài viết
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallTour<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxTour<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxTour<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Thuê xe
 * @param $role_id
 */
function showCoreCar ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'car'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 11";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallCar<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_list;<?php echo $row['category_id']?>">Danh sách bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_add;<?php echo $row['category_id']?>">Thêm bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_edit;<?php echo $row['category_id']?>">Chỉnh sửa bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxCar<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("car_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="car_del;<?php echo $row['category_id']?>">Xóa bài viết
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallCar<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxCar<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxCar<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Đồ lưu niệm
 * @param $role_id
 */
function showCoreGift ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'gift'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 10";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallGift<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_list;<?php echo $row['category_id']?>">Danh sách bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_add;<?php echo $row['category_id']?>">Thêm bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_edit;<?php echo $row['category_id']?>">Chỉnh sửa bài viết
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxGift<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("gift_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="gift_del;<?php echo $row['category_id']?>">Xóa bài viết
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallGift<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxGift<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxGift<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Vị trí địa lý
 * @param $role_id
 */
function showCoreLocation ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'location'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 12";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallLocation<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_list;<?php echo $row['category_id']?>">Danh sách nội dung
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_add;<?php echo $row['category_id']?>">Thêm nội dung
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_edit;<?php echo $row['category_id']?>">Chỉnh sửa nội dung
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxLocation<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("location_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="location_del;<?php echo $row['category_id']?>">Xóa nội dung
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallLocation<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxLocation<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxLocation<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Dữ liệu đường phố
 * @param $role_id
 */
function showCoreStreet ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'street'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div style="padding: 10px; border-left: 1px solid #ddd;">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="selecctallStreet" ><b>Chọn tất cả / Hủy tất cả</b>
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxStreet" name="variable[]" <?php echo (in_array("street_add",$privilege)) ? "checked" : "" ?> value="street_add">Thêm mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxStreet" name="variable[]" <?php echo (in_array("street_edit",$privilege)) ? "checked" : "" ?> value="street_edit">Chỉnh sửa mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxStreet" name="variable[]" <?php echo (in_array("street_del",$privilege)) ? "checked" : "" ?> value="street_del">Xóa mục
				</label>
			</div>
			<script>
			$(document).ready(function() {
				$('#selecctallStreet').click(function(event) {
					if(this.checked) {
						$('.checkboxStreet').each(function() {
							this.checked = true;
						});
					}else{
						$('.checkboxStreet').each(function() {
							this.checked = false;
						});
					}
				});
			});
			</script>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}


//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Dữ liệu tên dự án
 * @param $role_id
 */
function showCorePrjname ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'prjname'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div style="padding: 10px; border-left: 1px solid #ddd;">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="selecctallPrjname" ><b>Chọn tất cả / Hủy tất cả</b>
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxPrjname" name="variable[]" <?php echo (in_array("prjname_add",$privilege)) ? "checked" : "" ?> value="prjname_add">Thêm mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxPrjname" name="variable[]" <?php echo (in_array("prjname_edit",$privilege)) ? "checked" : "" ?> value="prjname_edit">Chỉnh sửa mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxPrjname" name="variable[]" <?php echo (in_array("prjname_del",$privilege)) ? "checked" : "" ?> value="prjname_del">Xóa mục
				</label>
			</div>
			<script>
			$(document).ready(function() {
				$('#selecctallPrjname').click(function(event) {
					if(this.checked) {
						$('.checkboxPrjname').each(function() {
							this.checked = true;
						});
					}else{
						$('.checkboxPrjname').each(function() {
							this.checked = false;
						});
					}
				});
			});
			</script>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Chiều rộng đường
 * @param $role_id
 */
function showCoreRoad ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'road'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div style="padding: 10px; border-left: 1px solid #ddd;">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="selecctallRoad" ><b>Chọn tất cả / Hủy tất cả</b>
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxRoad" name="variable[]" <?php echo (in_array("road_add",$privilege)) ? "checked" : "" ?> value="road_add">Thêm mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxRoad" name="variable[]" <?php echo (in_array("road_edit",$privilege)) ? "checked" : "" ?> value="road_edit">Chỉnh sửa mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxRoad" name="variable[]" <?php echo (in_array("road_del",$privilege)) ? "checked" : "" ?> value="road_del">Xóa mục
				</label>
			</div>
			<script>
			$(document).ready(function() {
				$('#selecctallRoad').click(function(event) {
					if(this.checked) {
						$('.checkboxRoad').each(function() {
							this.checked = true;
						});
					}else{
						$('.checkboxRoad').each(function() {
							this.checked = false;
						});
					}
				});
			});
			</script>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Dữ liệu phương hướng
 * @param $role_id
 */
function showCoreDirection ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'direction'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div style="padding: 10px; border-left: 1px solid #ddd;">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="selecctallDirection" ><b>Chọn tất cả / Hủy tất cả</b>
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxDirection" name="variable[]" <?php echo (in_array("direction_add",$privilege)) ? "checked" : "" ?> value="direction_add">Thêm mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxDirection" name="variable[]" <?php echo (in_array("direction_edit",$privilege)) ? "checked" : "" ?> value="direction_edit">Chỉnh sửa mục
				</label>
			</div>
			<div class="checkbox" style="padding-left: 10px;">
				<label>
					<input type="checkbox" class="checkboxDirection" name="variable[]" <?php echo (in_array("direction_del",$privilege)) ? "checked" : "" ?> value="direction_del">Xóa mục
				</label>
			</div>
			<script>
			$(document).ready(function() {
				$('#selecctallDirection').click(function(event) {
					if(this.checked) {
						$('.checkboxDirection').each(function() {
							this.checked = true;
						});
					}else{
						$('.checkboxDirection').each(function() {
							this.checked = false;
						});
					}
				});
			});
			</script>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Dữ liệu khác
 * @param $role_id
 */
function showCoreOthers ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'others'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<?php
		$db->table = "category";
		$db->condition = "type_id = 15";
		$db->order = "sort ASC";
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div style="float: left; padding: 10px; border-left: 1px solid #ddd;">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="selecctallOthers<?php echo $row['slug']?>" ><b><?php echo stripslashes($row['name'])?></b>
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("category_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="category_edit;<?php echo $row['category_id']?>">Chỉnh sửa thể loại
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_menu_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_menu_add;<?php echo $row['category_id']?>">Thêm mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_menu_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_menu_edit;<?php echo $row['category_id']?>">Chỉnh sửa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 10px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_menu_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_menu_del;<?php echo $row['category_id']?>">Xóa mục
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_list;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_list;<?php echo $row['category_id']?>">Danh sách nội dung
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_add;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_add;<?php echo $row['category_id']?>">Thêm nội dung
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_edit;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_edit;<?php echo $row['category_id']?>">Chỉnh sửa nội dung
					</label>
				</div>
				<div class="checkbox" style="padding-left: 20px;">
					<label>
						<input type="checkbox" class="checkboxOthers<?php echo $row['slug']?>" name="variable[]" <?php echo (in_array("others_del;".$row['category_id'],$privilege)) ? "checked" : "" ?> value="others_del;<?php echo $row['category_id']?>">Xóa nội dung
					</label>
				</div>
				<script>
				$(document).ready(function() {
					$('#selecctallOthers<?php echo $row['slug']?>').click(function(event) {
						if(this.checked) {
							$('.checkboxOthers<?php echo $row['slug']?>').each(function() {
								this.checked = true;
							});
						}else{
							$('.checkboxOthers<?php echo $row['slug']?>').each(function() {
								this.checked = false;
							});
						}
					});
				});
				</script>
			</div>
		<?php
		}
		?>
		<div class="clearfix"></div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản lý nội dung > Phần bổ sung
 * @param $role_id
 */
function showCorePages ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'pages'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div style="padding: 10px; border-left: 1px solid #ddd;">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="selecctallPages" ><b>Chọn tất cả / Hủy tất cả</b>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" class="checkboxPages" name="variable[]" <?php echo (in_array("plugin_page_add",$privilege)) ? "checked" : "" ?> value="plugin_page_add">Thêm trang
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" class="checkboxPages" name="variable[]" <?php echo (in_array("plugin_page_edit",$privilege)) ? "checked" : "" ?> value="plugin_page_edit">Chỉnh sửa trang
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" class="checkboxPages" name="variable[]" <?php echo (in_array("plugin_page_del",$privilege)) ? "checked" : "" ?> value="plugin_page_del">Xóa trang
				</label>
			</div>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallPages').click(function(event) {
			if(this.checked) {
				$('.checkboxPages').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxPages').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Cơ sở dữ liệu
 * @param $role_id
 */
function showCoreBackup ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'backup'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="selecctallTwo" ><b>Chọn tất cả / Hủy tất cả</b>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxBackup" name="variable[]" <?php echo (in_array("backup_data",$privilege)) ? "checked" : "" ?> value="backup_data">Sao lưu dữ liệu
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxBackup" name="variable[]" <?php echo (in_array("backup_config",$privilege)) ? "checked" : "" ?> value="backup_config">Cấu hình sao lưu
			</label>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallTwo').click(function(event) {
			if(this.checked) {
				$('.checkboxBackup').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxBackup').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Cấu hình
 * @param $role_id
 */
function showCoreConfig ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'config'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="selecctallThree" ><b>Chọn tất cả / Hủy tất cả</b>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_general",$privilege)) ? "checked" : "" ?> value="config_general">Cấu hình chung
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_test",$privilege)) ? "checked" : "" ?> value="config_test">Cấu hình tự kiểm tra
			</label>
		</div>
        <div class="checkbox">
            <label>
                <input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_smtp",$privilege)) ? "checked" : "" ?> value="config_smtp">Cấu hình SMTP
            </label>
        </div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_datetime",$privilege)) ? "checked" : "" ?> value="config_datetime">Cấu hình thời gian
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_plugins",$privilege)) ? "checked" : "" ?> value="config_plugins">Trình cắm bổ sung
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_socialnetwork",$privilege)) ? "checked" : "" ?> value="config_socialnetwork">Mạng xã hội
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_search",$privilege)) ? "checked" : "" ?> value="config_search">Máy chủ tìm kiếm
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("config_upload",$privilege)) ? "checked" : "" ?> value="config_upload">Cấu hình upload
			</label>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallThree').click(function(event) {
			if(this.checked) {
				$('.checkboxConfig').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxConfig').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Công cụ hỗ trợ
 * @param $role_id
 */
function showCoreTool ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'tool'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="selecctallFour" ><b>Chọn tất cả / Hủy tất cả</b>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxTool" name="variable[]" <?php echo (in_array("tool_delete",$privilege)) ? "checked" : "" ?> value="tool_delete">Dọn dẹp hệ thống
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxTool" name="variable[]" <?php echo (in_array("tool_site",$privilege)) ? "checked" : "" ?> value="tool_site">Chuẩn đoán site
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxTool" name="variable[]" <?php echo (in_array("tool_keywords",$privilege)) ? "checked" : "" ?> value="tool_keywords">Hạng site theo từ khóa
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxConfig" name="variable[]" <?php echo (in_array("tool_ipdie",$privilege)) ? "checked" : "" ?> value="tool_ipdie">Quản lý IP cấm
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxTool" name="variable[]" <?php echo (in_array("tool_update",$privilege)) ? "checked" : "" ?> value="tool_update">Kiểm tra phiên bản
			</label>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallFour').click(function(event) {
			if(this.checked) {
				$('.checkboxTool').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxTool').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Quản trị hệ thống
 * @param $role_id
 */
function showCoreCore ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'core'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>

	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="selecctallFive" ><b>Chọn tất cả / Hủy tất cả</b>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_role",$privilege)) ? "checked" : "" ?> value="core_role">Nhóm quản trị
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_user",$privilege)) ? "checked" : "" ?> value="core_user">Quản lý thành viên
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_dashboard",$privilege)) ? "checked" : "" ?> value="core_dashboard">Phân quyền quản trị
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxCore" name="variable[]" <?php echo (in_array("core_mail",$privilege)) ? "checked" : "" ?> value="core_mail">Gửi mail thành viên
			</label>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallFive').click(function(event) {
			if(this.checked) {
				$('.checkboxCore').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxCore').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * Cập nhật quyền quản trị: Thông tin hệ thống
 * @param $role_id
 */
function showCoreInfo ($role_id) {
	global $db;

	$privilege = array();
	$db->table = "core_privilege";
	$db->condition = "role_id = ".$role_id. " and type = 'info'";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	$stt = 0;
	foreach ($rows as $row) {
		$privilege[$stt] = $row['privilege_slug'];
		$stt++;
	}
	?>
	<input type="hidden" name="role_id" value="<?php echo $role_id?>" />
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="selecctallSix" ><b>Chọn tất cả / Hủy tất cả</b>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxInfo" name="variable[]" <?php echo (in_array("sys_info_diary",$privilege)) ? "checked" : "" ?> value="sys_info_diary">Thống kê hoạt động
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxInfo" name="variable[]" <?php echo (in_array("sys_info_site",$privilege)) ? "checked" : "" ?> value="sys_info_site">Cấu hình site
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxInfo" name="variable[]" <?php echo (in_array("sys_info_php",$privilege)) ? "checked" : "" ?> value="sys_info_php">Cấu hình PHP
			</label>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" class="checkboxInfo" name="variable[]" <?php echo (in_array("sys_info_expansion",$privilege)) ? "checked" : "" ?> value="sys_info_expansion">Tiện ích mở rộng
			</label>
		</div>
		<label><button type="submit" class="btn btn-form-primary btn-form">Xác nhận</button></label>
	</div>
	<script>
	$(document).ready(function() {
		$('#selecctallSix').click(function(event) {
			if(this.checked) {
				$('.checkboxInfo').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxInfo').each(function() {
					this.checked = false;
				});
			}
		});
	});
	</script>
<?php
}