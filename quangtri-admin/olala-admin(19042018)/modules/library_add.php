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
				<a href="?<?php echo TTH_PATH?>=library_list"><i class="fa fa-edit"></i> Quản lý nội dung</a>
			</li>
			<li>
				<a href="?<?php echo TTH_PATH?>=library_list"><i class="fa fa-book"></i> Thư viện đề thi</a>
			</li>
			<li>
				<i class="fa fa-plus-square-o"></i> Thêm câu hỏi
			</li>
		</ol>
	</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "library.php");
if(empty($typeFunc)) $typeFunc = "no";
$OK         = false;
$error      = '';
if($typeFunc=='add'){
    $date           = new DateClass();
    $file_max_size  = FILE_MAX_SIZE;
    $u_file         = '-no-';
    $dir_dest       = ROOT_DIR . DS . "uploads" . DS . "library" . DS;
    $file_type      = $_FILES['file']['type'];
    $file_name      = $_FILES['file']['name'];
    $file_size      = $_FILES['file']['size'];
    $file_type      = trim(strrchr($file_name, '.'));
    $file_full_name = "tmp_" . time() . $file_type;

    if (($file_size > 0) && ($file_size <= $file_max_size)) {
        if ($file_type == ".xlsx" || $file_type == ".xls") {

            if (@move_uploaded_file($_FILES['file']['tmp_name'], $dir_dest . $file_full_name)) {
                $u_file = 'Excel_' . time() . '_' . md5(uniqid()) . $file_type;
                @rename($dir_dest . $file_full_name, $dir_dest . $u_file);
                $OK = true;
            } else $OK = false;
        } else $OK = false;
    } else {
        $OK = false;
    }

    // Insert Database.
    if(!$OK) $error = '<span class="show-error">Vui lòng chèn file excel câu hỏi.</span>';
    else {
        include(_F_CLASSES . DS . "PHPExcel" . DS . "IOFactory.php");
        $objPHPExcel = PHPExcel_IOFactory::load($dir_dest . $u_file);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $library_id = 0;
            for ($row = 2; $row <= $highestRow; $row++) {
                $content    = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $type       = intval($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $title      = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $correct    = trim($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                if(!empty($content)) {
                    $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;
                    //---
                    $db->table = "library";
                    $data = array(
                        'product_menu_id' => intval($product_menu_id),
                        'product_id' => intval($product_id),
                        'type' => intval($type),
                        'content' => $db->clearText($content),
                        'is_active' => intval($is_active),
                        'created_time' => time(),
                        'modified_time' => time(),
                        'user_id' => $_SESSION["user_id"]
                    );
                    $db->insert($data);
                    $library_id = $db->LastInsertID;
                    if($is_active==0) {
                        // Ghi thông báo.
                        insertNotify(15, 'active/library', $library_id, $_SESSION["user_id"]);
                    }
                }

                if($type==1) {
                    $db->table = "library_answer";
                    $data = array(
                        'library_id' => $library_id,
                        'title' => $db->clearText($title),
                        'correct_1' => $db->clearText($correct)
                    );
                    $db->insert($data);
                } elseif(empty($correct)) {;
                    $db->table = "library_answer";
                    $data = array(
                        'library_id' => $library_id,
                        'title' => $db->clearText($title)
                    );
                    $db->insert($data);
                } else {;
                    $db->table = "library_answer";
                    $data = array(
                        'library_id' => $library_id,
                        'title' => $db->clearText($title),
                        'correct' => 1
                    );
                    $db->insert($data);
                }

            }
        }

        loadPageSucces("Đã thêm dữ liệu thành công.", "?".TTH_PATH."=library_list");

	}
}
else {
    $product_menu_id    = 0;
    $product_id         = 0;
	$content            = "";
    if(in_array("library_active", $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
}
if(!$OK) library("?".TTH_PATH."=library_add", "add", 0, $product_menu_id, $product_id, $is_active, $error);
