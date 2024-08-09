<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$library_id = isset($_GET['id']) ? intval($_GET['id']) : $library_id;
$user = 0;
$db->table = "library";
$db->condition = "`library_id` = $library_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
    $user = intval($row['user_id']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.", "?" . TTH_PATH . "=library_list");
if(!in_array("library_active", $corePrivilegeSlug)) {
    if(intval($_SESSION["user_id"])!=$user) loadPageAdmin("Bạn không được phân quyền chỉnh sửa nội dung này.","?".TTH_PATH."=library_list");
}
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
			<i class="fa fa-cog"></i> Chỉnh sửa câu hỏi
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "library2.php");
if(empty($typeFunc)) $typeFunc = "no";
$OK = false;
$error = '';
if($typeFunc=='edit'){
	$title = isset($_POST['title']) ? $_POST['title'] : array();
	$correct = isset($_POST['correct']) ? $_POST['correct'] : array();
	$content = (isset($_POST['content'])) ? $_POST['content'] : '';
	if(empty($content)) $error = '<span class="show-error">Vui lòng nhập nội dung câu hỏi.</span>';
	else {
		$OK = true;
		if($OK) {
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "library";
                $db->condition = "`library_id` = $library_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }

			$db->table = "library";
			$data = array(
                'product_menu_id' => intval($product_menu_id),
                'product_id' => intval($product_id),
				'type'=>$type+0,
				'content'=>$db->clearText($content),
                'is_active' => intval($is_active),
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`library_id` = $library_id";
			$db->update($data);
			//---
			$db->table = "library_answer";
			$db->condition = "`library_id` = $library_id";
			$db->delete();
			if($type==0 && $library_id>0) {
				for($i=0; $i<count($title); $i++) {
					if($title[$i]!='') {
						$db->table = "library_answer";
						$data = array(
								'library_id' => $library_id,
								'title' => $db->clearText($title[$i]),
								'correct' => $correct[$i]
						);
						$db->insert($data);
					}
				}
			}

			loadPageSucces("Đã chỉnh sửa dữ liệu thành công.", "?".TTH_PATH."=library_list");
			$OK = true;
		}
	}
}
else {
	$db->table = "library";
	$db->condition = "`library_id` = $library_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$product_menu_id    = intval($row['product_menu_id']);
        $product_id         = intval($row['product_id']);
		$content            = $row['content'];
		$type			    = intval($row['type']);
		$is_active		    = intval($row['is_active']);
	}
}
if(!$OK) library("?".TTH_PATH."=library_edit", "edit", $library_id, $product_menu_id, $product_id, $type, $content, $is_active, $error);