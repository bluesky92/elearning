<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
$slug = getSlugCategory(89);
?>
<!-- .header -->
<header class="header-new">
    <div class="fixed-menu">
        <div class="header-inner rel">
            <div class="container-fluid">
                <div class="flex-container">
					<div class="pull-center" id="time"></div>
                    <div>
                        <img src="../images/logo_QT.png"/>
                    </div>
                    <div class="pull-center" ></div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="flex-container">
                    <div class="pull-left"><a style="color:white;" href="<?php echo HOME_URL_LANG . '/' . getSlugCategory(98);?>"
                            class="link-forum"><i></i> <?php echo getNameCategory(98);?></a></div>
                    <div class="pull-left"><a style="color:white;" href="<?php echo HOME_URL_LANG . '/' . getSlugCategory(89);?>"
                            class="link-forum"><i></i> <?php echo getNameCategory(89);?></a></div>
                    <div class="pull-left"><a style="color:white;" href="<?php echo HOME_URL_LANG . '/' . getSlugCategory(102);?>"
                            class="link-forum"><i></i> <?php echo getNameCategory(102);?></a></div>
                    <div class="pull-left"><a data-target="#el-modal" data-toggle="modal" style="color:white;" href="javascript:;" onclick="return open_modal(0, 'self_test');">
                        <i></i> <?php echo getNameCategory(103);?></a>
                    </div>
                    <div class="pull-left"><a style="color:white;" href="<?php echo HOME_URL_LANG . '/' . getSlugCategory(104);?>"
                            class="link-forum"><i></i> <?php echo getNameCategory(104);?></a></div>
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar-collapse" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="pull-right"></div>

                    <?php
				if($account["id"]>0) {
					$count = '';
					$db->table = "notify_status";
					$db->condition = "`type` = 1 AND `status` = 0 AND `user_id` = " . $account["id"];
                    $db->order = "`status` ASC, `modified_time` DESC";
					$db->limit = "";
					$db->select();
					if($db->RowCount>0) $count = $db->RowCount;
					//
				?>
                    <div class="hd-user logged_in">
                        <div class="btn-group notification-dropdown">
                            <div aria-expanded="false" class="dropdown-toggle read-noti" data-toggle="dropdown">
                                <div class="notification">
                                    <div class="notification-button"><i class="fa fa-bell"></i><span
                                            class="badge noti-count"><?php echo $count;?></span></div>
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-notification">
                                <h5 class="title">Thông báo</h5>
                                <div class="noti-mask" id="flux">
                                    <?php
								$date = new DateClass();
								$stringObj = new StringClass();
								//---
								$db->table = "notify_status";
								$db->condition = "`type` = 1 AND `user_id` = " . $account["id"];
                                $db->order = "`status` ASC, `modified_time` DESC";
                                $db->limit = 50;
								$rows = $db->select();
								if($db->RowCount>0) {
									echo '<ul class="notifications-container">';
									foreach ($rows as $row) {
										echo infoItemNotify($row['notify_status_id'], $row['notify_id'], $row['status']);
									}
									echo '</ul>';
								} else echo '<ul class="notifications-container"><li><p>Không có thêm thông báo để hiển thị tại thời điểm này</p></li></ul>';
								?>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group user-dropdown">
                            <?php echo '<div aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown"><span>' . $USER[0] . '</span><img class="user-avatar-small" src="' . $USER[4] . '" alt="' . $USER[0] . '"></div>';?>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-dropdown-header">
                                    <div class="user-dropdown-header-left">
                                        <?php echo '<a class="link" href="' . HOME_URL_LANG . '/user/edit-profile"><img class="user-avatar-medium" src="' . $USER[4] . '" alt="' . $USER[0] . '"></a>';?>
                                    </div>
                                    <div class="user-dropdown-header-right">
                                        <?php echo '<p class="name">' . $USER[0] . '</p>';?>
                                        <div class="user-icon abs">
                                            <a class="link" href="<?php echo HOME_URL_LANG;?>/user/edit-profile"><i
                                                    class="fa fa-user"></i></a>
                                            <a class="link" href="<?php echo HOME_URL_LANG;?>/user/edit-account"><i
                                                    class="fa fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-dropdown-links">
                                    <a class="link" href="<?php echo HOME_URL_LANG . '/my-courses';?>">Các khoá học của
                                        tôi</a>
                                    <a class="link" href="<?php echo HOME_URL_LANG . '/my-wishlist';?>">Danh sách đang
                                        quan tâm</a>
                                    <a class="link" href="<?php echo HOME_URL_LANG . '/examination';?>">Kỳ kiểm tra &
                                        Kết quả</a>
                                    <a class="link" href="javascript:;" data-target="#el-modal" data-toggle="modal"
                                        onclick="return open_modal(0, 'self_test');">Tự kiểm tra</a>
                                </div>
                                <div class="user-dropdown-logout">
                                    <a class="btn btn-flat btn-logout" onclick="return logout();"><i
                                            class="fa fa-power-off"></i> Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="hd-user">
                        <a class="btn-register" data-target="#register-modal" data-toggle="modal"
                            href="javascript:;">Đăng ký</a>
                        <a class="btn-login" data-target="#login-modal" data-toggle="modal" href="javascript:;">Đăng
                            nhập</a>
                        <!-- Register -->
                        <div class="modal fade" id="register-modal" tabindex="-1" role="dialog"
                            aria-labelledby="registerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" class="close" data-dismiss="modal"
                                            type="button">×</button>
                                        <h3 class="modal-title">ĐĂNG KÝ</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form id="register" name="fr_register" method="post"
                                            onsubmit="return register_user('register');">
                                            <p class="sub-title">Đăng ký tài khoản dành cho học viên.</p>
                                            <div class="form-control-wrapper">
                                                <input class="form-control" type="text" name="user"
                                                    placeholder="Tên tài khoản..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input class="form-control" type="password" name="password"
                                                    placeholder="Mật khẩu..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input class="form-control" type="password" name="re_password"
                                                    placeholder="Nhập lại mật khẩu..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input class="form-control" type="text" name="name"
                                                    placeholder="Họ và tên..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input class="form-control" type="text" name="tel"
                                                    placeholder="Số điện thoại..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input class="btn btn-login-submit" type="submit" id="_btn_register"
                                                    name="reg" value="Đăng ký">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="_result_register" class="result"></div>
                                        <p class="bottom-text">Đã có tài khoản? <a class="btn-link" data-dismiss="modal"
                                                data-target="#login-modal" data-toggle="modal" href="javascript:;">Đăng
                                                nhập</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            check_register();
                        });
                        </script>
                        <!-- Login -->
                        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog"
                            aria-labelledby="loginModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" class="close" data-dismiss="modal"
                                            type="button">×</button>
                                        <h3 class="modal-title">ĐĂNG NHẬP</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form id="sign-in" name="signin" method="post"
                                            onsubmit="return sign_in('sign-in');">
                                            <p class="sub-title">Đăng nhập tài khoản dành cho học viên.</p>
                                            <div class="form-control-wrapper">
                                                <input type="text" class="form-control" name="user"
                                                    placeholder="Tên tài khoản..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Mật khẩu..." required autocomplete="off">
                                            </div>
                                            <div class="form-control-wrapper">
                                                <input class="btn btn-login-submit" type="submit" value="Đăng nhập">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="_result_login" class="result"></div>
                                        <p class="bottom-text">Chưa có tài khoản? <a class="btn-link"
                                                data-dismiss="modal" data-target="#register-modal" data-toggle="modal"
                                                href="javascript:;">Đăng ký</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- / .header -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
var timestamp = '<?=time();?>';

function updateTime(){
  var date = new Date(timestamp * 1000);
  var optionsTime = { timeZone: 'Asia/Ho_Chi_Minh', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false };
  var timeString = date.toLocaleTimeString('vi-VN', optionsTime);
  var day = String(date.getDate()).padStart(2, '0');
  var month = String(date.getMonth() + 1).padStart(2, '0');
  var year = date.getFullYear();
  var dayOfWeek = date.toLocaleDateString('vi-VN', { weekday: 'long', timeZone: 'Asia/Ho_Chi_Minh' });
  var dateString = dayOfWeek + ', ' + day + '-' + month + '-' + year;

  $('#time').html(dateString + ', ' + timeString);
  timestamp++;
}

$(function(){
  setInterval(updateTime, 1000);
});
</script>
<?php
$db->table = "product_menu";
$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = 89";
$db->order = "`sort` ASC";
$db->limit = "";
$rows = $db->select();
$total1 = $db->RowCount;
//---
$slug94 = getSlugCategory(94);
$db->table = "article_menu";
$db->condition = "`is_active` = 1 AND `hot` = 1 AND `parent` = 0 AND `category_id` = 94";
$db->order = "`sort` ASC";
$db->limit = "";
$rows_post = $db->select();
$total2 = $db->RowCount;
//---
/*
if($total1>0) {
	$style = '';
	if($slug_cat!='home') $style = ' style="margin-left: -240px;"';
	//echo '<div class="slider-sidebar-wrapper slider-sidebar-fixed"' .  $style .'><ul class="dropdown-menu sidebar-category">';
	if($account["id"]>0) echo '<li class="btn btn-flat category-item"><a href="' . HOME_URL_LANG . '/my-courses' . '" title="Các khoá học của tôi"><i class="mdi mdi-clipboard-account"></i> Các khoá học của tôi</a></li>';
	foreach($rows as $row) {
		echo '<li class="btn btn-flat category-item"><a href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '"><i class="mdi ' . stripslashes($row['icon']) . '"></i> ' . stripslashes($row['name']) . '</a>' . loadMenu($slug, $row['product_menu_id']) . '</li>';
	}
	if($total2>0) {
		foreach($rows_post as $row_post) {
			echo '<li class="btn btn-flat category-item"><a href="' . HOME_URL_LANG . '/' . $slug94 . '/' . stripslashes($row_post['slug']) . '" title="' . stripslashes($row_post['name']) . '"><i class="mdi ' . stripslashes($row_post['icon']) . '"></i> ' . stripslashes($row_post['name']) . '</a></li>';
		}
	}
	echo '</ul></div>';
} */
?>