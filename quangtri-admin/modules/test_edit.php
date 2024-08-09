<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$test_id = isset($_GET['id']) ? $_GET['id']+0 : $test_id;
$courses_name = $product_name = '';
$courses_id = $product_id = $product_menu_id = $category_id_core = 0;
$db->table = "test";
$db->condition = "`test_id` = $test_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
	$courses_id = $row['courses_id'];
}
if($db->RowCount==0) loadPageAdmin("Dữ liệu không tồn tại.","?".TTH_PATH."=product_manager");
$db->table = "courses";
$db->condition = "`courses_id` = $courses_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row){
	$product_id = $row['product_id'];
	$courses_name = stripslashes($row['name']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.", "?" . TTH_PATH . "=product_manager");
$db->table = "product";
$db->condition = "`product_id` = $product_id";
$db->order = "";
$db->limit = "";
$rows = $db->select();
foreach($rows as $row){
	$product_menu_id = $row['product_menu_id'];
	$product_name = stripslashes($row['name']);
}
$category_id_core = getTableOl($product_menu_id, 'product_menu', 'product_menu_id', 'category_id');
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
			<a href="?<?php echo TTH_PATH?>=courses_list&id=<?php echo $product_id?>"><i class="fa fa-list"></i> <?php echo $product_name;?></a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=test_list&id=<?php echo $courses_id?>"><i class="fa fa-file-text"></i> <?php echo $courses_name;?></a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa câu hỏi
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "test.php");
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
			$db->table = "test";
			$data = array(
				'courses_id'=>$courses_id+0,
				'type'=>$type+0,
				'content'=>$db->clearText($content),
				'is_active'=>$is_active+0,
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`test_id` = $test_id";
			$db->update($data);
			//---
			$db->table = "answer";
			$db->condition = "`test_id` = $test_id";
			$db->delete();
			if($type==0 && $test_id>0) {
				for($i=0; $i<count($title); $i++) {
					if($title[$i]!='') {
						$db->table = "answer";
						$data = array(
								'test_id' => $test_id,
								'title' => $db->clearText($title[$i]),
								'correct' => $correct[$i]
						);
						$db->insert($data);
					}
				}
			}

			loadPageSucces("Đã chỉnh sửa dữ liệu thành công.","?".TTH_PATH."=test_list&id=" . $courses_id);
			$OK = true;
		}
	}
}
else {
	$db->table = "test";
	$db->condition = "`test_id` = $test_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$courses_id         = $row['courses_id'];
		$content            = $row['content'];
		$type			    = $row['type']+0;
		$is_active		    = $row['is_active']+0;
	}
}
if(!$OK) test("?".TTH_PATH."=test_edit", "edit", $test_id, $courses_id, $product_id, $category_id_core, $type, $content, $is_active, $error);