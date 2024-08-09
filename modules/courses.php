<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//

//
$stringObj = new StringClass();
foreach($rows_crs as $row_crs) {
	$logs = array();
	$db->table = "courses_logs";
	$db->condition = "`user_id` = " . $account["id"];
	$db->order = "";
	$db->limit = "";
	$rows_log = $db->select();
	foreach($rows_log as $row_log) {
		array_push($logs, $row_log['courses_id']);
	}
	$logs = array_filter($logs);

	$db->table = "product";
	$db->condition = "`is_active` = 1  AND `product_id` = $id_article";
	$db->order = "";
	$db->limit = 1;
	$rows_pd = $db->select();
	foreach($rows_pd as $row_pd) {
		$link = HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row_pd['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row_pd['name'], $row_pd['product_id']);
	}

	$db->table = "courses";
	$db->condition = "`is_active` = 1  AND `product_id` = $id_article";
	$db->order = "`sort` ASC";
	$db->limit = "";
	$rows_cs = $db->select();
	$i = 0;
	$list_lecture = $error_link = '';
	$link_next = $error_test = 0;
	foreach($rows_cs as $row_cs) {
		$i++;
		$active = '';
		if($link_next==1) {
			$link_next = $link . '?list=' . $row_cs['courses_id'];
		}
		if($courses==$row_cs['courses_id']) {
			$active = ' active';
			$link_next = 1;
		}
		if($link_next==0) {
			$count_correct = 0;
			$db->table = "test_logs";
			$db->condition = "`courses_id` = " . $row_cs['courses_id'] . " AND `user_id` = " . $account["id"];
			$db->order = "`count_correct` DESC";
			$db->limit = 1;
			$rows_test = $db->select();
			foreach($rows_test as $row_test) {
				$count_correct = $row_test['count_correct'];
			}
			if($count_correct<$row_cs['test']) {
				$error_test = 1;
				$error_link = $link . '?list=' . $row_cs['courses_id'] . '&error=1';
			}
		}
		$status = ' learning';
		if(in_array($row_cs['courses_id'], $logs)) $status = ' completed';

		$list_lecture .= '<div class="row chap-item' . $active . '"><a href="'. $link . '?list=' . $row_cs['courses_id'] . '"><div class="row item-container">';
		$list_lecture .= '<div class="chap-item-status"><div class="status-container' . $status . '"><i class="fa fa-check-circle"></i></div></div>';
		$list_lecture .= '<div class="chap-item-content">';
		$list_lecture .= '<div class="row no-margin"><span>Bài giảng ' . $i . ':</p><p class="no-margin lecture-header-name">' . stripslashes($row_cs['name']) . '</span></div>';
		$list_lecture .= '<div class="row no-margin"><div class="row type-document"><ul class="no-padding">';
		$list_lecture .= '<li><i class="fa fa-play-circle"></i></li><li><span>' . stripslashes($row_cs['video_playtime']) . '</span></li><li><i class="fa fa-comments"></i></li>';
		$list_lecture .= '</ul></div></div>';
		$list_lecture .= '</div>';
		$list_lecture .= '</div></a></div>';
	}

	if($error_test==0) {
		$db->table = "courses_logs";
		$db->condition = "`courses_id` = $courses AND `user_id` = " . $account["id"];
		$db->order = "";
		$db->limit = 1;
		$rows_log = $db->select();
		if($db->RowCount>0) {
			$data = array(
					'modified_time' => time()
			);
			$db->condition = "`courses_id` = $courses AND `user_id` = " . $account["id"];
			$db->update($data);
		} else {
			$data = array(
					'courses_id' => $courses,
					'created_time' => time(),
					'modified_time' => time(),
					'user_id' => $account["id"]
			);
			$db->insert($data);
		}
?>

<div class="row no-margin lecture">
	<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 lecture-player">
		<div class="row lecture-player-header no-margin position-relative">
			<div><a class="lecture-back" href="<?php echo $link;?>"><i class="fa fa-play-circle"></i><span>Quay lại</span></a></div>
		</div>
		<div class="row lecture-player-main no-margin">
		<?php 
	if ($row_cs["video"] == "-no-")
	{
        //echo(ROOT_DIR.DS.'css'.DS.'ViewerJS'.DS);
		//echo HOME_URL . '/uploads/courses/' . str_replace(DS, '/', $row_crs['v_folder']) . $row_crs['document'];
		//disableDivVideo();
	}
	else echo("Có video ...");?>
	<div>
		
	</div>
			<div id="video-container">
				 
					<!--video id="video_player" controls="controls" width="100%" height="auto"><source src="<!--?php //echo HOME_URL . '/uploads/courses/' . str_replace(DS, '/', $row_crs['v_folder']) . $row_crs['video'];?>" type="video/mp4"/></video-->
					<iframe src="<?php echo $row_crs['link2Documents'] . '/preview';?>" width="640" height="480" allow="autoplay"></iframe>
			</div>
		</div>
		<div class="row lecture-player-footer no-margin position-relative">
			<div>
				<a class="lecture-autoplay">
					<label>Tự động chạy<input class="ios-switch red tinyswitch" id="autoplay" type="checkbox"><div><div></div></div></label>
				</a>
				<?php
				echo '<ul class="no-padding lecture-tools">';
				if($row_crs['practice']!='') {
					echo '<li><span class="course-btn-test"><a target="_blank" class="blue" href="' . stripslashes($row_crs['practice']) . '">Bài thực hành <i class="fa fa-fw fa-university"></i></a></span></li>';
				}
				echo '<li><span class="course-btn-test"><a data-target="#register-modal" data-toggle="modal" href="javascript:;">Bài kiểm tra <i class="fa fa-fw fa-mortar-board"></i></a></span></li>';
				if(!is_int($link_next)) {
					echo '<li><a class="player-navigation-next" href="' . $link_next . '"><span class="text">Bài tiếp</span><span class="icon"><i class="fa fa-step-forward"></i></span></a></li>';
				}
				echo '</ul>';
				?>
			</div>

		</div>
	</div>
	<div class="col-xs-0 col-sm-5 col-md-4 col-lg-3 lecture-container no-padding">
		<ul class="nav nav-tabs lecture-container-header">
			<li class="active">
				<a data-toggle="tab" href="#lecture-tab-list">
					<i class="fa fa-list"></i>
					Giáo trình
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#lecture-tab-download">
					<i class="fa fa-download"></i>
					Tài liệu
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#lecture-tab-discussion">
					<i class="fa fa-comments"></i>
					Thảo luận
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="lecture-tab-list">
				<div class="row no-margin list-lecture-container"><?php echo $list_lecture;?></div>
			</div>
			<div class="tab-pane fade" id="lecture-tab-download">
				<a class="extend" href="javascript:;" onclick="return extend($(this));" title="Mở rộng nội dung" rel="1"><i class="fa fa-angle-double-left"></i> Mở rộng</a>
				<div class="empty-document">
					<?php
					if(file_exists(ROOT_DIR  . DS . 'uploads' . DS . 'courses' . DS . $row_crs['d_folder'] . $row_crs['document']) && ($row_crs['document']!='-no-'))
						echo '<div class="text-center"><label>' . stripslashes($row_crs['document_title']) . '</label> &nbsp; <a class="btn btn-primary btn-round" target="_blank" href="' . HOME_URL  . '/uploads/courses/' . str_replace(DS, '/', $row_crs['d_folder']) . $row_crs['document'] . '">Tải về <i class="fa fa-fw fa-download"></i></a> <span>(' . size_format($row_crs['document_size']) . ')</span></div>';
					?>
				</div>
				<div class="empty-document"><?php echo stripslashes($row_crs['content']);?></div>
			</div>
			<div class="tab-pane fade" id="lecture-tab-discussion">
				<form id="form-discussion" class="discussion" method="post" onsubmit="return post_discussion('form-discussion', 'result-discussion', 0);">
					<input type="hidden" name="product" value="<?php echo $id_article;?>">
					<input type="hidden" name="course" value="<?php echo $courses;?>">
					<label><textarea class="form-control discussion-content" name="content" placeholder="Nhập nội dung thảo luận..." rows="3" required></textarea></label>
					<label><button type="submit" name="discussion" class="btn btn-primary lecture-discussion-submit">Đăng thảo luận</button></label>
				</form>
				<div class="row list-discussion">
					<div id="result-discussion" class="col-xs-12 col-sm-12 discussions-list">
						<?php
						$id_load = 0;
						$db->table = "discussion";
						$db->condition = "`is_active` = 1 AND `parent` = 0 AND `courses_id` = $courses";
						$db->order = "`created_time` DESC";
						$db->limit = 5;
						$rows_cm = $db->select();
						foreach($rows_cm as $row_cm) {
							$USER_CM = getInfoUser($row_cm['user_id']);
							$id_load = $row_cm['discussion_id'];
							echo '<div class="discussion-parent no-margin row">';
							echo '<div class="left"><img class="discussion-avatar" src="' . $USER_CM[4] . '" alt=""></div>';
							echo '<div class="right">';
							echo '<div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CM[0] . '</label> <label class="created_at">- ' . convertTimeAgo($row_cm['created_time']) . '</label></div>';
							echo '<div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($row_cm['content']) . '</div></div>';

							$db->table = "discussion";
							$db->condition = "`parent` = " . $row_cm['discussion_id'];
							$db->order = "`created_time` ASC";
							$db->limit = "";
							$rows_cmp = $db->select();
							$b_id = md5('list' . $row_cm['discussion_id']);

							if($db->RowCount > 0) $b_feedback = ' Phản hồi ('. $db->RowCount .')';
							else  $b_feedback = ' Phản hồi';

							echo '<div class="col-xs-12 col-sm-12 no-padding">';
							echo '<label class="reply" discussion-id="' . $b_id . '">' . $b_feedback . '</label>';
							echo '<div class="row no-margin discussion-parent-options" id="' . $b_id . '">';

							echo '<div class="row no-margin discussion-child-list">';
							foreach($rows_cmp as $row_cmp) {
								$USER_CMP = getInfoUser($row_cmp['user_id']);
								echo '<div class="discussion-child no-margin row">';
								echo '<div class="left"><img class="discussion-avatar" src="' . $USER_CMP[4] . '" alt=""></div>';
								echo '<div class="right">';
								echo '<div class="col-xs-12 col-sm-12 no-padding"><label class="name">' . $USER_CMP[0] . '</label> <label class="created_at">- ' . convertTimeAgo($row_cmp['created_time']) . '</label></div>';
								echo '<div class="col-xs-12 col-sm-12 no-padding"><div class="content">' . stripslashes($row_cmp['content']) . '</div></div>';
								echo '</div>';
								echo '</div>';
							}
							echo '</div>';
							echo '<div class="row no-margin discussion-reply"><form id="form-' . $b_id . '" class="discussion" method="post" onsubmit="return post_discussion(\'form-' . $b_id . '\', \'' . $b_id . '\', ' . $row_cm['discussion_id'] . ');"><label><textarea class="form-control discussion-content" name="content" placeholder="Nhập nội dung phản hồi..." rows="3" required></textarea></label><label><button type="submit" name="discussion" class="btn btn-primary lecture-discussion-submit">Đăng thảo luận</button></label></form></div>';

							echo '</div>';
							echo '</div>';

							echo '</div>';
							echo '</div>';
						}
						?>
					</div>
				</div>
				<div class="row no-margin load-more-discussions"><a href="javascript:;" onclick="return load_discussions('result-discussion', 2, $(this));" rel="<?php echo $id_load;?>">Xem thêm các thảo luận khác</a></div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="register-modal">
		<div class="modal-dialog" style="width: auto !important;">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
					<h3 class="modal-title">BÀI KIỂM TRA</h3>
					<p class="no-margin text-center"><?php echo stripslashes($row_crs['name']);?></p>
				</div>
				<div class="modal-body question-view">
					<form id="fm-test" name="test" method="post" onsubmit="return test_answer('fm-test');">
						<?php
						echo '<input type="hidden" name="course" value="' . $courses . '">';
						$db->table = "test";
						$db->condition = "`is_active` = 1 AND `courses_id` = $courses";
						$db->order = "`sort` ASC";
						$db->limit = "";
						$rows_test = $db->select();
						$i = 0;
						foreach($rows_test as $row_test){
							$i++;
							echo '<div class="question">';
							echo '<label class="question-title">Câu ' . $i . ':</label>';
							echo '<div class="question-content">' . stripslashes($row_test['content']) . '</div>';

							if($row_test['type']>0) {
								echo '<div class="question-answer"><label class="text-editor"><textarea class="editor" name="answer[' . $row_test['test_id'] . '][]" placeholder="Nhập câu trả lời của bạn..."></textarea></label></div>';
							} else {
								$db->table = "answer";
								$db->condition = "`correct` = 1 AND `test_id` = " . $row_test['test_id'];
								$db->order = "`answer_id` ASC";
								$db->limit = "";
								$db->select();
								$correct = $db->RowCount;

								$db->table = "answer";
								$db->condition = "`test_id` = " . $row_test['test_id'];
								$db->order = "`answer_id` ASC";
								$db->limit = "";
								$rows_as = $db->select();
								foreach ($rows_as as $row_as) {
									if ($correct > 1) echo '<div class="question-answer icheck"><div class="square-green single-row"><label class="checkbox"><input type="checkbox" name="answer[' . $row_as['test_id'] . '][]" value="' . $row_as['answer_id'] . '"><span>' . stripslashes($row_as['title']) . '</span></label></div></div>';
									else echo '<div class="question-answer icheck"><div class="square-green single-row"><label class="radio"><input type="radio" name="answer[' . $row_as['test_id'] . '][]" value="' . $row_as['answer_id'] . '"><span>' . stripslashes($row_as['title']) . '</span></label></div></div>';
								}
							}
							echo '</div>';
						}
						?>
						<div class="answer text-right"><label id="test-results" class="result"></label><button type="submit" class="btn btn-success btn-round">NỘP BÀI <i class="fa fa-fw fa-hourglass-half fa-fw"></i></button></div>
					</form>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>
<script>
    // Ví dụ vô hiệu hóa bằng JavaScript
	function disableDivVideo(){
		document.getElementById('test2024').setAttribute('disabled', 'true');
	}
</script>
<?php
	if(isset($_GET['error']) && $_GET['error']==1) {
		echo '<div class="modal fade in" id="compel-modal"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div class="result" style="display:block;font-size:20px;font-weight:300;line-height:30px;"><div class="failed">Yêu cầu bạn phải hoàn thành bài kiểm tra trước khi bước vào một bài giảng mới.</div></div></div></div></div></div>';
		echo '<script type="text/javascript">$(document).ready(function(){$(\'#compel-modal\').modal(\'show\');});</script>';

	}
	} else exit(header('Location: ' . $error_link));
}