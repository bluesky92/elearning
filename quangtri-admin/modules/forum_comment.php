<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$forum_id =  isset($_GET['id']) ? intval($_GET['id']) : 0;
$forum_name = '';
$category_id_core = $forum_menu_id = 0;
$db->table = "forum";
$db->condition = "`forum_id` = $forum_id";
$db->order = "";
$db->limit = "";
$rows = $db->select();
foreach($rows as $row){
	$forum_menu_id = $row['forum_menu_id'];
	$forum_name = stripslashes($row['name']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.", "?" . TTH_PATH . "=forum_manager");
$category_id_core = getTableOl($forum_menu_id, 'forum_menu', 'forum_menu_id', 'category_id');
if(isset($_POST['idDel'])){
	$idDel = $_POST['idDel'];
	$idDel = array_filter($idDel);
	if(count($idDel) > 0) {
		$idDel = implode(',', $idDel);

		$db->table = "forum_comment";
		$db->condition = "forum_comment_id IN ($idDel)";
		$db->delete();

		loadPageSucces("Đã xóa các bình luận thành công.", "?" . TTH_PATH . "=forum_comment&id=" . $forum_id);
	}
}

$date = new DateClass();
$stringObj = new StringClass();
?>
<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_manager"><i class="fa fa-cubes"></i> Diễn đàn</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=forum_list&id=<?php echo $forum_menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenu($forum_menu_id, 'forum')?></a>
		</li>
		<li>
			<i class="fa fa-list"></i> <?php echo $stringObj->crop($forum_name, 5);?>
		</li>
		<li>
			<i class="fa fa-comments"></i> Bình luận
		</li>
	</ol>
</div>
<!-- /.row -->
<?php dashboardCoreAdminTwo("forum_list;".$category_id_core)?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-border">
			<div class="table-responsive">
				<form method="post" enctype="multipart/form-data" id="deleteArt">
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th width="5%">STT</th>
							<th width="30%">Bình luận</th>
							<th width="15%">Ngày bình luận</th>
							<th width="15%">Người bình luận</th>
							<th width="15%">Ngày cập nhật</th>
							<th width="15%">Người cập nhật</th>
							<th>Xóa</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$db->table = "forum_comment";
						$db->condition = "`forum_id` = $forum_id";
						$db->order = "`created_time` DESC";
						$db->limit = "";
						$rows = $db->select();
						$countList = 0;
						$countList = $db->RowCount;

						$totalpages = 0;
						$perpage = 100;
						$total = $db->RowCount;
						if($total%$perpage==0) $totalpages=$total/$perpage;
						else $totalpages = floor($total/$perpage)+1;
						if(isset($_GET["page"])) $page=$_GET["page"]+0;
						else $page=1;
						$start=($page-1)*$perpage;
						$i=0+($page-1)*$perpage;

						$db->table = "forum_comment";
						$db->condition = "`forum_id` = $forum_id";
						$db->order = "`created_time` DESC";
						$db->limit = $start.', '.$perpage;
						$rows = $db->select();

						foreach($rows as $row) {
							$i++;
							?>
							<tr>
								<td style="vertical-align: top; text-align: center;"><?php echo $i;?></td>
								<td style="vertical-align: top; max-width: 250px; overflow: hidden;"><pre style="max-width: 100%;"><?php echo stripslashes($row['content']);?></pre></td>
								<td style="vertical-align: top; text-align: center;"><?php echo $date->vnDateTime($row['created_time']);?></td>
								<td style="vertical-align: top; text-align: center;"><?php echo getUserName($row['user_id']);?></td>
								<td style="vertical-align: top; text-align: center;"><?php echo $date->vnDateTime($row['modified_time']);?></td>
								<td style="vertical-align: top; text-align: center;"><?php echo getUserName($row['modified_user']);?></td>
								<td style="vertical-align: top; text-align: center;" class="details-control">
									<div class="checkbox">
										<label class="checkbox-inline">
											<input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="idDel[]" value="<?php echo $row['forum_comment_id']?>">
										</label>
									</div>
								</td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					<div class="row">
						<div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=forum_comment&id='.$forum_id.'&page=')?></div>
						<div class="col-sm-6" align="right" style="padding: 7px 0;">
							<label class="radio-inline"><input type="checkbox" id="selecctall"  data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả" ></label>
							<input type="button" class="btn btn-primary btn-xs <?php echo in_array("forum_del;".$category_id_core,$corePrivilegeSlug)? "confirmManager" : "alertManager"?> " value="Xóa" name="deleteArt">
						</div>
					</div>
				</form>
			</div>
			<!-- /.table-responsive -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<script>
	$(document).ready(function() {
		$('#dataTablesList').dataTable( {
			"language": {
				"url": "<?php echo ADMIN_DIR?>/js/plugins/dataTables/de_DE.txt"
			},
			"aoColumnDefs" : [ {
				"bSortable" : false,
				"aTargets" : [ 6, "no-sort" ]
			} ],
			"paging":   false,
			"info":     false,
			"order": [ 0, "asc" ]
		} );

		$('#selecctall').click(function(event) {
			if(this.checked) {
				$('.checkboxArt').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkboxArt').each(function() {
					this.checked = false;
				});
			}
		});
	});
</script>
<script>
	$(".confirmManager").click(function() {
		confirm("Tất cả các dữ liệu liên quan đến bài viết sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không?", function() {
			if(this.data == true) document.getElementById("deleteArt").submit();
		});
	});
	$(".alertManager").boxes('alert', 'Bạn không được phân quyền với chức năng này.');
</script>