<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

if($account["id"]>0) {
    $self_test_id   = isset($_POST['self_test_id']) ? intval($_POST['self_test_id']) : 0;
    $answer         = isset($_POST['answer']) ? $_POST['answer'] : array();
    $date           = new DateClass();
    $status         = $start = $time = $count = $total_match = 0;
    $current_time   = strtotime($date->vnOther(time(), 'Y-m-d H:i'));

    $count          = intval(getConstant('test_count'));
    $time           = intval(getConstant('test_time'));

    $db->table = "self_test";
    $db->condition = "`self_test_id` = $self_test_id AND `user_id` = " . intval($account["id"]);
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    foreach ($rows as $row) {
        $status = intval($row['status']);
        $start  = intval($row['start']);
    }

    $minutes = ($time + 3) - (($current_time - $start) / 60);

    if ($minutes > 0 && $status == 0) {
        $db->table = "self_test";
        $data = array(
            'status' => 1,
            'end' => $current_time
        );
        $db->condition = "`self_test_id` = $self_test_id AND `user_id` = " . intval($account["id"]);
        $db->update($data);

        $total_match = 0;
        $results_html = '';

        foreach ($answer as $key => $value) {
            $type = $test = 0;
            $db->table = "library";
            $db->condition = "`library_id` = $key";
            $db->order = "";
            $db->limit = 1;
            $rows = $db->select();
            foreach ($rows as $row) {
                $type = intval($row['type']);
                $question_content = stripslashes($row['content']);
            }
			//-----
			/*
			$db->table = "library_answer";
            $db->condition = "`library_id` = $key AND `library_answer_id`=$value";
            $db->order = "";
            $db->limit = "";
            $record_ans = $db->select();
			$user_ans_text = array();
			foreach ($record_ans as $rec_ans) {
                array_push($user_ans_text, $rec_ans['title']);
            }
			$user_ans_text = array_filter($user_ans_text);
			*/
			//
            $db->table = "library_answer";
            $db->condition = "`library_id` = $key AND `correct` = 1";
            $db->order = "";
            $db->limit = "";
            $rows_ans = $db->select();
            $correct = array();
            $correct_ans_text = array();
            foreach ($rows_ans as $row_ans) {
                array_push($correct, $row_ans['library_answer_id']);
                array_push($correct_ans_text, $row_ans['title']);
            }

            $correct = array_filter($correct);
            $correct_ans_text = array_filter($correct_ans_text);
			
            $user_answers = array_filter($value);
			
            $is_correct = !array_diff($correct, $user_answers) && !empty($user_answers) && $type == 0;

            if ($is_correct) {
                $total_match++;
                $test = 1;
            }

            $user_answers_html = '';
            foreach ($user_answers as $answer_id) {
				$db->table = "library_answer";
				$db->condition = "`library_id` = $key AND `library_answer_id`=$answer_id";
				$db->order = "";
				$db->limit = "";
				$record_ans = $db->select();
				var_dump($record_ans);
                $user_answers_html .= '<span>' . htmlspecialchars($record_ans['title']) . '</span> ';
            }
			$correct_answers_html = '';
			foreach ($correct_ans_text as $correct_id) {
                $correct_answers_html .= '<span>' . htmlspecialchars($correct_id) . '</span> ';
            }

            $results_html .= '<div class="question">';
            $results_html .= '<label class="question-title">Câu hỏi ID: ' . $key . '</label>';
            $results_html .= '<div class="question-content">' . $question_content . '</div>';
            $results_html .= '<div class="user-answers"><strong>Câu trả lời của bạn: </strong>' . $user_answers_html . '</div>';
            $results_html .= '<div class="user-answers"><strong>Đáp án đúng là: </strong>' . $correct_answers_html . '</div>';

            if ($test) {
                $results_html .= '<div class="question-answer true">Đúng!</div>';
            } else {
                $results_html .= '<div class="question-answer false">Sai!</div>';
            }

            $results_html .= '</div>';
        }

        $mix = round($count / 2, 0);
        $result_message = $total_match >= $mix 
            ? '<div class="success">NỘP BÀI THÀNH CÔNG. Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . $count . '</strong> (câu).</div>'
            : '<div class="failed">NỘP BÀI THÀNH CÔNG. Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . $count . '</strong> (câu).</div>';

        echo $result_message . $results_html;

    } elseif ($status == 1) {
        echo '<div class="failed">LỖI! Bài kiểm tra này bạn đã hoàn thành trước đó.</div>';
    } else {
        echo '<div class="failed">LỖI! Bạn nộp bài quá thời gian quy định.</div>';
    }

} else {
    echo 'Error--';
}
