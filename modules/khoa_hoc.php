<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$date = new DateClass();
$stringObj = new StringClass();
$category_id = $parent_bf = 0;
$title = '';
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = $breadcrumb_menu = '';

$db->table = "category";
$db->condition = "is_active = 1 and slug = '".$slug_cat."'";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach ($rows as $row) {
	$category_id = $row['category_id']+0;
	$title = stripslashes($row['name']);
	$breadcrumb_category = '<li><a href="' . HOME_URL_LANG . '/' . $slug_cat . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a></li>';
}
if($id_menu > 0) {
	$parent = $id_menu;
	$i = 0;
	while($parent>0) {
		if($i==1) $parent_bf = $parent;
		$db->table = "product_menu";
		$db->condition = "`product_menu_id` = $parent";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach ($rows as $row) {
				if($i==0) $title = stripslashes($row['name']);
				$breadcrumb_menu = '<li><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a></li>' . $breadcrumb_menu;
				$parent = $row['parent'];
			}
		} else $parent = 0;
		$i++;
	}
}
if($id_article > 0) {
	$db->table = "product";
	$db->condition = "`is_active` = 1 AND `product_id` = $id_article";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	if($db->RowCount>0) {
		foreach($rows as $row) {
			$title = stripslashes($row['name']);
		?>
		<main class="category">
			<div class="row no-margin category-header">
				<div class="row container">
					<?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu . '</ul>'; ?>
					<div class="row no-margin category-header-name"><?php echo '<h2>' . $title . '</h2>'; ?></div>
				</div>
			</div>
			<?php
			$db->table = "product_logs";
			$db->condition = "`product_id` = $id_article AND `user_id` = " . $account["id"];
			$db->order = "";
			$db->limit = 1;
			$db->select();
			if($db->RowCount>0) {
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
				//---
				$db->table = "courses";
				$db->condition = "`is_active` = 1  AND `product_id` = $id_article";
				$db->order = "`sort` ASC";
				$db->limit = "";
				$rows_cs = $db->select();
				$total = $db->RowCount;
				if($total>0) {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding no-margin">
					<div class="row learning-container">
						<div class="col-lg-6 col-md-6 col-sm-10 col-sm-offset-1 col-xs-12 list-lecture">
							<div class="row no-margin lecture-header">
								<?php
								$list_course = $start_course = '';
								$i = $count = 0;
								foreach($rows_cs as $row_cs) {
									$i++;
									if($i==1) {
										$start_course = '';
										$start_course .= '<a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '?list=' . $row_cs['courses_id'] . '" title="' . stripslashes($row['name']) . '"><ul>';
										$start_course .= '<li class="play-circle-lecture"><i class="fa fa-play-circle"></i></li>';
										$start_course .= '<li class="first-lecture">';
										$start_course .= '<div class="lecture-header-content"><p class="no-margin lecture-header-index">Bài giảng ' . $i . ':</p><p class="no-margin lecture-header-name">' . stripslashes($row_cs['name']) . '</p><p class="no-margin lecture-header-time">' . stripslashes($row_cs['video_playtime']) . '</p></div>';
										$start_course .= '</li>';
										$start_course .= '</ul></a>';
									}
									$status = ' learning';
									if(in_array($row_cs['courses_id'], $logs)) {
										$status = ' completed';
										$start_course = '';
										$start_course .= '<a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '?list=' . $row_cs['courses_id'] . '" title="' . stripslashes($row['name']) . '"><ul>';
										$start_course .= '<li class="play-circle-lecture"><i class="fa fa-play-circle"></i></li>';
										$start_course .= '<li class="first-lecture">';
										$start_course .= '<div class="lecture-header-content"><p class="no-margin lecture-header-index">Bài giảng ' . $i . ':</p><p class="no-margin lecture-header-name">' . stripslashes($row_cs['name']) . '</p><p class="no-margin lecture-header-time">' . stripslashes($row_cs['video_playtime']) . '</p></div>';
										$start_course .= '</li>';
										$start_course .= '</ul></a>';
									}

									$list_course .= '<div class="row chap-item"><a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '?list=' . $row_cs['courses_id'] . '" title="' . stripslashes($row['name']) . '"><div class="row item-container">';
									$list_course .= '<div class="chap-item-status"><div class="status-container' . $status . '"><i class="fa fa-check-circle"></i></div></div>';
									$list_course .= '<div class="chap-item-content">';

									$list_course .= '<div class="row no-margin">Bài giảng ' . $i . ': ' . stripslashes($row_cs['name']) . '</div>';
									$list_course .= '<div class="row no-margin"><div class="row type-document"><ul class="no-padding"><li><i class="fa fa-play-circle"></i></li><li><span>' . stripslashes($row_cs['video_playtime']) . '</span></li><li><i class="fa fa-comments"></i></li></ul></div></div>';

									$list_course .= '</div>';
									$list_course .= '</div></a></div>';
									if(in_array($row_cs['courses_id'], $logs)) $count++;
								}
								//
								echo $start_course;

								$progress_percent = (100/$total)*$count;
								$progress_percent = 'style="width:' . $progress_percent . '%"';
								$finished = '';
								if($total==$count) $finished = ' finished';
								?>
							</div>
							<div class="row no-margin lecture-progress">
								<div class="row trophy">
									<div class="progress-title">
										<ul class="progress-title-content no-margin">
											<li class="progress-title-item">Bạn đã hoàn thành</li>
											<li class="progress-title-item bold"><?php echo $count;?></li>
											<li class="progress-title-item">trên</li>
											<li class="progress-title-item bold"><?php echo $total;?></li>
											<li class="progress-title-item">bài giảng</li>
										</ul>
										<i class="fa fa-trophy<?php echo $finished;?>"></i>
									</div>
								</div>
								<div class="row no-margin progress-container">
									<div class="progress">
										<div class="progress-bar" <?php echo $progress_percent;?>></div>
									</div>
									<div class="progress-finish">
										<div class="finish<?php echo $finished;?>"></div>
									</div>
								</div>
								<div class="rating-container">
									<div class="rating" rel="<?php echo $row['product_id'];?>">
										<?php echo '<label>Đánh giá ngay</label>' . showRatings(floatval($row['vote'])/floatval($row['click_vote']));?>
									</div>
								</div>
							</div>
							<div class="row no-margin list-lecture-container">
								<?php
								echo $list_course;
								?>
							</div>
						</div>
						<div class="hidden-xs hidden-sm col-sm-6 no-padding">
							<div class="col-xs-12 col-sm-12 pull-right no-margin discussions">
								<div class="row no-margin discussions-header">
									<div class="col-xs-12 col-sm-12 no-padding tab">
										<div class="col-xs-6 col-sm-6 no-padding">
											<div active="discussion" class="col-xs-10 col-sm-10 col-sm-offset-1 tab-item active">
												<i class="fa fa-comments"></i>
												<span>Thảo luận</span>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 no-padding tab-line">
										<div class="col-xs-6 col-sm-6 no-padding line-discussion active"></div>
										<div class="col-xs-6 col-sm-6 no-padding line-announcement active"></div>
									</div>
								</div>
								<div class="row no-margin discussions-content">
									<div class="col-xs-12 col-sm-12 no-padding discussions-tools">
										<form id="form-discussion" class="discussion" method="post" onsubmit="return post_discussion('form-discussion', 'result-discussion', 0);">
											<input type="hidden" name="product" value="<?php echo $id_article;?>">
											<input type="hidden" name="course" value="0">
											<label><textarea class="form-control discussion-content" name="content" placeholder="Nhập nội dung thảo luận..." rows="3" required></textarea></label>
											<label><button type="submit" name="discussion" class="btn btn-primary lecture-discussion-submit">Đăng thảo luận</button></label>
										</form>
									</div>
									<div id="result-discussion" class="col-xs-12 col-sm-12 discussions-list">
										<?php
										$id_load = 0;
										$db->table = "discussion";
										$db->condition = "`is_active` = 1 AND `parent` = 0 AND `product_id` = $id_article";
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
											echo '<div class="col-xs-12 col-sm-12 no-padding">';
											echo '<label class="reply" discussion-id="' . $b_id . '"> Phản hồi (' . $db->RowCount . ')</label>';
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
									<div class="row no-margin load-more-discussions"><a href="javascript:;" onclick="return load_discussions('result-discussion', 1, $(this));" rel="<?php echo $id_load;?>">Xem thêm các thảo luận khác</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } else echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding no-margin"><div class="wrap updating clearfix"><h3>'.$lgTxt_update.'</h3></div></div>';
			} else {?>
				<div class="bg-detail no-padding no-margin">
					<div class="detail">
						<div class="detail-top">
							<div class="course-detail clearfix">
								<div class="top-left">
									<h4 class="course-title">Mô tả về khóa học</h4>
									<div class="detail-wp"><?php echo stripslashes($row['content']);?></div>
								</div>
								<div class="top-right">
									<div class="course-purchase">
										<div class="purchase-submit">
											<?php
											if($account["id"]>0) echo '<a class="btn btn-raised btn-lg buy-button" href="javascript:;" onclick="return add_course(' . $id_article . ');">Tham gia khóa học</a>';
											else echo '<a class="btn btn-raised btn-lg buy-button" data-target="#login-modal" data-toggle="modal" href="javascript:;">Tham gia khóa học</a>';
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="detail-bottom">
							<div class="course-detail clearfix">
								<div class="bottom-left">
									<div id="curiculums">
										<div class="curiculums-title">Giáo trình</div>
										<?php
										$db->table = "courses";
										$db->condition = "`is_active` = 1  AND `product_id` = $id_article";
										$db->order = "`sort` ASC";
										$db->limit = "";
										$rows_cs = $db->select();
										$i=0;
										foreach($rows_cs as $row_cs) { $i++; ?>
											<div class="curiculum">
												<div class="row no-margin curiculum-list">
													<div class="col-xs-12 no-padding">
														<div class="row no-margin curiculum-content">
															<div class="col-xs-12">
																<div class="detail-curi-type pull-left" style="margin-right:10px">
																	<i class="fa fa-play-circle"></i>
																</div>
																<div class="detail-curi-lecture pull-left">
																	<h5 class="normal-text no-margin" style="line-height:1.5; color: #777777">Bài số <?php echo $i;?></h5>
																</div>
																<div class="detail-curi-title pull-left">
																	<h5 class="normal-text no-margin" style="line-height:1.5; color: #777777"><?php echo stripslashes($row_cs['name']);?></h5>
																</div>
																<div class="detail-curi-leacture pull-right">
																	<h5 class="normal-text no-margin"><b><?php echo stripslashes($row_cs['video_playtime']);?></b></h5>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
									<?php
									$info = array();
									$info = getInfoTrainers($row['trainers']);
									if(count($info)>0) {
										$tr_slug = getSlugCategory(95);
										echo '<div id="author">';
										echo '<div class="author-title">Tiểu sử tác giả</div>';
										echo '<div class="author-content">';
										echo '<div class="author-avatar"><img src="' . $info[1] . '" alt="' . $info[0] . '"></div>';
										echo '<div class="author-description"><h5>' . $info[2] . '</h5><h3><a target="_blank" href="' . HOME_URL_LANG .  '/' . $tr_slug . '/' . getSlugMenu($info[4], 'article') . '/' . $stringObj->getLinkHtml($info[0], $row['trainers']) . '" title="' . $info[0] . '">' . $info[0] . '</a></h3></div>';
										echo '<div class="author-information">' . $info[3] . '</div>';
										echo '</div>';
										echo '</div>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</main>
		<?php
		}
	} else include(_F_MODULES . DS . "_error_404.php");
} else {
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
				<div class="row no-margin category-header-name"><?php echo '<h2>' . $title . '</h2>'; ?></div>
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
								$active = '';
								if($row['product_menu_id']==$id_menu) $active = ' class="active a-ul"';
								echo '<li' . $active . '><a class="other-category-item" href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a>' . loadMenu($slug, $row['product_menu_id'], $id_menu) . '</li>';
							}
							echo '</ul>';
						}
						?>
					</div>
				</div>
				<?php
				if ($id_menu > 0) {
					$slug_submenu = getSlugMenu($id_menu, 'product');
					$loc = getListMenuChild('product_menu', $category_id, $id_menu);

					echo '<div class="col-lg-9 col-md-9 col-sm-12">';
					$db->table = "product";
					$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc)";
					$db->order = "`created_time` DESC";
					$db->limit = "";
					$db->select();
					$total = $db->RowCount;
					if ($total > 0) {
						echo '<div class="category-all-courses-main">';
						$db->table = "product";
						$db->condition = "`is_active` = 1 AND `hot` = 1 AND `product_menu_id` IN ($loc)";
						$db->order = "`modified_time` DESC";
						$db->limit = 6;
						$rows = $db->select();
						if ($db->RowCount > 0) {
							echo '<h3>Chuyên đề nổi bật</h3>';
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
								$author = '<div class="row ellipsis-1lines course-author">' . getNameTrainers($row['trainers']) . '</div>';
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
						$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc)";
						$db->order = "created_time DESC";
						$db->limit = $start . ',' . $per_page;
						$rows = $db->select();

						$i = 0;
						echo '<div class="course-list"><h3>Tất cả các Chuyên đề</h3>';
						foreach ($rows as $row) {
							include(_F_TEMPLATES . DS . "show_list_product.php");
							$i++;
						}
						echo '</div>';
						echo '</div>';
						showPageNavigation($page, $total_pages, HOME_URL_LANG . '/' . $slug_cat . '/' . $slug_submenu . '?p=');
					} else echo '<div class="wrap updating clearfix"><h3>' . $lgTxt_update . '</h3></div>';
					echo '</div>';

				} else {
					$loc = getListMenuChild('product_menu', $category_id);

					echo '<div class="col-lg-9 col-md-9 col-sm-12">';
					$db->table = "product";
					$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc)";
					$db->order = "`created_time` DESC";
					$db->limit = "";
					$db->select();
					$total = $db->RowCount;
					if ($total > 0) {
						echo '<div class="category-all-courses-main">';
						$db->table = "product";
						$db->condition = "`is_active` = 1 AND `hot` = 1 AND `product_menu_id` IN ($loc)";
						$db->order = "`modified_time` DESC";
						$db->limit = 6;
						$rows = $db->select();
						if ($db->RowCount > 0) {
							echo '<h3>Chuyên đề nổi bật</h3>';
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
								$author = '<div class="row ellipsis-1lines course-author">' . getNameTrainers($row['trainers']) . '</div>';
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
						$db->condition = "`is_active` = 1 AND `product_menu_id` IN ($loc)";
						$db->order = "created_time ASC";
						$db->limit = $start . ',' . $per_page;
						$rows = $db->select();

						$i = 0;
						echo '<div class="course-list"><h3>Tất cả các Chuyên đề</h3>';
						foreach ($rows as $row) {
							include(_F_TEMPLATES . DS . "show_list_product.php");
							$i++;
						}
						echo '</div>';
						echo '</div>';
						showPageNavigation($page, $total_pages, HOME_URL_LANG . '/' . $slug_cat . '?p=');
					} else echo '<div class="wrap updating clearfix"><h3>' . $lgTxt_update . '</h3></div>';
					echo '</div>';
				}
				?>
			</div>
		</div>
	</main>
	<?php
}