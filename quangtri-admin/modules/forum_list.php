<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

if(isset($_POST['idDel'])){
	$idDel = $_POST['idDel'];
	$idDel = array_filter($idDel);
	if(count($idDel) > 0) {
		$idDel = implode(',', $idDel);

		$db->table = "forum";
		$db->condition = "forum_id IN ($idDel)";
		$db->delete();
		//---
		$db->table = "forum_comment";
		$db->condition = "forum_id IN ($idDel)";
		$db->delete();
		//---
		loadPageSucces("Đã các đề tài thành công.","?".TTH_PATH."=forum_list&id=".$_POST['list_id']);
	}
}

$forum_menu_id =  isset($_GET['id']) ? $_GET['id']+0 : 0;
$category_id_core = 0;
$db->table = "forum_menu";
$db->condition = "forum_menu_id = ".$forum_menu_id;
$rows = $db->select();
foreach($rows as $row){
	$category_id_core = $row['category_id'];
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.","?".TTH_PATH."=forum_manager");
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
			<i class="fa fa-list"></i> <?php echo getNameMenu($forum_menu_id, 'forum')?>
		</li>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdminTwo("forum_list;".$category_id_core)?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-border">
			<div class="table-responsive">
				<form action="?<?php echo TTH_PATH?>=forum_list" method="post" id="deleteArt">
					<input type="hidden" name="list_id" value="<?php echo $forum_menu_id?>" />
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th>STT</th>
							<th>Tiêu đề</th>
							<th>Trạng thái</th>
							<th>Nổi bật</th>
							<th>Phản hồi</th>
							<th>Lượt xem</th>
							<th>Thích</th>
							<th>Ngày đăng</th>
							<th>Người đăng</th>
							<th>Chức năng</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$date = new DateClass();

						$query = "";
                        if(!in_array("active;".$category_id_core, $corePrivilegeSlug)) $query = " AND `user_id` = " . $_SESSION["user_id"];

						$db->table = "forum";
						$db->condition = "forum_menu_id = ".$forum_menu_id . $query;
						$db->order = "created_time DESC";
						$db->limit = "";
						$rows = $db->select();
						$countList = 0;
						$countList = $db->RowCount;

						$totalpages = 0;
						$perpage = 50;
						$total = $db->RowCount;
						if($total%$perpage==0) $totalpages=$total/$perpage;
						else $totalpages = floor($total/$perpage)+1;
						if(isset($_GET["page"])) $page=$_GET["page"]+0;
						else $page=1;
						$start=($page-1)*$perpage;
						$i=0+($page-1)*$perpage;

						$db->table = "forum";
						$db->condition = "forum_menu_id = ".$forum_menu_id . $query;
						$db->order = "created_time DESC";
						$db->limit = $start.','.$perpage;
						$rows = $db->select();

						foreach($rows as $row) {
							$i++;
							?>
							<tr>
								<td align="center"><?php echo $i?></td>
								<td><span class="tth-ellipsis"><?php echo stripslashes($row['name'])?></span></td>
								<?php
								//-----------Kiểm tra phân quyền ---------------------------------------
								if(in_array("forum_edit;".$category_id_core,$corePrivilegeSlug) && in_array("active;".$category_id_core, $corePrivilegeSlug)) {
								?>
								<td align="center">
									<?php echo ($row["is_active"]+0==0)?
										'<div class="btn-event-close" data-toggle="tooltip" data-placement="top" title="Mở" onclick="edit_status($(this), '.$row["forum_id"].', \'is_active\', \'forum\');" rel="1">0</div>'
										:
										'<div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status($(this), '.$row["forum_id"].', \'is_active\', \'forum\');" rel="0">1</div>'
									?>
								</td>
								<td align="center">
									<?php echo ($row["hot"]+0==0)?
										'<div class="btn-event-close" data-toggle="tooltip" data-placement="top" title="Mở" onclick="edit_status($(this), '.$row["forum_id"].', \'hot\', \'forum\');" rel="1">0</div>'
										:
										'<div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status($(this), '.$row["forum_id"].', \'hot\', \'forum\');" rel="0">1</div>'
									?>
								</td>
								<?php
								} else {
								?>
								<td align="center">
									<?php echo ($row["is_active"]+0==0)?
										'<div class="btn-event-close alertManager" data-toggle="tooltip" data-placement="top" title="Mở">0</div>'
										:
										'<div class="btn-event-open alertManager" data-toggle="tooltip" data-placement="top" title="Đóng">1</div>'
									?>
								</td>
								<td align="center">
									<?php echo ($row["hot"]+0==0)?
										'<div class="btn-event-close alertManager" data-toggle="tooltip" data-placement="top" title="Mở"></div>'
										:
										'<div class="btn-event-open alertManager" data-toggle="tooltip" data-placement="top" title="Đóng"></div>'
									?>
								</td>
								<?php }
								//----------- end if ------------
								?>
								<td align="center"><?php echo countForumComments($row['forum_id']);?></td>
								<td align="center"><?php echo formatNumberVN($row['views']);?></td>
								<td align="center"><?php echo formatNumberVN($row['c_like']);?></td>
								<td align="center"><?php echo $date->vnDateTime($row['created_time'])?></td>
								<td align="center"><?php echo getUserName($row['user_id']);?></td>
								<td class="details-control" align="center">
									<div class="checkbox">
										<a href="?<?php echo TTH_PATH?>=forum_comment&id=<?php echo $row['forum_id']?>"><img data-toggle="tooltip" data-placement="top" title="Bình luận" src="images/comments.png"></a>&nbsp;|&nbsp;
										<a href="<?php echo '?'.TTH_PATH.'=forum_edit&id='.$row['forum_id']?>"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/edit.png"></a>&nbsp;|&nbsp;
										<label class="checkbox-inline">
											<input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="idDel[]" value="<?php echo $row['forum_id']?>">
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
						<div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=forum_list&id='.$forum_menu_id.'&page=')?></div>
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
				"aTargets" : [9, "no-sort" ]
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
	$(".confirmManager").click(function() {
		var element = $(this);
		var action = element.attr("id");
		confirm("Tất cả các dữ liệu liên quan đến bài viết sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không?", function() {
			if(this.data == true) document.getElementById("deleteArt").submit();
		});
	});
	$(".alertManager").boxes('alert', 'Bạn không được phân quyền với chức năng này.');
</script>