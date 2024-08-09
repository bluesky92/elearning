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
		$db->table = "forum_menu";
		$db->condition = "`forum_menu_id` = $parent";
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
	<div class="row no-margin category-all-forum">
		<div class="container">
			<div class="category-all-forum-main">
				<?php
				if ($id_article > 0){
					$id = $id_article;
					include(_F_TEMPLATES . DS . "show_forum.php");
				} else if($id_menu <= 0) {
					echo '<div class="forum-title"><h3><i class="fa fa-tags fa-fw"></i> Các chuyên mục diễn đàn</h3></div>';
					$db->table = "forum_menu";
					$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = $category_id";
					$db->order = "`sort` ASC";
					$db->limit = "";
					$rows = $db->select();
					if($db->RowCount>0) {
						echo '<div class="forum-list">';
						foreach($rows as $row) {
							$photo_avt  = '';
							$alt        = stripslashes($row['name']);
							if($row['img']!="" && $row['img']!="no") {
								$photo_avt = '<img src="'. HOME_URL .'/uploads/forum_menu/' . str_replace(DS, '/', $row['folder']) . 'av-'. $row['img'] . '" alt="' . $alt . '" />';
							} else {
								$photo_avt = '<img src="'. HOME_URL .'/images/forum.png" alt="' . $alt . '" />';
							}

							$photo_avt = '<div class="img"><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt . '</a></div>';
							$title = '<h4 class="ellipsis-1lines"><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a></h4>';

							$f_count = $f_comment = 0;
							$right = '';

							$db->table = "forum";
							$db->condition = "`is_active` = 1  AND `forum_menu_id` = " . $row['forum_menu_id'];
							$db->order = "`created_time` DESC";
							$db->limit = "";
							$rows2 = $db->select();
							$f_count = $db->RowCount;
							$i = 0;
							foreach($rows2 as $row2) {
								$f_comment += countForumComments($row2['forum_id']);
								if($i==0) {
									$f_user = getInfoUser($row2['user_id']);
									$right = '<div class="f-right"><div class="f-box"><p class="ellipsis-1lines">Mới nhất: <a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '/' . $stringObj->getLinkHtml($row2['name'], $row2['forum_id']) . '" title="' . stripslashes($row2['name']) . '">' . stripslashes($row2['name']) . '</a></p><p class="f-cl-blue">' . $f_user[6] . ', <a class="f-time" title="' . $date->vnFull($row2['created_time']) . ' (lúc ' . $date->vnTime($row2['created_time']) . ')">' . convertTime5DayAgo($row2['created_time']) . '</a></p></div></div>';
								}
								$i++;
							}

							$left = '<div class="f-left"><div class="f-box">' . $title . '<p class="f-count">Đề tài thảo luận: <span>' . $f_count . '</span>; Bình luận: <span>' . $f_comment . '</span></p></div></div>';

							echo '<div class="forum-item">' . $photo_avt . '<div class="caption">' . $left . $right . '</div></div>';
						}
						echo '</div>';
					}
				} else {
					$db->table = "forum_menu";
					$db->condition = "`is_active` = 1 AND `forum_menu_id` = $id_menu AND `category_id` = $category_id";
					$db->order = "`sort` ASC";
					$db->limit = "";
					$db->select();
					if($db->RowCount>0) {
						$slug_submenu   = getSlugMenu($id_menu, 'forum');
						$action         = isset($_GET['af']) ? $_GET['af'] : '';
						$id             = isset($_GET['id']) ? intval($_GET['id']) : 0;

						if ($account["id"]>0 && $action == 'create') {
							echo '<div class="forum-form">';
							echo '<form id="_fm_forum" method="post" onsubmit="return update_forum(\'_fm_forum\', \'add\',' . $id_menu . ', 0);">';
							echo '<div class="forum-f-item f-margin20"><label><input type="text" class="form-control" name="title" placeholder="Nhập tên chủ đề..." required maxlength="255"></label></div>';
							echo '<div class="forum-f-item f-margin20"><label><textarea name="content" class="summernote" rows="20" placeholder="Viết nội dung chủ đề..." required></textarea></label></div>';
							echo '<div class="forum-f-item f-margin20 forum-f-btn"><label><input type="submit" class="btn btn-primary" name="add" value="Đăng chủ đề"></label><label><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . $slug_submenu . '" class="btn btn-danger">Thoát</a></label></div>';
							echo '</form>';
							echo '</div>';
						} elseif($account["id"]>0 && $action == 'edit' && $id>0) {
							$db->table = "forum";
							$db->condition = "`is_active` = 1 AND `forum_id` = $id";
							$db->order = "";
							$db->limit = 1;
							$rows_f = $db->select();
							if($db->RowCount>0) {
								$stringObj = new StringClass();
								foreach($rows_f as $row_f) {
									echo '<div class="forum-form">';
									echo '<form id="_fm_forum" method="post" onsubmit="return update_forum(\'_fm_forum\', \'edit\', ' . $id_menu . ', ' . $id . ');">';
									echo '<div class="forum-f-item f-margin20"><label><input type="text" class="form-control" name="title" value="' . stripslashes($row_f['name']) . '" placeholder="Nhập tên chủ đề..." required maxlength="255"></label></div>';
									echo '<div class="forum-f-item f-margin20"><label><textarea name="content" class="summernote" rows="20" placeholder="Viết nội dung chủ đề..." required>' . stripslashes($row_f['content']) . '</textarea></label></div>';
									echo '<div class="forum-f-item f-margin20 forum-f-btn"><label><input type="submit" class="btn btn-primary" name="edit" value="Cập nhật chủ đề"></label><label><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . $slug_submenu . '/' . $stringObj->getLinkHtml($row_f['name'], $row_f['forum_id']) . '" class="btn btn-danger">Thoát</a></label></div>';
									echo '</form>';
									echo '</div>';
								}
							} else include(_F_MODULES . DS . "error_404.php");
						} else {
							$db->table = "forum_menu";
							$db->condition = "`is_active` = 1 AND `parent` = $id_menu AND `category_id` = $category_id";
							$db->order = "`sort` ASC";
							$db->limit = "";
							$rows = $db->select();
							if ($db->RowCount > 0) {
								echo '<div class="forum-title"><h3><i class="fa fa-tags fa-fw"></i> Các chuyên mục diễn đàn</h3></div>';
								echo '<div class="forum-list">';
								foreach ($rows as $row) {
									$photo_avt = '';
									$alt = stripslashes($row['name']);
									if ($row['img'] != "" && $row['img'] != "no") {
										$photo_avt = '<img src="' . HOME_URL . '/uploads/forum_menu/' . str_replace(DS, '/', $row['folder']) . 'av-' . $row['img'] . '" alt="' . $alt . '" />';
									} else {
										$photo_avt = '<img src="' . HOME_URL . '/images/forum.png" alt="' . $alt . '" />';
									}

									$photo_avt = '<div class="img"><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . $photo_avt . '</a></div>';
									$title = '<h4 class="ellipsis-1lines"><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a></h4>';

									$f_count = $f_comment = 0;
									$right = '';

									$db->table = "forum";
									$db->condition = "`is_active` = 1  AND `forum_menu_id` = " . $row['forum_menu_id'];
									$db->order = "`created_time` DESC";
									$db->limit = "";
									$rows2 = $db->select();
									$f_count = $db->RowCount;
									$i = 0;
									foreach($rows2 as $row2) {
										$f_comment += countForumComments($row2['forum_id']);
										if($i==0) {
											$f_user = getInfoUser($row2['user_id']);
											$right = '<div class="f-right"><div class="f-box"><p class="ellipsis-1lines">Mới nhất: <a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . stripslashes($row['slug']) . '/' . $stringObj->getLinkHtml($row2['name'], $row2['forum_id']) . '" title="' . stripslashes($row2['name']) . '">' . stripslashes($row2['name']) . '</a></p><p class="f-cl-blue">' . $f_user[6] . ', <a class="f-time" title="' . $date->vnFull($row2['created_time']) . ' (lúc ' . $date->vnTime($row2['created_time']) . ')">' . convertTime5DayAgo($row2['created_time']) . '</a></p></div></div>';
										}
										$i++;
									}

									$left = '<div class="f-left"><div class="f-box">' . $title . '<p class="f-count">Đề tài thảo luận: <span>' . $f_count . '</span>; Bình luận: <span>' . $f_comment . '</span></p></div></div>';

									echo '<div class="forum-item">' . $photo_avt . '<div class="caption">' . $left . $right . '</div></div>';
								}
								echo '</div>';
							}

							//-----

							$db->table = "forum";
							$db->condition = "`is_active` = 1 AND `forum_menu_id` = $id_menu";
							$db->order = "`created_time` DESC";
							$db->limit = "";
							$rows = $db->select();
							if ($db->RowCount > 0) {
								if($account["id"]>0) echo '<div class="forum-title clearfix"><h3 class="pull-left"><i class="fa fa-tags fa-fw"></i> Các đề tài thảo luận</h3><div class="forum-btn pull-right"><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . $slug_submenu . '?af=create' . '" class="btn btn-primary btn-round">Đăng đề tài mới</a></div></div>';
								else  echo '<div class="forum-title"><h3><i class="fa fa-tags fa-fw"></i> Các đề tài thảo luận</h3></div>';

								echo '<div class="forum-list">';
								foreach ($rows as $row) {

									$title = '<h4 class="ellipsis-1lines">' . stripslashes($row['name']) . '</h4>';
								}
								echo '</div>';
								?>
								<table class="table forum-table display" cellspacing="0" cellpadding="0"
								       id="dataTablesList">
									<thead>
									<tr>
										<th width="7%">Ảnh</th>
										<th>Tiêu đề</th>
										<th width="10%">Bình luận</th>
										<th width="10%">Đã xem</th>
										<th width="10%">Thích</th>
										<th width="15%">Bình luận cuối</th>
									</tr>
									</thead>
									<thead>
									</thead>
								</table>
								<script>
									$(document).ready(function() {
										$('#dataTablesList').dataTable( {
											"language": {
												"url": "/js/data-tables/de_DE.txt"
											},
											"lengthMenu": [20, 30, 50, 80, 100],
											"info": false,
											"processing": true,
											"serverSide": true,
											"ajax": {
												url: '/action.php?url=forum_list&id=<?php echo $id_menu;?>',
												type: 'POST'
											},
											"fnRowCallback" : function(nRow, aData, iDisplayIndex) {
												$('td:eq(0)', nRow).css("text-align", "center");
												$('td:eq(2)', nRow).addClass("f-line f-right");
												$('td:eq(3)', nRow).addClass("f-line f-right");
												$('td:eq(4)', nRow).addClass("f-line f-right");
												$('td:eq(5)', nRow).addClass("f-right");
												return nRow;
											},
											"order": [[ 0, "desc" ]],
											"aoColumnDefs" : [ {
												'targets': [0, 5],
												'searchable': false,
												'orderable': false
											} ]
										} );
									});
								</script>
								<?php
							}
							if($account["id"]>0) echo '<div class="forum-btn text-right"><a href="' . HOME_URL_LANG . '/' . $slug_cat . '/' . $slug_submenu . '?af=create' . '" class="btn btn-primary btn-round">Đăng đề tài mới</a></div>';
						}
					} else {
						include(_F_MODULES . DS . "error_404.php");
					}
				}
				?>
			</div>
		</div>
	</div>
</main>