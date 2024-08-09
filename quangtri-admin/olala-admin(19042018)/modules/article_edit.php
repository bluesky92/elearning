<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$article_id = isset($_GET['id']) ? intval($_GET['id']) : intval($article_id);
$user = 0;
$db->table = "article";
$db->condition = "article_id = ".$article_id;
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
	$menu_id    = intval($row['article_menu_id']);
    $user       = intval($row['user_id']);
}
if($db->RowCount==0) loadPageAdmin("Bài viết không tồn tại.","?".TTH_PATH."=article_manager");

// ---------------
$db->table = "article_menu";
$db->condition = "`article_menu_id` = $menu_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
    $category = $row['category_id'];
    if(!in_array("active;".$category, $corePrivilegeSlug)) {
        if(intval($_SESSION["user_id"])!=$user) loadPageAdmin("Bạn không được phân quyền chỉnh sửa nội dung này.","?".TTH_PATH."=article_list&id=" . $menu_id);
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
			<a href="?<?php echo TTH_PATH?>=article_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=article_manager"><i class="fa fa-newspaper-o"></i> Bài viết</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=article_list&id=<?php echo $menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenuArt($menu_id)?></a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa bài viết
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "article.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();

$OK = false;
$error = '';
if($typeFunc=='edit'){
	$comment    = (isset($_POST['comment'])) ? $_POST['comment'] : '';
	$content    = (isset($_POST['content'])) ? $_POST['content'] : '';
	$info_user  = getInfoUser($_SESSION["user_id"]);
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tiêu đề bài viết.</span>';
	else {
		$handleUploadImg    = false;
		$file_max_size      = FILE_MAX_SIZE;
		$dir_dest           = ROOT_DIR . DS . 'uploads' . DS . 'article' . DS;
		$s_folder           = $info_user[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
		$file_size          = $_FILES['img']['size'];

		$e_folder = $ds_folder = '';
		$db->table = "article";
		$db->condition = "`article_id` = $article_id";
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
                $OK = false;
			}
		}
		else {
			$handleUploadImg = false;
			$OK = true;
		}

		if(isset($del_img)) {
			$handleUploadImg = false;
			if(glob($dir_dest . $ds_folder . DS .'*'.$img)) array_map("unlink", glob($dir_dest . $ds_folder . DS .'*'.$img));
			$db->table = "article";
			$data = array(
				'img'=>'-no-'
			);
			$db->condition = "`article_id` = $article_id";
			$db->update($data);
		}

		if($OK) {
			$address =  isset($_POST['address']) ? $_POST['address'] : '';
			$price =  isset($_POST['price']) ? $_POST['price'] : 0;
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "article";
                $db->condition = "`article_id` = $article_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

			$id_query = 0;
			$db->table = "article";
			$data = array(
				'article_menu_id'=>$article_menu_id+0,
				'name'=>$db->clearText($name),
				'title'=>$db->clearText($title),
				'description'=>$db->clearText($description),
				'keywords'=>$db->clearText($keywords),
				'folder'=>$db->clearText($e_folder),
				'img_note'=>$db->clearText($img_note),
				'address'=>$db->clearText($address),
				'price'=>formatNumberToInt($price),
				'comment'=>$db->clearText($comment),
				'content'=>$db->clearText($content),
				'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'created_time'=>strtotime($date->dmYtoYmd($created_time)),
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`article_id` = $article_id";
			$db->update($data);
			$id_query = $article_id;

			if($handleUploadImg) {
				$stringObj = new String();
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
					$db->table = "article";
					$data = array(
						'img'=>$db->clearText($name_img)
					);
					$db->condition = "`article_id` = $id_query";
					$db->update($data);
				}
                else {
                    loadPageAdmin("Lỗi tải hình: ".$imgUp->error,"?".TTH_PATH."=article_list&id=".$article_menu_id);
                }

				$imgUp->file_new_name_body    = 'post-'. $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 320;
				$imgUp->image_y               = 180;
				$imgUp->Process($dir_dest . $s_folder);

				$imgUp->file_new_name_body    = 'trainers-'. $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 320;
				$imgUp->image_y               = 320;
				$imgUp->Process($dir_dest . $s_folder);

				$imgUp->file_new_name_body    = 'thm-'. $name_image;
				$imgUp->image_resize          = true;
				$imgUp->image_ratio_fill      = true;
				$imgUp->image_x               = 80;
				$imgUp->image_y               = 80;
				$imgUp->Process($dir_dest . $s_folder);

				$imgUp-> Clean();
			}

			loadPageSucces("Đã chỉnh sửa Bài viết thành công.","?".TTH_PATH."=article_list&id=".$article_menu_id);
			$OK = true;
		}
	}
}
else {
	$db->table = "article";
	$db->condition = "`article_id` = $article_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$article_menu_id    = $row['article_menu_id']+0;
		$name			    = $row['name'];
		$title			    = $row['title'];
		$description	    = $row['description'];
		$keywords		    = $row['keywords'];
		$folder             = $row['folder'];
		$img                = $row['img'];
		$img_note           = $row['img_note'];
		$address            = $row['address'];
		$price              = $row['price'];
		$upload_img_id      = $row['upload_id']+0;
		$comment            = $row['comment'];
		$content            = $row['content'];
		$is_active		    = $row['is_active']+0;
		$hot			    = $row['hot']+0;
		$created_time       = $date->vnDateTime($row['created_time']);
	}
}
if(!$OK) article("?".TTH_PATH."=article_edit", "edit", $article_id, $article_menu_id, $name, $title, $description, $keywords, $folder, $img, $img_note, $address, $price, $comment, $content, $is_active, $hot, $created_time, $upload_img_id, $error);