<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$type = isset($_POST['type']) ? $_POST['type'] : '-no-';
if($type=='signin') {
	$user       = isset($_POST["user"]) ? (string) $_POST["user"] : '';
	$password   = isset($_POST["password"]) ? (string) $_POST["password"] : '';
	if(!check_login($user, $password)) {
		echo '<div class="failed">Đăng nhập thất bại, hệ thống không tìm thấy tài khoản nào phù hợp với thông tin mà bạn khai báo. Bạn vui lòng thử lại (nhớ kiểm tra phím Caps Lock).<br>Tài khoản sẽ bị khóa, nếu bạn nhập sai quá 5 lần.</div>';
	} else {
		echo true;
	}

} elseif($type=='register') {
	$p_user     = isset($_POST["user"]) ? (string) $_POST["user"] : '';
	$p_password = isset($_POST["password"]) ? (string) $_POST["password"] : '';
	$p_name     = isset($_POST["name"]) ? (string) $_POST["name"] : '';
	$p_tel      = isset($_POST["tel"]) ? (string) $_POST["tel"] : '';
	$p_email    = isset($_POST["email"]) ? (string) $_POST["email"] : '';

	$db->table = "core_user";
	$db->condition = "`user_name` LIKE '" . $db->clearText($p_user) . "'";
	$db->order = "";
	$db->limit = 1;
	$db->select();
	if($db->RowCount>0) {
		echo '<div class="failed">Tên đăng nhập <strong>' . $p_user . '</strong> này đã tồn tại, vui lòng chọn một tên đăng nhập khác.</div>';
	} else {
		$db->table = "core_user";
		$data = array(
			'role_id'=>13,
			'user_name'=>$db->clearText($p_user),
			'password'=>$db->clearText(md5($p_user.$p_password)),
			'full_name'=>$db->clearText($p_name),
			'email'=>$db->clearText($p_email),
			'phone'=>$db->clearText($p_tel),
			'created_time'=>time()
		);
		$db->insert($data);
		if($db->LastInsertID>0) {
			// Ghi thông báo.
			insertNotify(12, 'user', $db->LastInsertID, $account["id"]);
			echo '<div class="success">Đăng ký tài khoản thành công, bạn có thể đăng nhập vào hệ thống bằng thông tin đã đăng ký hợp lệ.</div>';
		}
		else echo '<div class="failed">Có lỗi hệ thống xảy ra, bạn vui lòng thử lại.</div>';
	}

} elseif($type=='logout') {
	unset($_SESSION["personnel"]);
	echo true;
} elseif($type=='avatar') {
	if($account["id"]>0) {
		$file_max_size = FILE_MAX_SIZE;
		$dir_dest = ROOT_DIR . DS . 'uploads' . DS . 'user';
		$file_size = $_FILES['new_avatar']['size'];
		if($file_size>0) {
			$imgUp = new Upload($_FILES['new_avatar']);
			$imgUp->file_max_size = $file_max_size;
			if($imgUp->uploaded) {
				$db->table = "core_user";
				$db->condition = "`user_id` = " . $account["id"];
				$db->order = "";
				$db->limit = 1;
				$rows = $db->select();
				foreach($rows as $row) {
					if(glob($dir_dest . DS . '*' . $row['img'])) array_map("unlink", glob($dir_dest . DS . '*' . $row['img']));
					//---
					$img_name_file = 'u_' . time() . "_" . md5(uniqid());
					$imgUp->file_new_name_body      = $img_name_file;
					$imgUp->image_resize            = true;
					$imgUp->image_ratio_crop        = true;
					$imgUp->image_x                 = 200;
					$imgUp->image_y                 = 200;
					$imgUp->Process($dir_dest);
					if($imgUp->processed) {
						$name_img = $imgUp->file_dst_name;
						$db->table = "core_user";
						$data = array(
								'img' => $db->clearText($name_img)
						);
						$db->condition = "`user_id` = " . $account["id"];
						$db->update($data);
						//---
						$imgUp->file_new_name_body      = 'sm_' . $img_name_file;
						$imgUp->image_resize            = true;
						$imgUp->image_ratio_crop        = true;
						$imgUp->image_x                 = 90;
						$imgUp->image_y                 = 90;
						$imgUp->Process($dir_dest);
					}
					$imgUp-> Clean();
				}
			}
		}
	}
} else echo 'Error--';

function check_login($user, $pass) {
	global $db;
	$db->table = "core_user";
	$db->condition = "`user_name` = '" . $db->clearText($user) . "' AND `password` = '" . $db->clearText(md5($user.$pass)) . "' AND `role_id`>0 AND `is_active`=1";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	if($db->RowCount>0) {
		foreach($rows as $row) {
			$_SESSION["personnel"] = intval($row["user_id"]);
            $db->table = "core_user";
            $data = array(
                'log' => 0
            );
            $db->condition = "`user_id` = " . intval($row["user_id"]);
            $db->update($data);
		}
		return true;
	} else {
        $db->table = "core_user";
        $db->condition = "`user_name` = '" . $db->clearText($user) . "' AND `is_active`=1";
        $db->order = "";
        $db->limit = 1;
        $rows = $db->select();
        if($db->RowCount>0) {
            foreach ($rows as $row) {
                $db->table = "core_user";
                $data = array(
                    'log' => intval($row['log']+1)
                );
                $db->condition = "`user_id` = " . intval($row["user_id"]);
                $db->update($data);
                //---
                if( $row['log'] >= 5 ) {
                    $db->table = "core_user";
                    $data = array(
                        'is_active' => 0
                    );
                    $db->condition = "`user_id` = " . intval($row["user_id"]);
                    $db->update($data);
                }
            }
        }

		unset($_SESSION["personnel"]);
		return false;
	}
}