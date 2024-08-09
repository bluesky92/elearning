<?php
@ob_start();
@session_start();
// System
define( 'TTH_SYSTEM', true );

$url = isset($_GET['url']) ? (string) $_GET['url'] : 'intro';
$url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
$path = array();
$path = explode('/',$url);
if($path[0]=='en') {
	$_SESSION["language"] = 'en';
} elseif($path[0]=='vi') {
	$_SESSION["language"] = 'vi';
} else {
	$_SESSION["language"] = 'vi';
	array_unshift($path, 'vi');
}
//----------------------------------------------------------------------------------------------------------------------
require_once(str_replace( DIRECTORY_SEPARATOR, '/', dirname( __file__ ) ) . '/define.php');
require_once(ROOT_DIR . DS ."lang" . DS . TTH_LANGUAGE . ".lang");
include_once(_F_FUNCTIONS . DS . "Function.php");
try {
	$db =  new ActiveRecord(TTH_DB_HOST, TTH_DB_USER, TTH_DB_PASS, TTH_DB_NAME);
}
catch(DatabaseConnException $e) {
	echo $e->getMessage();
}
$account["id"] = empty($_SESSION["personnel"]) ? 0 : intval($_SESSION["personnel"]);
$USER = getInfoUser($account["id"]);
include_once(_F_INCLUDES . DS . "_tth_constants.php");
include_once(_F_INCLUDES . DS . "_tth_url.php");
include_once(_F_INCLUDES . DS . "_tth_online_daily.php");
$TTH_editor = 0;
//---
if(in_array($slug_cat, array('dien-dan', 'khoa-hoc', 'examination'))) {
    $zz_id = $id_article;
	if($slug_cat=='dien-dan') $zz_type = 'forum';
	elseif($slug_cat=='khoa-hoc') $zz_type = 'product';
    elseif($slug_cat=='examination') {
        $zz_type = 'examination';
        $zz_id = isset($_GET['post']) ? intval($_GET['post']) : 0;
    }
    //---
	if($zz_id>0) updateNotify($zz_type, $zz_id, $account["id"], 1);
}
?>
<!DOCTYPE html>
<html lang="<?php echo TTH_LANGUAGE;?>">
<head>
<?php
include(_F_INCLUDES . DS . "_tth_head.php");
?>
</head>
<body>
<?php echo getConstant('script_body');?>
<!-- #wrapper -->
<div id="wrapper">
<?php
if($slug_cat=='intro') {
	if($account["id"]>0) exit(header('Location: ' . HOME_URL_LANG . '/home'));
	include(_F_MODULES . DS . "intro.php");
} else {
	$courses = isset($_GET['list']) ? intval($_GET['list']) : 0;
	$db->table = "product_logs";
	$db->condition = "`product_id` = $id_article AND `user_id` = " . $account["id"];
	$db->order = "";
	$db->limit = 1;
	$db->select();
	$product_logs = $db->RowCount;

	$db->table = "courses";
	$db->condition = "`is_active` = 1 AND `product_id` = $id_article AND `courses_id` = $courses";
	$db->order = "";
	$db->limit = 1;
	$rows_crs = $db->select();
	if ($account["id"] > 0 && $db->RowCount > 0 && $slug_cat == 'khoa-hoc' && $product_logs > 0) {
		$TTH_editor = 1;
		include(_F_MODULES . DS . "courses.php");
	} else {
		include(_F_INCLUDES . DS . "tth_header.php");
		echo '<section class="container-wrapper">';
		include(_F_MODULES . DS . str_replace('-', '_', $slug_cat) . ".php");
		echo '</section>';
		include(_F_INCLUDES . DS . "tth_footer.php");
	}
}
?>
</div>
<!-- / #wrapper -->
<div id="_loading"></div>

<!-- Modal -->
<div class="modal fade" id="el-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="elModalLabel" aria-hidden="true"></div>
<!-- /.modal -->
<?php
if($account["id"]>0) echo '<a class="self-test-fixed" data-target="#el-modal" data-toggle="modal" href="javascript:;" onclick="return open_modal(0, \'self_test\');" title="Tự kiểm tra">Tự kiểm tra</a>';
include(_F_INCLUDES . DS . "_tth_script.php");
echo getConstant('script_bottom');
//if($slug_cat=='home'){ require_once("popup" . DS . "popup.php");}
?>
</body>
</html>