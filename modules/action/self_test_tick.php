<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
    $product_menu_id    = isset($_POST['product_menu_id']) ? intval($_POST['product_menu_id']) : 0;
    $product_id         = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    // $product_id         = 272;
    echo($product_menu_id);
	$date               = new DateClass();
	$result             = '';
    $current_time       = strtotime($date->vnOther(time(), 'Y-m-d H:i'));
    $start              = $current_time;
    $self_test_id       = 0;

    $product_menu_name  = getNameProductMenu($product_menu_id);
    $product_name       = getNameProductExa($product_id);
    $test_count         = intval(getConstant('test_count'));
    $test_time          = intval(getConstant('test_time'));

    if($product_id>0) $query = " AND `product_id` IN (0, $product_id)";
    else $query = "";
    $db->table = "library";
    $db->condition = "`is_active` = 1 AND `product_menu_id` = $product_menu_id " . $query;
    $db->order = "RAND()";
    $db->limit = "";
    $db->select();
    $test_count = $db->RowCount;

    $db->table = "self_test";
    $data = array(
        'product_menu_id' => $product_menu_id,
        'product_id' => $product_id,
        'user_id' => intval($account["id"]),
        'status' => 0,
        'start' => $start,
        'questionCount' => $test_count
    );
    $db->insert($data);
    $self_test_id = $db->LastInsertID;

    $result .= '<div class="modal-dialog" style="width: auto !important;"><div class="modal-content">';
    $result .= '<div class="modal-header"><h3 class="modal-title">TỰ KIỂM TRA</h3></div>';

    $result .= '<div class="modal-body">';

    $result .= '<div class="examination-info">';
    // $result .= '<div class="exa-item"><label>Chủ đề khóa học:</label><label class="inp">' . $product_menu_name . '</label></div>';
    $result .= '<div class="exa-item"><label>'.$product_menu_name.'</label><label id="_product" class="inp">' . $product_name . '</label></div>';
    $query = "";
    if($product_id>0) $query = " AND `product_id` IN (0, $product_id)";
    else $query = "";
    $result .= '<p><label>Số câu hỏi:</label> ' .  $test_count . '</p>';

    // $result .= '<p><label>product_menu_id:</label> ' .  $product_menu_id . '</p>';
    // $result .= '<p><label>product_id:</label> ' .  $product_id . '</p>';
    // $result .= '<p><label>Thời gian làm bài:</label> ' .  $test_time . ' (phút)</p>';
    $result .= '<p><label>Làm kiểm tra lúc:</label> <strong class="start">' .  $date->vnDateTime($start) . '</strong></p>';
    $result .= '</div>';

    $result .= '<div class="question-view">';
    $result .= '<form id="fm-library" name="library" method="post" onsubmit="return self_test_answer(\'fm-library\');">';
    $result .= '<input type="hidden" name="self_test_id" value="' . $self_test_id . '">';

    // $query = "";
    

    $db->table = "library";
    $db->condition = "`is_active` = 1 AND `product_menu_id` = $product_menu_id " . $query;
    $db->order = "RAND()";
    $db->limit = $test_count;
    $rows_library = $db->select();
    $i = 0;
    foreach($rows_library as $row_library){
        $i++;
        $result .= '<div class="question">';
        $result .= '<label class="question-title">Câu ' . $i . ':</label>';
        $result .= '<div class="question-content">' . stripslashes($row_library['content']) . '</div>';
        if($row_library['type']>0) {
            $result .= '<div class="question-answer"><label class="text-editor"><textarea class="editor" name="answer[' . $row_library['library_id'] . '][]" placeholder="Nhập câu trả lời của bạn..."></textarea></label></div>';
        } else {
            $result .= '<input type="hidden" name="answer[' . $row_library['library_id'] . '][]" value="">';

            $db->table = "library_answer";
            $db->condition = "`correct` = 1 AND `library_id` = " . $row_library['library_id'];
            $db->order = "`library_answer_id` ASC";
            $db->limit = "";
            $db->select();
            $correct = $db->RowCount;

            $db->table = "library_answer";
            $db->condition = "`library_id` = " . intval($row_library['library_id']);
            $db->order = "`library_answer_id` ASC";
            $db->limit = "";
            $rows_as = $db->select();
            foreach ($rows_as as $row_as) {
                if ($correct > 1) $result .= '<div class="question-answer icheck"><div class="square-green single-row"><label class="checkbox"><input type="checkbox" name="answer[' . $row_library['library_id'] . '][]" value="' . $row_as['library_answer_id'] . '"><span>' . stripslashes($row_as['title']) . '</span></label></div></div>';
                else $result .= '<div class="question-answer icheck"><div class="square-green single-row"><label class="radio"><input type="radio" name="answer[' . $row_library['library_id'] . '][]" value="' . $row_as['library_answer_id'] . '"><span>' . stripslashes($row_as['title']) . '</span></label></div></div>';
            }
        }
        $result .= '</div>';
    }

    $result .= '<div class="answer text-right"><label id="self-test-results" class="result"></label><button type="submit" class="btn btn-success btn-round">NỘP BÀI ?<i class="fa fa-fw fa-hourglass-half fa-fw"></i></button></div>';
    $result .= '</form>';
    $result .= '</div>';

    $result .= '</div>';

    $result .= '<div class="modal-footer"></div></div></div>';

    // $minutes = '<div id="exa-timer">' . $test_time . ':00</div><script>startTimer2();$(function(){$(".square-green input").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",increaseArea:"20%"})});</script>';
    $minutes = '<script>$(function(){$(".square-green input").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",increaseArea:"20%"})});</script>';


    echo $result . $minutes;
	
} else echo 'Error--';