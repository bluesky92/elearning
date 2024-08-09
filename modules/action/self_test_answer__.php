<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
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
	echo ("số hàng: ".$rows);
    foreach ($rows as $row) {
        $status = intval($row['status']);
        $start  = intval($row['start']);
    }

    $minutes = ($time + 3) - (($current_time-$start)/60);

    if($minutes>0 && $status==0) {
        $db->table = "self_test";
        $data = array(
            'status' => 1,
            'end' => $current_time
        );
        $db->condition = "`self_test_id` = $self_test_id AND `user_id` = " . intval($account["id"]);
        $db->update($data);
        //---
		$indexQuestion = 0;
        foreach($answer as $key => $value) {
			$indexQuestion+=1;
            $type = $test = 0;
            $db->table = "library";
            $db->condition = "`library_id` = $key";
            $db->order = "";
            $db->limit = 1;
            $rows = $db->select();
            foreach ($rows as $row) {
                $type = intval($row['type']);
            }
            //---
            $db->table = "library_answer";
            $db->condition = "`library_id` = $key AND `correct` = 1";
            $db->order = "";
            $db->limit = "";
            $rows_ans = $db->select();
            $correct = array();
            foreach($rows_ans as $row_ans) {
                array_push($correct, $row_ans['library_answer_id']);
            }

            $correct = array_filter($correct);
            if(!array_diff($correct, $value) && !empty($value) && $type==0) {
                $total_match++;
                $test = 1;
            }
            //---
            $value = array_filter($value);
            $value = array_keys(array_flip($value));
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            $db->table = "self_test_answer";
            $data = array(
                'self_test_id' => $self_test_id,
                'user_id' => intval($account["id"]),
                'library_id' => intval($key),
                'type' => intval($type),
                'answer' => $db->clearText($value),
                'test' => intval($test),
                'modified_time' => intval($current_time)
            );
            $db->insert($data);
        }

        $mix = round($count/2, 0);
        if($total_match >= $mix) echo '<div class="success">NỘP BÀI THÀNH CÔNG. Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . $count . '</strong> (câu).</div>';
        else echo '<div class="failed">NỘP BÀI THÀNH CÔNG. Kết quả bài kiểm tra của bạn: <strong>' . $total_match . '/' . $count . '</strong> (câu).</div>';

    } elseif($status==1) echo '<div class="failed">LỖI! Bài kiểm tra này bạn đã hoàn thành trước đó.</div>';
    else echo '<div class="failed">LỖI! Bạn nộp bài quá thời gian quy định.</div>';

} else echo 'Error--';