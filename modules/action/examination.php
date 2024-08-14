<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$id             = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $date           = new DateClass();
	$result         = '';
	$status         = $start = $solanthi = 0;
    $current_time   = strtotime($date->vnOther(time(), 'Y-m-d H:i'));

	$db->table = "examination_logs";
	$db->condition = "`examination_id` = $id AND `user_id` = " . intval($account["id"]);
	$db->order = "`examination_logs_id` DESC";
	$db->limit = 1;
	$rows = $db->select();
    foreach ($rows as $row) {
        $status = intval($row['status']);
        $start  = intval($row['start']);
    }

    $db->table = "examination";
    $db->condition = "`examination_id` = $id";
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
	if($db->RowCount>0) {
        $result .= '<div class="modal-dialog" style="width: auto !important;"><div class="modal-content">';
        foreach ($rows as $row) {
            // Check :::
            // can modify here .... maby 
            $check = 0;
            $minutes = intval($row['time']) - (($current_time-$start)/60);
            if($status==0) {
                if($current_time<intval($row['start'])) $check = 1;
                elseif($start==0) $check = 2;
                elseif($minutes>0) $check = 3;
                else $check = 4;
            } else $check = 0;

            $result .= '<div class="modal-header"><button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button><h3 class="modal-title">_KỲ KIỂM TRA_</h3><p class="no-margin text-center">' . stripslashes($row['title']) . '</p></div>';
            $result .= '<div class="modal-body">';

            $result .= '<div class="examination-info">';
            $result .= '<h4><label>Tiêu đề:</label> ' . stripslashes($row['title']) . '</h4>';
            $result .= '<p><label>Chủ đề khóa học:</label> ' . getNameProductMenu($row['product_menu_id']) . '</p>';
            $result .= '<p><label>Khóa học:</label> ' . getNameProductExa($row['product_id']) . '</p>';
            $result .= '<p><label>Số câu hỏi:</label> ' .  intval($row['count']) . '</p>';
            $result .= '<p><label>Số lần được kiểm tra lại:</label> ' .  intval($row['solanthi']) . '</p>';
            $result .= '<p><label>Thời gian làm bài:</label> ' .  intval($row['time']) . ' (phút)</p>';
            $result .= '<p><label>Lúc bắt đầu:</label> <strong class="start">' .  $date->vnDateTime($row['start']) . '</strong></p>';
            $result .= '<p><label>Người tạo:</label> ' .  getUserFullName($row['user_id']) . '</p>';
            $result .= '</div>';
            $solanthi = intval($row['solanthi']);
            //echo ("biến check là: $check");
            if($check==0) {
                // $db->table = "examination_answer";
                // $db->condition = "`examination_id` = $id AND `user_id` = " . intval($account["id"]) . " AND `test` = 1";
                // $db->order = "";
                // $db->limit = "";
                // $db->select();
                // $total_match = $db->RowCount;
                // $mix = round(intval($row['count'])/2, 0);
                $result .= '<div class="result" style="display: block !important; margin-top: 30px;">';
                //------------------------------------------------------------------------------------
                $db->table = "examination_logs";
                $db->condition = "`examination_id` = $id AND `user_id` = " . intval($account["id"]) . " AND `status` = 1";
                $db->order = "";
                $db->limit = "";
                $row_needs = $db->select();
                $total_match = $db->RowCount; // số lần thi
                $lanthi = 0;
                $current_score = 0;
                foreach ($row_needs as $lanthithu) {
                    $lanthi++;
                    $current_score = intval($lanthithu['score']);
                    if ($current_score >= 50)
                        $result .= '<div class="success">Bạn thi lần thứ: <strong>' . $lanthi. '</strong> đạt '. $current_score.' (điểm) </div>';
                    else $result .= '<div class="failed">Bạn thi lần thứ: <strong>' . $lanthi. '</strong> đạt '. $current_score.' (điểm) </div>';
                }
                
                if($total_match >=1) $result .= '<div class="success">Bạn đã thi <strong>' . $total_match. '</strong> (lần).</div>';
                // else $result .= '<div class="failed">Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . intval($row['count']) . '</strong> (câu).</div>';
                $result .= '</div>';
				$result .= '<div class="exa-btn text-center" style="margin-top: 20px;">';
				// $result .= '<button type="button" class="btn btn-info btn-round" onclick="return viewAnswers(' . intval($row['examination_id']) . ' ,' . intval($account["id"]) . ');">Xem lại đáp án</button>';
				
                $result .= '</div>';
                if ($current_score <= 80) 
                    if ($lanthi < $solanthi)
                        $result .= '<div class="exa-btn text-center"><button type="button" class="btn btn-danger btn-round" onclick="return open_modal(' . intval($row['examination_id']) . ', \'examination_tick\');">Kiểm tra lại</button></div>';
                    else $result .= '<div class="btn btn-danger btn-round text-center">Số lần thi lại đã hết!!!</div>';
                
            } elseif($check==1)
                $result .= '<div class="exa-btn text-center"><button type="button" class="btn btn-default btn-round">Kiểm tra chưa bắt đầu</button></div>';
            elseif($check==2) $result .= '<div class="exa-btn text-center"><button type="button" class="btn btn-danger btn-round" onclick="return open_modal(' . intval($row['examination_id']) . ', \'examination_tick\');">Bắt đầu kiểm tra</button></div>';
            elseif($check==3)
                $result .= '<div class="exa-btn text-center"><button type="button" class="btn btn-danger btn-round" onclick="return open_modal(' . intval($row['examination_id']) . ', \'examination_tick\');">Bắt đầu kiểm tra, làm tiếp...</button></div>';
            elseif($check==4)
                $result .= '<div class="exa-btn text-center"><button type="button" class="btn btn-info btn-round">Kiểm tra đã kết thúc, chưa nộp bài!</button></div>';
            else {}

            $result .= '</div>';
        }
        $result .= '<div class="modal-footer"></div></div></div>';
    }

    echo $result;
	
} else echo 'Error--';