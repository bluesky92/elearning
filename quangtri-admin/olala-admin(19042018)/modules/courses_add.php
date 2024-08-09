<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$category_id = 0;
$product_id =  isset($_GET['id']) ? $_GET['id']+0 : $product_id;
$product_name = '';
$product_menu_id = 0;
$db->table = "product";
$db->condition = "`product_id` = $product_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row){
	$product_menu_id = $row['product_menu_id'];
	$product_name = stripslashes($row['name']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.", "?" . TTH_PATH . "=product_manager");
$db->table = "product_menu";
$db->condition = "product_menu_id = ".$product_menu_id;
$db->order = "";
$db->limit = 1;
$rows = $db->select();
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
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-bookmark"></i> Khóa học</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_list&id=<?php echo $product_menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenu($product_menu_id, 'product')?></a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=courses_list&id=<?php echo $product_id?>"><i class="fa fa-list"></i> <?php echo $product_name;?></a>
		</li>
		<li>
			<i class="fa fa-plus-square-o"></i> Thêm bài giảng
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "courses.php");
if(empty($typeFunc)) $typeFunc = "no";
$OK         = false;
$error      = '';
if($typeFunc=='add'){
	$info_user = getInfoUser($_SESSION["user_id"]);
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tiêu đề.</span>';
	else {
		require_once(_F_CLASSES . DS . 'getid3' . DS . 'getid3.php');
		ini_set('max_execution_time', MAX_EXECUTION_TIME);
		$stringObj              = new String();
		$file_max_size          = FILE_MAX_SIZE;
		$dir_dest               = ROOT_DIR . DS . 'uploads' . DS . 'courses' . DS;
		$s_folder               = $info_user[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
		//---
		$file_name_video        = 'Video_' . substr($stringObj->getSlug($name), 0, 100);
		$file_size_video        = $_FILES['video']['size'];
		$file_time_video        = '';
		//---
		if($document_title!='') $file_name_document = 'Document_' . substr($stringObj->getSlug($document_title), 0, 100);
		else $file_name_document = 'Document_' . substr($stringObj->getSlug($name), 0, 100);
		$file_size_document     = $_FILES['document']['size'];

		$OK = true;
		if($OK) {
			if ($file_size_video > 0) {
				$videoUp = new Upload($_FILES['video']);
				$videoUp->file_max_size = $file_max_size;
				if($videoUp->uploaded) {
					$videoUp->file_new_name_body = $file_name_video;
					$videoUp->Process($dir_dest . $s_folder);
					$file_name_video    = $videoUp->file_dst_name;
					$getID3             = new getID3;
					$ThisFileInfo       = $getID3->analyze($dir_dest . $s_folder . $file_name_video);
					$file_time_video    = $ThisFileInfo['playtime_string'];
					$OK                 = true;
				} else {
					$error = '<span class="show-error">Video: '.$videoUp->error.'</span>';
				}
			} else {
				$OK = true;
				$file_name_video = '-no-';
			}
		}
		if($OK) {
			if ($file_size_document > 0) {
				$documentUp = new Upload($_FILES['document']);
				$documentUp->file_max_size = $file_max_size;
				if($documentUp->uploaded) {
					$documentUp->file_new_name_body = $file_name_document;
					$documentUp->Process($dir_dest . $s_folder);
					$file_name_document = $documentUp->file_dst_name;
					$OK                 = true;
				} else {
					$error = '<span class="show-error">Tài liệu: '.$documentUp->error.'</span>';
				}
			} else {
				$OK = true;
				$file_name_document = '-no-';
			}
		}

		if($OK) {
            $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;

			$db->table = "courses";
			$data = array(
				'product_id'=>$product_id+0,
				'name'=>$db->clearText($name),
				'v_folder'=>$db->clearText($s_folder),
				'video'=>$db->clearText($file_name_video),
				'video_playtime'=>$db->clearText($file_time_video),
				'video_size'=>$file_size_video,
				'd_folder'=>$db->clearText($s_folder),
				'document'=>$db->clearText($file_name_document),
				'document_title'=>$db->clearText($document_title),
				'document_size'=>$file_size_document,
				'content'=>$db->clearText($content),
				'test'=>$test+0,
				'practice'=>$db->clearText($practice),
				'sort'=>sortAcs($product_id)+1,
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'created_time'=>time(),
				'modified_time'=>time(),
				'user_id'=>$_SESSION["user_id"]
			);
			$db->insert($data);
            $id_query = $db->LastInsertID;
            if($is_active==0) {
                // Ghi thông báo.
                insertNotify(15, 'active/courses', $id_query, $_SESSION["user_id"], $category_id);
            }

			loadPageSucces("Đã thêm dữ liệu thành công.","?".TTH_PATH."=courses_list&id=".$product_id);
		}
	}
}
else {
	$name			    = "";
	$name_video         = "";
	$name_document      = "";
	$document_title     = "";
	$content            = "";
	$test               = 0;
	$practice           = "";
    if(in_array("active;".$category_id, $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
	$hot			    = 0;
}
if(!$OK) courses("?".TTH_PATH."=courses_add", "add", 0, $product_id, $name, $name_video, $name_document, $document_title, $content, $test, $practice, $is_active, $hot, $error);
