<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$gallery_id = isset($_GET['id']) ? $_GET['id']+0 : $gallery_id+0;
$user = 0;
$db->table = "gallery";
$db->condition = "gallery_id = ".$gallery_id;
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
	$menu_id    = $row['gallery_menu_id']+0;
    $user       = intval($row['user_id']);
}
if($db->RowCount==0) loadPageAdmin("Hình ảnh không tồn tại.","?".TTH_PATH."=gallery_manager");
// ---------------
$db->table = "gallery_menu";
$db->condition = "gallery_menu_id = ".$menu_id;
$rows = $db->select();
$category_id = 0;
foreach($rows as $row) {
	$category_id =	$row["category_id"]+0;
    if(!in_array("active;".$category_id, $corePrivilegeSlug)) {
        if(intval($_SESSION["user_id"])!=$user) loadPageAdmin("Bạn không được phân quyền chỉnh sửa nội dung này.","?".TTH_PATH."=gallery_list&id=" . $menu_id);
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
			<a href="?<?php echo TTH_PATH?>=gallery_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=gallery_manager"><i class="fa fa-image"></i> Hình ảnh</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=gallery_list&id=<?php echo $menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenuGal($menu_id)?></a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa hình ảnh
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "gallery.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();

$OK = false;
$error = '';
if($typeFunc=='edit'){
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên hình.</span>';
	else {
		$handleUploadImg = false;
		$file_max_size = FILE_MAX_SIZE;
		$dir_dest = ROOT_DIR . DS .'uploads' . DS . "gallery";
		$file_size = $_FILES['img']['size'];

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
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "gallery";
                $db->condition = "`gallery_id` = $article_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

			$id_query = 0;
			$db->table = "gallery";
			$data = array(
				'gallery_menu_id'=>$gallery_menu_id+0,
				'name'=>$db->clearText($name),
				'comment'=>$db->clearText($comment),
				'link'=>$db->clearText($link),
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'created_time'=>strtotime($date->dmYtoYmd($created_time)),
				'modified_time'=>time(),
				'user_id'=>$_SESSION["user_id"]
			);
			$db->condition = "gallery_id = ".$gallery_id;
			$db->update($data);
			$id_query = $gallery_id;

			if($handleUploadImg) {
				$stringObj = new String();

				if(glob($dir_dest . DS . 'gallery' . DS . '*'.$img)) array_map("unlink", glob($dir_dest . DS . 'gallery' . DS . '*'.$img));

				$name_image = getRandomString().'-'.$id_query.'-'.substr($stringObj->getSlug($name),0,120);
				if($category_id==91) {
					$imgUp->file_new_name_body    = $name_image;
					$imgUp->image_resize          = true;
					$imgUp->image_ratio_crop      = true;
					$imgUp->image_x               = 1740;
					$imgUp->image_y               = 955;
					$imgUp->Process($dir_dest);
				} else {
					$imgUp->file_new_name_body    = $name_image;
					$imgUp->image_resize          = true;
					$imgUp->image_ratio_crop      = true;
					$imgUp->image_x               = 480;
					$imgUp->image_y               = 360;
					$imgUp->Process($dir_dest);
				}

				if($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "gallery";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "gallery_id = ".$id_query;
					$db->update($data);
				}
                else {
                    loadPageAdmin("Lỗi tải hình: ".$imgUp->error,"?".TTH_PATH."=gallery_list&id=".$gallery_menu_id);
                }

				$imgUp-> Clean();
			}

			loadPageSucces("Đã chỉnh sửa Hình ảnh thành công.","?".TTH_PATH."=gallery_list&id=".$gallery_menu_id);
			$OK = true;
		}
	}
}
else {
	$db->table = "gallery";
	$db->condition = "gallery_id = ".$gallery_id;
    $db->order = "";
    $db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$gallery_menu_id    = $row['gallery_menu_id']+0;
		$name			    = $row['name'];
		$img                = $row['img'];
		$upload_img_id      = $row['upload_id'];
		$comment            = $row['comment'];
		$content            = $row['content'];
		$link               = $row['link'];
		$is_active		    = $row['is_active']+0;
		$hot			    = $row['hot']+0;
		$created_time       = $date->vnDateTime($row['created_time']);
	}
}
if(!$OK) gallery("?".TTH_PATH."=gallery_edit", "edit", $gallery_id, $gallery_menu_id, $name, $img, $comment, $content, $link, $is_active, $hot, $created_time, $upload_img_id, $error);
?>