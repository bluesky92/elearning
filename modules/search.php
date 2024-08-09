<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$date = new DateClass();
$stringObj = new StringClass();
$category_id = 89;
$title = 'Kết quả tìm kiếm cho từ khóa';
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = $breadcrumb_menu = '';
$breadcrumb_category = '<li><a href="' . HOME_URL_LANG . '/search" title="' . $lgTxt_title_search . '">' . $lgTxt_title_search . '</a></li>';

$query = $slugFilter = '';
$search = isset($_GET['q']) ? (string) $_GET['q'] : '';
$search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
$search = str_replace('-', ' ', $search);
$title = $title . ' “' . $search .'”';
$slugFilter .= "/?filter=ok";
if($search!='') {
	$query .= " AND CONCAT_WS(`name`, `comment`, `content`, `title`, `description`, `keywords`) LIKE '%" . $db->clearText($search). "%'";
	$slugFilter .= "&q=" . $search;
}

$arr_like = array();
if($account["id"]>0) {
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
<main class="category">
	<div class="row no-margin category-header">
		<div class="row container">
			<?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu . '</ul>'; ?>
			<div class="row no-margin category-header-name"><?php echo '<h4 style="color:#fff;font-weight:300;margin:20px 0 30px 0;">' . $title . '</h4>'; ?></div>
		</div>
	</div>
	<div class="row no-margin category-all-courses">
		<div class="container">
			<div class="col-lg-3 col-md-3 col-sm-12 no-padding category-all-courses-left">
				<div class="row other-category-container hidden-sm">
					<?php
					$slug = getSlugCategory($category_id);
					$db->table = "product_menu";
					$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = $category_id";
					$db->order = "`sort` ASC";
					$db->limit = "";
					$rows = $db->select();
					if ($db->RowCount > 0) {
						echo '<ul class="row no-margin other-category">';
						foreach ($rows as $row) {
							echo '<li><a class="other-category-item" href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a>' . loadMenu($slug, $row['product_menu_id']) . '</li>';
						}
						echo '</ul>';
					}
					?>
				</div>
			</div>
			<?php
			$loc = getListMenuChild('product_menu', $category_id);

			echo '<div class="col-lg-9 col-md-9 col-sm-12">';
			$db->table = "product";
			$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc)" . $query;
			$db->order = "`created_time` DESC";
			$db->limit = "";
			$db->select();
			$total = $db->RowCount;
			if ($total > 0) {
				echo '<div class="category-all-courses-main">';
				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `hot` = 1 AND `product_menu_id` IN ($loc)" . $query;
				$db->order = "`modified_time` DESC";
				$db->limit = 6;
				$rows = $db->select();
				if ($db->RowCount > 0) {
					echo '<h3>Các khóa học nổi bật</h3>';
					echo '<div class="clearfix"><div class="card-category" id="courses_slider" style="position:relative;overflow:hidden;height:277px;">';
					echo '<div class="pre-card" style="position:absolute;top:45px;left:0px;background-color:#ffffff;"><a data-slide="prev" href="#" style="display:block;"><i class="fa fa-chevron-left"></i></a></div>';
					echo '<div class="next-card" style="position:absolute;top:45px;right:0px;background-color:#ffffff;"><a data-slide="next" href="#" style="display:block;"><i class="fa fa-chevron-right"></i></a></div>';
					echo '<div class="category-inner clearfix" style="width:20000px;position:absolute;top:0;left:0;">';
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
						$author = '<div class="row ellipsis-2lines course-author">' . getNameTrainers($row['trainers']) . '</div>';
						$comment = '<div class="row ellipsis-2lines course-description">' . stripslashes($row['comment']) . '</div>';
						$rating =  '<div class="rating" rel="' . $row['product_id'] . '">' . showRatings(floatval($row['vote'])/floatval($row['click_vote'])). '</div>';

						echo '<div class="course-card-item"><div class="course-card">';
						if(in_array($row['product_id'], $arr_like)) echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="1" class="wishlist-heart wishlisted" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
						else echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="0" class="wishlist-heart" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
						echo '<a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '" title="' . stripslashes($row['name']) . '">';
						echo $photo_avt;
						echo '<div class="course-card-content">' . $title . $author . $comment . $rating . '</div>';
						echo '</a>';
						echo '</div></div>';
					}
					echo '</div></div></div>';
				}

				$total_pages = 0;
				$per_page = 10;
				if ($total % $per_page == 0) $total_pages = $total / $per_page;
				else $total_pages = floor($total / $per_page) + 1;
				if ($page <= 0) $page = 1;
				$start = ($page - 1) * $per_page;

				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc)" . $query;
				$db->order = "created_time DESC";
				$db->limit = $start . ',' . $per_page;
				$rows = $db->select();

				$i = 0;
				echo '<div class="course-list" style="margin-top:20px">';
				foreach ($rows as $row) {
					include(_F_TEMPLATES . DS . "show_list_product.php");
					$i++;
				}
				echo '</div>';
				echo '</div>';
				showPageNavigation($page, $total_pages, HOME_URL_LANG . '/' . $slug_cat . $slugFilter .'&p=');
			} else echo '<div class="wrap updating clearfix"><h3>Không tìm thấy dữ liệu phù hợp với yêu cầu của bạn!</h3></div>';
			echo '</div>';
			?>
		</div>
	</div>
</main>