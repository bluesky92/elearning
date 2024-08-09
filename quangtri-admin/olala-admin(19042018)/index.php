<?php
@session_start();
// System
define( 'TTH_SYSTEM', true );
$_SESSION["language"] = (!empty($_SESSION["lang_admin"]) && isset($_SESSION["lang_admin"])) ? $_SESSION["lang_admin"] : 'vi';

require_once('..' . DIRECTORY_SEPARATOR . 'define.php');
include_once(_A_FUNCTIONS . DS . "Function.php");
try {
	$db =  new ActiveRecord(TTH_DB_HOST, TTH_DB_USER, TTH_DB_PASS, TTH_DB_NAME);
}
catch(DatabaseConnException $e) {
	echo $e->getMessage();
}
include_once(_F_INCLUDES . DS . "_tth_constants.php");
require_once(ROOT_DIR . DS . ADMIN_DIR . DS . '_check_login.php');
if($login_true) {
	$tth =  isset($_GET[TTH_PATH]) ? $_GET[TTH_PATH] : 'home';
	include_once(_A_FUNCTIONS . DS . "ContentManager.php");

	$corePrivilegeSlug = array();
	$corePrivilegeSlug = corePrivilegeSlug();

	if(in_array($tth, array('core_user_edit', 'discussion_list', 'forum_comment', 'examination_list', 'article_menu_edit', 'article_edit', 'gallery_menu_edit', 'gallery_edit', 'product_menu_edit', 'product_edit', 'courses_edit', 'forum_menu_edit', 'examination_edit'))) {
		$zz_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$zz_type = '';
		if($tth=='core_user_edit') $zz_type = 'user';
		elseif($tth=='discussion_list') $zz_type = 'product';
		elseif($tth=='forum_comment') $zz_type = 'forum';
        elseif($tth=='examination_list') $zz_type = 'examination';
        elseif($tth=='article_menu_edit') $zz_type = 'active/article_menu';
        elseif($tth=='article_edit') $zz_type = 'active/article';
        elseif($tth=='gallery_menu_edit') $zz_type = 'active/gallery_menu';
        elseif($tth=='gallery_edit') $zz_type = 'active/gallery';
        elseif($tth=='product_menu_edit') $zz_type = 'active/product_menu';
        elseif($tth=='product_edit') $zz_type = 'active/product';
        elseif($tth=='courses_edit') $zz_type = 'active/courses';
        elseif($tth=='forum_menu_edit') $zz_type = 'active/forum_menu';
        elseif($tth=='examination_edit') $zz_type = 'active/examination';
		updateNotify($zz_type, $zz_id, $_SESSION["user_id"], 1);
	}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<?php
include(_A_INCLUDES . DS . "tth_head.php");
?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <?php
            include(_A_INCLUDES . DS . "tth_header.php");
            ?>
            <div class="navbar-default sidebar" role="navigation">
				<?php
				include(_A_INCLUDES . DS . "tth_menu.php");
                ?>
            </div>
        </nav>
        <div id="page-wrapper">
            <?php
            if (is_file(_A_MODULES . DS . $tth .".php"))
                include(_A_MODULES . DS . $tth .".php");
            else loadPageAdmin("Hiện tại chưa hỗ trợ chức năng này.", ADMIN_DIR);
            ?>
	        <!-- Modal -->
	        <div class="modal fade" id="_notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
	        <!-- /.modal -->
        </div>
        <!-- /#page-wrapper -->
	    <div id="footer-admin">
		    <?php
		    include(_A_INCLUDES . DS . "tth_footer.php");
		    ?>
		</div>

    </div>

    <a href="javascript:void(0)" title="Lên đầu trang" id="btnGoTop">
	    <span id="toTopHover"></span>
    </a>

    <div id="loadingPopup" style="z-index: 999999999;"></div>
</body>
</html>
	<!-- Tooltip -->
	<script>
	$('#wrapper').tooltip({
		selector: "[data-toggle=tooltip]",
		container: "body"
	});
	$('#dataTablesList').find('input[type="checkbox"]').shiftSelectable();
	</script>
<?php
}
else include("login.php");
