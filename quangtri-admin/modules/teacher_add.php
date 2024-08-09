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
			<i class="fa fa-plus-square-o"></i> Thêm giáo viên
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "teacher_add_templ.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();
$OK = false;
$error = '';
if($typeFunc=='add'){
	$db->table = "teachers";
	$db->condition = "";
	$db->order = "";
	$db->select();
	if($db->RowCount<0) $error = '<span class="show-error">Có lỗi sảy ra rồi'.$db->RowCount.' ...</span>';
	else {
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
		//if ($OK) echo ("OK");
	///*	
	if($OK) {
			
			$id_query = 0;

			$db->table = "teachers";
			$data = array(
				'full_name'=>$db->clearText($full_name),
				'gender'=>$gender+0,
				'birthday'=>strtotime($date->dmYtoYmd($birthday)),
				'hocvi'=>$db->clearText($hocvi),
				'email'=>$db->clearText($email),
				'phone'=>$db->clearText($phone),
				'address'=>$db->clearText($address),
				'intro'=>$db->clearText($comment),
				'is_active'=>$is_active+0,
				'vote'=>$vote+0,
				'created_time'=>time()
			);
			
			//try {	
			
			//error_log("There’s been a problem!");
			//var_dump($data);
        try {
            $db->insert($data);
        } catch (DatabaseConnException $e) {
			error_log($e->getMessage(),3,"C:\\xampp\\php\\logs\\php_errors.log");
        }
        // }
			//} catch () {
			//	echo( "Error inserting record: ");
			//}
			
			
			$id_query = $db->LastInsertID;
            
			if($handleUploadImg) {
				$stringObj = new StringClass();

				$img_name_file = 'u_' . time() . "_" . md5(uniqid());

				$imgUp->file_new_name_body      = $img_name_file;
				$imgUp->image_resize            = true;
				$imgUp->image_ratio_crop        = true;
				$imgUp->image_x                 = 200;
				$imgUp->image_y                 = 200;
				$imgUp->Process($dir_dest);

				if ($imgUp->processed) {
					$name_img = $imgUp->file_dst_name;
					$db->table = "teachers";
					$data = array(
						'img' => $db->clearText($name_img)
					);
					$db->condition = "teachers_id = " . $id_query;
					error_log(var_dump($data),3,"C:\\xampp\\php\\logs\\php_errors.log");
					$db->update($data);
				} else {
					loadPageAdmin("Lỗi tải hình: " . $imgUp->error, "?" . TTH_PATH . "=teachers");
				}
				$imgUp->file_new_name_body      = 'sm_' . $img_name_file;
				$imgUp->image_resize            = true;
				$imgUp->image_ratio_crop        = true;
				$imgUp->image_x                 = 90;
				$imgUp->image_y                 = 90;
				$imgUp->Process($dir_dest);
				$imgUp->Clean();
			}
			loadPageSucces("Đã thêm Giáo viên thành công.","?".TTH_PATH."=teacher_manager");
			$OK = true;
		}
	//*/
	}
}
else {
	$full_name      = "Lê Văn Test";
	$gender         = 1;
	$birthday       = '01/01/1992';
	$hocvi          = 'Tiến sĩ';
	$email          = "test@mail.com";
	$phone          = "0865251677";
	$address        = "Không rõ";
	$comment        = 'Super';
	$img            = "";
	$is_active		= 1;
	$vote           = 3;
}
if(!$OK) memberTeacher("?".TTH_PATH."=teacher_add", "add", 0, $full_name, $gender, $birthday, $hocvi, $email, $phone, $address, $comment, $img, $is_active, $vote, $error);
?>