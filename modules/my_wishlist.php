<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$date = new DateClass();
$stringObj = new StringClass();
$slug = getSlugCategory(89);

$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = $breadcrumb_menu = '';
$breadcrumb_category = '<li><a href="' . HOME_URL_LANG . '/my-wishlist" title="Khóa học đang quan tâm">Khóa học đang quan tâm</a></li>';

$arr_like = $arr_logs = array();

if($account["id"]>0) {
	$db->table = "product_logs";
	$db->condition = "`user_id` = " . $account["id"];
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	foreach ($rows as $row) {
		array_push($arr_logs, $row['product_id']);
	}
	$arr_logs = array_filter($arr_logs);

	$db->table = "product_like";
	$db->condition = "`user_id` = " . $account["id"];
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	foreach ($rows as $row) {
		array_push($arr_like, $row['product_id']);
	}
	$arr_like = array_filter($arr_like);
}
?>
<main class="home">
	<div class="row no-margin category-header">
		<div class="row container">
			<?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . '</ul>'; ?>
			<div class="row no-margin category-header-name"><?php echo '<h2>Khóa học đang quan tâm</h2>'; ?></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php
			if(count($arr_like)>0) {
				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `product_id` IN (" . implode(',', $arr_like) . ")";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();
				if ($db->RowCount > 0) {
					echo '<div class="col-sm-12 block_courses">';
					echo '<div class="list-course-card" style="height: auto;">';
					foreach ($rows as $row) {
						$photo_avt = '';
						$photo_avt = '';
						$alt = ($row['img_note'] != "") ? stripslashes($row['img_note']) : stripslashes($row['name']);
						if ($row['img'] != "" && $row['img'] != "no") {
							$photo_avt = '<img src="' . HOME_URL . '/uploads/product/' . str_replace(DS, '/', $row['folder']) . 'course-' . $row['img'] . '" alt="' . $alt . '" />';
						} else {
							$photo_avt = '<img src="' . HOME_URL . '/images/404-course.jpg" alt="' . $alt . '" />';
						}
						$photo_avt = '<div class="course-image no-margin">' . $photo_avt . '</div>';
						$title = '<div class="row ellipsis-2lines course-title">' . stripslashes($row['name']) . '</div>';
						$author = '<div class="row ellipsis-1lines course-author">' . getNameTrainers($row['trainers']) . '</div>';
						$comment = '<div class="row ellipsis-2lines course-description">' . stripslashes($row['comment']) . '</div>';
						$rating =  '<div class="rating" rel="' . $row['product_id'] . '">' . showRatings(floatval($row['vote'])/floatval($row['click_vote'])). '</div>';

						echo '<div class="course-card">';
						if (in_array($row['product_id'], $arr_like)) echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like(' . $row['product_id'] . ', $(this));" rel="1" class="wishlist-heart wishlisted" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
						else echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like(' . $row['product_id'] . ', $(this));" rel="0" class="wishlist-heart" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
						echo '<a href="' . HOME_URL_LANG . '/' . $slug . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '" title="' . stripslashes($row['name']) . '">';
						echo $photo_avt;
						echo '<div class="course-card-content">' . $title . $author . $comment . $rating . '</div>';
						echo '</a>';
						echo '</div>';
					}
					echo '</div></div>';
				}
			}
			?>
		</div>
	</div>
</main>
