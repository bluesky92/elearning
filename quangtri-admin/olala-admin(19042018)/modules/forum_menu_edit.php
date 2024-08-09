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
			<i class="fa fa-cog"></i> Chỉnh sửa chuyên mục
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "forum_menu.php");
if(empty($typeFunc)) $typeFunc = "no";
$forum_menu_id =  isset($_GET['id']) ? $_GET['id']+0 : $forum_menu_id+0;
$db->table = "forum_menu";
$db->condition = "`forum_menu_id` = " . $forum_menu_id;
$db->order = "";
$db->limit = 1;
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Chuyên mục không tồn tại.","?".TTH_PATH."=forum_manager");

$OK = false;
$error = '';
if($typeFunc=='edit'){
	$info_user  = getInfoUser($_SESSION["user_id"]);
	$stringObj  = new String();
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên chuyên mục.</span>';
	else {
		$handleUploadImg    = false;
		$file_max_size      = FILE_MAX_SIZE;
		$dir_dest           = ROOT_DIR . DS . 'uploads' . DS . 'forum_menu' . DS;
		$s_folder           = $info_user[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
		$file_size          = $_FILES['img']['size'];

		$ds_folder = $e_folder = '';
		$db->table = "forum_menu";
		$db->condition = "`forum_menu_id` = $forum_menu_id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		foreach($rows as $row) {
			$e_folder = $row['folder'];
			$ds_folder = $row['folder'];
		}

		if($file_size>0) {
			$imgUp = new Upload($_FILES['img']);
			$imgUp->file_max_size = $file_max_size;
			if ($imgUp->uploaded) {
				$handleUploadImg = true;
				$e_folder = $s_folder;
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
			$stringObj = new String();

			$slug = (empty($slug)) ? $name : $slug;
			$slug = $stringObj->getSlug($slug);
			$db->table = "forum_menu";
			$db->condition = "slug = '".$slug."'";
			$rows = $db->select();
			$id = 0;
			foreach ($rows as $row) {
				$id = $row['forum_menu_id'];
			}
			if($db->RowCount > 0 && $id != $forum_menu_id) {
				$slug = $slug. '-' .$stringObj->getSlug(getRandomString(10));
			}
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "forum_menu";
                $db->condition = "`forum_menu_id` = $forum_menu_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

			$id_query = 0;
			$db->table = "forum_menu";
			$data = array(
				'name'=>$db->clearText($name),
				'slug'=>$db->clearText($slug),
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'comment'=>$db->clearText($comment),
				'folder'=>$db->clearText($e_folder),
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`forum_menu_id` = $forum_menu_id";
			$db->update($data);
			$id_query = $forum_menu_id;

			if($handleUploadImg) {
				$stringObj = new String();

				if(glob($dir_dest . $ds_folder .'*'.$img)) array_map("unlink", glob($dir_dest . $ds_folder .'*'.$img));

				$img_name_file = substr($stringObj->getSlug($name), 0, 100) . '-' . $id_query;
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
					$db->condition = "forum_menu_id = ".$id_query;
					$db->update($data);
				}
                else {
                    loadPageAdmin("Lỗi tải hình: ".$imgUp->error,"?".TTH_PATH."=forum_manager");
                }

				$imgUp->file_new_name_body      = 'av-' . $img_name_file;
				$imgUp->image_resize            = true;
				$imgUp->image_ratio_fill        = true;
				$imgUp->image_x                 = 100;
				$imgUp->image_y                 = 100;
				$imgUp->Process($dir_dest . $s_folder);

				$imgUp-> Clean();
			}

			loadPageSucces("Đã chỉnh sửa chuyên mục thành công.","?".TTH_PATH."=forum_manager");
			$OK = true;
		}
	}
}
else {
	$db->table = "forum_menu";
	$db->condition = "forum_menu_id = ".$forum_menu_id;
    $db->order = "";
    $db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$category_id        = $row['category_id']+0;
		$name			    = $row['name'];
		$slug			    = $row['slug'];
		$title			    = $row['title'];
		$description	    = $row['description'];
		$keywords		    = $row['keywords'];
		$parent			    = $row['parent'];
		$is_active		    = $row['is_active']+0;
		$hot			    = $row['hot']+0;
		$folder             = $row['folder'];
		$img                = $row['img'];
		$comment            = $row['comment'];
	}
}
if(!$OK) forumMenu("?".TTH_PATH."=forum_menu_edit", "edit", $forum_menu_id, $category_id, $name, $slug, $title, $description, $keywords, $parent, $is_active, $hot, $folder, $img, $comment, $error);
