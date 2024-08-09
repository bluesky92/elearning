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
			<a href="?<?php echo TTH_PATH?>=teacher_manager"><i class="fa fa-dashboard"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=teacher_manager"><i class="fa fa-male"></i> Quản lý giáo viên</a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa giáo viên
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
//

$teacher_id = isset($_GET['id']) ? $_GET['id']+0 : $userId+0;
$db->table = "teachers";
$db->condition = "teachers_id = ".$teacher_id;
$db->order = "";
//loadPageAdmin("Giáo viên không tồn tại..".$teacher_id, "?".TTH_PATH."=teacher_manager");
try {
	$db->select();
}
catch (Exception $e){
	error_log($e->getMessage(),3,"C:\\xampp\\php\\logs\\php_errors.log");
}

if($db->RowCount==0) loadPageAdmin("Giáo viên không tồn tại= $teacher_id", "?".TTH_PATH."=teacher_manager");


include_once (_A_TEMPLATES . DS . "teacher_add_templ.php");

if(empty($typeFunc)) $typeFunc = "no";
//echo("Hello");
$date = new DateClass();
$OK = false;
$error = '';

if($typeFunc=='edit'){
	$handleUploadImg = false;
	$file_max_size = FILE_MAX_SIZE;
	$dir_dest = ROOT_DIR . DS . 'uploads' . DS . 'user';
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
		//var_dump($db->clearText($hocvi));
		$db->table = "teachers";
		$data = array(
			'full_name'=>$db->clearText($full_name),
			'gender'=>$gender + 0,
			'birthday'=>strtotime($date->dmYtoYmd($birthday)),
			'hocvi'=>$db->clearText($hocvi),
			'email'=>$db->clearText($email),
			'phone'=>$db->clearText($phone),
			'address'=>$db->clearText($address),
			'intro'=>$db->clearText($intro),
			'is_active'=>$is_active+0,
			'vote'=>$vote+0,
			'modified_time'=>time()
		);	
		var_dump($db->clearText($intro));
		$db->condition = "teachers_id = " . $teacher_id;
		$db->update($data);

		if($handleUploadImg) {
			
			$stringObj = new StringClass();
			if(glob($dir_dest . DS .'*'.$img)) array_map("unlink", glob($dir_dest . DS .'*'.$img));

			$img_name_file = 'u_' . time() . "_" . md5(uniqid());
			$imgUp->file_new_name_body      = $img_name_file;
			$imgUp->image_resize            = true;
			$imgUp->image_ratio_crop        = true;
			$imgUp->image_x                 = 200;
			$imgUp->image_y                 = 200;
			$imgUp->Process($dir_dest);
			if($imgUp->processed) {
				$name_img = $imgUp->file_dst_name;
				$db->table = "teachers";
				$data = array(
					'img' => $db->clearText($name_img)
				);
				$db->condition = "teachers_id = " . $teacher_id;
				//var_dump($data);
				
				try {
					$db->update($data);
				}
				catch (Exception $e){
					error_log($e->getMessage(),3,"C:\\xampp\\php\\logs\\php_errors.log");
				}
			}
			else {
				loadPageAdmin("Lỗi tải hình: ".$imgUp->error,"?". TTH_PATH . "=teacher_manager");
			}
			$imgUp->file_new_name_body      = 'sm_' . $img_name_file;
			$imgUp->image_resize            = true;
			$imgUp->image_ratio_crop        = true;
			$imgUp->image_x                 = 90;
			$imgUp->image_y                 = 90;
			$imgUp->Process($dir_dest);
			$imgUp-> Clean();
		}
		loadPageSucces("Đã chỉnh sửa Giáo viên thành công.", "?" . TTH_PATH . "=teacher_manager");
		$OK = true;
	}
}
else {
	
	$db->table = "teachers";
	$db->condition = "teachers_id = ".$teacher_id;
	$db->order = "";
	$rows = $db->select();
	//loadPageAdmin("OK:".$OK, "?".TTH_PATH."=teacher_manager");
	//var_dump($rows);
	foreach ($rows as $row) {
		//$role_id		= $row['role_id']+0;
		$full_name      = stripslashes($row['full_name']);
		$gender         = $row['gender']+0;
		$birthday       = $date->vnDate($row['birthday']);
        $hocvi          = $row['hocvi'];
		$email          = $row['email'];
		$phone          = $row['phone'];
		$address        = stripslashes($row['address']);
		$intro          = $row['intro'];
		$img            = $row['img'];
		$is_active		= $row['is_active']+0;
		$vote           = $row['vote'];
	}
}
if(!$OK) memberTeacher("?".TTH_PATH."=teacher_edit", "edit", $teacher_id, $full_name, $gender, $birthday, $hocvi, $email, $phone, $address, $intro, $img, $is_active, $vote, $error);
?>