<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = '<li><a href="' . HOME_URL_LANG . '/examination" title="Kỳ kiểm tra">Kỳ kiểm tra</a></li>';
?>
<main class="home">
	<div class="row no-margin category-header">
		<div class="row container">
			<?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . '</ul>';?>
			<div class="row no-margin category-header-name"><h2>Kỳ kiểm tra</h2></div>
		</div>
	</div>
	<div class="row no-margin faq-container">
		<div class="container">
            <?php
            if($account["id"]>0) {
                $date = new DateClass();

                $db->table = "examination";
                $db->condition = "`is_active` = 1 AND `examination_id` IN (SELECT `examination_id` FROM `" . TTH_DATA_PREFIX . "examination_logs` WHERE `user_id` = " . $account["id"] . ")";
                $db->order = "`start` DESC";
                $db->limit = "";
                $db->select();
                $total = $db->RowCount;
				//echo("here".$total);
                if($total>0) {
                    $total_pages = 0;
                    $per_page = 10;
                    if($total%$per_page==0) $total_pages = $total/$per_page;
                    else $total_pages = floor($total/$per_page)+1;
                    if($page<=0) $page=1;
                    $start=($page-1)*$per_page;

                    $db->table = "examination";
                    $db->condition = "`is_active` = 1 AND `examination_id` IN (SELECT `examination_id` FROM `" . TTH_DATA_PREFIX . "examination_logs` WHERE `user_id` = " . $account["id"] . ")";
                    $db->order = "`start` DESC";
                    $db->limit = $start . ", " . $per_page;
                    $rows = $db->select();

                    echo '<div class="faq-content"><ul class="examination">';
                    foreach($rows as $row) {
                        echo '<li><a data-target="#el-modal" data-toggle="modal" href="javascript:;" onclick="return open_modal(' . intval($row['examination_id']) . ', \'examination\');"><i class="fa fa-chevron-right"></i> ' . stripslashes($row['title']) . '</a><p class="info"><label><span>Chủ đề khóa học:</span> '  . getNameProductMenu($row['product_menu_id']) . '</label> - <label><span>Khóa học:</span> '  . getNameProductExa($row['product_id']) . '</label> - <label><span>Số câu hỏi:</span> '  . intval($row['count']) . '</label> - <label><span>Thời gian làm bài:</span> '  . intval($row['time']) . ' (phút)</label> - <label><span>Lúc bắt đầu:</span> <strong class="start">'  . $date->vnDateTime($row['start']) . '</strong></label> - <label><span>Người tạo:</span> '  . getUserFullName($row['user_id']) . '</label></p></li>';
                    }
                    echo '</ul></div>';

                    showPageNavigation($page, $total_pages, HOME_URL_LANG . '/examination?p=');
                }
            }
            ?>
		</div>
	</div>
</main>