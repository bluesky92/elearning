<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$sumView = 0;
$db->table = "article";
$db->condition = "`is_active` = 1 AND `article_id` = $id";
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
		$db->table = "article";
		$db->condition = "is_active = 1 and article_menu_id = ".($row['article_menu_id']+0).' and article_id <> '.$id;
		$db->order = "created_time DESC";
		$db->limit = 10;
		$rows2 = $db->select();
		$total = $db->RowCount;
		?>
		<div class="col-lg-9 col-md-9 col-sm-12 category-all-courses-main">
			<div class="row no-margin courses-result">
				<?php echo '<p class="time"><i class="fa fa-calendar fa-fw"></i> ' . $date->vnFull($row['created_time']) . '</p>';?>
				<h2><?php echo stripslashes($row['name']);?></h2>
				<?php if($row['comment']!='') echo '<h5>' . stripslashes($row['comment']) . '</h5>';?>
				<div class="detail-wp"><?php echo stripslashes($row['content']); ?></div>
				<?php
				//----------------------------------------------------------
				if($total>0) {
					echo '<div class="others"><ul class="list-other">';
					foreach($rows2 as $row2) {
						include(_F_TEMPLATES . DS . "show_other_article.php");
					}
					echo '</ul></div>';
				} ?>
			</div>
		</div>
		<?php
		$sumView = $row['views']+1;
	}
	$db->table = "article";
	$data = array(
			'views'=>$sumView
	);
	$db->condition = "article_id = ".$id;
	$db->update($data);

}
else {
	echo '<div class="col-lg-9 col-md-9 col-sm-12">';
	include(_F_MODULES . DS . "error_404.php");
	echo '</div>';
}