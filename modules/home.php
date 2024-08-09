<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$date = new DateClass();
$stringObj = new StringClass();
$slug = getSlugCategory(89);

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
<main class="home" style="margin-top: 130px;">
	<div class="container">
		<div class="row">
			<?php
			//if(getPage('banner')!='') echo '<div class="col-sm-12 banner-home">' . getPage('banner') . '</div>';
			//---
			if(count($arr_logs)>0) {
				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `product_id` IN (" . implode(',', $arr_logs) . ")";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();
				if ($db->RowCount > 0) {
					echo '<div class="col-sm-12 block_courses">';
					echo '<div class="category-title pull-left">Khóa học của tôi</div><div class="category-show-all pull-right"><a class="btn btn-default btn-sm show-all" href="javascript:;" onclick="return _showAllCourses(this);">Xem tất cả <i class="fa fa-fw fa-plus-circle"></i></a></div><div class="clearfix"></div>';
					echo '<div class="list-course-card">';
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

			if(count($arr_like)>0) {
				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `product_id` IN (" . implode(',', $arr_like) . ")";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();
				if ($db->RowCount > 0) {
					echo '<div class="col-sm-12 block_courses">';
					echo '<div class="category-title pull-left">Khóa học đang được quan tâm</div><div class="category-show-all pull-right"><a class="btn btn-default btn-sm show-all" href="javascript:;" onclick="return _showAllCourses(this);">Xem tất cả <i class="fa fa-fw fa-plus-circle"></i></a></div><div class="clearfix"></div>';
					echo '<div class="list-course-card">';
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

			$db->table = "product";
			$db->condition = "`is_active` = 1 AND `hot` = 1 AND `product_menu_id` IN (SELECT `product_menu_id` FROM `".TTH_DATA_PREFIX."product_menu` WHERE `category_id` = 89)";
			$db->order = "`modified_time` DESC";
			$db->limit = 16;
			$rows = $db->select();
			if ($db->RowCount > 0) {
				echo '<div class="col-sm-12 block_courses">';
				echo '<div class="category-title pull-left">Khóa học nổi bật</div><div class="category-show-all pull-right"><a class="btn btn-default btn-sm show-all" href="javascript:;" onclick="return _showAllCourses(this);">Xem tất cả <i class="fa fa-fw fa-plus-circle"></i></a></div><div class="clearfix"></div>';
				echo '<div class="list-course-card">';
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
					if(in_array($row['product_id'], $arr_like)) echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="1" class="wishlist-heart wishlisted" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
					else echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="0" class="wishlist-heart" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
					echo '<a href="' . HOME_URL_LANG . '/' . $slug . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '" title="' . stripslashes($row['name']) . '">';
					echo $photo_avt;
					echo '<div class="course-card-content">' . $title . $author . $comment . $rating. '</div>';
					echo '</a>';
					echo '</div>';
				}
				echo '</div></div>';
			}

			$db->table = "product_menu";
			$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = 89";
			$db->order = "`sort` ASC";
			$db->limit = "";
			$rows_mn = $db->select();
			foreach($rows_mn as $row_mn) {
				$list = getProductMenuChild($row_mn['product_menu_id']);
				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($list)";
				$db->order = "`created_time` DESC";
				$db->limit = 16;
				$rows = $db->select();
				if ($db->RowCount > 0) {
					echo '<div class="col-sm-12 block_courses">';
					echo '<div class="category-title pull-left">' . stripslashes($row_mn['name']) . '</div><div class="category-show-all pull-right"><a class="btn btn-default btn-sm show-all" href="javascript:;" onclick="return _showAllCourses(this);">Xem tất cả <i class="fa fa-fw fa-plus-circle"></i></a></div><div class="clearfix"></div>';
					echo '<div class="list-course-card">';
					foreach ($rows as $row) {
						$photo_avt = '';
						$photo_avt = '';
						$alt = ($row['img_note'] != "") ? stripslashes($row['img_note']) : stripslashes($row['name']);
						if ($row['img'] != "" && $row['img'] != "no") {
							$photo_avt = '<img src="' . HOME_URL . '/uploads/product/'  . str_replace(DS, '/', $row['folder']) . 'course-' . $row['img'] . '" alt="' . $alt . '" />';
						} else {
							$photo_avt = '<img src="' . HOME_URL . '/images/404-course.jpg" alt="' . $alt . '" />';
						}
						$photo_avt = '<div class="course-image no-margin">' . $photo_avt . '</div>';
						$title = '<div class="row ellipsis-2lines course-title">' . stripslashes($row['name']) . '</div>';
						$author = '<div class="row ellipsis-1lines course-author">' . getNameTrainers($row['trainers']) . '</div>';
						$comment = '<div class="row ellipsis-2lines course-description">' . stripslashes($row['comment']) . '</div>';
						$rating =  '<div class="rating" rel="' . $row['product_id'] . '">' . showRatings(floatval($row['vote'])/floatval($row['click_vote'])). '</div>';

						echo '<div class="course-card">';
						if(in_array($row['product_id'], $arr_like)) echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="1" class="wishlist-heart wishlisted" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
						else echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="0" class="wishlist-heart" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
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
		<div class="category home-news">
		<?php
		$slug = getSlugCategory(90);
		$db->table = "article";
		$db->condition = "`is_active` = 1 AND `article_menu_id` IN (SELECT `article_menu_id` FROM `".TTH_DATA_PREFIX."article_menu` WHERE `category_id` = 90)";
		$db->order = "`created_time` DESC";
		$db->limit = 10;
		$rows = $db->select();
		if ($db->RowCount > 0) {
			echo '<div class="category-all-courses category-all-courses-main">';
			echo '<h3 style="margin:0 0 10px"><a style="color:inherit" href="' . HOME_URL_LANG . '/' . getSlugCategory(90) . '">Tin tức - Sự kiện</a></h3>';
			echo '<div class="clearfix"><div class="card-category" id="courses_slider" style="position:relative;overflow:hidden;height:277px;">';
			echo '<div class="pre-card" style="position:absolute;top:45px;left:0px;background-color:#ffffff;"><a data-slide="prev" href="#" style="display:block;"><i class="fa fa-chevron-left"></i></a></div>';
			echo '<div class="next-card" style="position:absolute;top:45px;right:0px;background-color:#ffffff;"><a data-slide="next" href="#" style="display:block;"><i class="fa fa-chevron-right"></i></a></div>';
			echo '<div class="category-inner clearfix" style="width:20000px;position:absolute;top:0;left:0;">';
			foreach ($rows as $row) {
				$photo_avt = '';
				$photo_avt = '';
				$alt = ($row['img_note'] != "") ? stripslashes($row['img_note']) : stripslashes($row['name']);
				if ($row['img'] != "" && $row['img'] != "no") {
					$photo_avt = '<img src="' . HOME_URL . '/uploads/article/' . str_replace(DS, '/', $row['folder']) . 'post-' . $row['img'] . '" alt="' . $alt . '" />';
				} else {
					$photo_avt = '<img src="' . HOME_URL . '/images/404-post.jpg" alt="' . $alt . '" />';
				}
				$photo_avt = '<div class="course-image no-margin">' . $photo_avt . '</div>';
				$title = '<div class="row ellipsis-2lines course-title">' . stripslashes($row['name']) . '</div>';
				$comment = '<div class="row ellipsis-2lines course-description">' . stripslashes($row['comment']) . '</div>';
				$time = '<div class="time"><i class="fa fa-calendar"></i> ' . $date->vnFull($row['created_time']) . '</div>';

				echo '<div class="course-card-item"><div class="course-card">';
				echo '<a href="' . HOME_URL_LANG . '/' . $slug . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">';
				echo $photo_avt;
				echo '<div class="course-card-content">' . $title . $time . $comment . '</div>';
				echo '</a>';
				echo '</div></div>';
			}
			echo '</div></div></div>';
		}
		?>
		</div>
	</div>
</main>
