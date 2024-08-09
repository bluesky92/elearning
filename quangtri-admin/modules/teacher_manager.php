<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<i class="fa fa-dashboard"></i> Quản lý nội dung
		</li>
		<li>
			<i class="fa fa-male"></i> Quản lý giáo viên
		</li>
		<a class="btn-add-new" href="?<?php echo TTH_PATH?>=teacher_add">Thêm giáo viên</a>
		<br></br>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<?php
if(isset($_POST['idDel'])){
	$dir_dest = ROOT_DIR . DS .'uploads'. DS . 'user';

	$idDel = implode(',',$_POST['idDel']);

	$db->table = "teachers";
	$db->condition = "teachers_id IN (".$idDel.")";
	$db->order = "";
	$rows = $db->select();
	foreach($rows as $row) {
		if(!empty($row['img']) && glob($dir_dest . DS . '*'.$row['img'])) {
			array_map("unlink", glob($dir_dest . DS . '*'.$row['img']));
		}
	}

	$db->table = "teachers";
	$db->condition = "teachers_id IN (".$idDel.")";
	$db->delete();
	loadPageSucces("Đã xóa giáo viên thành công.","?".TTH_PATH."=teacher_manager");
}
?>
<div>
<li></li>
<li></li>
 </div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-border">
			<div class="table-responsive">
				<form action="?<?php echo TTH_PATH?>=teacher_manager" method="post" id="deleteArt">
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th>STT</th>
							<th>Avatar</th> 
                            <th>Họ và tên</th>
							<th>Học vị</th>
							<th>Thời gian cập nhật</th>
							<th>Chức năng</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$date = new DateClass();
						$countList = 0;

						$db->table = "teachers";
						$db->condition = "";
						$db->order = "`teachers_id` ASC";
						$db->limit = "";
						$rows = $db->select();
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

						$db->table = "teachers";
						$db->condition = "";
						$db->order = "`teachers_id` ASC";
						$db->limit = $start.','.$perpage;
						$rows = $db->select();

						foreach($rows as $row) {
							$i++;
							?>
							<tr>
								<td align="center"><?php echo $i?></td>
								<td align="center">
									<?php echo ($row["img"]=='no')?
										'<img data-toggle="tooltip" data-placement="top" title="Không có hình" src="images/error.png">'
										:
										'<img id="popover-'.$i.'" class="btn-popover" title="'.stripslashes($row["name"]).'" src="images/OK.png">
										<script>
											var image = \'<img src="../uploads/user/'.$row["img"].'">\';
											$(\'#popover-'.$i.'\').popover({placement: \'bottom\', content: image, html: true});
										</script>' 
									?>
								</td> 
                                <td align="center"> <?php echo stripslashes($row['full_name']);?></td>
                                <td align="center">
									<?php echo stripslashes($row['hocvi'])?>
								</td>
														
								<td align="center"><?php echo $date->vnDateTime($row['modified_time'])?></td>
								
								<td class="details-control" align="center">
									<div class="checkbox">
										<a href="?<?php echo TTH_PATH?>=teacher_edit&id=<?php echo $row['teachers_id']?>"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/edit.png"></a> &nbsp;
										<label class="checkbox-inline">
											<input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkboxArt" name="idDel[]" value="<?php echo $row['teachers_id']?>">
										</label>&nbsp;&nbsp;
								
									</div>
								</td>
								
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					
					<div class="row">
						<div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=teacher_manager&page=')?></div>
						<div class="col-sm-6" align="right" style="padding: 7px 0;">
							<label class="radio-inline"><input type="checkbox" id="selecctall"  data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả" ></label>
							<input type="button" class="btn btn-primary btn-xs confirm" value="Xóa" name="deleteArt">
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
				"aTargets" : [1,8, "no-sort" ]
			} ],
			"paging":   false,
			"info":     false,
			"order": [0, "asc" ]
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
	$(".confirm").click(function() {
		var element = $(this);
		var action = element.attr("id");
		confirm("Tất cả các dữ liệu liên quan sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không nào?", function() {
			if(this.data == true) document.getElementById("deleteArt").submit();
		});
	});
</script>