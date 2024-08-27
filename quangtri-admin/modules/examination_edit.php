<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$examination_id = isset($_GET['id']) ? intval($_GET['id']) : $examination_id;
$user = 0;
$db->table = "examination";
$db->condition = "`examination_id` = $examination_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row) {
    $user = intval($row['user_id']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.", "?" . TTH_PATH . "=examination_list");
if(!in_array("examination_active", $corePrivilegeSlug)) {
    if(intval($_SESSION["user_id"])!=$user) loadPageAdmin("Bạn không được phân quyền chỉnh sửa nội dung này.","?".TTH_PATH."=examination_list");
}
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
			<i class="fa fa-cog"></i> Chỉnh sửa bài kiểm tra
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "examination.php");
if(empty($typeFunc)) $typeFunc = "no";
$OK = false;
$error = '';
if($typeFunc=='edit'){
    $count  = isset($_POST['count']) ? $_POST['count'] : 0;
    $count_exams  = isset($_POST['count_exams']) ? $_POST['count_exams'] : 0;
    $time   = isset($_POST['time']) ? $_POST['time'] : 0;
    $start  = isset($_POST['start']) ? $_POST['start'] : time();
    if(empty($title)) $error = '<span class="show-error">Vui lòng nhập tiêu đề bài kiểm tra.</span>';
	else {
		$OK = true;
		if($OK) {
            // ---- TO - Danh sách người nhận.
            // $to = isset($_POST['to']) ? $_POST['to'] : array();
            // $to_role = 0;
            // $to_product = $to_personal = $to_all = array();
            /*
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
                */
            //---
            // loadPageSucces("Đã chỉnh sửa dữ liệu thành công. $to_role", "?".TTH_PATH."=examination_list");
            //var_dump($to_role);
            /*
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
            */
            //---
            if(!isset($_POST['is_active'])) {
                $is_active = 0;
                $db->table = "examination";
                $db->condition = "`examination_id` = $examination_id";
                $db->order = "";
                $db->limit = 1;
                $rows = $db->select();
                foreach($rows as $row) {
                    $is_active = intval($row['is_active']);
                }
            }
            //---

			$db->table = "examination";
			$data = array(
                'title'=>$db->clearText($title),
                'product_menu_id' => intval($product_menu_id),
                'product_id' => intval($product_id),
                'count' => intval($count),
                'solanthi'=> intval($count_exams),
                'time' => intval($time),
                'start' => strtotime($date->dmYtoYmd($start)),
                'to_role' => $db->clearText($to_role),
                'to_product' => $db->clearText($to_product),
                'to_personal' => $db->clearText($to_personal),
                'to_all' => $db->clearText($to_all2),
                'is_active' => intval($is_active),
				'modified_time'=>time(),
				'modified_user'=>$_SESSION["user_id"]
			);
			$db->condition = "`examination_id` = $examination_id";
			$db->update($data);
            /*
			if($db->AffectedRows>0) {
                $db->table = "examination_logs";
                $db->condition = "`examination_id` = $examination_id";
                $db->delete();

                $db->table = "examination_answer";
                $db->condition = "`examination_id` = $examination_id";
                $db->delete();
                // đoạn này chèn dữ liệu đủ , tạo khung trước cho toàn bộ thí sinh....
                /*
                foreach ($to_all as $value) {
                    $db->table = "examination_logs";
                    $data = array(
                        'examination_id' => $examination_id,
                        'user_id' => $value
                    );
                    $db->insert($data);
                } 
            } */
            // Ghi thông báo.
            insertNotify(14, 'examination', $examination_id, $_SESSION["user_id"]);

			loadPageSucces("Đã chỉnh sửa dữ liệu thành công.", "?".TTH_PATH."=examination_list");
			$OK = true;
		}
	}
}
else {
	$db->table = "examination";
	$db->condition = "`examination_id` = $examination_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
    // var_dump($rows);
	foreach($rows as $row) {
        $title              = $row['title'];
        $product_menu_id    = intval($row['product_menu_id']);
        $product_id         = intval($row['product_id']);
        $count              = intval($row['count']);
        $count_exams        = intval($row['solanthi']);
        $time               = intval($row['time']);
        $start              = $date->vnDateTime($row['start']);
        $to_role            = $row['to_role'];
        $to_product         = $row['to_product'];
        $to_personal        = $row['to_personal'];
		$is_active		    = intval($row['is_active']);
	}
}
if(!$OK) examination("?".TTH_PATH."=examination_edit", "edit", $examination_id, $product_menu_id, $product_id, $title, $count, $count_exams, $time, $start, $to_role, $to_product, $to_personal, $is_active, $error);