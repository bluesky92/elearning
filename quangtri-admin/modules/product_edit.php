<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$product_id = isset($_GET['id']) ? $_GET['id']+0 : $product_id+0;
$user = 0;
$db->table = "product";
$db->condition = "product_id = ".$product_id;
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
	$menu_id    = $row['product_menu_id'];
    $user       = intval($row['user_id']);
}
if($db->RowCount==0) loadPageAdmin("Dữ liệu không tồn tại.","?".TTH_PATH."=product_manager");
// ---------------
$db->table = "product_menu";
$db->condition = "`product_menu_id` = $menu_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
    $category = $row['category_id'];
    if(!in_array("active;".$category, $corePrivilegeSlug)) {
        if(intval($_SESSION["user_id"])!=$user) loadPageAdmin("Bạn không được phân quyền chỉnh sửa nội dung này.","?".TTH_PATH."=product_list&id=" . $menu_id);
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
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-bookmark"></i> Đào tạo</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_list&id=<?php echo $menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenu($menu_id, 'product')?></a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa khóa học
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "product.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();
$OK = false;
$error = '';
if($typeFunc=='edit'){
	$comment    = (isset($_POST['comment'])) ? $_POST['comment'] : '';
	$content    = (isset($_POST['content'])) ? $_POST['content'] : '';
	$info_user  = getInfoUser($_SESSION["user_id"]);
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tiêu đề.</span>';
	else {
		$handleUploadImg    = false;
		$file_max_size      = FILE_MAX_SIZE;
		$dir_dest           = ROOT_DIR . DS . 'uploads' . DS . 'product' . DS;
		$s_folder           = $info_user[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
		$file_size          = $_FILES['img']['size'];

		$ds_folder = $e_folder = '';
		$db->table = "product";
		$db->condition = "`product_id` = $product_id";
		$db->order = "";
		$db->limit = "";
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
				$error = '<span class="show-error">Hình ảnh: '.$imgUp->error.'</span>';
			}
		}
		else {
			$handleUploadImg = false;
			$OK = true;
		}

		if($OK) {
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "product";
                $db->condition = "`product_id` = $product_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

            $id_query = 0;
			$db->table = "product";
			$data = array(
				'product_menu_id'=>$product_menu_id+0,
				'name'=>$db->clearText($name),
				'folder'=>$db->clearText($e_folder),
				'img_note'=>$db->clearText($img_note),
				'comment'=>$db->clearText($comment),
				'content'=>$db->clearText($content),
				'trainers'=>$trainers+0,
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
				'created_time'=>strtotime($date->dmYtoYmd($created_time)),
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`product_id` = $product_id";
			$db->update($data);

			if($handleUploadImg) {
				$stringObj = new StringClass();
				if(glob($dir_dest . $ds_folder . '*' . $img)) array_map("unlink", glob($dir_dest . $ds_folder . '*' . $img));

				$name_image = substr($stringObj->getSlug($name), 0, 100) . '-' . $product_id;
				$imgUp->file_new_name_body      = $name_image;
				$imgUp->image_resize            = true;
				$imgUp->image_ratio_fill        = true;
				$imgUp->image_x                 = 490;
				$imgUp->image_y                 = 256;
				$imgUp->Process($dir_dest . $s_folder);

				if($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "product";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "`product_id` = $product_id";
					$db->update($data);
				}

				$imgUp->file_new_name_body    = 'course-' . $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 320;
				$imgUp->image_y               = 180;
				$imgUp->Process($dir_dest . $s_folder);
				$imgUp->Clean();
			}

			loadPageSucces("Đã chỉnh sửa dữ liệu thành công.","?".TTH_PATH."=product_list&id=".$product_menu_id);
			$OK = true;
		}
	}
}
else {
	$db->table = "product";
	$db->condition = "`product_id` = $product_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$product_menu_id    = $row['product_menu_id']+0;
		$name			    = $row['name'];
		$folder             = $row['folder'];
		$img                = $row['img'];
		$img_note           = $row['img_note'];
		$comment            = $row['comment'];
		$content            = $row['content'];
		$trainers		    = $row['trainers']+0;
		$is_active		    = $row['is_active']+0;
		$hot			    = $row['hot']+0;
		$title			    = $row['title'];
		$description	    = $row['description'];
		$keywords		    = $row['keywords'];
		$created_time       = $date->vnDateTime($row['created_time']);
	}
}
if(!$OK) product("?".TTH_PATH."=product_edit", "edit", $product_id, $product_menu_id, $name, $folder, $img, $img_note, $comment, $content, $trainers, $is_active, $hot, $created_time, $title, $description, $keywords, $error);