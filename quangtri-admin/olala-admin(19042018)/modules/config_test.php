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
			<i class="fa fa-cogs"></i> Cấu hình
		</li>
		<li>
			<i class="fa fa-mortar-board"></i> Cấu hình tự kiểm tra
		</li>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<?php
if(isset($_POST['update'])) {

	function updateConstant ($constant, $value) {
		global $db;
		$db->table = "constant";
		$data =array(
			'value'=>$db->clearText($value)
		);
		$db->condition = "constant = '".$constant."'";
		$db->update($data);
	}

	$nameConstant = $_POST["name_constant"];
	$countConstant = count($nameConstant);
	$valueConstant = $_POST["value_constant"];
	for($i = 0; $i < $countConstant; $i++) {
		updateConstant($nameConstant[$i],$valueConstant[$i]);
	}

	loadPageSucces("Đã cập nhật thông tin cấu hình thành công.","?".TTH_PATH."=config_test");
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
                <i class="fa fa-mortar-board"></i> Cấu hình tự kiểm tra
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="?<?php echo TTH_PATH?>=config_test" method="post">
                        <table class="table table-hover" style="width: 50%;">
                            <?php
                            $db->table = "constant";
                            $db->condition = "type = 7";
                            $db->order = "sort ASC";
                            $db->limit = "";
                            $rows = $db->select();

                            foreach($rows as $row) {
                                ?>
                                <tr>
                                    <td width="200px"><label><?php echo $row['name']?>:</label></td>
                                    <td>
                                        <input type="hidden" name="name_constant[]" value="<?php echo $row['constant']?>" >
                                        <input class="form-control auto-number" type="text" name="value_constant[]" maxlength="3" data-a-sep="." data-a-dec="," data-v-max="999" data-v-min="0" autocomplete="off" value="<?php echo stripslashes($row['value'])?>" >
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="2" align="center">
                                    <button type="submit" name="update" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
                                    <button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
                                    <button type="button" class="btn btn-form-info btn-form" onclick="location.href='<?php echo ADMIN_DIR?>'">Thoát</button>
                                </td>
                            </tr>
                        </table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>