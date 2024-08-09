<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$category_id = 0;
$product_menu_id = isset($_GET['id']) ? $_GET['id']+0 : $product_menu_id+0;
$db->table = "product_menu";
$db->condition = "product_menu_id = ".$product_menu_id;
$db->order = "";
$db->limit = 1;
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.","?".TTH_PATH."=product_manager");
foreach($rows as $row) {
    $category_id = $row['category_id'];
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
			<a href="?<?php echo TTH_PATH?>=product_list&id=<?php echo $product_menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenu($product_menu_id, 'product')?></a>
		</li>
		<li>
			<i class="fa fa-plus-square-o"></i> Thêm khóa học
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
if($typeFunc=='add'){
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

		if($file_size>0) {
			$imgUp = new Upload($_FILES['img']);

			$imgUp->file_max_size = $file_max_size;
			if ($imgUp->uploaded) {
				$handleUploadImg = true;
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
            $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;

			$id_query = 0;
			$db->table = "product";
			$data = array(
				'product_menu_id'=>$product_menu_id+0,
				'name'=>$db->clearText($name),
				'folder'=>$db->clearText($s_folder),
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
				'user_id'=>$_SESSION["user_id"]
			);
			$db->insert($data);
			$id_query = $db->LastInsertID;
            if($is_active==0) {
                // Ghi thông báo.
                insertNotify(15, 'active/product', $id_query, $_SESSION["user_id"], $category_id);
            }

			if($handleUploadImg) {
				$stringObj = new String();
				$name_image = substr($stringObj->getSlug($name), 0, 100) . '-' . $id_query;
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
					$db->condition = "`product_id` = $id_query";
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

			loadPageSucces("Đã thêm dữ liệu thành công.","?".TTH_PATH."=product_list&id=".$product_menu_id);
			$OK = true;
		}
	}
}
else {
	$name			    = "";
	$folder             = "";
	$img                = "";
	$img_note           = "";
	$comment            = "";
	$content            = "";
	$trainers           = 0;
    if(in_array("active;".$category_id, $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
	$hot			    = 0;
	$title			    = "";
	$description	    = "";
	$keywords		    = "";
	$created_time       = $date->vnDateTime(time());
}
if(!$OK) product("?".TTH_PATH."=product_add", "add", 0, $product_menu_id, $name, $folder, $img, $img_note, $comment, $content, $trainers, $is_active, $hot, $created_time, $title, $description, $keywords, $error);