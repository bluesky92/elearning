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
		<div class="col-xs-12">
			<div class="policy-content">
				<div class="detail-wp"><?php echo stripslashes($row['content']); ?></div>
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
else include(_F_MODULES . DS . "error_404.php");