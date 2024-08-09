<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
?>
<header class="container-fluid" id="header">
	<div class="row">
		<nav class="navbar navbar-default top-menu">
			<div class="container-special clearfix">
				<div class="container-fluid">
					<div class="row">
						<div class="navbar-header">
							<button aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar-collapse" data-toggle="collapse" type="button">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="<?php echo HOME_URL_LANG . '/home';?>" title="<?php echo getConstant('title');?>"><img src="<?php echo HOME_URL . '/images/logo.png';?>" alt="<?php echo getConstant('meta_site_name');?>"></a>
						</div>
						<div class="collapse navbar-collapse" id="navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
								<?php
								if($account["id"]==0) {
								?>
								<li class="register">
									<a class="btn-register" data-target="#register-modal" data-toggle="modal" href="javascript:;">Đăng ký</a>
									<!-- Register -->
									<div class="modal fade" id="register-modal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
													<h3 class="modal-title">ĐĂNG KÝ</h3>
												</div>
												<div class="modal-body">
													<form id="register" name="fr_register" method="post" onsubmit="return register_user('register');">
														<p class="sub-title">Đăng ký tài khoản dành cho học viên.</p>
														<div class="form-control-wrapper">
															<input class="form-control" type="text" name="user" placeholder="Tên tài khoản..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input class="form-control" type="password" name="password" placeholder="Mật khẩu..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input class="form-control" type="password" name="re_password" placeholder="Nhập lại mật khẩu..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input class="form-control" type="text" name="name" placeholder="Họ và tên..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input class="form-control" type="text" name="tel" placeholder="Số điện thoại..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input class="btn btn-login-submit" type="submit" id="_btn_register" name="reg" value="Đăng ký">
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<div id="_result_register" class="result"></div>
													<p class="bottom-text">Đã có tài khoản? <a class="btn-link" data-dismiss="modal" data-target="#login-modal" data-toggle="modal" href="javascript:;">Đăng nhập</a></p>
												</div>
											</div>
										</div>
									</div>
									<script type="text/javascript">$(document).ready(function(){ check_register(); });</script>
								</li>
								<li class="login-block">
									<a class="btn-login" data-target="#login-modal" data-toggle="modal" href="javascript:;">Đăng nhập</a>
									<!-- Login -->
									<div class="modal fade" id="login-modal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
													<h3 class="modal-title">ĐĂNG NHẬP</h3>
												</div>
												<div class="modal-body">
													<form id="sign-in" name="signin" method="post" onsubmit="return sign_in('sign-in');">
														<p class="sub-title">Đăng nhập tài khoản dành cho học viên.</p>
														<div class="form-control-wrapper">
															<input type="text" class="form-control" name="user" placeholder="Tên tài khoản..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input type="password" class="form-control" name="password" placeholder="Mật khẩu..." required autocomplete="off">
														</div>
														<div class="form-control-wrapper">
															<input class="btn btn-login-submit" type="submit" value="Đăng nhập">
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<div id="_result_login" class="result"></div>
													<p class="bottom-text">Chưa có tài khoản? <a class="btn-link" data-dismiss="modal" data-target="#register-modal" data-toggle="modal" href="javascript:;">Đăng ký</a></p>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<div class="carousel slide carousel-banner" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<?php
				$db->table = "gallery";
				$db->condition = "`is_active` = 1 AND `gallery_menu_id` IN (SELECT `gallery_menu_id` FROM `".TTH_DATA_PREFIX."gallery_menu` WHERE `category_id` = 91)";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();
				if($db->RowCount>0) {
					echo '<style type="text/css">';
					foreach ($rows as $row) {
						echo '#header .carousel-banner .item.it-' . $row['gallery_id'] . '{background-image:url("' . HOME_URL . '/uploads/gallery/'.$row['img'] . '");}';
					}
					echo '</style>';

					$i=0;
					foreach ($rows as $row) {
						$active = '';
						if($i==0) $active = ' active';
						echo '<div class="item it-' . $row['gallery_id'] . $active . '">';
						if($row['comment']!='') echo '<div class="carousel-caption hidden-xs target"><div class="container container-carousel animated fadeInUp">' . stripslashes($row['comment']) . '</div></div>';
						echo '</div>';
						$i++;
					}
				}
				?>
			</div>
			<a class="left carousel-control" data-slide="prev" href=".carousel-banner" role="button">
				<i aria-hidden="true" class="fa fa-angle-left"></i>
			</a>
			<a class="right carousel-control" data-slide="next" href=".carousel-banner" role="button">
				<i aria-hidden="true" class="fa fa-angle-right"></i>
			</a>
		</div>
		<div class="navigation">
			<div class="container container-carousel">
				<nav class="navbar navbar-default main-navbar">
					<div class="navbar-collapse">
						<ul class="nav navbar-nav list-category">
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
									<span class="icon-bar"><i aria-hidden="true" class="fa fa-bars"></i></span>
									<span class="hidden-sm hidden-xs">Chủ đề khóa học</span>
									<span class="icon-down hidden-sm hidden-xs"><i aria-hidden="true" class="fa fa-angle-down"></i></span>
								</a>
								<ul class="dropdown-menu dropdown-content">
									<li>
										<div class="row speical-row">
											<div class="topic">
												<div class="row">
													<?php
													echo '<h5>Chủ đề</h5>';
													$slug = getSlugCategory(89);
													$db->table = "product_menu";
													$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = 89";
													$db->order = "`sort` ASC";
													$db->limit = "";
													$rows = $db->select();
													if($db->RowCount>0) {
														echo '<div class="list-item clearfix">';
														foreach($rows as $row) {
															echo '<p><a href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a></p>';
														}
														echo '</div>';
													}
													echo '<p class="button-all"><a href="' . HOME_URL_LANG . '/' . $slug . '">Khám phá ngay</a></p>'
													?>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
						<form action="<?php echo HOME_URL_LANG . '/search';?>" class="wp-page navbar-form navbar-right form-search" id="atc-search" method="GET">
							<div class="form-group">
								<input autocomplete="off" class="form-control" id="books-search-txt" name="q" placeholder="Nhập từ khóa tìm kiếm..." type="text">
							</div>
							<button class="btn btn-default" type="submit">
								<i aria-hidden="true" class="fa fa-search"></i>
							</button>
						</form>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>
<main class="container-fluid" id="main">
	<div class="row">
		<section class="module-2">
			<div class="container">
				<?php
				$date = new DateClass();
				$stringObj = new StringClass();
				$slug = getSlugCategory(89);
				//-----
				$db->table = "product";
				$db->condition = "`is_active` = 1 AND `hot` = 1 AND `product_menu_id` IN (SELECT `product_menu_id` FROM `".TTH_DATA_PREFIX."product_menu` WHERE `category_id` = 89)";
				$db->order = "`modified_time` DESC";
				$db->limit = 12;
				$rows = $db->select();
				if ($db->RowCount > 0) {
					echo '<div class="row"><div class="col-sm-12 block_courses"><div class="list-course-card">';
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
						echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="0" class="wishlist-heart" data-toggle="tooltip" data-placement="bottom" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
						echo '<a href="' . HOME_URL_LANG . '/' . $slug . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '" title="' . stripslashes($row['name']) . '">';
						echo $photo_avt;
						echo '<div class="course-card-content">' . $title . $author . $comment . $rating. '</div>';
						echo '</a>';
						echo '</div>';
					}
					echo '</div></div></div>';
				}
				?>
				<div class="show-time">
					<a href="<?php echo HOME_URL_LANG . '/' . $slug;?>">Và rất nhiều khóa học hấp dẫn khác</a>
				</div>
			</div>
		</section>
	</div>
</main>
<?php
include(_F_INCLUDES . DS . "tth_footer.php");
