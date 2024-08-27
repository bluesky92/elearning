<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function add_memberUser($act, $typeFunc, $error) {
    // global $db, $corePrivilegeSlug;
    // dashboardCoreAdmin();
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-info"></i> Thông tin thành viên
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>">
                        <input type="hidden" name="library_id" value="<?php echo ("OK");?>">
						<div class="panel-show-error">
                            <?php echo $error?>
						</div>
						<table class="table table-hover" style="width: 50%;">
					 
                            <tr>
                                <td class="ver-top"><label>Chèn File thành viên:</label></td>
                                <td>
                                    <input class="form-control file" type="file" name="file" data-show-upload="false" data-show-preview="false" data-max-file-count="1" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </td>
                            </tr>
                            
							<tr>
								<td colspan="2" align="center">
									<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
									<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=core_user'">Thoát</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function product_list(id) {
        showLoader();
        $.ajax({
            url: '/quangtri-admin/action.php',
            type: 'POST',
            data: 'url=product_list&id=' + id,
            dataType: 'html',
            success: function (data) {
                showResult('_product', data);
                return true;
            }
        });
        return false;
    }
    // $(document).ready(function() {
    //     var $dropdown = $('select[name="product_menu_id"]');
    //     console.log("OK");
    //     if ($dropdown.children('option').length >= 1) {  // 1 real option + 1 placeholder/disabled option
    //         console.log("OK11");
    //         $dropdown.trigger('change');
    //     }
    // });
</script>
<?php
}



