<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
if($id_menu==0) {
	$db->table = "article_menu";
	$db->condition = "`is_active` = 1 AND `category_id` = 94";
	$db->order = "`sort` ASC";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		header('Location: ' . HOME_URL_LANG . '/' . $slug_cat . '/' .stripslashes($row['slug']));
		exit();
	}
}
$date = new DateClass();
$stringObj = new StringClass();
$category_id = $parent_bf = 0;
$title = '';
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = $breadcrumb_menu = '';

$db->table = "category";
$db->condition = "`is_active` = 1 AND `slug` = '$slug_cat'";
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
		$db->table = "article_menu";
		$db->condition = "`article_menu_id` = $parent";
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
		//---
		$i++;
	}
}
?>
<main class="category">
	<div class="row no-margin category-header">
		<div class="row container">
			<?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . $breadcrumb_menu . '</ul>';?>
			<div class="row no-margin category-header-name"><?php echo '<h2>' . $title . '</h2>';?></div>
		</div>
	</div>
	<div class="row no-margin faq-container">
		<div class="container">
			<?php
			if ($id_article > 0){
				$id = $id_article;
				include(_F_TEMPLATES . DS . "show_about.php");
			} else {
				$loc = getListMenuChild('article_menu', $category_id, $id_menu);

				$db->table = "article";
				$db->condition = "`is_active` = 1 AND `article_menu_id` IN ($loc)";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();

				$total = $db->RowCount;
				if($total>1) {
					echo '<div class="faq-content"><ul>';
					$i=0;
					foreach($rows as $row) {
						include(_F_TEMPLATES . DS . "show_list_about.php");
						$i++;
					}
					echo '</ul></div>';

				} elseif ($total==1) {
					foreach($rows as $row) {
						$id = $row['article_id'];
					}
					include(_F_TEMPLATES . DS . "show_about.php");

				} else echo '<div class="wrap updating clearfix"><h3>'.$lgTxt_update.'</h3></div>';
			}
			?>
		</div>
	</div>
</main>