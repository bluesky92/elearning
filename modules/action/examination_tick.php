<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
    echo("NOW");
	$id             = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $date           = new DateClass();
	$result         = '';
	$status         = $start = 0;
    $current_time   = strtotime($date->vnOther(time(), 'Y-m-d H:i'));

	// $db->table = "examination_logs";
	// $db->condition = "`examination_id` = $id AND `user_id` = " . intval($account["id"]);
	// $db->order = "";
	// $db->limit = 1;
	// $rows = $db->select();
    // foreach ($rows as $row) {
    //     $status = intval($row['status']);
    //     $start  = intval($row['start']);
    // }

    // if($start==0) {
        $start = $current_time;
        $db->table = "examination_logs";
        $data = array(
            'examination_id'=>$id,
            'user_id' => intval($account["id"]),
            'exam_order' =>1,
            'start' => $start
        );
        $db->condition = "";
        $db->insert($data); ///update hay insert 
    // }

    $db->table = "examination";
    $db->condition = "`examination_id` = $id";
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
	if($db->RowCount>0) {
	    //if($status==0) {
            $result .= '<div class="modal-dialog" style="width: auto !important;"><div class="modal-content">';
            foreach ($rows as $row) {
                $result .= '<div class="modal-header"><h3 class="modal-title">KỲ KIỂM TRA</h3><p class="no-margin text-center">' . stripslashes($row['title']) . '</p></div>';
                $result .= '<div class="modal-body">';

                $result .= '<div class="examination-info">';
                $result .= '<p><label>Số câu hỏi:</label> ' .  intval($row['count']) . '</p>';
                $result .= '<p><label>Thời gian làm bài:</label> ' .  intval($row['time']) . ' (phút)</p>';
                $result .= '<p><label>Làm kiểm tra lúc:</label> <strong class="start">' .  $date->vnDateTime($start) . '</strong></p>';
                $result .= '</div>';

                $result .= '<div class="question-view">';
                $result .= '<form id="fm-library" name="library" method="post" onsubmit="return examination_answer(\'fm-library\');">';
                $result .= '<input type="hidden" name="examination" value="' . intval($row['examination_id']) . '">';

                $query = "";
                if(intval($row['product_id'])>0) $query = " AND `product_id` IN (0, " . intval($row['product_id']) . ")";
                else $query = "";
                $db->table = "library";
                $db->condition = "`is_active` = 1 AND `product_menu_id` = " . intval($row['product_menu_id']) . $query;
                $db->order = "RAND()";
                $db->limit = intval($row['count']);
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
                        $db->condition = "`library_id` = " . $row_library['library_id'];
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

                $result .= '<div class="answer text-right"><label id="examination-results" class="result"></label><button type="submit" class="btn btn-success btn-round">NỘP BÀI <i class="fa fa-fw fa-hourglass-half fa-fw"></i></button></div>';
                $result .= '</form>';
                $result .= '</div>';

                $result .= '</div>';
                $minutes = intval($row['time']) - (($current_time-$start)/60);
                $minutes = '<div id="exa-timer">' . $minutes . ':00</div><script>startTimer();$(function(){$(".square-green input").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",increaseArea:"20%"})});</script>';
            }
            $result .= '<div class="modal-footer"></div></div></div>';
        //}
    }

    echo $result . $minutes;
	
} else $result .= 'Error--';