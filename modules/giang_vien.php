<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$date = new DateClass();
$stringObj = new StringClass();
$category_id = 0;
$title = '';
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';
$breadcrumb_category = '<li>Thông tin giảng viên</li>';

$sumView = 0;
$db->table = "article";
$db->condition = "`is_active` = 1 AND `article_id` = $id_article";
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach ($rows as $row) {
		$photo_avt = '';
		if($row['img']!="" && $row['img']!="no") {
			$photo_avt = HOME_URL .'/uploads/article/' . str_replace(DS, '/', $row['folder']) . 'trainers-'. $row['img'];
		} else {
			$photo_avt = HOME_URL .'/images/404-trainers.jpg';
		}
		$photo_avt = '<img class="image-profile img-circle" src="' . $photo_avt . '" alt="' . stripslashes($row['name']) . '">'
	?>
	<main class="profile-view">
		<div class="row no-margin category-header">
			<div class="row container top-text">
				<?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu_parent . $breadcrumb_menu . '</ul>';?>
			</div>
			<div class="row container profile-info">
				<div class="col-md-3">
					<div class="row no-margin profile-detail">
						<div class="profile-avatar"><?php echo $photo_avt;?></div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="profile-description">
						<div class="row no-margin top-desc">
							<span class="description-item name"><?php echo stripslashes($row['name']);?></span>
							<span class="description-item academic_rank"><?php echo stripslashes($row['comment']);?></span>
						</div>
						<div class="row no-margin inst-desc"><?php echo stripslashes($row['content']);?></div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php
	}
} else include(_F_MODULES . DS . "_error_404.php");