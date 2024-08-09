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
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-bookmark"></i> Đào tạo</a>
		</li>
		<li>
			<i class="fa fa-plus-square-o"></i> Thêm mục
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "product_menu.php");
if(empty($typeFunc)) $typeFunc = "no";
$category_id =  isset($_GET['id_cat']) ? $_GET['id_cat']+0 : $category_id+0;
$db->table = "category";
$db->condition = "category_id = ".$category_id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.","?".TTH_PATH."=product_manager");
$product_menu_id = isset($_GET['id_pro']) ? $_GET['id_pro']+0 : 0;
$db->table = "product_menu";
$db->condition = "product_menu_id = ".$product_menu_id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount==0 && $product_menu_id!=0) loadPageAdmin("Mục không tồn tại.","?".TTH_PATH."=product_manager");

$OK = false;
$error = '';
if($typeFunc=='add'){
	$plus       = isset($_POST['plus']) ? $_POST['plus'] : '';
	$info_user  = getInfoUser($_SESSION["user_id"]);
	$stringObj  = new String();
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên mục.</span>';
	else {
		$handleUploadImg    = false;
		$file_max_size      = FILE_MAX_SIZE;
		$dir_dest           = ROOT_DIR . DS . 'uploads' . DS . 'product_menu' . DS;
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
			$db->table = "product_menu";
			$db->condition = "`slug` = '".$slug."'";
			$db->select();
			if($db->RowCount > 0) {
				$slug = $slug. '-' .$stringObj->getSlug(getRandomString(10));
			}
            $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;

			$id_query = 0;
			$db->table = "product_menu";
			$data = array(
				'category_id'=>$category_id+0,
				'name'=>$db->clearText($name),
				'slug'=>$db->clearText($slug),
				'plus'=>$db->clearText($plus),
				'icon'=>$db->clearText($font_icon),
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
				'parent'=>$parent+0,
				'sort'=>sortAcs($category_id,$parent)+1,
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'folder'=>$db->clearText($s_folder),
				'created_time'=>time(),
				'modified_time'=>time(),
				'user_id'=>$_SESSION["user_id"]
			);
			$db->insert($data);
			$id_query = $db->LastInsertID;
            if($is_active==0) {
                // Ghi thông báo.
                insertNotify(15, 'active/product_menu', $id_query, $_SESSION["user_id"], $category_id);
            }


			if($handleUploadImg) {
				$name_image = substr($stringObj->getSlug($name), 0, 100) . '-' . $id_query;
				$imgUp->file_new_name_body    = $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 490;
				$imgUp->image_y               = 256;
				$imgUp->Process($dir_dest . $s_folder);
				if($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "product_menu";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "`product_menu_id` = $id_query";
					$db->update($data);
				}
                else {
                    loadPageAdmin("Lỗi tải hình: ".$imgUp->error,"?".TTH_PATH."=product_manager");
                }
				$imgUp->file_new_name_body    = 'courses-' . $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 320;
				$imgUp->image_y               = 180;
				$imgUp->Process($dir_dest . $s_folder);
				$imgUp->Clean();
			}

			loadPageSucces("Đã thêm Mục thành công.","?".TTH_PATH."=product_manager");
			$OK = true;
		}
	}
}
else {
	$name			= "";
	$slug           = "";
	$plus           = "";
	$font_icon      = "";
	$title			= "";
	$description	= "";
	$keywords		= "";
	$parent			= isset($_GET['id_pro']) ? $_GET['id_pro']+0 : 0;
    if(in_array("active;".$category_id, $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
	$hot			= 0;
	$folder         = "";
	$img            = "";
}
if(!$OK) productMenu("?".TTH_PATH."=product_menu_add", "add", 0, $category_id, $name, $slug, $plus, $font_icon, $title, $description, $keywords, $parent, $is_active, $hot, $folder, $img, $error);
