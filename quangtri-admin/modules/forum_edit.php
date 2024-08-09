<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$forum_id = isset($_GET['id']) ? $_GET['id']+0 : $forum_id+0;
$user = 0;
$db->table = "forum";
$db->condition = "forum_id = ".$forum_id;
$db->order = "";
$rows = $db->select();
foreach($rows as $row) {
	$menu_id    = $row['forum_menu_id'];
    $user       = intval($row['user_id']);
}
if($db->RowCount==0) loadPageAdmin("Bài viết không tồn tại.","?".TTH_PATH."=forum_manager");
// ---------------
$db->table = "forum_menu";
$db->condition = "`forum_menu_id` = $menu_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
    $category = $row['category_id'];
    if(!in_array("active;".$category, $corePrivilegeSlug)) {
        if(intval($_SESSION["user_id"])!=$user) loadPageAdmin("Bạn không được phân quyền chỉnh sửa nội dung này.","?".TTH_PATH."=forum_list&id=" . $menu_id);
    }
}
?>
<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_manager"><i class="fa fa-cubes"></i> Diễn đàn</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_list&id=<?php echo $menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenu($menu_id, 'forum')?></a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa đề tài
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "forum.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();

$OK = false;
$error = '';
if($typeFunc=='edit'){
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tiêu đề bài viết.</span>';
	else {
		$db->table = "forum";
		$data = array(
			'forum_menu_id'=>$forum_menu_id+0,
			'name'=>$db->clearText($name),
			'title'=>$db->clearText($title),
			'description'=>$db->clearText($description),
			'keywords'=>$db->clearText($keywords),
			'content'=>$db->clearText($content),
			'is_active'=>$is_active+0,
			'hot'=>$hot+0,
			'modified_time'=>time(),
			'modified_user'=>$_SESSION["user_id"]
		);
		$db->condition = "forum_id = ".$forum_id;
		$db->update($data);

		loadPageSucces("Đã chỉnh sửa đề tài thành công.","?".TTH_PATH."=forum_list&id=".$forum_menu_id);
		$OK = true;
	}
}
else {
	$db->table = "forum";
	$db->condition = "forum_id = ".$forum_id;
	$rows = $db->select();
	foreach($rows as $row) {
		$forum_menu_id    = $row['forum_menu_id']+0;
		$name			    = $row['name'];
		$title			    = $row['title'];
		$description	    = $row['description'];
		$keywords		    = $row['keywords'];
		$content            = $row['content'];
		$is_active		    = $row['is_active']+0;
		$hot			    = $row['hot']+0;
	}
}
if(!$OK) forum("?".TTH_PATH."=forum_edit", "edit", $forum_id, $forum_menu_id,  $name, $title, $description, $keywords, $content, $is_active, $hot, $error);