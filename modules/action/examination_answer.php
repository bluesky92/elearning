<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
    $examination    = isset($_POST['examination']) ? intval($_POST['examination']) : 0;
    $answer         = isset($_POST['answer']) ? $_POST['answer'] : array();
    $date           = new DateClass();
    $status         = $start = $time = $count = $total_match = 0;
    $current_time   = strtotime($date->vnOther(time(), 'Y-m-d H:i'));

    $db->table = "examination_logs";
    $db->condition = "`examination_id` = $examination AND `user_id` = " . intval($account["id"]);
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    foreach ($rows as $row) {
        $status = intval($row['status']);
        $start  = intval($row['start']);
    }
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

    if($minutes>0 && $status==0) {
        $db->table = "examination_logs";
        $data = array(
            'status' => 1,
            'end' => $current_time
        );
        $db->condition = "`examination_id` = $examination AND `user_id` = " . intval($account["id"]);
        $db->update($data);
        //---
        foreach($answer as $key => $value) {
            $type = $test = 0;
            $db->table = "library";
            $db->condition = "`library_id` = " . intval($key);
            $db->order = "";
            $db->limit = 1;
            $rows = $db->select();
            foreach ($rows as $row) {
                $type = intval($row['type']);
            }
            //---
            $db->table = "library_answer";
            $db->condition = "`library_id` = " . intval($key) . " AND `correct` = 1";
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
            $db->table = "examination_answer";
            $data = array(
                'examination_id' => $examination,
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