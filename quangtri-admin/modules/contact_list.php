<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
?>
<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<i class="fa fa-edit"></i> Quản lý nội dung
		</li>
		<li>
			<i class="fa fa-send-o"></i> Thư liên hệ
		</li>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<?php
if(isset($_POST['idDel'])){

	$idDel = implode(',',$_POST['idDel']);

	$db->table = "contact";
	$db->condition = "contact_id IN (".$idDel.")";
	$db->delete();
	loadPageSucces("Đã thực hiện thao tác Xóa thành công.","?".TTH_PATH."=contact_list");
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-border">
			<div class="table-responsive">
				<form action="?<?php echo TTH_PATH?>=contact_list" method="post" enctype="multipart/form-data" id="delete">
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Tên khách hàng</th>
							<th>Email</th>
							<th>Điện thoại</th>
							<th>Trạng thái</th>
							<th>Ngày gửi</th>
							<th>Chọn</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$date = new DateClass();

						$db->table = "contact";
						$db->condition = "";
						$db->order = "created_time DESC";
						$rows = $db->select();

						$totalpages = 0;
						$perpage = 100;
						$total = $db->RowCount;
						if($total%$perpage==0) $totalpages=$total/$perpage;
						else $totalpages = floor($total/$perpage)+1;
						if(isset($_GET["page"])) $page=$_GET["page"]+0;
						else $page=1;
						$start=($page-1)*$perpage;
						$i=0+($page-1)*$perpage;

						$db->table = "contact";
						$db->condition = "";
						$db->order = "created_time DESC";
						$db->limit = $start.','.$perpage;
						$rows = $db->select();

						foreach($rows as $row) {
							$i++;
							?>
							<tr>
								<td align="center"><?php echo $i?></td>
								<td><?php echo stripslashes($row['name'])?></td>
								<td><?php echo stripslashes($row['email'])?></td>
								<td><?php echo stripslashes($row['phone'])?></td>
								<td align="center">
									<?php echo ($row["is_active"]+0==0)?
											'<button type="button" id="_v_'.$row["contact_id"].'" class="btn btn-success btn-sm-sm" data-toggle="tooltip" data-placement="top" title="Chuyển sang: Chưa xem" onclick="status_view($(this), '.$row["contact_id"].', \'is_active\', \'contact\');" rel="1">Đã xem</button>'
											:
											'<button type="button" id="_v_'.$row["contact_id"].'" class="btn btn-warning btn-sm-sm" data-toggle="tooltip" data-placement="top" title="Chuyển sang: Đã xem" onclick="status_view($(this), '.$row["contact_id"].', \'is_active\', \'contact\');" rel="0">Chưa xem</button>'
									?>
								</td>
								<td align="center"><?php echo $date->vnDateTime($row['created_time'])?></td>
								<td class="details-control" align="center">
									<span class="btn btn-primary btn-sm-sm" data-toggle="modal" data-target="#_contact" onclick="return open_modal_contact(<?php echo $row['contact_id']?>);">Xem</span>&nbsp;
									<div class="checkbox">
										<label class="checkbox-inline">
											<input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkbox" name="idDel[]" value="<?php echo $row['contact_id']?>">
										</label>
									</div>
								</td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					<!-- Modal -->
					<div class="modal fade" id="_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
					<!-- /.modal -->
					<div class="row">
						<div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=contact_list&page=')?></div>
						<div class="col-sm-6" align="right" style="padding: 7px 0;">
							<label class="radio-inline"><input type="checkbox" id="selecctall"  data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả" ></label>
							<input type="button" class="btn btn-primary btn-xs confirmManager" value="Xóa" name="delete">
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
				$('.checkbox').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkbox').each(function() {
					this.checked = false;
				});
			}
		});
	});
	$(".confirmManager").click(function() {
		var element = $(this);
		var action = element.attr("id");
		confirm("Tất cả các dữ liệu liên quan sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không?", function() {
			if(this.data == true) document.getElementById("delete").submit();
		});
	});
</script>