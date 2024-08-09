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
			<i class="fa fa-book"></i> Thư viện đề thi
		</li>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<?php
if(isset($_POST['idDel'])){

	$idDel = implode(',',$_POST['idDel']);

    $db->table = "library_answer";
    $db->condition = "library_id IN ($idDel)";
    $db->delete();

	$db->table = "library";
	$db->condition = "library_id IN ($idDel)";
	$db->delete();
	loadPageSucces("Đã thực hiện thao tác Xóa thành công.","?".TTH_PATH."=library_list");
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-border">
            <div class="panel-tool">
                <a class="btn-download-bdb fa fa-download" href="?<?php echo TTH_PATH?>=library_add">Thêm câu hỏi</a>
                <a class="btn-download-bdb" target="_blank" href="/uploads/library/(Temp)_Cau-hoi.xls"><i class="fa fa-download fa-fw"></i> Tải mẫu nhập file Excel...</a>
            </div>
			<div class="table-responsive">
				<form action="?<?php echo TTH_PATH?>=library_list" method="post" enctype="multipart/form-data" id="delete">
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th>STT</th>
							<th>Câu hỏi</th>
                            <th>Chủ đề</th>
                            <th>Loại câu</th>
							<th>Trạng thái</th>
                            <th>Ngày đăng</th>
							<th>Người đăng</th>
							<th>Chọn</th>
						</tr>
						</thead>
                        <thead>
                        <tr>
                            <td align="center">-</td>
                            <td><input type="text" data-column="1" class="form-control filter"></td>
                            <td><input type="text" data-column="2" class="form-control filter"></td>
                            <td align="center"><select data-column="3" class="form-control filter"><option value="">Loại câu...</option><option value="1">Trắc nghiệm</option><option value="2">Tự luận</option></select></td>
                            <td align="center"><select data-column="4" class="form-control filter"><option value="">Trạng thái...</option><option value="1">Đóng (Đỏ)</option><option value="2">Mở (Xanh)</option></select></td>
                            <td><input type="text" data-column="5" class="form-control filter input-date text-center"></td>
                            <td><input type="text" data-column="6" class="form-control filter text-center"></td>
                            <td align="center">-</td>
                        </tr>
                        </thead>
                    </table>
					<div class="row">
						<div class="col-xs-12" align="right">
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
        $('#dataTablesList tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
        var table = $('#dataTablesList').DataTable( {
            "language": {
                "url": "<?php echo ADMIN_DIR?>/js/plugins/dataTables/de_DE.txt"
            },
            "lengthMenu": [50, 100, 200, 500],
            "info":     false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '/olala-admin/action.php',
                type: 'POST',
                data: {
                    url: 'library_list',
                    type: 'load'
                }
            },
            "fnRowCallback" : function(nRow, aData, iDisplayIndex) {
                $('td:eq(0)', nRow).css( "text-align", "center" );
                $('td:eq(3)', nRow).css( "text-align", "center" );
                $('td:eq(4)', nRow).css( "text-align", "center" );
                $('td:eq(5)', nRow).css( "text-align", "center" );
                $('td:eq(6)', nRow).css( "text-align", "center" );
                $('td:eq(7)', nRow).css( "text-align", "center" );
                return nRow;
            },
            "order": [[ 0, "desc" ]],
            "aoColumnDefs" : [ {
                'targets': [7],
                'searchable':false,
                'orderable':false
            } ]
        });
        // Apply the search
        table.columns().eq( 0 ).each( function () {
            $( 'input.filter' ).on( 'keyup change', function () {
                var i =$(this).attr('data-column');
                var v =$(this).val();
                table.columns(i).search(v).draw();
            });
            $( 'select.filter' ).each( function () {
                $(this).on( 'change', function () {
                    var i =$(this).attr('data-column');
                    var v =$(this).val();
                    table.columns(i).search(v).draw();
                });
                var i = $(this).attr('data-column');
                var v = $(this).val();
                table.columns(i).search(v).draw();
            });
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
    $('.input-date').datetimepicker({
        lang:'vi',
        timepicker: false,
        closeOnDateSelect:true,
        format:'<?php echo TTH_DATE_FORMAT;?>'
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