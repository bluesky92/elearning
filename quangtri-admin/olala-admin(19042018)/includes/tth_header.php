<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$date = new DateClass();
?>

<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
	    <i class="fa fa-bars fa-2x"></i>
    </button>
	<a class="navbar-brand" target="_blank" title="Thiết kế website Đà Nẵng, Olala Web" href="https://olalaweb.vn">
		<img src="./images/olala-adminpanel.png" height="40px" alt="Logo Olala Admin Panel" />
	</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
	<?php
	$count = '';
	$db->table = "notify_status";
	$db->condition = "`type` = 0 AND `status` = 0 AND `user_id` = " . $_SESSION["user_id"];
    $db->order = "`status` ASC, `modified_time` DESC";
	$db->limit = "";
	$rows = $db->select();
	if($db->RowCount>0) $count = '<span class="notification-label">' . $db->RowCount . '</span>';

	$db->table = "notify_status";
	$db->condition = "`type` = 0 AND `user_id` = " . $_SESSION["user_id"];
	$db->order = "`status` ASC, `modified_time` DESC";
	$db->limit = 50;
	$rows = $db->select();
	if($db->RowCount>0) {
		$date = new DateClass();
		//---
		?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-globe fa-fw fa-lg"></i> <i class="fa fa-caret-down"></i> <?php echo $count;?></a>
			<div id="_notify" class="dropdown-menu dropdown-alerts">
				<div class="node-hv">&nbsp;</div>
				<ul class="header-list-notification">
					<?php
					foreach($rows as $row) {
						echo infoItemNotify($row['notify_status_id'], $row['notify_id'], $row['status']);
					}
					?>
				</ul>
			</div>
		</li>
	<?php } ?>
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<img height="20px" src="images/f_<?php echo TTH_LANGUAGE?>.png"> <i class="fa fa-database fa-fw fa-lg"></i> <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu">
			<div class="node-hv">&nbsp;</div>
			<li>
				<a href="javascript:_postback();" onclick="Forward('?<?php echo TTH_PATH?>=set_language&lang=vi');"><img height="25px" src="images/f_vi.png">&nbsp; (vi-vn)</a>
			</li>
			<!--
			<li class="divider"></li>
			<li>
				<a href="javascript:_postback();" onclick="Forward('?<?php echo TTH_PATH?>=set_language&lang=en');"><img height="25px" src="images/f_en.png">&nbsp; (en-us)</a>
			</li>
			-->
		</ul>
	</li>
    <li class="dropdown">
        <a class="dropdown-toggle toggle-user" data-toggle="dropdown" href="#">
            <?php
            $info_user = array();
            $info_user = getInfoUser($_SESSION["user_id"]);
            ?>
            <label class="tth-user-admin"><?php echo $info_user[4] . ' ' . $info_user[0];?>&nbsp; <i class="fa fa-caret-down"></i></label>
        </a>
        <ul class="dropdown-menu dropdown-user">
	        <div class="node-hv">&nbsp;</div>
            <li>
                <a href="javascript:_postback();" onclick="Forward('?<?php echo TTH_PATH?>=core_user_changeinfo&active=info');"><i class="fa fa-user fa-fw fa-slideDown"></i> Thông tin cá nhân</a>
            </li>
	        <li>
		        <a href="javascript:_postback();" onclick="Forward('?<?php echo TTH_PATH?>=core_user_changeinfo&active=pass');"><i class="fa fa-gear fa-fw"></i> Đổi mật khẩu</a>
	        </li>
            <li class="divider"></li>
            <li>
	            <a target="_blank" href="mailto:<?php echo $info_user[3];?>"><i class="fa fa-envelope fa-fw"></i> Gửi thư điện tử</a>
            </li>
            <li class="divider"></li>
	        <li>
		        <a target="_blank" href="/"><i class="fa fa-external-link fa-fw"></i> Trang chủ site</a>
	        </li>
            <li>
                <a href="javascript:_postback();" onclick="Forward('?logout=OK');"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
            </li>
        </ul>
    </li>
</ul>