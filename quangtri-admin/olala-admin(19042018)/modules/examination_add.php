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
				<a href="?<?php echo TTH_PATH?>=examination_list"><i class="fa fa-edit"></i> Quản lý nội dung</a>
			</li>
			<li>
				<a href="?<?php echo TTH_PATH?>=examination_list"><i class="fa fa-mortar-board"></i> Kiểm tra - Kết quả</a>
			</li>
			<li>
				<i class="fa fa-plus-square-o"></i> Thêm bài kiểm tra
			</li>
		</ol>
	</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "examination.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();

$OK         = false;
$error      = '';
if($typeFunc=='add'){
    $count  = isset($_POST['count']) ? $_POST['count'] : 0;
    $time   = isset($_POST['time']) ? $_POST['time'] : 0;
    $start  = isset($_POST['start']) ? $_POST['start'] : time();
	if(empty($title)) $error = '<span class="show-error">Vui lòng nhập tiêu đề bài kiểm tra.</span>';
	else {
		$OK = true;
		if($OK) {
            // ---- TO - Danh sách người nhận.
            $to = isset($_POST['to']) ? $_POST['to'] : array();
            $to_role = $to_product = $to_personal = $to_all = array();
            if(isset($to) && count($to) > 0) {
                for ($i = 0; $i < count($to); $i++) {
                    $item = explode(';', $to[$i]);
                    if($item[0] == 'r') {
                        array_push($to_role, $item[1]);
                        //---
                        $role = intval($item[1]);
                        $db->table = "core_user";
                        $db->condition = "`is_active` = 1 AND `role_id` = $role";
                        $db->order = "`sort` ASC";
                        $db->limit = "";
                        $rows = $db->select();
                        foreach ($rows as $row) {
                            array_push($to_all, $row['user_id']);
                        }
                    } elseif ($item[0] == 'p') {
                        array_push($to_product, $item[1]);
                        //---
                        $product = intval($item[1]);
                        $db->table = "product_logs";
                        $db->condition = "`product_id` = $product";
                        $db->order = "`created_time` DESC";
                        $db->limit = "";
                        $rows = $db->select();
                        foreach ($rows as $row) {
                            array_push($to_all, $row['user_id']);
                        }
                    } elseif ($item[0] == 'u') {
                        array_push($to_personal, $item[1]);
                        array_push($to_all, $item[1]);
                    }
                }
            }
            //---
            $to_role = array_keys(array_flip($to_role));
            $to_role = json_encode($to_role);
            //---
            $to_product = array_keys(array_flip($to_product));
            $to_product = json_encode($to_product);
            //---
            $to_personal = array_keys(array_flip($to_personal));
            $to_personal = json_encode($to_personal);
            //---
            $to_all = array_keys(array_flip($to_all));
            $to_all2 = json_encode($to_all);
            //---
            $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;
            //---

			$db->table = "examination";
			$data = array(
                'title' => $db->clearText($title),
				'product_menu_id' => intval($product_menu_id),
                'product_id' => intval($product_id),
				'count' => intval($count),
                'time' => intval($time),
                'start' => strtotime($date->dmYtoYmd($start)),
                'to_role' => $db->clearText($to_role),
                'to_product' => $db->clearText($to_product),
                'to_personal' => $db->clearText($to_personal),
                'to_all' => $db->clearText($to_all2),
				'is_active' => intval($is_active),
				'created_time' => time(),
				'modified_time' => time(),
				'user_id' => $_SESSION["user_id"]
			);
			$db->insert($data);
			$id_query = $db->LastInsertID;
            if($is_active==0) {
                // Ghi thông báo.
                insertNotify(15, 'active/examination', $id_query, $_SESSION["user_id"]);
            }

            if($id_query>0) {
                foreach ($to_all as $value) {
                    $db->table = "examination_logs";
                    $data = array(
                        'examination_id' => $id_query,
                        'user_id' => $value
                    );
                    $db->insert($data);
                }
            }
            // Ghi thông báo.
            insertNotify(13, 'examination', $id_query, $_SESSION["user_id"]);

			loadPageSucces("Đã thêm dữ liệu thành công.", "?".TTH_PATH."=examination_list");
		}
	}
}
else {
    $product_menu_id    = 0;
    $product_id         = 0;
    $title              = '';
    $count              = 0;
    $time               = 0;
    $start              = $date->vnDateTime(time());
    $to_role            = array();
    $to_product         = array();
    $to_personal        = array();
    if(in_array("examination_active", $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
}
if(!$OK) examination("?".TTH_PATH."=examination_add", "add", 0, $product_menu_id, $product_id, $title, $count, $time, $start, $to_role, $to_product, $to_personal, $is_active, $error);
