<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$date = new DateClass();
$stringObj = new StringClass();
if($account["id"]==0) {
	exit(header('Location: ' . HOME_URL_LANG));
} elseif(!isset($path[2])) {
	exit(header('Location: ' . HOME_URL_LANG . '/user/edit-profile'));
}
?>
<main class="profile">
	<div class="main-profile">
		<div class="container">
			<ul class="col-lg-12 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
				<li class="<?php if($path[2]=='edit-profile') echo 'active ';?>col-sm-3 col-xs-6 profile-item-nav" role="presentation">
					<a href="<?php echo HOME_URL_LANG;?>/user/edit-profile">Thông tin cá nhân</a>
				</li>
				<li class="<?php if($path[2]=='edit-account') echo 'active ';?>profile-item-nav col-sm-3 col-xs-6" role="presentation">
					<a href="<?php echo HOME_URL_LANG;?>/user/edit-account">Tài khoản</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:#fff;padding-bottom:30px;">
			<?php if($path[2]=='edit-account') {
			$alert = '';
			if(isset($_POST['change-password'])) {
				$p_user = isset($_POST["user"]) ? $_POST["user"] : array();
				$db->table = "core_user";
				$db->condition = "`user_id` = " . $account["id"] . " AND `password` = '".md5($db->clearText($USER[6].$p_user['current_password']))."'";
				$db->order = "";
				$db->limit = 1;
				$db->select();
				if($db->RowCount>0) {
					$data = array(
						'password' => md5($db->clearText($USER[6].$p_user['password'])),
						'modified_time' => time()
					);
					$db->condition = "`user_id` = " . $account["id"];
					$db->update($data);
					if($db->AffectedRows>0) $alert = '<div class="alert alert-success" role="alert">Đổi mật khẩu thành công.</div>';
				} else $alert = '<div class="alert alert-danger" role="alert">Mật khẩu hiện tại không chính xác!</div>';
			}
			?>
			<div class="profile-right tab-pane active in" id="account">
				<div class="profile-account clearfix">
					<form action="<?php echo HOME_URL_LANG;?>/user/edit-account" class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xs-12 form-horizontal" id="change-password-form" method="post" novalidate="novalidate">
						<?php echo $alert;?>
						<div class="row info-title">Thay đổi mật khẩu</div>
						<div class="row info-data">
							<label class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-5">Tên tài khoản</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
								<span><?php echo $USER[6];?></span>
							</div>
						</div>
						<div class="row info-data">
							<label class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-5">Mật khẩu hiện tại</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
								<input type="password" name="user[current_password]">
							</div>
						</div>
						<div class="row info-data">
							<label class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-5">Mật khẩu mới</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
								<input type="password" id="user_password" name="user[password]">
							</div>
						</div>
						<div class="row info-data">
							<label class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-5">Xác nhận mật khẩu mới</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
								<input type="password" name="user[password_confirmation]">
							</div>
						</div>
						<div class="row">
							<div class="password-save col-lg-11 col-md-11 col-sm-11">
								<input class="btn btn-default" type="submit" name="change-password" value="Lưu thay đổi">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php } elseif($path[2]=='edit-profile') {
				$alert = '';
				if(isset($_POST['profile'])) {
					$p_user = isset($_POST["user"]) ? $_POST["user"] : array();
					$db->table = "core_user";
					$data = array(
						'full_name' => $db->clearText($p_user['name']),
						'phone' => $db->clearText($p_user['tel']),
						'email' => $db->clearText($p_user['email']),
						'address' => $db->clearText($p_user['address']),
						'comment' => $db->clearText($p_user['comment']),
						'modified_time' => time()
					);
					$db->condition = "`user_id` = " . $account["id"];
					$db->update($data);
					if($db->AffectedRows>0) $alert = '<div class="alert alert-success" role="alert">Cập nhật thông tin thành công.</div>';
					else $alert = '<div class="alert alert-danger" role="alert">Quá trình cập nhật thông tin xảy ra lỗi!</div>';
					$USER = getInfoUser($account["id"]);
				}
			?>
			<div class="row profile-right tab-pane fade active in" id="profile">
				<div class="profile-form clearfix">
					<div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-4 col-xs-12 xs-center">
						<div class="profile-avatar">
							<div class="avatar-action-choose text-center">
								<form id="change_avt" name="avatar" method="post" enctype="multipart/form-data" onsubmit="return change_avatar('change_avt');">
									<div class="file-upload btn btn-default" id="file-upload" onclick="return trigger_input();" style="background-image: url('<?php echo $USER[7];?>');">
										<div class="overflow">
											<span id="select_img">Thay đổi ảnh đại diện</span>
										</div>
										<input accept=".png, .jpg" class="upload" id="edit__avatar" onchange="return change_avatar('change_avt');" name="new_avatar" style="display: none;" type="file">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
						<div class="row">
							<form action="<?php echo HOME_URL_LANG;?>/user/edit-profile" class="col-xs-12" method="post">
								<?php echo $alert;?>
								<div class="row info-title">Thông tin cơ bản</div>
								<div class="row info-data" style="margin-top: 10px;">
									<label class="col-md-3 col-sm-3 col-xs-5">Họ tên đầy đủ</label>
									<div class="col-md-9 col-sm-9 col-xs-7 info-content">
										<input name="user[name]" type="text" value="<?php echo $USER[0];?>">
									</div>
								</div>
								<div class="row info-data" style="margin-top: 10px;">
									<label class="col-md-3 col-sm-3 col-xs-5">Số điện thoại</label>
									<div class="col-md-9 col-sm-9 col-xs-7 info-content">
										<input name="user[tel]" type="text" value="<?php echo $USER[2];?>">
									</div>
								</div>
								<div class="row info-data" style="margin-top: 10px;">
									<label class="col-md-3 col-sm-3 col-xs-5">Email</label>
									<div class="col-md-9 col-sm-9 col-xs-7 info-content">
										<input name="user[email]" type="text" value="<?php echo $USER[3];?>">
									</div>
								</div>
								<div class="row info-data" style="margin-top: 10px;">
									<label class="col-md-3 col-sm-3 col-xs-5">Địa chỉ</label>
									<div class="col-md-9 col-sm-9 col-xs-7 info-content">
										<input name="user[address]" type="text" value="<?php echo $USER[8];?>">
									</div>
								</div>
								<div class="row info-data" style="margin-top: 20px;">
									<label class="col-md-5 col-sm-5 col-xs-6">Giới thiệu bản thân</label>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
										<textarea name="user[comment]" placeholder="Đôi dòng giới thiệu về bản thân bạn..." rows="3"><?php echo $USER[9];?></textarea>
									</div>
								</div>
								<div class="row" style="margin-top: 20px;">
									<input class="btn btn-default profile-button-save pull-right" name="profile" type="submit" value="Lưu thay đổi">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</main>
