<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

if ($account["id"] > 0) {
    $self_test_id = isset($_POST['self_test_id']) ? intval($_POST['self_test_id']) : 0;
    $answer = isset($_POST['answer']) ? $_POST['answer'] : array();
    $date = new DateClass();
    $status = $start = $time = $count = $total_match = 0;
    $current_time = strtotime($date->vnOther(time(), 'Y-m-d H:i'));

    $count = intval(getConstant('test_count'));
    $time = intval(getConstant('test_time'));

    $db->table = "self_test";
    $db->condition = "`self_test_id` = $self_test_id AND `user_id` = " . intval($account["id"]);
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    foreach ($rows as $row) {
        $status = intval($row['status']);
        $start = intval($row['start']);
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

		$indexQuestion = 0;
        foreach($answer as $key => $value) {
			$indexQuestion+=1;
            $type = $test = 0;
            $db->table = "library";
            $db->condition = "`library_id` = $key";
            $db->order = "";
            $db->limit = 1;
            $rows = $db->select();
            $question_content = '';
            foreach ($rows as $row) {
                $type = intval($row['type']);
                $question_content = stripslashes($row['content']);
            }

            // Lấy các đáp án đúng
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

            // Lấy các đáp án của người dùng
            $user_answers = array_filter($value);
            $user_answers_text = array();
            foreach ($user_answers as $answer_id) {
                $db->table = "library_answer";
                $db->condition = "`library_id` = $key AND `library_answer_id` = $answer_id";
                $db->order = "";
                $db->limit = 1;
                $record_ans = $db->select();
                foreach ($record_ans as $rec_ans) {
                    array_push($user_answers_text, $rec_ans['title']);
                }
            }

            $correct = array_filter($correct);
            $is_correct = !array_diff($correct, $user_answers) && !empty($user_answers) && $type == 0;

            if ($is_correct) {
                $total_match++;
                $test = 1;
            }

            // Hiển thị các đáp án của người dùng và đáp án đúng
            $user_answers_html = implode(', ', array_map('htmlspecialchars', $user_answers_text));
            $correct_answers_html = implode(', ', array_map('htmlspecialchars', $correct_ans_text));

            $results_html .= '<div class="question">';
            $results_html .= '<label class="question-title" >Câu ' . $indexQuestion . ' :</label>';
            $results_html .= '<div class="question-content" style="text-align: left;">' . $question_content . '</div>';
            $results_html .= '<div class="question-answer"><strong>Câu trả lời của bạn: </strong>' . $user_answers_html . '</div>';
            $results_html .= '<div class="question-answer"><strong>Đáp án đúng là: </strong>' . $correct_answers_html . '</div>';

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
