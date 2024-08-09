<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$product_id =  isset($_GET['id']) ? $_GET['id']+0 : 0;
$product_name = '';
$category_id_core = $product_menu_id = 0;
$db->table = "product";
$db->condition = "`product_id` = $product_id";
$db->order = "";
$db->limit = "";
$rows = $db->select();
foreach($rows as $row){
	$product_menu_id = $row['product_menu_id'];
	$product_name = stripslashes($row['name']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.", "?" . TTH_PATH . "=product_manager");
$category_id_core = getTableOl($product_menu_id, 'product_menu', 'product_menu_id', 'category_id');
if(isset($_POST['idDel'])){
	$idDel = $_POST['idDel'];
	$idDel = array_filter($idDel);
	if(count($idDel) > 0) {
		$dir_dest = ROOT_DIR . DS . 'uploads';
		$idDel = implode(',', $idDel);

		$db->table = "courses";
		$db->condition = "`courses_id` IN ($idDel)";
		$db->order = "";
		$db->limit = "";
		$rows = $db->select();
		foreach ($rows as $row) {
			$mask = $dir_dest . DS . "courses" . DS;
			if (!empty($row['video']) && glob($mask . $row['v_folder'] . DS . $row['video'])) {
				array_map("unlink", glob($mask . $row['v_folder'] . DS . $row['video']));
			}
			if (!empty($row['document']) && glob($mask . $row['d_folder'] . DS . $row['document'])) {
				array_map("unlink", glob($mask . $row['d_folder'] . DS . $row['document']));
			}
		}
		$db->table = "courses";
		$db->condition = "`courses_id` IN ($idDel)";
		$db->delete();

		loadPageSucces("Đã xóa dữ liệu thành công.", "?" . TTH_PATH . "=courses_list&id=" . $product_id);
	}
}
?>
<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_manager"><i class="fa fa-bookmark"></i> Đào tạo</a>
		</li>
		<li>
			<a href="?<?php echo TTH_PATH?>=product_list&id=<?php echo $product_menu_id?>"><i class="fa fa-list"></i> <?php echo getNameMenu($product_menu_id, 'product')?></a>
		</li>
		<li>
			<i class="fa fa-list"></i> <?php echo $product_name;?>
		</li>
		<li><i class="fa fa-tag"></i> Các bài giảng</li>
		<a class="btn-add-new" href="?<?php echo TTH_PATH?>=courses_add&id=<?php echo $product_id?>">Thêm bài giảng</a>
	</ol>
</div>
<!-- /.row -->
<?php dashboardCoreAdminTwo("product_list;".$category_id_core)?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-border">
			<div class="table-responsive">
				<form method="post" enctype="multipart/form-data" id="deleteArt">
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th>STT</th>
							<th>Tiêu đề</th>
							<th>Sắp xếp</th>
							<th>Trạng thái</th>
							<th>Nổi bật</th>
							<th>Lượt xem</th>
							<th>Ngày đăng</th>
							<th>Người đăng</th>
							<th>Chức năng</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$date = new DateClass();

						$db->table = "courses";
						$db->condition = "`product_id` = $product_id";
						$db->order = "`sort` ASC";
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

						$db->table = "courses";
						$db->condition = "`product_id` = $product_id";
						$db->order = "`sort` ASC";
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
								if(in_array("product_edit;".$category_id_core,$corePrivilegeSlug) && in_array("active;".$category_id_core, $corePrivilegeSlug)) {
									?>
									<td align="center">
										<?php echo showSort("sort_".$row["courses_id"]."", $countList,$row["sort"], "80%", 0, $row["courses_id"] ,'courses', 1);?>
									</td>
									<td align="center">
										<?php echo ($row["is_active"]+0==0)?
												'<div class="btn-event-close" data-toggle="tooltip" data-placement="top" title="Mở" onclick="edit_status($(this), '.$row["courses_id"].', \'is_active\', \'courses\');" rel="1">0</div>'
												:
												'<div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status($(this), '.$row["courses_id"].', \'is_active\', \'courses\');" rel="0">1</div>'
										?>
									</td>
									<td align="center">
										<?php echo ($row["hot"]+0==0)?
												'<div class="btn-event-close" data-toggle="tooltip" data-placement="top" title="Mở" onclick="edit_status($(this), '.$row["courses_id"].', \'hot\', \'courses\');" rel="1">0</div>'
												:
												'<div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status($(this), '.$row["courses_id"].', \'hot\', \'courses\');" rel="0">1</div>'
										?>
									</td>
									<?php
								} else {
									?>
									<td align="center">
										<?php echo showSort("sort_".$row["courses_id"]."", $countList,$row["sort"], "80%", 0, $row["courses_id"] ,'courses', 0);?>
									</td>
									<td align="center">
										<?php echo ($row["is_active"]+0==0)?
												'<div class="btn-event-close alertManager" data-toggle="tooltip" data-placement="top" title="Mở">0</div>'
												:
												'<div class="btn-event-open alertManager" data-toggle="tooltip" data-placement="top" title="Đóng">1</div>'
										?>
									</td>
									<td align="center">
										<?php echo ($row["hot"]+0==0)?
												'<div class="btn-event-close alertManager" data-toggle="tooltip" data-placement="top" title="Mở">0</div>'
												:
												'<div class="btn-event-open alertManager" data-toggle="tooltip" data-placement="top" title="Đóng">1</div>'
										?>
									</td>
								<?php }
								//----------- end if ------------
								?>
								<td align="center"><?php echo formatNumberVN($row['views']+0);?></td>
								<td align="center"><?php echo $date->vnDateTime($row['created_time'])?></td>
								<td align="center"><?php echo getUserName($row['user_id']);?></td>
								<td class="details-control" align="center">
									<div class="checkbox">
										<a href="?<?php echo TTH_PATH?>=test_list&id=<?php echo $row['courses_id']?>"><img data-toggle="tooltip" data-placement="top" title="Danh sách bài kiểm tra" src="images/list2.png"></a>&nbsp;|&nbsp;
										<a href="?<?php echo TTH_PATH?>=discussion_list&id=<?php echo $row['product_id']?>&courses=<?php echo $row['courses_id']?>"><img data-toggle="tooltip" data-placement="top" title="Thảo luận" src="images/comments.png"></a>&nbsp;|&nbsp;
										<a href="?<?php echo TTH_PATH?>=courses_edit&id=<?php echo $row['courses_id']?>"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/edit.png"></a>&nbsp;|&nbsp;
										<label class="checkbox-inline">
											<input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="idDel[]" value="<?php echo $row['courses_id']?>">
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
						<div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=courses_list&id='.$product_id.'&page=')?></div>
						<div class="col-sm-6" align="right" style="padding: 7px 0;">
							<label class="radio-inline"><input type="checkbox" id="selecctall"  data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả" ></label>
							<input type="button" class="btn btn-primary btn-xs <?php echo in_array("product_del;".$category_id_core,$corePrivilegeSlug)? "confirmManager" : "alertManager"?> " value="Xóa" name="deleteArt">
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
				"aTargets" : [8, "no-sort" ]
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