<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$courses_id = isset($_GET['id']) ? $_GET['id']+0 : $courses_id;
$product = 0;
$db->table = "courses";
$db->condition = "`courses_id` = $courses_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
	$product = $row['product_id'];
}
if($db->RowCount==0) loadPageAdmin("Dữ liệu không tồn tại.","?".TTH_PATH."=product_manager");
$product_name = '';
$product_menu_id = 0;
$db->table = "product";
$db->condition = "`product_id` = $product";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row){
	$product_menu_id = $row['product_menu_id'];
	$product_name = stripslashes($row['name']);
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
			<a href="?<?php echo TTH_PATH?>=courses_list&id=<?php echo $product?>"><i class="fa fa-list"></i> <?php echo $product_name;?></a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa bài giảng
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "courses.php");
if(empty($typeFunc)) $typeFunc = "no";
$OK = false;
$error = '';
if($typeFunc=='edit'){
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

		$v_folder = $d_folder = $old_v_folder = $old_d_folder = $old_time_video = '';
		$old_size_video = $old_size_document = 0;
		$db->table = "courses";
		$db->condition = "`courses_id` = $courses_id";
		$db->order = "";
		$db->limit = "";
		$rows = $db->select();
		foreach($rows as $row) {
			$old_v_folder        = $row['v_folder'];
			$old_d_folder        = $row['d_folder'];
			$old_time_video     = stripslashes($row['video_playtime']);
			$old_size_video		= $row['video_size'];
			$old_size_document	= $row['document_size'];
		}

		$OK = true;
		if($OK) {
			if ($file_size_video > 0) {
				$videoUp = new Upload($_FILES['video']);
				$videoUp->file_max_size = $file_max_size;
				if($videoUp->uploaded) {
					//- Xóa file cũ.
					if(glob($dir_dest . $old_v_folder . $name_video)) array_map("unlink", glob($dir_dest . $old_v_folder . $name_video));
					//---
					$videoUp->file_new_name_body = $file_name_video;
					$videoUp->Process($dir_dest . $s_folder);
					$file_name_video    = $videoUp->file_dst_name;
					$getID3             = new getID3;
					$ThisFileInfo       = $getID3->analyze($dir_dest . $s_folder . $file_name_video);
					$file_time_video    = $ThisFileInfo['playtime_string'];
					$v_folder           = $s_folder;
					$OK                 = true;
				} else {
					$error = '<span class="show-error">Video: '.$videoUp->error.'</span>';
				}
			} else {
				$OK = true;
				$file_name_video = $name_video;
				$file_time_video = $old_time_video;
				$file_size_video = $old_size_video;
				$v_folder        = $old_v_folder;
			}
		}
		if($OK) {
			if ($file_size_document > 0) {
				$documentUp = new Upload($_FILES['document']);
				$documentUp->file_max_size = $file_max_size;
				if($documentUp->uploaded) {
					//- Xóa file cũ.
					if(glob($dir_dest . $old_d_folder . $name_document)) array_map("unlink", glob($dir_dest . $old_d_folder . $name_document));
					//---
					$documentUp->file_new_name_body = $file_name_document;
					$documentUp->Process($dir_dest . $s_folder);
					$file_name_document = $documentUp->file_dst_name;
					$d_folder           = $s_folder;
					$OK                 = true;
				} else {
					$error = '<span class="show-error">Tài liệu: '.$documentUp->error.'</span>';
				}
			} else {
				$OK = true;
				$file_name_document = $name_document;
				$file_size_document = $old_size_document;
				$d_folder           = $old_d_folder;
			}
		}

		if($OK) {
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "courses";
                $db->condition = "`courses_id` = $courses_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

			$id_query = 0;
			$db->table = "courses";
			$data = array(
				'product_id'=>$product_id+0,
				'name'=>$db->clearText($name),
				'v_folder'=>$db->clearText($v_folder),
				'video'=>$db->clearText($file_name_video),
				'video_playtime'=>$db->clearText($file_time_video),
				'video_size'=>$file_size_video,
				'd_folder'=>$db->clearText($d_folder),
				'document'=>$db->clearText($file_name_document),
				'document_title'=>$db->clearText($document_title),
				'document_size'=>$file_size_document,
				'content'=>$db->clearText($content),
				'test'=>$test+0,
				'practice'=>$db->clearText($practice),
                'is_active'=>intval($is_active),
				'hot'=>$hot+0,
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`courses_id` = $courses_id";
			$db->update($data);

			loadPageSucces("Đã chỉnh sửa dữ liệu thành công.","?".TTH_PATH."=courses_list&id=".$product_id);
			$OK = true;
		}
	}
}
else {
	$db->table = "courses";
	$db->condition = "`courses_id` = $courses_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$product_id         = $row['product_id']+0;
		$name			    = $row['name'];
		$name_video         = $row['video'];
		$name_document      = $row['document'];
		$document_title     = $row['document_title'];
		$content            = $row['content'];
		$test               = $row['test'];
		$practice           = $row['practice'];
		$is_active		    = $row['is_active']+0;
		$hot			    = $row['hot']+0;
	}
}
if(!$OK) courses("?".TTH_PATH."=courses_edit", "edit", $courses_id, $product_id, $name, $name_video, $name_document, $document_title, $content, $test, $practice, $is_active, $hot, $error);