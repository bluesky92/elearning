<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$examination_id     =  isset($_GET['id']) ? intval($_GET['id']) : 0;
$examination_title  = '';
$examination_count  = 0;
$db->table = "examination";
$db->condition = "`examination_id` = $examination_id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach($rows as $row){
    $examination_title = stripslashes($row['title']);
    $examination_count = intval($row['count']);
}
if($db->RowCount==0) loadPageAdmin("Mục không tồn tại.","?".TTH_PATH."=article_manager");
?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
        <li>
            <a href="?<?php echo TTH_PATH?>=examination_list"><i class="fa fa-edit"></i> Quản lý nội dung</a>
        </li>
        <li>
            <a href="?<?php echo TTH_PATH?>=examination_list"><i class="fa fa-mortar-board"></i> Kiểm tra - Kết quả</a>
        </li>
        <li>
            <i class="fa fa-list"></i> <?php echo $examination_title;?>
        </li>
        <li>
			<i class="fa fa-users"></i> Thành phần
		</li>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default panel-no-border">
            <div class="table-responsive">
                <form action="?<?php echo TTH_PATH?>=examination_list" method="post" enctype="multipart/form-data" id="delete">
                    <table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
                        <thead>
                        <tr>
                            <th width="50px">STT</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Bài kiểm tra</th>
                            <th>Làm kiểm tra lúc</th>
                            <th>Kết thúc lúc</th>
                            <th>Kết quả</th>
                            <th>Chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $date = new DateClass();
                        $stringObj = new String();

                        $db->table = "examination_logs";
                        $db->condition = "`examination_id` = $examination_id";
                        $db->order = "";
                        $db->limit = "";
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

                        $db->table = "examination_logs";
                        $db->condition = "`examination_id` = $examination_id";
                        $db->order = "";
                        $db->limit = $start . ', ' . $perpage;
                        $rows = $db->select();

                        foreach($rows as $row) {
                            $i++;

                            $db->table = "examination_answer";
                            $db->condition = "`examination_id` = $examination_id AND `user_id` = " . intval($row['user_id']) . " AND `test` = 1";
                            $db->order = "";
                            $db->limit = "";
                            $db->select();
                            $total_match = $db->RowCount;
                            ?>
                            <tr>
                                <td align="center"><?php echo $i?></td>
                                <td><?php echo getUserName(intval($row['user_id']));?></td>
                                <td><?php echo getUserFullName(intval($row['user_id']));?></td>
                                <td align="center">
                                    <?php echo (intval($row["status"])==1)?
                                        '<button type="button" class="btn btn-success btn-sm-sm" data-toggle="tooltip" data-placement="top" title="Đã làm bài kiểm tra xong" rel="0">Đã làm xong</button>'
                                        :
                                        '<button type="button" class="btn btn-warning btn-sm-sm" data-toggle="tooltip" data-placement="top" title="Chưa làm bài kiểm tra xong" rel="1">Chưa làm xong</button>'
                                    ?>
                                </td>
                                <td align="center"><?php echo $date->vnDateTime($row['start']);?></td>
                                <td align="center"><?php echo $date->vnDateTime($row['end']);?></td>
                                <td align="center"><?php echo $total_match . '/' . $examination_count;?></td>
                                <td class="details-control" align="center">
                                    <div class="checkbox">
                                        <?php
                                        if(intval($row["status"])==1) echo '<a data-toggle="modal" data-target="#_examination" href="javascript:;" onclick="return open_modal_examination(' . $examination_id . ', ' . intval($row['user_id']) . ');"><img data-toggle="tooltip" data-placement="top" title="Xem kết quả kiểm tra" src="images/list.png"></a>';
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="_examination" tabindex="-1" role="dialog" aria-labelledby="examinationModalLabel" aria-hidden="true"></div>
            <!-- /.modal -->
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
				"aTargets" : [ 7, "no-sort" ]
			} ],
			"paging":   false,
			"info":     false,
			"examination": [ 0, "asc" ]
		} );
	});
</script>