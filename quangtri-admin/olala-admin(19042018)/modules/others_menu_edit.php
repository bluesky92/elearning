<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=others_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=others_manager"><i class="fa fa-puzzle-piece"></i> Dữ liệu khác</a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa mục
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "others_menu.php");
if(empty($typeFunc)) $typeFunc = "no";
$others_menu_id =  isset($_GET['id']) ? $_GET['id']+0 : $others_menu_id+0;
$db->table = "others_menu";
$db->condition = "others_menu_id = ".$others_menu_id;
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.","?".TTH_PATH."=others_manager");

$OK = false;
$error = '';
if($typeFunc=='edit'){
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên mục.</span>';
	else {
		$stringObj = new String();

		$slug = (empty($slug)) ? $name : $slug;
		$slug = $stringObj->getSlug($slug);
		$db->table = "others_menu";
		$db->condition = "slug = '".$slug."'";
		$rows = $db->select();
		$id = 0;
		foreach ($rows as $row) {
			$id = $row['others_menu_id'];
		}
		if($db->RowCount > 0 && $id != $others_menu_id) {
			$slug = $slug. '-' .$stringObj->getSlug(getRandomString(10));
		}

		$db->table = "others_menu";
		$data = array(
			'name'=>$db->clearText($name),
			'slug'=>$db->clearText($slug),
			'plus'=>$db->clearText($plus),
			'menu'=>$menu+0,
			'is_active'=>$is_active+0,
			'hot'=>$hot+0,
			'modified_time'=>time(),
			'user_id'=>$_SESSION["user_id"]
		);
		$db->condition = "others_menu_id = ".$others_menu_id;
		$db->update($data);
		loadPageSucces("Đã chỉnh sửa Mục thành công.","?".TTH_PATH."=others_manager");
		$OK = true;
	}
}
else {
	$db->table = "others_menu";
	$db->condition = "others_menu_id = ".$others_menu_id;
	$rows = $db->select();
	foreach($rows as $row) {
		$category_id    = $row['category_id']+0;
		$name			= $row['name'];
		$slug			= $row['slug'];
		$plus			= $row['plus'];
		$menu   		= $row['menu']+0;
		$parent			= $row['parent'];
		$is_active		= $row['is_active']+0;
		$hot			= $row['hot']+0;
	}
}
if(!$OK) othersMenu("?".TTH_PATH."=others_menu_edit", "edit", $others_menu_id, $category_id, $name, $slug, $plus, $menu, $parent, $is_active, $hot, $error);
?>
