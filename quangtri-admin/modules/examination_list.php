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
			<i class="fa fa-mortar-board"></i> Kiểm tra - Kết quả
		</li>
        <a class="btn-add-new" href="?<?php echo TTH_PATH?>=examination_add">Thêm bài kiểm tra</a>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<?php
if(isset($_POST['idDel'])){
	$idDel = implode(',',$_POST['idDel']);

    $db->table = "notify";
    $db->condition = "`post` IN ($idDel)";
    $db->order = "";
    $db->limit = "";
    $rows = $db->select();
    foreach ($rows as $row) {
        $db->table = "notify_status";
        $db->condition = "`notify_id` = " . $row['notify_id'];
        $db->delete();
    }
    $db->table = "notify";
    $db->condition = "`post` IN ($idDel)";
    $db->delete();

    $db->table = "examination_logs";
    $db->condition = "`examination_id` IN ($idDel)";
    $db->delete();

    $db->table = "examination_answer";
    $db->condition = "`examination_id` IN ($idDel)";
    $db->delete();

	$db->table = "examination";
	$db->condition = "`examination_id` IN ($idDel)";
	$db->delete();
	loadPageSucces("Đã thực hiện thao tác Xóa thành công.","?".TTH_PATH."=examination_list");
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default panel-no-border">
            <div class="table-responsive">
                <form action="?<?php echo TTH_PATH?>=examination_list" method="post" enctype="multipart/form-data" id="delete">
                    <table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
                        <thead>
                        <tr>
                            <th width="50px">STT</th>
                            <th>Kiểm tra</th>
                            <th>Khóa học</th>
                            <th>Thời gian</th>
                            <th>Lúc bắt đầu</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng</th>
                            <th>Người đăng</th>
                            <th>Chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $date = new DateClass();
                        $stringObj = new StringClass();

                        $query = "";
                        if(!in_array("examination_active", $corePrivilegeSlug)) $query = "`user_id` = " . $_SESSION["user_id"];

                        $db->table = "examination";
                        $db->condition = $query;
                        $db->order = "`created_time` DESC";
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

                        $db->table = "examination";
                        $db->condition = $query;
                        $db->order = "`created_time` DESC";
                        $db->limit = $start.','.$perpage;
                        $rows = $db->select();

                        foreach($rows as $row) {
                            $i++;
                            ?>
                            <tr>
                                <td align="center"><?php echo $i?></td>
                                <td><?php echo $stringObj->crop(stripslashes($row['title']), 20);?></td>
                                <td><?php echo getNameProductMenu($row['product_menu_id']);?></td>
                                <td><?php echo intval($row['time']);?> (phút)</td>
                                <td align="center"><?php echo $date->vnDateTime($row['start']);?></td>
                                <?php
                                //-----------Kiểm tra phân quyền ---------------------------------------
                                if(in_array("examination_edit",$corePrivilegeSlug) && in_array("examination_active", $corePrivilegeSlug)) {
                                    ?>
                                    <td align="center">
                                        <?php echo ($row["is_active"]+0==0)?
                                            '<div class="btn-event-close" data-toggle="tooltip" data-placement="top" title="Mở" onclick="edit_status($(this), ' . intval($row["examination_id"]) . ', \'is_active\', \'examination\');" rel="1">0</div>'
                                            :
                                            '<div class="btn-event-open" data-toggle="tooltip" data-placement="top" title="Đóng" onclick="edit_status($(this), ' . intval($row["examination_id"]) . ', \'is_active\', \'examination\');" rel="0">1</div>'
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
                                <?php }
                                //----------- end if ------------
                                ?>
                                <td align="center"><?php echo $date->vnDateTime($row['created_time']);?></td>
                                <td align="center"><?php echo getUserName($row['user_id']);?></td>
                                <td class="details-control" align="center">
                                    <div class="checkbox">
                                        <a href="?<?php echo TTH_PATH?>=examination_logs&id=<?php echo intval($row['examination_id'])?>"><img data-toggle="tooltip" data-placement="top" title="Xem kết quả kiểm tra" src="images/list.png"></a>&nbsp;|&nbsp;
                                        <a href="?<?php echo TTH_PATH?>=examination_edit&id=<?php echo intval($row['examination_id'])?>"><img data-toggle="tooltip" data-placement="top" title="Chỉnh sửa" src="images/edit.png"></a> &nbsp;
                                        <label class="checkbox-inline">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Xóa" class="checkbox" name="idDel[]" value="<?php echo intval($row['examination_id'])?>">
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
                        <div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=examination_list&page=')?></div>
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
				"aTargets" : [ 8, "no-sort" ]
			} ],
			"paging":   false,
			"info":     false,
			"examination": [ 0, "asc" ]
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
    $(".alertManager").boxes('alert', 'Bạn không được phân quyền với chức năng này.');
</script>