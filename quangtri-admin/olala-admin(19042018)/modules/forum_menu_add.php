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
			<a href="?<?php echo TTH_PATH?>=forum_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_manager"><i class="fa fa-cubes"></i> Diễn đàn</a>
		</li>
		<li>
			<i class="fa fa-plus-square-o"></i> Thêm chuyên mục
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "forum_menu.php");
if(empty($typeFunc)) $typeFunc = "no";
$category_id =  isset($_GET['id_cat']) ? $_GET['id_cat']+0 : $category_id+0;
$db->table = "category";
$db->condition = "category_id = ".$category_id;
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Chuyên mục không tồn tại.","?".TH_PATH."=forum_manager");
$forum_menu_id = isset($_GET['id_art']) ? $_GET['id_art']+0 : 0;
$db->table = "forum_menu";
$db->condition = "forum_menu_id = ".$forum_menu_id;
$rows = $db->select();
if($db->RowCount==0 && $forum_menu_id!=0) loadPageAdmin("Chuyên mục không tồn tại.","?".TH_PATH."=forum_manager");

$OK = false;
$error = '';
if($typeFunc=='add'){
	$info_user  = getInfoUser($_SESSION["user_id"]);
	$stringObj  = new String();
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên chuyên mục.</span>';
	else {
		$handleUploadImg    = false;
		$file_max_size      = FILE_MAX_SIZE;
		$dir_dest           = ROOT_DIR . DS . 'uploads' . DS . 'forum_menu' . DS;
		$s_folder           = $info_user[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
		$file_size          = $_FILES['img']['size'];

		if($file_size>0) {
			$imgUp = new Upload($_FILES['img']);

			$imgUp->file_max_size = $file_max_size;
			if ($imgUp->uploaded) {
				$handleUploadImg = true;
				$OK = true;
			}
			else {
				$error = '<span class="show-error">Lỗi tải hình: '.$imgUp->error.'</span>';
			}
		}
		else {
			$handleUploadImg = false;
			$OK = true;
		}

		if($OK) {
			$slug = (empty($slug)) ? $name : $slug;
			$slug = $stringObj->getSlug($slug);
			$db->table = "forum_menu";
			$db->condition = "slug = '".$slug."'";
			$db->select();
			if($db->RowCount > 0) {
				$slug = $slug. '-' .$stringObj->getSlug(getRandomString(10));
			}
            $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;

			$id_query = 0;
			$db->table = "forum_menu";
			$data = array(
				'category_id'=>$category_id+0,
				'name'=>$db->clearText($name),
				'slug'=>$db->clearText($slug),
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
				'parent'=>$parent+0,
				'sort'=>sortAcs($category_id,$parent)+1,
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'folder'=>$db->clearText($s_folder),
				'comment'=>$db->clearText($comment),
				'created_time'=>time(),
				'modified_time'=>time(),
				'user_id'=>$_SESSION["user_id"]
			);
			$db->insert($data);
			$id_query = $db->LastInsertID;
            if($is_active==0) {
                // Ghi thông báo.
                insertNotify(15, 'active/forum_menu', $id_query, $_SESSION["user_id"], $category_id);
            }

			if($handleUploadImg) {
				$stringObj = new String();

				$img_name_file = substr($stringObj->getSlug($name), 0, 100). '-' . $id_query;
				$imgUp->file_new_name_body      = $img_name_file;
				$imgUp->image_resize            = true;
				$imgUp->image_ratio_fill        = true;
				$imgUp->image_x                 = 490;
				$imgUp->image_y                 = 256;
				$imgUp->Process($dir_dest . $s_folder);

				if($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "forum_menu";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "`forum_menu_id` = $id_query";
					$db->update($data);
				}
                else {
                    loadPageAdmin("Lỗi tải hình: " . $imgUp->error, "?" . TTH_PATH . "=forum_manager");
                }

				$imgUp->file_new_name_body      = 'av-' . $img_name_file;
				$imgUp->image_resize            = true;
				$imgUp->image_ratio_fill        = true;
				$imgUp->image_x                 = 100;
				$imgUp->image_y                 = 100;
				$imgUp->Process($dir_dest . $s_folder);

				$imgUp-> Clean();
			}

			loadPageSucces("Đã thêm chuyên mục thành công.","?" . TTH_PATH . "=forum_manager");
			$OK = true;
		}
	}
}
else {
	$name			    = "";
	$slug               = "";
	$title			    = "";
	$description	    = "";
	$keywords		    = "";
	$parent			    = isset($_GET['id_art']) ? $_GET['id_art']+0 : 0;
    $parent			= isset($_GET['id_pro']) ? $_GET['id_pro']+0 : 0;
    if(in_array("active;".$category_id, $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
	$hot			    = 0;
	$folder             = "";
	$img                = "";
	$comment            = "";
}
if(!$OK) forumMenu("?".TTH_PATH."=forum_menu_add", "add", 0, $category_id, $name, $slug, $title, $description, $keywords, $parent, $is_active, $hot, $folder, $img, $comment, $error);
