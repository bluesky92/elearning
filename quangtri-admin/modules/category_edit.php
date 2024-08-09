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
			<i class="fa fa-edit"></i> Quản lý nội dung
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa thể loại
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "category.php");
if(empty($typeFunc)) $typeFunc = "no";
$category_id =  isset($_GET['id_cat']) ? $_GET['id_cat']+0 : $category_id+0;
$db->table = "category";
$db->condition = "category_id = ".$category_id;
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Thể loại không tồn tại.", ADMIN_DIR);

$OK = false;
$error = '';
if($typeFunc=='edit'){
	$info_user  = getInfoUser($_SESSION["user_id"]);
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên chuyên mục.</span>';
	else {
		$handleUploadImg    = false;
		$file_max_size      = FILE_MAX_SIZE;
		$dir_dest           = ROOT_DIR . DS . 'uploads' . DS . 'category' . DS;
		$s_folder           = $info_user[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
		$file_size          = $_FILES['img']['size'];

		$e_folder = $ds_folder = '';
		$db->table = "category";
		$db->condition = "`category_id` = $category_id";
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
		    if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "category";
                $db->condition = "`category_id` = $category_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

			$id_query = 0;
			$db->table = "category";
			$data = array(
				'name'=>$db->clearText($name),
				'slug'=>$db->clearText($slug),
				'plus'=>$db->clearText($txt_plus),
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
				'icon'=>$db->clearText($font_icon),
				'comment'=>$db->clearText($comment),
				'menu_main'=>$menu_main+0,
				'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'folder'=>$db->clearText($e_folder),
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`category_id` = $category_id";
			$db->update($data);
			$id_query = $category_id;

			if($handleUploadImg) {
				$stringObj = new StringClass();
				if(glob($dir_dest . $ds_folder . '*' . $img)) array_map("unlink", glob($dir_dest . $ds_folder . '*' . $img));

				$name_image = substr($stringObj->getSlug($name), 0, 100) . '-' . $id_query;
				$imgUp->file_new_name_body    = $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 490;
				$imgUp->image_y               = 256;
				$imgUp->Process($dir_dest . $s_folder);
				if($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "category";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "`category_id` = $category_id";
					$db->update($data);
				}
				else {
					loadPageAdmin("Lỗi tải hình: ".$imgUp->error, "?".TTH_PATH."=".getSlugCat($type_id));
				}
				$imgUp->Clean();
			}

			loadPageSucces("Đã chỉnh sửa Thể loại thành công.", "?".TTH_PATH."=".getSlugCat($type_id));
			$OK = true;
		}
	}
}
else {
	$db->table = "category";
	$db->condition = "category_id = ".$category_id;
    $db->order = "";
    $db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$name			= $row['name'];
		$slug           = $row['slug'];
		$txt_plus		= $row['plus'];
		$title			= $row['title'];
		$description	= $row['description'];
		$keywords		= $row['keywords'];
		$comment        = $row['comment'];
		$is_active		= $row['is_active']+0;
		$hot			= $row['hot']+0;
		$folder         = $row['folder'];
		$img            = $row['img'];
		$menu_main      = $row['menu_main']+0;
		$type_id		= $row['type_id'];
		$font_icon		= $row['icon'];
	}
}
if(!$OK) articleCat("?".TTH_PATH."=category_edit", "edit", $category_id, $name, $slug, $txt_plus, $title, $description, $keywords, $comment, $is_active, $hot, $folder, $img, $menu_main, $type_id, $font_icon, $error);
?>
