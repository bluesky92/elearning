<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['type'])) {
	$type       = isset($_POST['type']) ? $_POST['type'] : '-no-';
    $date       = new DateClass();
    $stringObj  = new StringClass();

	if($type=='load') {
		$requestData = $_REQUEST;
		$columns = array(
			0 => '`' . TTH_DATA_PREFIX . 'library`.`modified_time`',
			1 => '`' . TTH_DATA_PREFIX . 'library`.`content`',
			2 => '`' . TTH_DATA_PREFIX . 'product_menu`.`name`',
			3 => '`' . TTH_DATA_PREFIX . 'library`.`type`',
			4 => '`' . TTH_DATA_PREFIX . 'library`.`is_active`',
			5 => '`' . TTH_DATA_PREFIX . 'library`.`created_time`',
            6 => '`' . TTH_DATA_PREFIX . 'core_user`.`user_name`'
		);

		$query = "1 ";
		if( !empty($requestData['search']['value']) ) {
			$query .= " AND CONCAT(`" . TTH_DATA_PREFIX . "library`.`content`, `" . TTH_DATA_PREFIX . "product_menu`.`name`, `" . TTH_DATA_PREFIX . "core_user`.`user_name`) LIKE '%" . $requestData['search']['value'] . "%'";
		}

		if( !empty($requestData['columns'][1]['search']['value']) ) {
            $query .= " AND `" . TTH_DATA_PREFIX . "library`.`content` LIKE '%" . $requestData['columns'][1]['search']['value'] . "%'";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ) {
            $query .= " AND `" . TTH_DATA_PREFIX . "product_menu`.`name` LIKE '%" . $requestData['columns'][2]['search']['value'] . "%'";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ) {
            $query .= " AND `" . TTH_DATA_PREFIX . "library`.`type` = " . (intval($requestData['columns'][3]['search']['value'])-1);
		}
        if( !empty($requestData['columns'][4]['search']['value']) ) {
            $query .= " AND `" . TTH_DATA_PREFIX . "library`.`is_active` = " . (intval($requestData['columns'][4]['search']['value'])-1);
        }
        if (!empty($requestData['columns'][5]['search']['value'])) {
            $d1 = strtotime($date->dmYtoYmd($requestData['columns'][5]['search']['value']));
            $d2 = $d1 + 86400;
            $query .= " AND `" . TTH_DATA_PREFIX . "library`.`created_time` >= $d1 AND `" . TTH_DATA_PREFIX . "library`.`created_time` <= $d2";
        }
        if( !empty($requestData['columns'][6]['search']['value']) ) {
            $query .= " AND `" . TTH_DATA_PREFIX . "core_user`.`user_name` LIKE '%" . $requestData['columns'][6]['search']['value'] . "%'";
        }

        if(!in_array("library_active", $corePrivilegeSlug)) $query .= " AND `" . TTH_DATA_PREFIX . "library`.`user_id` = " . $_SESSION["user_id"];

        $db->table = "library";
        $db->join = "LEFT JOIN `" . TTH_DATA_PREFIX . "product_menu` ON `" . TTH_DATA_PREFIX . "library`.`product_menu_id` = `" . TTH_DATA_PREFIX . "product_menu`.`product_menu_id` LEFT JOIN `" . TTH_DATA_PREFIX . "core_user` ON `" . TTH_DATA_PREFIX . "library`.`user_id` = `" . TTH_DATA_PREFIX . "core_user`.`user_id`";
		$db->condition = $query;
		$db->order = "";
		$db->limit = "";
		$db->select();
		$totalData = $db->RowCount;
		$totalFiltered = $totalData;

		$db->table = "library";
        $db->join = "LEFT JOIN `" . TTH_DATA_PREFIX . "product_menu` ON `" . TTH_DATA_PREFIX . "library`.`product_menu_id` = `" . TTH_DATA_PREFIX . "product_menu`.`product_menu_id` LEFT JOIN `" . TTH_DATA_PREFIX . "core_user` ON `" . TTH_DATA_PREFIX . "library`.`user_id` = `" . TTH_DATA_PREFIX . "core_user`.`user_id`";
        $db->condition = $query;
		$db->order = $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir'];
		$db->limit = $requestData['start'] . " ," . $requestData['length'];
		$rows = $db->select("`library_id`, `" . TTH_DATA_PREFIX . "library`.`content` AS `content`, `" . TTH_DATA_PREFIX . "product_menu`.`name` AS `name`, `" . TTH_DATA_PREFIX . "library`.`type` AS `type`, `" . TTH_DATA_PREFIX . "library`.`is_active` AS `active`, `" . TTH_DATA_PREFIX . "library`.`created_time` AS `created_time`, `" . TTH_DATA_PREFIX . "core_user`.`user_name` AS `user_name`");
		$data = array();
		$i = $requestData['start'];
		foreach($rows as $row) {
			$i++;
			$nestedData =   array();
			$nestedData[] = $i;
			$nestedData[] = $stringObj->crop(strip_tags(stripslashes($row['content'])), 30);
			$nestedData[] = stripslashes($row['name']);
			

			$type = (intval($row["type"])==0) ?
                '<button type="button" class="btn btn-success btn-sm-sm" data-toggle="tooltip" data-placement="top" title="Câu hỏi trắc nghiệm" rel="0">Trắc nghiệm</button>'
                :
                '<button type="button" class="btn btn-warning btn-sm-sm" data-toggle="tooltip" data-placement="top" title="Câu hỏi tự luận" rel="1">Tự luận</button>';

			$nestedData[] = $type;

            if(in_array("library_edit",$corePrivilegeSlug) && in_array("library_active", $corePrivilegeSlug)) {
                $active = (intval($row["active"]) == 0) ?
                    '<div class="btn-event-close" data-toggle="tooltip" data-placement="top" title="Mở" onclick="edit_status($(this), ' . intval($row["library_id"]) . ', \'is_active\', \'library\');" rel="1">0</div>'
                    :
                    '<div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status($(this), ' . intval($row["library_id"]) . ', \'is_active\', \'library\');" rel="0">1</div>';
            } else {
                $active = (intval($row["active"]) == 0) ?
                    '<div class="btn-event-close alertManager" data-toggle="tooltip" data-placement="top" title="Mở" rel="1">0</div>'
                    :
                    '<div class="btn-event-open alertManager" data-toggle="tooltip" data-placement="top" title="Đóng" rel="0">1</div>';
            }

			$nestedData[] = $active;
            $nestedData[] = $date->vnDate(intval($row['created_time']));
            $nestedData[] = stripslashes($row['user_name']);
			$nestedData[] = '<div class="checkbox"><a href="?'.TTH_PATH.'=library_edit&id='. intval($row['library_id']) .'"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/edit.png"></a> &nbsp; <label class="checkbox-inline"><input type="checkbox" class="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="ol-checkbox-js" name="idDel[]" value="' . intval($row['library_id']) . '"></label></div>';
			$data[] = $nestedData;
		}

		$json_data = array(
				"draw"            => intval( $requestData['draw'] ),
				"recordsTotal"    => intval( $totalData ),
				"recordsFiltered" => intval( $totalFiltered ),
				"data"            => $data
		);

		echo json_encode($json_data);

	}

} else echo json_encode(false);