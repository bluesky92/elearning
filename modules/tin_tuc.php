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
	<div class="row no-margin category-all-courses" id="parent_style">
		<div class="container">
			<div class="col-lg-3 col-md-3 col-sm-12 no-padding category-all-courses-left">
				<div class="row other-category-container hidden-sm">
					<?php
					$slug = getSlugCategory($category_id);
					$db->table = "article_menu";
					$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = $category_id";
					$db->order = "`sort` ASC";
					$db->limit = "";
					$rows = $db->select();
					if ($db->RowCount > 0) {
						echo '<ul class="row no-margin other-category">';
						foreach ($rows as $row) {
							$active = '';
							if($row['article_menu_id']==$id_menu) $active = ' class="active a-ul"';
							echo '<li' . $active . '><a class="other-category-item" href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a>' . loadMenuArticle($category_id, $row['article_menu_id'], $id_menu) . '</li>';
						}
						echo '</ul>';
					}
					?>
				</div>
			</div>
			<?php
			if ($id_article > 0){
				$id = $id_article;
				include(_F_TEMPLATES . DS . "show_article.php");
			} else if($id_menu <= 0) {
				$loc = getListMenuChild('article_menu', $category_id);

				$db->table = "article";
				$db->condition = "`is_active` = 1 AND `article_menu_id` IN ($loc)";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();

				$total = $db->RowCount;
				if($total>1) {
					$total_pages = 0;
					$per_page = 10;
					if($total%$per_page==0) $total_pages = $total/$per_page;
					else $total_pages = floor($total/$per_page)+1;
					if($page<=0) $page=1;
					$start=($page-1)*$per_page;

					$db->table = "article";
					$db->condition = "`is_active` = 1 AND `article_menu_id` IN ($loc)";
					$db->order = "`created_time` DESC";
					$db->limit = $start . ", " . $per_page;
					$rows = $db->select();

					$i = 0;
					echo '<div class="col-lg-9 col-md-9 col-sm-12"><div class="category-all-courses-main courses-result">';
					foreach($rows as $row) {
						include(_F_TEMPLATES . DS . "show_list_article.php");
						$i++;
					}
					echo '</div>';
					showPageNavigation($page, $total_pages, HOME_URL_LANG . '/'.$slug_cat.'?p=');
					echo '</div>';
				}
				else if ($total==1) {
					$id = 0;
					foreach($rows as $row) {
						$id = $row['article_id'];
					}
					include(_F_TEMPLATES . DS . "show_article.php");
				}
				else echo '<div class="col-lg-9 col-md-9 col-sm-12"><div class="wrap updating clearfix"><h3>'.$lgTxt_update.'</h3></div></div>';
			} else {
				$slug_submenu = getSlugMenu($id_menu, 'article');
				$loc = getListMenuChild('article_menu', $category_id, $id_menu);

				$db->table = "article";
				$db->condition = "`is_active` = 1 AND `article_menu_id` IN ($loc)";
				$db->order = "`created_time` DESC";
				$db->limit = "";
				$rows = $db->select();

				$total = $db->RowCount;
				if($total>1) {
					$total_pages = 0;
					$per_page = 10;
					if($total%$per_page==0) $total_pages=$total/$per_page;
					else $total_pages = floor($total/$per_page)+1;
					if($page<=0) $page=1;
					$start=($page-1)*$per_page;

					$db->table = "article";
					$db->condition = "`is_active` = 1 AND `article_menu_id` IN ($loc)";
					$db->order = "`created_time` DESC";
					$db->limit = $start.','.$per_page;
					$rows = $db->select();

					$i = 0;
					echo '<div class="col-lg-9 col-md-9 col-sm-12"><div class="category-all-courses-main courses-result">';
					foreach($rows as $row) {
						include(_F_TEMPLATES . DS . "show_list_article.php");
						$i++;
					}
					echo '</div>';
					showPageNavigation($page, $total_pages, HOME_URL_LANG . '/'.$slug_cat.'/'.$slug_submenu.'?p=');
					echo '</div>';
				}
				else if ($total==1) {
					$id = 0;
					foreach($rows as $row) {
						$id = $row['article_id'];
					}
					include(_F_TEMPLATES . DS . "show_article.php");
				}
				else echo '<div class="col-lg-9 col-md-9 col-sm-12"><div class="wrap updating clearfix"><h3>'.$lgTxt_update.'</h3></div></div>';
			}
			?>
		</div>
	</div>
</main>