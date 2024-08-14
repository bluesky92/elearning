<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['id'])) {
	$id     = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $user   = isset($_POST['user']) ? intval($_POST['user']) : 0;
    $examination_logs_id   = isset($_POST['exam_logs_id']) ? intval($_POST['exam_logs_id']) : 0;
	$date   = new DateClass();

    $result = $examination_title = $examination_time = $examination_count = $examination_start = $examination_end  = '';
    // $examination_logs_id = 0;
    $db->table = "examination";
    $db->condition = "`examination_id` = $id";
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    foreach($rows as $row){
        $examination_title = stripslashes($row['title']);
        $examination_time = intval($row['time']);
        $examination_count = intval($row['count']);
    }

    $db->table = "examination_logs";
    $db->condition = "`examination_id` = $id AND `user_id` = $user";
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    foreach($rows as $row){
        $examination_start  = intval($row['start']);
        $examination_end    = intval($row['end']);
        // $examination_logs_id = intval($row['examination_logs_id']);
    }
    // var_dump($examination_logs_id);
    // $db->condition = "`examination_id` = $id AND `examination_logs_id` = $examination_logs_id AND `user_id` = $user";
	$db->table = "examination_answer";
    // $db->condition = "`examination_id` = $id AND `user_id` = $user";
    $db->condition = "`examination_id` = $id AND `examination_logs_id` = $examination_logs_id AND `user_id` = $user";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	if($db->RowCount > 0) {
        $result .= '<div class="modal-dialog"><div class="modal-content">';
        $result .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="examinationModalLabel">' . $examination_title .'</h4></div>';
        $result .= '<div class="modal-body">';
        $result .= '<p class="exa-info">+ <span>Họ và tên:</span> <strong>' .  getUserFullName($user) . '</strong><br>';
        $result .= '+ <span>Số câu hỏi (quy định):</span> <strong>' .  $examination_count . '</strong><br>';
        $result .= '+ <span>Thời gian làm bài (quy định):</span> <strong>' . $examination_time . ' (phút)</strong><br>';
        $result .= '+ <span>Làm kiểm tra lúc:</span> <strong class="start">' .  $date->vnDateTime($examination_start) . '</strong><br>';
        $result .= '+ <span>Nộp kiểm tra lúc:</span> <strong class="end">' .  $date->vnDateTime($examination_end) . '</strong></p>';
        $result .= '+ <span>Dev:</span> <strong class="end">' .  $examination_logs_id . '</strong></p>';

        // .question-view
        $result .= '<div class="question-view">';

        $i = 0;
        foreach($rows as $row) {
            $i++;
            $check = '';
            if(intval($row['type']) == 1) $check = '';
            elseif(intval($row['test']) == 1) $check = '<span class="question-true"style="color: #00ff1c;"><i class="fa fa-check-square"></i> (Đúng)</span>';
            else $check = '<span class="question-false" style="color: red;"><i class="fa fa-minus-square"></i> (Sai)</span>';

            $result .= '<div class="question">';
            $result .= '<label class="question-title">Câu ' . $i . ': ' . $check . '</label>';

            $db->table = "library";
            $db->condition = "`library_id` = " . intval($row['library_id']);
            $db->order = "";
            $db->limit = 1;
            $rows_library = $db->select();

            foreach($rows_library as $row_library) {
                $answer = json_decode($row['answer']);
                $result .= '<div class="question-content">' . stripslashes($row_library['content']) . '</div>';
                if ($row_library['type'] > 0) {
                    $result .= '<div class="question-answer"><label class="text-editor"><textarea class="editor" readonly>' . $answer[0] . '</textarea></label></div>';
                } else {
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
                        if ($correct > 1) {
                            $checked = $checked_class = '';
                            if(in_array($row_as['library_answer_id'], $answer)) $checked = ' checked';
                            if(intval($row_as['correct'])==1) $checked_class = ' answer-true';
                            else $checked_class = ' answer-false';

                            $result .= '<div class="question-answer' . $checked_class . '"><label><input type="checkbox" disabled' . $checked . '><span>' . stripslashes($row_as['title']) . '</span></label></div>';
                        }
                        else {
                            $checked = $checked_class = '';
                            if(in_array($row_as['library_answer_id'], $answer)) $checked = ' checked';
                            if(intval($row_as['correct'])==1) $checked_class = ' answer-true';
                            else $checked_class = ' answer-false';

                            $result .= '<div class="question-answer' . $checked_class . '"><label><input type="radio" disabled' . $checked . '><span>' . stripslashes($row_as['title']) . '</span></label></div>';
                        }
                    }
                }
            }

            $result .= '</div>';
        }
        // \.question-view
        $result .= '</div>';

        $result .= '</div>';
        $result .= '<div class="modal-footer"><button type="button" class="btn btn-form-primary btn-form" data-dismiss="modal">Đóng</button></div>';
        $result .= '</div></div>';
		// foreach($rows as $row) {
		// }
	} 
    if($db->RowCount == 0) {
        $result .= '<div class="modal-dialog"><div class="modal-content">';
        $result .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="examinationModalLabel">' . $examination_title .'</h4></div>';
        $result .= '<div class="modal-body">';
        $result .= '<p class="exa-info">+ <span>Họ và tên:</span> <strong>' .  getUserFullName($user) . '</strong><br>';
        $result .= '+ <span>Số câu hỏi (quy định):</span> <strong>' .  $examination_count . '</strong><br>';
        $result .= '+ <span>Thời gian làm bài (quy định):</span> <strong>' . $examination_time . ' (phút)</strong><br>';
        $result .= '+ <span>Làm kiểm tra lúc:</span> <strong class="start">' .  $date->vnDateTime($examination_start) . '</strong><br>';
        $result .= '+ <span>Nộp kiểm tra lúc:</span> <strong class="end">' .  $date->vnDateTime($examination_end) . '</strong></p>';
        $result .= '+ <span>Dev:</span> <strong class="end">' .  $examination_logs_id . '</strong></p>';
        $result .= ' <div style ="color: red;"> Bài kiểm tra, đã bị lỗi. Không xem được.</div>';
    }
    
	echo $result;
}