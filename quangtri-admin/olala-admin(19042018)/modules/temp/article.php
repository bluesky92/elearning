<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function article($act, $typeFunc, $article_id, $article_menu_id, $name, $title, $description, $keywords, $folder, $img, $img_note, $address, $price, $comment, $content, $is_active, $hot, $created_time, $upload_img_id, $error) {
	global $db, $tth, $corePrivilegeSlug;
	$category = 0;
	$db->table = "article_menu";
	$db->condition = "`article_menu_id` = $article_menu_id";
	$db->order = "";
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
				<i class="fa fa-files-o"></i> Nội dung bài viết
			</div>
			<div class="panel-body">
				<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>" />
					<input type="hidden" name="article_id" value="<?php echo $article_id?>" />
					<input type="hidden" name="img" value="<?php echo $img?>" />
					<input type="hidden" name="upload_img_id" value="<?php echo $upload_img_id?>">
					<div class="panel-show-error">
						<?php echo $error?>
					</div>
					<table class="table table-hover">
						<tr>
							<td width="12%"><label>Tiêu đề bài viết:</label></td>
							<td width="88%" colspan="3"><input class="form-control" type="text" name="name" maxlength="200" value="<?php echo stripslashes($name)?>" required="required" ></td>
						</tr>
						<tr>
							<td><label>Mục:</label></td>
							<td colspan="3"><?php categoryName($article_menu_id);?></td>
						</tr>
						<tr>
							<td width="12%" class="ver-top"><label>Hình đại diện:</label></td>
							<td width="38%" class="ver-top">
								<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*">
								<?php if($img!='no' && $img!='') { ?>
									<br />
									<label class="checkbox-inline">
										<input id="del-img" type="checkbox" name="del_img" value="delete"><span><strong>Không dùng</strong> Hình đại diện</span>
									</label>
								<?php } ?>
							</td>
							<td width="12%" class="ver-top"><label>Ghi chú hình:</label></td>
							<td width="38%" class="ver-top"><input class="form-control" type="text" name="img_note" maxlength="255" value="<?php echo stripslashes($img_note)?>" ></td>
						</tr>
						<?php if($category==89) { ?>
						<tr>
							<td><label>Địa chỉ:</label></td>
							<td><input class="form-control" type="text" name="address" maxlength="255" value="<?php echo stripslashes($address)?>" ></td>
							<td><label>Giá từ:</label></td>
							<td><input class="form-control auto-number" type="text" name="price" data-a-sep="." data-a-dec="," data-v-max="999999999999999" data-v-min="0" maxlength="25" value="<?php echo stripslashes($price)?>"></td>
						</tr>
						<?php } ?>
						<tr>
							<td class="ver-top"><label>Mô tả:</label></td>
							<td colspan="3">
								<textarea class="form-control" rows="3" name="comment"><?php echo stripslashes($comment)?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Nội dung chi tiết:</label></td>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4">
								<textarea class="form-control" name="content" id="content" required="required" ><?php echo stripslashes($content)?></textarea>
							</td>
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
							<td colspan="3"><input class="form-control" id="input-datetime" type="text" name="created_time" style="width: 125px;"  value="<?php echo $created_time?>" ></td>
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
								<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=article_list&id=<?php echo $article_menu_id?>'">Thoát</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>
<?php
/*
$dir_dest = ROOT_DIR . DS .'uploads'. DS .'photos';
$list_img = "";
$p1 = $p2 = array();
$db->table = "uploads_tmp";
$db->condition = "upload_id = ".$upload_img_id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
foreach ($rows as $row){
	$list_img = $row['list_img'];
}

$files_img = explode(";", $list_img);
if(count($files_img)>0) {
	for ($i = 0; $i < count($files_img); $i++) {
		if ($files_img[$i] != "" && file_exists($dir_dest . DS . $files_img[$i])) {
			$src = "/uploads/photos/" . $files_img[$i];
			$l_key = explode("_", $files_img[$i]);
			$key = $l_key[0];
			$url = '/uploads/upload.php?type=2&id='.$upload_img_id.'&item='.$files_img[$i].'&lang='.TTH_LANGUAGE;
			$p1[$i] = '"<a href=\''.$src.'\' data-gallery><img src=\''.$src.'\' class=\'file-preview-image\'></a>"';
			$p2[$i] = '{url: "'.$url.'", key: '.$key.'}';
		}
	}
}
*/
?>
<script>
	CKEDITOR.replace('content', {
			height: 300}
	);
	$('#input-datetime').datetimepicker({
		mask:'39/19/9999 29:59',
		lang:'vi',
		format:'<?php echo TTH_DATETIME_FORMAT?>'
	});
	$('.file-img').fileinput({
		<?php if($img!='' && $img!='-no-') { ?>
		initialPreview: [
			"<img src='../uploads/article/<?php echo str_replace(DS, '/', $folder) . $img?>' class='file-preview-image' title='<?php echo $img?>' alt='<?php echo $img?>'>"
		],
		<?php } ?>
		allowedFileExtensions : ['jpg', 'png', 'gif', 'bmp']
	});
</script>
<?php
}
/**
 * @param $id
 * @param $par
 */
function categoryName($id) {
	echo '<select name="article_menu_id" class="form-control">';
	global $db;
	$db->table = "category";
	$db->condition = "type_id = 1";
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
	$db->table = "article_menu";
	$db->condition = "category_id = ".$category_id." and parent = ".$parent;
	$db->order = "sort ASC";
	$db->limit = "";
	$rows2 = $db->select();
	foreach($rows2 as $row) {
		if ($level <= 3){
			echo "<option value='".$row["article_menu_id"]."'";
			if ($id==$row["article_menu_id"]) echo " selected ";
			echo ">".$space.stripslashes($row["name"])."</option>";
				loadMenuCategory($db, $level+1, $row["article_menu_id"]+0, $row["category_id"]+0, $id);
		}
	}
}
