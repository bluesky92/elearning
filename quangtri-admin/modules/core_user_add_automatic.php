<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=core_user"><i class="fa fa-dashboard"></i> Quản trị hệ thống</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=core_user"><i class="fa fa-male"></i> Quản lý thành viên</a>
		</li>
		<li>
			<i class="fa fa-plus-square-o"></i> Thêm thành viên
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "core_user2.php");

if(empty($typeFunc)) $typeFunc = "no";
$date = new DateClass();
$OK = false;
$error = '';
$duplicateEntries = [];

function bind_param_array($stmt, $params) {
    $types = "";
    $bind_params = array();

    foreach ($params as $param) {
        $bind_params[] = &$param; // Phải sử dụng tham chiếu &
        if (is_int($param)) {
            $types .= "i"; // Integer
        } elseif (is_float($param)) {
            $types .= "d"; // Double
        } elseif (is_string($param)) {
            $types .= "s"; // String
        } else {
            $types .= "b"; // Blob
        }
    }

    array_unshift($bind_params, $types);
    call_user_func_array(array($stmt, 'bind_param'), $bind_params);
}

if($typeFunc=='add'){
	$date           = new DateClass();
    $file_max_size  = FILE_MAX_SIZE;
    $u_file         = '-no-';
    $dir_dest       = ROOT_DIR . DS . "uploads" . DS . "member" . DS;
    $file_type      = $_FILES['file']['type'];
    $file_name      = $_FILES['file']['name'];
    $file_size      = $_FILES['file']['size'];
    $file_type      = trim(strrchr($file_name, '.'));
    $file_full_name = "tmp_" . time() . $file_type;

	if (($file_size > 0) && ($file_size <= $file_max_size)) {
        // if ($file_type == ".xlsx" || $file_type == ".xls" || $file_type == ".docx" ) {
		if ($file_type == ".xlsx" || $file_type == ".xls" ) {

            if (@move_uploaded_file($_FILES['file']['tmp_name'], $dir_dest . $file_full_name)) {
                $u_file = 'Excel_' . time() . '_' . md5(uniqid()) . $file_type;
                @rename($dir_dest . $file_full_name, $dir_dest . $u_file);
                $OK = true;
            } else $OK = false;
        } else $OK = false;
    } else {
        $OK = false;
    }
	if(!$OK) $error = '<span class="show-error" style="font-size: 2rem">Vui lòng chèn file thông tin thành viên. Hiện tại chỉ hỗ trợ file định dạng .xls, .xlsx</span>';
    include(_F_CLASSES . DS . "PHPExcel" . DS . "IOFactory.php");
	$objPHPExcel = PHPExcel_IOFactory::load($dir_dest . $u_file);
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$highestRow = $worksheet->getHighestRow();
		$db->table = "core_user";
		 
		for ($row = 2; $row <= $highestRow; $row++) { 
			$ten    = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
			$namsinh       = intval($worksheet->getCellByColumnAndRow(2, $row)->getValue());
			$gioitinh      = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
			$sodienthoai    = trim($worksheet->getCellByColumnAndRow(4, $row)->getValue());
			$diachimail    = trim($worksheet->getCellByColumnAndRow(5, $row)->getValue());
			$password = '123456';

			// Check for duplicate user
			$db->table = "core_user";
			$db->condition = "user_name = '" . $db->clearText($sodienthoai) . "'";
			$existingUser = $db->select();

			if (count($existingUser) > 0) {
				// Add to duplicate entries list
				$duplicateEntries[] = $sodienthoai;
				continue; // Skip to the next entry
			}

			// Insert new user if not duplicate
			$data = array(
				'role_id' => $db->clearText(13),
				'user_name' => $db->clearText($sodienthoai),
				'password' => $db->clearText(md5($sodienthoai . $password)),
				'full_name' => $db->clearText($ten),
				'gender' => 1,
				'phone' => $db->clearText($sodienthoai),
				'is_active' => 1,
				'created_time' => time(),
				'user_id_edit' => $_SESSION["user_id"]
			);
			$db->insert($data);
		}
	}

	if (count($duplicateEntries) > 0) {
		$error = '<span class="show-error" style="font-size: 2rem">Một số tài khoản đã tồn tại: ' . implode(', ', $duplicateEntries) . '</span>';
		$OK = false;
	}
	else {
		loadPageSucces("Đã thêm Thành viên thành công.","?".TTH_PATH."=core_user");
		$OK = true;
	}

	// ---------------------------------------------------------------
}
if(!$OK) add_memberUser("?".TTH_PATH."=core_user_add_automatic", "add", $error);
?>
