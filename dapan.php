<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0 && isset($_POST['examination_id'])) {
    $id = intval($_POST['examination_id']);
    
    $db->table = "examination_logs";
    $db->condition = "`examination_id` = $id AND `user_id` = " . intval($account["id"]);
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();

    if($db->RowCount>0) {
        $output = '<div class="answer-review">';

        foreach ($rows as $row) {
            // Truy vấn câu hỏi và đáp án từ database
            // Hiển thị câu hỏi và đáp án đã chọn
            $output .= '<div class="question">';
            $output .= '<p>' . stripslashes($row['question_content']) . '</p>';

            // Hiển thị đáp án
            $output .= '<div class="answers">';
            $db->table = "examination_answer";
            $db->condition = "`examination_id` = $id AND `user_id` = " . intval($account["id"]);
            $db->select();
            foreach ($db->rows as $answer) {
                $is_correct = $answer['correct'] ? 'correct' : '';
                $output .= '<div class="answer ' . $is_correct . '">' . htmlspecialchars($answer['content']) . '</div>';
            }
            $output .= '</div>'; // .answers
            $output .= '</div>'; // .question
        }

        $output .= '</div>'; // .answer-review
        echo $output;
    } else {
        echo 'Không tìm thấy thông tin kỳ kiểm tra.';
    }
} else {
    echo 'Có lỗi xảy ra. Vui lòng thử lại sau.';
}
?>
