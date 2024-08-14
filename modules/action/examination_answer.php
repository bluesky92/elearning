<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
    $examination    = isset($_POST['examination']) ? intval($_POST['examination']) : 0;
    $answer         = isset($_POST['answer']) ? $_POST['answer'] : array();
    $date           = new DateClass();
    $status         = $start = $time = $count = $total_match = $examination_logs_id=0;
    $current_time   = strtotime($date->vnOther(time(), 'Y-m-d H:i'));

    $db->table = "examination_logs";
    $db->condition = "`examination_id` = $examination AND `user_id` = " . intval($account["id"]);
    $db->order = "`examination_logs_id` DESC";
    $db->limit = 1;
    $rows = $db->select();
    foreach ($rows as $row) {
        $status = intval($row['status']);
        $start  = intval($row['start']);
        $examination_logs_id = intval($row['examination_logs_id']);
    }
    // var_dump($rows);
    // echo ("examination_logs_id là: $examination_logs_id");
    $db->table = "examination";
    $db->condition = "`examination_id` = $examination";
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    foreach ($rows as $row) {
        $time = intval($row['time']);
        $count = intval($row['count']);
    }

    $minutes = ($time + 3) - (($current_time-$start)/60);
    // echo ($minutes);
    //if($minutes>0 && $status==0) {
    if($minutes>0) {
        
        //---
        $indexQuestion = 0;
        foreach($answer as $key => $value) {
            $indexQuestion += 1;
            $type = $test = 0;
            $db->table = "library";
            $db->condition = "`library_id` = " . intval($key);
            $db->order = "";
            $db->limit = 1;
            $rows = $db->select();
            $question_content = '';
            foreach ($rows as $row) {
                $type = intval($row['type']);
                $question_content = stripslashes($row['content']);
            }
            //---// Lấy các đáp án đúng
            $db->table = "library_answer";
            $db->condition = "`library_id` = " . intval($key) . " AND `correct` = 1";
            $db->order = "";
            $db->limit = "";
            $rows_ans = $db->select();
            $correct = array();
            $correct_ans_text = array();
            foreach($rows_ans as $row_ans) {
                array_push($correct, $row_ans['library_answer_id']);
                array_push($correct_ans_text, $row_ans['title']);
            }
            // Lấy tất cả các đáp án
            $db->table = "library_answer";
            $db->condition = "`library_id` = $key";
            $db->order = ""; 
            $db->limit = "";
            $rows_all_ans = $db->select();

            $all_answers_html = '';
            foreach ($rows_all_ans as $row_ans) {
                $answer_id = $row_ans['library_answer_id'];
                $answer_title = htmlspecialchars($row_ans['title']);
                
                $class = '';
                if (in_array($answer_id, $correct)) {
                    $class = 'correct';
                } elseif (in_array($answer_id, $value)) {
                    $class = 'selected';
                }
                
                $all_answers_html .= '<div class="answer-option ' . $class . '">' . $answer_title . '</div>';
            }
            $correct = array_filter($correct);
            $user_answers = array_filter($value);
            $is_correct = !array_diff($correct, $user_answers) && !empty($user_answers) && $type == 0;

            if ($is_correct) {
                $total_match++;
                $test = 1;
            }
            $results_html .= '<div class="question">';
            $results_html .= '<label class="question-title">Câu ' . $indexQuestion . ':</label>';
			if ($test) {
                $results_html .= '<label class="question-answer true">Đúng!</label>';
            } else {
                $results_html .= '<label class="question-answer false">Sai!</label>';
            }
            $results_html .= '<div class="question-content" style="text-align: left;">' . $question_content . '</div>';
            $results_html .= '<div class="all-answers" style="text-align: left;"><strong>Các lựa chọn:</strong>' . $all_answers_html . '</div>';
            $results_html .= '</div>';
            //---
            $value = array_filter($value);
            $value = array_keys(array_flip($value));
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            $db->table = "examination_answer";
            $data = array(
                'examination_id' => $examination,
                'user_id' => intval($account["id"]),
                'library_id' => intval($key),
                'examination_logs_id' => intval($examination_logs_id),
                'type' => intval($type),
                'answer' => $db->clearText($value),
                'test' => intval($test),
                'modified_time' => intval($current_time)
            );
            $db->insert($data);
        }
        // Tính toán trước
        $mix = round($count/2, 0);
        $score_student = round(($total_match/$count)*100);
        // cập nhật điểm vào ... DB
        // echo ("điểm đạt được là: $score_student");
        $db->table = "examination_logs";
        $data = array(
            'status' => 1,
            'end' => $current_time,
            'score' => $score_student
        );
        // $db->condition = "`examination_id` = $examination AND `user_id` = " . intval($account["id"]);
        $db->condition = "`examination_logs_id` = $examination_logs_id";
        $db->update($data);
        
        $result_message = $total_match >= $mix
        ? '<div class="success">NỘP BÀI THÀNH CÔNG. Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . $count . '</strong> (câu). Đạt '.$score_student.' %</div>'
        : '<div class="failed">NỘP BÀI THÀNH CÔNG. Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . $count . '</strong> (câu).Đạt '.$score_student.' %</div>';
        echo $result_message . $results_html;
    } 
	//elseif($status==1) echo '<div class="failed">LỖI! Bài kiểm tra này bạn đã hoàn thành trước đó.</div>';
    else echo '<div class="failed">LỖI! Bạn nộp bài quá thời gian quy định.</div>';

} else echo 'Error--';