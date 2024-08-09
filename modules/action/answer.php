<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($account["id"]>0) {
	$course = isset($_POST['course']) ? intval($_POST['course']) : 0;
	$answer = isset($_POST['answer']) ? $_POST['answer'] : array();

	$total_match = $total_test = 0;
	$db->table = "test";
	$db->condition = "`is_active` = 1 AND `type` = 0 AND `courses_id` = $course";
	$db->order = "`sort` ASC";
	$db->limit = "";
	$rows = $db->select();
	$total_test = $db->RowCount;
	foreach($rows as $row) {
		if(isset($answer[$row['test_id']])) {
			$db->table = "answer";
			$db->condition = "`test_id` = " . intval($row['test_id']) . " AND `correct` = 1";
			$db->order = "";
			$db->limit = "";
			$rows_an = $db->select();
			$correct = array();
			foreach($rows_an as $row_an) {
				array_push($correct, $row_an['answer_id']);
			}
			$correct = array_filter($correct);
			if(!array_diff($correct, $answer[$row['test_id']])) $total_match++;
		}
	}

	$db->table = "test_logs";
	$data = array(
		'courses_id' => $course,
		'user_id' => intval($account["id"]),
		'count_correct' => $total_match,
		'created_time' => time()
	);
	$db->insert($data);
	$id = $db->LastInsertID;

	foreach($answer as $key => $value) {
		if(count($value)>0) {
			foreach($value as $val) {
				$db->table = "answer_logs";
				if($val>0) {
					$data = array(
							'test_logs_id' => intval($id),
							'test_id' => intval($key),
							'answer_id' => intval($val),
							'type' => 0
					);
				} else {
					$data = array(
							'test_logs_id' => intval($id),
							'test_id' => intval($key),
							'type' => 1,
							'answer' => $db->clearText($val)
					);
				}
				$db->insert($data);
			}
		}
	}

	$db->table = "courses";
	$db->condition = "`courses_id` = $course";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	$test = 0;
	foreach($rows as $row) {
		$test = intval($row['test']);
	}
	if($total_match>=$test) echo '<div class="success">Bạn đã vượt qua bài kiểm tra, kết quả: <strong>' . $total_match . '/' . $total_test . '</strong> (câu).</div>';
	else echo '<div class="failed">Bạn chưa vượt qua bài kiểm tra, kết quả: <strong>' . $total_match . '/' . $total_test . '</strong> (câu).</div>';

} else echo 'Error--';